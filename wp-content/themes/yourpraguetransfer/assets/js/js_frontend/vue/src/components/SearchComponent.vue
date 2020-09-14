<template>
    <div class="searchComponent">

        <!-- REKAPITULACE -->
        <section id="your-way" class="container-fluid text-white">
            <div class="s7_underpage-slider-sw s7_sw-sec mx-auto">
                <h1 class="text-center text-white text-uppercase font-weight-bold pb-2">Vaše cesta</h1>
                <div class="s7_place-ftw d-flex align-items-center flex-md-row flex-column justify-content-center">
                    <div class="s7_place-start d-flex align-items-center">
                        <i class="fas text-white fa-map-marker-alt mr-3"></i>
                        <p class="text-white font-weight-light mb-0">{{this.destination_from}}</p>
                    </div>
                    <div class="s7_ftw-arrows">
                        <i class="fas fa-caret-right mr-2 text-white"></i>
                        <i class="fas fa-caret-right mr-2 text-white"></i>
                        <i class="fas fa-caret-right text-white"></i>
                    </div>
                    <div class="s7_place-finish d-flex align-items-center">
                        <i class="fas text-white fa-map-marker-alt mr-3"></i>
                        <p class="text-white font-weight-light mb-0">{{this.destination_to}}</p>
                    </div>
                </div>
                <div class="s7_underpage-col-row mx-auto d-flex justify-content-center">
                    <div class="s7_underpage-ico d-flex align-items-center">
                        <figure class="mb-0"><img :src="images_path + '/route.png'" alt="" class="w-100"></figure>
                        <p class="s7_underpage-text font-weight-light text-white mb-0"><strong class="text-white">{{distance}}</strong> Km</p>
                    </div>
                    <div class="s7_underpage-ico d-flex align-items-center">
                        <figure class="mb-0"><img :src="images_path + '/time.png'" alt="" class="w-100"></figure>
                        <p class="s7_underpage-text font-weight-light text-white mb-0"><strong class="text-white">{{duration | duration('humanize', {d: 7, w: 4, h:60, d: 24, m: 60}) }}</strong></p>
                    </div>
                    <div class="s7_underpage-ico d-flex align-items-center">
                        <figure class="mb-0"><img :src="images_path + '/money.png'" alt="" class="w-100"></figure>
                        <p class="s7_underpage-text font-weight-light text-white mb-0">od <strong class="text-white">580</strong> Kč</p>
                    </div>
                </div>
                <a href="#" class="btn rounded-0 w-100 font-weight-bold d-flex align-items-center justify-content-between mx-auto text-uppercase"><span class="text-white">Změnit cestu</span><i class="fas fa-chevron-right text-white"></i></a>
            </div>
        </section>


        <!-- MAPA A SEZNAM -->
        <section id="search-map" class="container-fluid row mx-0">
            <div class="s7_car-col col-xl-6 col-12 pr-0">
                <form action="">
                    <select name="sorting_name" id="sorting_id" class="text-uppercase border-0 rounded-0 w-100">
                        <option value="default"><span>Řadit dle </span><i class="fas fa-chevron-down"></i></option>
                    </select>
                    <select name="currency_name" id="curreny_id" class="text-uppercase border-0 rounded-0 w-100">
                        <option value="default"><span>Měna </span><i class="fas fa-chevron-down"></i></option>
                    </select>
                </form>


                <div class="s7_nabidka-aut">
                    <div class="s7_nabidka-aut-info d-flex" v-for="auto in this.car_offers">
                        <figure class="s7_res-car-img mb-0 position-relative"><img :src="images_path + '/auto-reservation.png'" alt=""></figure>
                        <div class="s7_car-text">
                            <div class="d-flex align-items-center">
                                <h3 class="font-weight-bold mr-3 mb-0">{{auto.class}}</h3>
                                <div class="s7_nabidka-aut-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="s7_nabidka-aut-typ-auto font-italic mb-1">{{auto.name}}</div>
                            <p class="s7_nabidka-aut-popis">{{auto.short_desc}} <button class="border-0 radius-0"><i class="far fa-image"></i>Více fotografií</button></p>
                        </div>
                        <div class="s7_reservation-buttons w-100">
                            <div class="s7_res-button-one-way d-flex align-items-center">
                                <div class="s7_res-price w-100 font-weight-bold"><p class="s7_res-big-text">{{auto.one_way}} <span class="s7_res-normal-text">Kč</span></p><p class="s7_res-small-text mb-0">jednosměrná</p></div>
                                <a href="#" class="s7_res-btn w-100 btn rounded-0 border-0 text-uppercase d-flex justify-content-between align-items-center"><span class="text-white">Rezervovat</span><i class="fas fa-chevron-right text-white"></i></a>
                            </div>
                            <div class="s7_res-button-two-way d-flex align-items-center">
                                <div class="s7_res-price w-100 font-weight-bold"><p class="s7_res-big-text">{{auto.two_way}} <span class="s7_res-normal-text">Kč</span></p><p class="s7_res-small-text mb-0">obousměrná</p></div>
                                <a href="#" class="s7_res-btn w-100 btn rounded-0 border-0 text-uppercase d-flex justify-content-between align-items-center"><span class="text-white">Rezervovat</span><i class="fas fa-chevron-right text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="s7_nabidka-aut-sluzby d-flex flex-row">
                        <div class="s7_reservation-ico text-center d-flex align-items-center">
                            <figure class="s7_res-ico mb-0"><img :src="images_path + '/res-ico-4.png'" alt="láhev vody" class="s7_reservation-ico-img"></figure>
                            <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Pití zdarma</p>
                        </div>
                        <div class="s7_reservation-ico text-center d-flex align-items-center">
                            <figure class="s7_res-ico mb-0"><img :src="images_path + '/res-ico-1.png'" alt="platební karty" class="s7_reservation-ico-img"></figure>
                            <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Platba online</p>
                        </div>
                        <div class="s7_reservation-ico text-center d-flex align-items-center">
                            <figure class="s7_res-ico mb-0"><img :src="images_path + '/res-ico-3.png'" alt="štít" class="s7_reservation-ico-img"></figure>
                            <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Bezpečnost</p>
                        </div>
                        <div class="s7_reservation-ico text-center d-flex align-items-center">
                            <figure class="s7_res-ico mb-0"><img :src="images_path + '/res-ico-2.png'" alt="wifi" class="s7_reservation-ico-img"></figure>
                            <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Wifi na palubě</p>
                        </div>
                        <div class="s7_reservation-ico text-center d-flex align-items-center">
                            <figure class="s7_res-ico mb-0"><img :src="images_path + '/res-ico-4.png'" alt="nonstop" class="s7_reservation-ico-img"></figure>
                            <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Pití zdarma</p>
                        </div>
                        <div class="s7_reservation-ico text-center d-flex align-items-center">
                            <figure class="s7_res-ico mb-0"><img :src="images_path + '/res-ico-1.png'" alt="platební karty" class="s7_reservation-ico-img"></figure>
                            <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Platba online</p>
                        </div>
                    </div>
                </div>



            </div>
            <div class="s7_map-col col-xl-6 col-12 px-0">
                <div id="map" class="s7_mapitself"></div>
            </div>
        </section>

        <!-- KONTAKT -->
        <section id="res-contact" class="container-fluid d-flex justify-content-center">
            <div class="s7_res-contact-phone d-flex align-items-center">
                <figure class="mb-0"><img :src="this.images_path + '/phone.png'" alt="phone" class="s7_res-contact-ico-img w-100"></figure>
                <a href="tel:+420 722 855 989" class="s7_res-contact-ico-text font-weight-bold text-decoration-none">+420 722 855 989</a>
            </div>
            <div class="s7_res-contact-envelope d-flex align-items-center">
                <figure class="mb-0"><img :src="this.images_path + '/envelope.png'" alt="phone" class="s7_res-contact-ico-img w-100"></figure>
                <a href="mailto:info@yourpraguetransfers.cz" class="s7_res-contact-ico-text font-weight-bold text-decoration-none">info@yourpraguetransfers.cz</a>
            </div>
            <div class="s7_res-contact-map d-flex align-items-center">
                <figure class="mb-0"><img :src="this.images_path + '/map-mark.png'" alt="phone" class="s7_res-contact-ico-img w-100"></figure>
                <span class="s7_res-contact-ico-text font-weight-bold">Evropská 27, 247 89, Praha 6</span>
            </div>
        </section>
    </div>
</template>

<script>
    import {Loader, LoaderOptions} from 'google-maps';
    import Axios from "axios";
    import VueAxios from 'vue-axios';


    export default {
        name: "search-component",
        data: function(){
            return {
                google: null,
                google_map: null,
                distance: 0,
                duration: 0,
                currency: 0,
                sortBy: 0,
                loading: true,
                car_offers: [
                    {
                        id: 0,
                        class: "High Class",
                        stars: 5,
                        name: "Škoda Superb Lauring Clement",
                        one_way: 580,
                        two_way: 1000,
                        short_desc: "Toto je testovací popisek, buď hodný pejsku",
                        top: true
                    }
                ]
            }
        },
        props: {
            images_path: {
                required: true,
                type: String
            },
            destination_from: {
                required: true,
                type: String
            },
            destination_to: {
                required: true,
                type: String
            },
            destination_from_lat_lng: {
                required: true,
                type: Object
            },
            destination_to_lat_lng: {
                required: true,
                type: Object
            },
            google_api_key: {
                required: true,
                type: String
            },
            api_url: {
                required: true,
                type: String
            }
        },
        async mounted() {
            // start map
            try {
                const options = {libraries: ['places']};
                const loader = new Loader(this.google_api_key, options);
                const google = await loader.load();
                this.google = google;
                this.createRoute();

            } catch (error) {
                console.error(error);
            }
        },
        methods: {
            buildMap: function () {
                const map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: 50.167741, lng: 14.398851},
                    zoom: 8,
                });
                this.google_map = map;
                return map;
            },
            createRoute: function () {
                var directionsService = new google.maps.DirectionsService();
                var directionsDisplay = new google.maps.DirectionsRenderer();
                var _this = this;

                var selectedMode = 'DRIVING';
                var request = {
                    origin: this.destination_from_lat_lng,
                    destination: this.destination_to_lat_lng,
                    travelMode: google.maps.TravelMode[selectedMode]
                };
                directionsService.route(request, function(response, status) {

                    if (status == 'OK') {

                        var map = _this.buildMap();
                        directionsDisplay.setDirections(response);
                        directionsDisplay.setMap(map);

                        _this.distance = Math.round(response.routes[0].legs[0].distance.value / 1000);
                        _this.duration = response.routes[0].legs[0].duration.value * 1000;
                        _this.fetchCarsAndPrices();

                    }else {

                    }

                    _this.loading = false;
                });
            },
            fetchCarsAndPrices: function () {
                var _this = this;
                var request = {
                    from_lat_lng: _this.destination_from_lat_lng,
                    to_lat_lng: this.destination_to_lat_lng,
                };

                var finalurl = _this.api_url + "?action=getCarOffers";

                console.log(request);

                Axios.post(finalurl, request).then(function (response) {
                    if (response)
                        if(typeof response.data == "object"){

                        }else{
                            console.error("Data is not type of Object");
                        }
                }).catch(function (error) {
                    console.error(error);
                });
            }
        }
    }
</script>

<style scoped>

</style>