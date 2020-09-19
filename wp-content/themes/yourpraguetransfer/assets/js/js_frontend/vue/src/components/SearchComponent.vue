<template>
    <div class="searchComponent" :class="{componentLoading: this.loading}">

        <!-- REKAPITULACE -->
        <section id="your-way" class="container-fluid text-white">
            <div class="s7_underpage-slider-sw s7_sw-sec mx-auto">
                <h1 class="text-center text-white text-uppercase font-weight-bold pb-2">Vaše cesta</h1>
                <div class="s7_place-ftw d-flex align-items-center flex-md-row flex-column justify-content-center">
                    <div class="s7_place-start d-flex align-items-center">
                        <i class="fas text-white fa-map-marker-alt mr-3"></i>
                        <p class="text-white font-weight-light mb-0">{{this.ddestination_from}}</p>
                    </div>
                    <div class="s7_ftw-arrows">
                        <i class="fas fa-caret-right mr-2 text-white"></i>
                        <i class="fas fa-caret-right mr-2 text-white"></i>
                        <i class="fas fa-caret-right text-white"></i>
                    </div>
                    <div class="s7_place-finish d-flex align-items-center">
                        <i class="fas text-white fa-map-marker-alt mr-3"></i>
                        <p class="text-white font-weight-light mb-0">{{this.ddestination_to}}</p>
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
                <a :href="home_url" class="btn rounded-0 w-100 font-weight-bold d-flex align-items-center justify-content-between mx-auto text-uppercase">
                    <span class="text-white">Změnit cestu</span>
                    <i class="fas fa-chevron-right text-white"></i>
                </a>
            </div>
        </section>


        <!-- MAPA A SEZNAM -->
        <section id="search-map" class="container-fluid row mx-0">
            <div class="s7_car-col col-xl-6 col-12 pr-0">
                <form action="">
                    <select name="sorting_name" id="sorting_id" class="text-uppercase border-0 rounded-0 w-100" v-model="sortBy">
                        <option value="0" selected>Řadit dle: Ceny vzestupně</option>
                        <option value="1">Řadit dle: Ceny sestupně</option>
                    </select>
                    <select name="currency_name" id="curreny_id" class="text-uppercase border-0 rounded-0 w-100" v-model="currency">
                        <option value="0" selected>Měna: CZK</option>
                        <option value="1">Měna: EUR</option>
                    </select>
                </form>


                <div class="s7_nabidka-aut">
                    <div class="s7_nabidka-aut-info d-flex flex-wrap" v-for="(auto, index) in cars_offers" :key="index">
                        <figure class="s7_res-car-img mb-0 position-relative mb-2" :class="{top: parseInt(auto.db_top)==1}">
                            <img :src="getFrontImage(auto)" alt="" class="img-fluid">
                        </figure>
                        <div class="s7_car-text">
                            <div class="d-flex align-items-center">
                                <h3 class="font-weight-bold mr-3 mb-0">{{auto.db_trida}}</h3>
                                <div class="s7_nabidka-aut-stars">
                                    <i class="fas fa-star" v-for="hvezda in parseInt(auto.db_hvezdy)"></i>
                                </div>
                            </div>
                            <div class="s7_nabidka-aut-typ-auto font-italic mb-1">{{auto.db_nazev}}</div>
                            <p class="s7_nabidka-aut-popis">
                                {{getPopis(auto)}}
                                <gallery :images="getRestPhotos(auto)" :index="image_index" v-if="getRestPhotos(auto).length > 0" @close="image_index = null"></gallery>
                                <button class="border-0 radius-0" @click="image_index=0" v-if="getRestPhotos(auto).length > 0"><i class="far fa-image"></i>Více fotografií</button>
                            </p>
                        </div>
                        <div class="s7_reservation-buttons">
                            <div class="s7_res-button-one-way d-flex align-items-center">
                                <div class="s7_res-price w-100 font-weight-bold">
                                    <p class="s7_res-big-text">{{getPriceTowards(auto) | format_price}} <span class="s7_res-normal-text">{{currency_label}}</span></p>
                                    <p class="s7_res-small-text mb-0">jednosměrná</p></div>
                                <a href="#" data-toggle="modal" data-target="#Modal-form-1" @click="openPopup(auto, getPriceTowards(auto), false)" class="s7_res-btn w-100 btn rounded-0 border-0 text-uppercase d-flex justify-content-between align-items-center">
                                    <span class="text-white">Rezervovat</span>
                                    <i class="fas fa-chevron-right text-white"></i>
                                </a>
                            </div>
                            <div class="s7_res-button-two-way d-flex align-items-center">
                                <div class="s7_res-price w-100 font-weight-bold">
                                    <p class="s7_res-big-text">{{getPriceBackwards(auto) | format_price}} <span class="s7_res-normal-text">{{currency_label}}</span></p>
                                    <p class="s7_res-small-text mb-0">obousměrná</p></div>
                                <a href="#" data-toggle="modal" data-target="#Modal-form-1" @click="openPopup(auto, getPriceBackwards(auto), true)" class="s7_res-btn w-100 btn rounded-0 border-0 text-uppercase d-flex justify-content-between align-items-center">
                                    <span class="text-white">Rezervovat</span>
                                    <i class="fas fa-chevron-right text-white"></i>
                                </a>
                            </div>
                        </div>

                        <div class="s7_nabidka-aut-sluzby d-flex flex-row">
                            <div class="s7_reservation-ico text-center d-flex align-items-center" v-if="parseInt(auto.db_voda) === 1">
                                <figure class="s7_res-ico mb-0"><img :src="images_path + '/res-ico-4.png'" alt="láhev vody" class="s7_reservation-ico-img"></figure>
                                <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Pití zdarma</p>
                            </div>
                            <div class="s7_reservation-ico text-center d-flex align-items-center" v-if="parseInt(auto.db_wifi) === 1">
                                <figure class="s7_res-ico mb-0"><img :src="images_path + '/res-ico-2.png'" alt="wifi" class="s7_reservation-ico-img"></figure>
                                <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Wifi na palubě</p>
                            </div>

                            <div class="s7_reservation-ico text-center d-flex align-items-center" v-if="parseInt(auto.db_vyzvednuti) === 1">
                                <figure class="s7_res-ico mb-0"><img :src="images_path + '/res-ico-1.png'" alt="nonstop" class="s7_reservation-ico-img"></figure>
                                <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Vyzvednutí v odletové hale</p>
                            </div>
                            <div class="s7_reservation-ico text-center d-flex align-items-center" v-if="parseInt(auto.db_klimatizace) === 1">
                                <figure class="s7_res-ico mb-0"><img :src="images_path + '/res-ico-3.png'" alt="platební karty" class="s7_reservation-ico-img"></figure>
                                <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Klimatizované vozidlo</p>
                            </div>
                            <div class="s7_reservation-ico text-center d-flex align-items-center" v-if="parseInt(auto.db_voucher) === 1">
                                <figure class="s7_res-ico mb-0"><img :src="images_path + '/res-ico-5.png'" alt="platební karty" class="s7_reservation-ico-img"></figure>
                                <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Voucher na turistiku</p>
                            </div>
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

        <ReservationForms
            :destination_from="destination_from"
            :destination_to="destination_to"
            :distance="distance"
            :duration="duration"
            :currency="currency"
            :selected_offer="selected_offer"
            :selected_way_option="selected_way_option"
            :precalculated_price="precalculated_price"
        ></ReservationForms>
    </div>
</template>

<script>
    import {Loader, LoaderOptions} from 'google-maps';
    import {Truncate} from 'lodash';
    import Axios from "axios";
    import VueAxios from 'vue-axios';
    import VueGallery from 'vue-gallery';
    import ReservationForms from "./ReservationForms";


    export default {
        name: "search-component",
        components: {
            'gallery': VueGallery, ReservationForms
        },
        data: function(){
            return {
                google: null,
                google_map: null,
                distance: 0,
                duration: 0,
                currency: 0,
                sortBy: 0,
                loading: true,
                car_offers: [],
                image_index: null,
                selected_offer: false,
                selected_way_option: false,
                precalculated_price: 0
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
            },
            home_url: {
                required: true,
                type: String
            },
            kurz_eur: {
                required: true,
                type: Number
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


                Axios.post(finalurl, request).then(function (response) {
                    if (response)
                        if(typeof response.data == "object"){
                            _this.car_offers = response.data.cars;
                            _this.loading = false;
                        }else{
                            console.error("Data is not type of Object");
                        }
                }).catch(function (error) {
                    console.error(error);
                });
            },
            getPriceTowards: function(car){
                var price = 0;
                if(car.hasOwnProperty('db_cenik_cena_tam')){
                    price = car.db_cenik_cena_tam;
                }else if(car.hasOwnProperty('db_letistni_transfer') && car.db_letistni_transfer!== false){
                    price = car.db_letistni_transfer;
                }else{
                    if(car.db_jednotka == "km"){
                        price = car.db_cena_za_jednotku * this.distance;
                    }else if (car.db_jednotka == "h"){
                        price = car.db_cena_za_jednotku * Math.ceil(this.duration/1000/60/60);
                    }
                }

                if(this.currency == 1){
                    price = price / this.kurz_eur;
                }

                price = Math.round(price);
                return price;
            },
            getPriceBackwards: function(car){
                var price = 0;

                if(car.hasOwnProperty('db_cenik_cena_zpet')){
                    price = car.db_cenik_cena_zpet;
                }else if(car.hasOwnProperty('db_letistni_transfer') && car.db_letistni_transfer!== false){
                    price = car.db_letistni_transfer * 2;
                }else{
                    if(car.db_jednotka == "km"){
                        price = car.db_cena_za_jednotku * this.distance * 2;
                    }else if (car.db_jednotka == "h"){
                        price = car.db_cena_za_jednotku * Math.ceil(this.duration/1000/60/60) * 2;
                    }
                }

                if(this.currency == 1){
                    price = price / this.kurz_eur;
                }

                price = Math.round(price);
                return price;
            },
            getPopis: function (car) {
                return _.truncate(car.db_popis, {'length': 120});
            },
            getFrontImage: function (car) {
                var obrazky = car.subobjects.obrazekClass;
                for(var index in obrazky){
                    let obrazek = obrazky[index];
                    if(obrazek.db_front.value == 1){
                        return this.home_url + obrazek.db_url.value;
                    }
                }
                return this.images_path + "/auto-reservation.png";
            },
            getRestPhotos: function (car) {
                var obrazky = car.subobjects.obrazekClass;
                var obr_arr = [];
                for(var index in obrazky){
                    let obrazek = obrazky[index];
                    if(obrazek.db_front.value != 1){
                        var image_url = this.home_url + obrazek.db_url.value;
                        image_url = image_url.replace("default","gallery");
                        obr_arr.push(image_url);
                    }
                }

                return obr_arr;
            },
            openPopup: function (auto, price, twoway) {
                this.selected_offer = auto;
                this.selected_way_option = twoway;
                this.precalculated_price = price;
                this.$root.$emit('openPopup');
            }
        },
        computed: {
            ddestination_to: function () {
                return _.truncate(this.destination_to);
            },
            ddestination_from: function () {
                return _.truncate(this.destination_from);
            },
            currency_label: function () {
                return (this.currency == 1 ? "€" : "Kč");
            },
            cars_offers: function () {
                var sortin = this.sortBy;
                var _this = this;
                if(this.car_offers.length > 0){
                    var res = this.car_offers.sort(function (a, b) {
                        var price_a = _this.getPriceTowards(a);
                        var price_b = _this.getPriceTowards(b);

                        if(sortin == 0){
                            if(price_a < price_b){
                                return -1;
                            }else if(price_a > price_b) {
                                return 1;
                            }else{
                                return 0;
                            }
                        }else{
                            if(price_a < price_b){
                                return 1;
                            }else if(price_a > price_b) {
                                return -1;
                            }else{
                                return 0;
                            }
                        }

                    });
                    return res;
                }else{
                    return [];
                }
            }
        },
        filters: {
            format_price: function (price) {
                let val = price;
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            }
        },
        watch: {
            sortBy: function () {
                //this.$forceUpdate();
            }
        }
    }
</script>

<style scoped>
    .componentLoading{
        position: relative;
    }

    .componentLoading:after{
        content: "";
        left: 0px;
        right: 0px;
        top: 0px;
        bottom: 0px;
        background-color: rgba(255,255,255,0.7);
        background-image: url("../../../../../images/images_frontend/loading.gif");
        position: absolute;
        background-position: 50% 20%;
        background-repeat: no-repeat;
    }
</style>