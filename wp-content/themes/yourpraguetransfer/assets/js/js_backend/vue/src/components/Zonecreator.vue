<template>
    <div class="zoneContainer">
        <div class="polygonList">
            <h5>Seznam polygonů v zóně</h5>
            <ul>
                <li v-for="(polygon, index) in polygons" @mouseenter="highlightPolygon(polygon)" @mouseleave="unhighlightPolygon(polygon)">
                    <span class="polygonName">{{index+1}}. polygon</span>
                    <i class="fas fa-trash" @click="removePolygon(index, polygon)"></i>
                </li>
            </ul>
        </div>
        <div id="zoneMap" class="zonesMap" style="height: 500px;"></div>
        <input type="hidden" v-for="(polygon, index) in polygons" :name="'polygon_'+index" value="test" :value="getPolygonCords(polygon)">
    </div>
</template>

<script>

    import LoadScript from 'vue-plugin-load-script';
    import Vue from 'vue';

    Vue.use(LoadScript);

    export default {
        name: "Zonecreator",
        props: {
            prerender_zones: {
                required: false,
                type: Array,
                default: {}
            },
            prerender_editable_zones: {
                required: false,
                type: Array,
                default: {}
            }
        },
        data: function(){
            return {
                map: null,
                drawingManager: null,
                polygons: []
            }
        },
        mounted() {

            // establish map
            Vue.loadScript('https://maps.googleapis.com/maps/api/js?key=' + serverData.google_api_key + '&libraries=drawing,places').then(() => {
                this.initMap();
            }).catch((er) => {
                console.error(er);
                console.error("Fail to initialize map libraries");
            });

        },
        methods: {
            initMap: function () {

                var souradnice = {lat: 49.865529, lng: 15.183360};
                var zoom = 7;

                map = new google.maps.Map(document.getElementById("zoneMap"), {
                    center: souradnice,
                    zoom: zoom
                });

                var drawingManager = new google.maps.drawing.DrawingManager({
                    drawingMode: google.maps.drawing.OverlayType.POLYGON,
                    drawingControl: true,
                    drawingControlOptions: {
                        position: google.maps.ControlPosition.TOP_CENTER,
                        drawingModes: ['polygon']
                    },
                    markerOptions: {icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'},
                    polygonOptions: {
                        fillColor: "yellow",
                        fillOpacity: 0.35,
                        strokeWeight: 3,
                        clickable: false,
                        editable: true,
                        zIndex: 99
                    },
                });

                drawingManager.setMap(map);

                this.map = map;
                this.drawingManager = drawingManager;
                this.initListeners();
                this.renderOtherZones();
                this.renderCurrentZone();
            },
            initListeners: function () {
                var _this = this;
                google.maps.event.addListener(_this.drawingManager, 'overlaycomplete', function(event) {
                    // dokončení cesty

                    if (event.type === google.maps.drawing.OverlayType.POLYGON) {
                        _this.polygons.push(event.overlay);
                        var newId = _this.polygons.length-1;
                        var layer = event.overlay;

                        // možnost mazání bodů
                        google.maps.event.addListener(event.overlay, 'rightclick', function(mev) {
                            if (mev.vertex != null) {
                                if(layer.getPath().getArray().length > 3){
                                    layer.getPath().removeAt(mev.vertex);
                                }
                            }
                        });

                        google.maps.event.addListener(layer.getPath(), 'insert_at', function(index, obj) {
                            _this.changePath(newId, this);
                        });

                        google.maps.event.addListener(layer.getPath(), 'set_at', function(index, obj) {
                            _this.changePath(newId, this);
                        });

                    }
                });
            },
            getCords: function (overlay){
                var path = [];

                if(typeof overlay.getArray == "function"){
                    $.each(overlay.getArray(), function (key, latlng) {
                        var lat = latlng.lat();
                        var lng = latlng.lng();
                        path.push(new bodClass(lat, lng));
                    });
                    return path;
                }

                $.each(overlay.getPath().getArray(), function (key, latlng) {
                    var lat = latlng.lat();
                    var lng = latlng.lng();
                    path.push(new bodClass(lat, lng));
                });
                return path;
            },
            highlightPolygon: function (polygon) {
                polygon.setOptions({fillOpacity: 1});
            },
            unhighlightPolygon: function (polygon) {
                polygon.setOptions({fillOpacity: 0.35});
            },
            removePolygon: function (index, polygon) {
                polygon.setMap(null);
                this.polygons.splice(index, 1);
            },
            getPolygonCords: function (polygon) {
                return JSON.stringify(this.getCords(polygon));
            },
            renderOtherZones: function () {
                var bounds = new google.maps.LatLngBounds();
                for(var index in this.prerender_zones){
                    var cords = this.prerender_zones[index];
                    var polygon = new google.maps.Polygon({
                        paths: cords,
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.6,
                        strokeWeight: 1,
                        fillColor: '#FF0000',
                        fillOpacity: 0.15
                    });
                    polygon.setMap(this.map);
                    for(var vertex in this.prerender_zones[index]){
                        var vertexObj = this.prerender_zones[index][vertex];
                        bounds.extend(vertexObj);
                    }
                }
                this.map.fitBounds(bounds);

            },
            renderCurrentZone: function () {
                if(this.prerender_editable_zones.length > 0){
                    var bounds = new google.maps.LatLngBounds();

                    for(var index in this.prerender_editable_zones){
                        var cords = this.prerender_editable_zones[index];
                        var polygon = new google.maps.Polygon({
                            paths: cords,
                            strokeColor: '#0000FF',
                            strokeOpacity: 0.6,
                            strokeWeight: 1,
                            fillColor: '#0000FF',
                            fillOpacity: 0.15
                        });
                        polygon.setMap(this.map);
                        polygon.setEditable(true);
                        this.polygons.push(polygon);
                        var newId = this.polygons.length-1;

                        var _this = this;
                        google.maps.event.addListener(polygon.getPath(), 'insert_at', function(index, obj) {
                            _this.changePath(newId, this);
                        });

                        google.maps.event.addListener(polygon.getPath(), 'set_at', function(index, obj) {
                            _this.changePath(newId, this);
                        });


                        for(var vertex in this.prerender_editable_zones[index]){
                            var vertexObj = this.prerender_editable_zones[index][vertex];
                            bounds.extend(vertexObj);
                        }
                    }
                    this.map.fitBounds(bounds);
                }
            },
            changePath: function (id, path) {
                this.polygons[id] = path;
                this.$forceUpdate();
            }
        }
    }
</script>

<style scoped>
    .zoneContainer{
        display: flex;
    }

    .polygonList{
        flex-basis: calc(30% - 15px);
        margin-right: 15px;
        padding: 10px;
        background-color: #f3f3f3;
    }

    .polygonList li{
        background-color: green;
        padding: 5px 10px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .polygonList li i {
        cursor: pointer;
    }

    .polygonList li:hover{
        background-color: darkgreen;
    }

    .zonesMap{
        flex-basis: 70%;
    }

</style>