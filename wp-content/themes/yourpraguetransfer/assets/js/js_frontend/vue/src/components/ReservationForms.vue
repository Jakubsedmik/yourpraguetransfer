<template>
    <div>

        <!-- /*------  Modals  ------*/ -->
        <!-- /*--- Modal 1 ---*/ -->
        <div class="modal fade" id="Modal-form-1" tabindex="-1" role="dialog" aria-labelledby="Modal-form-1-Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content border-0" :class="{componentLoading: this.loading}">

                    <div class="modal-header flex-column align-items-center border-0">
                        <h2 class="s7_underlink modal-title position-relative font-weight-bold text-center text-uppercase" id="Modal-form-1-Label">Rezervace <span class="font-weight-light">cesty</span></h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="s7_modal-header-text text-center">Proveďte rezervaci Vaší cesty a nic Vám neunikne</p>
                    </div>



                    <!-- PART 1 -->
                    <div class="modal-body" v-if="step == 0">
                        <div class="s7_modal-body-content s7_modal-body-content-start-1">
                            <h3 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i>Vyzvedneme Vás</h3>
                            <div class="form-field" :class="{ 'form-field--error': $v.step_first.data_destination_from.$error }">
                                <label for="s7_input-form-start" class="s7_modal-body-undertext text-uppercase">Adresa * <span class="s7_modal-body-lower-text">(při změně adresy může dojít k přepočítání ceny)</span></label>
                                <input type="text" name="data_destination_from_lat_lng" class="border-0 w-100 js-vue-autocomplete" v-model.trim="$v.step_first.data_destination_from.$model">

                                <div class="form-field-error" v-if="!$v.step_first.data_destination_from.required">Toto pole je povinné</div>
                                <div class="form-field-error" v-if="!$v.step_first.data_destination_from.minLength">Toto pole musí mít minimálně 3 znaky</div>
                            </div>
                        </div>
                        <div class="s7_modal-body-content s7_modal-body-content-end-1">
                            <h3 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i>Odvezeme Vás</h3>
                            <div class="form-field" :class="{ 'form-field--error': $v.step_first.data_destination_to.$error }">
                                <label for="s7_input-form-goal" class="s7_modal-body-undertext text-uppercase">Adresa * <span class="s7_modal-body-lower-text">(při změně adresy může dojít k přepočítání ceny)</span></label>
                                <input type="text" name="data_destination_to_lat_lng" class="border-0 w-100 js-vue-autocomplete" v-model.trim="$v.step_first.data_destination_to.$model">
                                <div class="form-field-error" v-if="!$v.step_first.data_destination_to.required">Toto pole je povinné</div>
                                <div class="form-field-error" v-if="!$v.step_first.data_destination_to.minLength">Toto pole musí mít minimálně 3 znaky</div>
                            </div>
                        </div>

                    </div>



                    <!-- PART 2 -->
                    <div class="modal-body" v-if="step == 1">
                        <div class="s7_modal-body-content s7_modal-body-content-start-2">
                            <h3 class="font-weight-bold"><i class="far fa-clock"></i>Kdy pro Vás přijedeme</h3>
                            <div class="form-field" :class="{ 'form-field--error': $v.step_second.time_date.$error }">
                                <label for="s7_input-form-date" class="s7_modal-body-undertext text-uppercase">Adresa * <span class="s7_modal-body-lower-text">(při změně adresy může dojít k přepočítání ceny)</span></label>
                                <input type="datetime-local" value="2020-06-22T19:30" name="s7_input-form-date" class="border-0 w-100" v-model.trim="$v.step_second.time_date.$model">
                                <div class="form-field-error" v-if="!$v.step_second.time_date.required">Toto pole je povinné</div>
                            </div>
                        </div>
                        <div class="s7_modal-body-content s7_modal-body-content-mid-2" :class="{'disabled': !selected_way_option}">
                            <h3 class="font-weight-bold"><i class="far fa-clock"></i>Kdy pro Vás přijedeme (cesta zpět)</h3>
                            <div class="form-field" :class="{ 'form-field--error': $v.step_second.time_date_two_way.$error }">
                                <label for="s7_input-form-goal-date" class="s7_modal-body-undertext text-uppercase">Adresa * <span class="s7_modal-body-lower-text">(při změně adresy může dojít k přepočítání ceny)</span></label>
                                <input type="datetime-local" value="2020-06-22T19:30" name="s7_input-form-goal-date" v-model.trim="$v.step_second.time_date_two_way.$model" class="border-0 w-100" :disabled="!selected_way_option">
                                <div class="form-field-error" v-if="!$v.step_second.time_date_two_way.required">Toto pole je povinné</div>
                            </div>
                        </div>
                        <div class="s7_modal-body-content s7_modal-body-content-end-2 position-relative">
                            <h3 class="font-weight-bold"><i class="fas fa-male"></i>Počet osob</h3>
                            <div class="form-field" :class="{ 'form-field--error': $v.step_second.persons.$error }">
                                <label for="s7_input-form-count-passenger" class="s7_modal-body-undertext text-uppercase">Adresa * <span class="s7_modal-body-lower-text">(při změně adresy může dojít k přepočítání ceny)</span></label>
                                <input type="number" name="s7_input-form-count-passenger" class="border-0 w-100" v-model.trim="$v.step_second.persons.$model" @change="checkForNewPrice">
                                <div class="s7_buttons-p-m position-absolute d-flex flex-column justify-content-between">
                                    <button class="s7_button-plus-minus d-flex align-items-center p-0 justify-content-center border-0 text-white minus" @click="increasePersons()">+</button>
                                    <button class="s7_button-plus-minus d-flex align-items-center p-0 justify-content-center border-0 text-white plus" @click="decreasePersons()">-</button>
                                </div>
                                <div class="form-field-error" v-if="!$v.step_second.persons.required">Toto pole je povinné</div>
                            </div>
                        </div>

                    </div>


                    <!-- PART 3 -->
                    <div class="modal-body" v-if="step == 2">
                        <div class="s7_modal-body-content s7_modal-body-content-start-3">
                            <h3 class="font-weight-bold"><i class="fas fa-user-alt"></i>Vaše údaje</h3>
                            <div class="s7_input-personal-info-row row">
                                <div class="col-md-6 col-12">
                                    <div class="form-field" :class="{ 'form-field--error': $v.step_third.name.$error }">
                                        <label for="s7_input-form-first-name" class="s7_modal-body-undertext text-uppercase">Jméno *</label>
                                        <input type="text" name="s7_input-form-first-name" class="border-0 w-100" placeholder="Jan" v-model.trim="$v.step_third.name.$model">
                                        <div class="form-field-error" v-if="!$v.step_third.name.required">Toto pole je povinné</div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-field" :class="{ 'form-field--error': $v.step_third.surename.$error }" >
                                        <label for="s7_input-form-last-name" class="s7_modal-body-undertext text-uppercase">Příjmení *</label>
                                        <input type="text" name="s7_input-form-last-name" class="border-0 w-100" placeholder="Novák" v-model.trim="$v.step_third.surename.$model">
                                        <div class="form-field-error" v-if="!$v.step_third.surename.required">Toto pole je povinné</div>
                                    </div>
                                </div>
                            </div>
                            <div class="s7_input-personal-info-row row">
                                <div class="col-md-6 col-12">
                                    <div class="form-field" :class="{ 'form-field--error': $v.step_third.email.$error }">
                                        <label for="s7_input-form-email" class="s7_modal-body-undertext text-uppercase">Email *</label>
                                        <input type="email" name="s7_input-form-email" class="border-0 w-100" placeholder="test@yourpraguetransfer.cz" v-model.trim="$v.step_third.email.$model">
                                        <div class="form-field-error" v-if="!$v.step_third.email.required">Toto pole je povinné</div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-field" :class="{ 'form-field--error': $v.step_third.telephone.$error }">
                                        <label for="s7_input-form-tel" class="s7_modal-body-undertext text-uppercase">Telefon *</label>
                                        <input type="text" name="s7_input-form-tel" class="border-0 w-100" placeholder="+420 777 888 999" pattern="[0-9]{3} [0-9]{3} [0-9]{3}" v-model.trim="$v.step_third.telephone.$model">
                                        <div class="form-field-error" v-if="!$v.step_third.telephone.required">Toto pole je povinné</div>
                                    </div>
                                </div>
                            </div>
                            <div class="s7_input-personal-info-row row">
                                <div class="col-md-6 col-12">
                                    <div class="form-field">
                                        <label for="s7_input-form-sign" class="s7_modal-body-undertext text-uppercase">Pickup sign</label>
                                        <input type="text" name="s7_input-form-sign" class="border-0 w-100" placeholder="JANNOVAK" v-model="step_third.pickupsign">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-field">
                                        <label for="s7_input-form-travel" class="s7_modal-body-undertext text-uppercase">Číslo letu/vlaku/autobusu</label>
                                        <input type="text" name="s7_input-form-travel" class="border-0 w-100" placeholder="CX-8875" v-model="step_third.transport_id">
                                    </div>
                                </div>
                            </div>
                            <label for="s7_input-form-note" class="s7_modal-body-undertext text-uppercase">Poznámka</label>
                            <input type="text" name="s7_input-form-note" class="s7_input-form-note border-0 w-100" placeholder="Přivezte mi něco k jídlu prosím" v-model="step_third.note">
                            <h3 class="s7_custom-checkboxes-title font-weight-bold"><i class="fas fa-star"></i>Speciální požadavky</h3>
                            <div class="s7_form-special-checkboxes form-check p-0 d-flex">
                                <label class="container">Velká zavazadla
                                    <input type="checkbox" v-model="step_third.large_baggage">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Dětská sedačka
                                    <input type="checkbox" v-model="step_third.kid_seat">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                    </div>


                    <!-- PART 4 -->
                    <div class="modal-body pt-0" v-if="step == 3">
                        <div class="s7_modal-body-content s7_modal-body-content-start-4">
                            <h3 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i>Rekapitulace</h3>
                            <div class="s7_content-ico-row s7_recap-dates-times d-flex align-items-baseline">
                                <i class="s7_content-ico far fa-calendar-alt"></i>
                                <p class="s7_recap-date-time-start mb-0">{{step_second.time_date}}</p>
                                <i class="s7_content-ico fas fa-history" v-if="selected_way_option == true"></i>
                                <p class="s7_recap-date-time-goal mb-0" v-if="selected_way_option == true">{{step_second.time_date_two_way}}</p>
                            </div>
                            <div class="s7_content-ico-row s7_recap-persons d-flex align-items-baseline">
                                <i class="s7_content-ico fas fa-user-alt"></i>
                                <p class="s7_recap-name mb-0">{{step_third.name}} {{step_third.surename}}</p>
                                <p class="s7_recap-count mb-0"> ({{step_second.persons}} osoby)</p>
                            </div>
                            <div class="s7_content-ico-row s7_recap-start-goal d-flex align-items-baseline mb-0">
                                <i class="s7_content-ico fas fa-map-marker-alt"></i>
                                <p class="s7_recap-start mb-0">{{step_first.data_destination_from}}</p>
                                <i class="s7_content-ico fas fa-long-arrow-alt-right"></i>
                                <p class="s7_recap-goal mb-0">{{step_first.data_destination_to}}</p>
                            </div>
                        </div>
                        <div class="s7_modal-body-content s7_modal-body-content-mid-4">
                            <h3 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i>Jak zaplatíte <span class="s7_payment-title">({{precalculated_price | format_price}} Kč)</span></h3>
                            <div class="s7_chose-payment-method">
                                <label for="s7_payment-methods" class="s7_modal-body-undertext text-uppercase">Vyberte platební metodu</label>
                                <select name="s7_payment-methods" id="methods" class="border-0 w-100" v-model="step_fourth.payment">
                                    <option value="1">Platba online - kartou / online bankovním převodem</option>
                                    <option value="0">Platba hotově v cíli</option>
                                </select>
                            </div>
                        </div>
                        <p class="s7_form-4-text-links text-center">Pokračováním souhlasíte s <a href="#" class="font-weight-bold">podmínkami</a> a s <a href="#" class="font-weight-bold">obchodními podmínkami</a></p>
                    </div>

                    <div class="modal-body">

                        <div class="s7_form-next-btn-div">
                            <button type="submit" @click.prevent="nextStep" class="s7_form-next-btn btn mx-auto border-0 rounded-0 font-weight-bold d-flex justify-content-between align-items-center w-100">
                                <span class="text-white text-uppercase">Pokračovat</span>
                                <i class="fas fa-chevron-right text-white"></i>
                            </button>
                        </div>

                        <div class="s7_form-1-end row flex-sm-row flex-column">
                            <div class="col-md-4 col-sm-6 col-12 d-flex align-items-center justify-content-center mb-md-0 mb-4">
                                <figure class="mb-0">
                                    <img :src="this.images_path + '/Form-way.png'" alt="">
                                </figure>
                                <p class="s7_form-1-end-big-text font-weight-bold mb-0">{{data_distance}} <span class="font-weight-light">Km</span></p>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12 d-flex align-items-center justify-content-center mb-md-0 mb-4">
                                <figure class="mb-0">
                                    <img :src="this.images_path + '/Form-time.png'" alt="">
                                </figure>
                                <p class="s7_form-1-end-big-text font-weight-bold mb-0">{{Math.round(data_duration/1000/60/60*100)/100}} <span class="font-weight-light">h</span></p>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12 d-flex align-items-center justify-content-center mb-md-0 mb-4">
                                <figure class="mb-0">
                                    <img :src="this.images_path + '/Form-cash.png'" alt="">
                                </figure>
                                <p class="s7_form-1-end-big-text font-weight-bold mb-0">{{data_final_price | format_price}} <span class="font-weight-light">{{currency_label}}</span></p>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer border-0 d-flex flex-wrap justify-content-between">
                        <p class="s7_modal-footer-text text-white m-0" :class="{'s7_modal-footer-text-filled': step>=0}" @click="setStep(0)">1. Místo</p>
                        <p class="s7_modal-footer-text text-white m-0" :class="{'s7_modal-footer-text-filled': step>=1}" @click="setStep(1)">2. Osoby a datum</p>
                        <p class="s7_modal-footer-text text-white m-0" :class="{'s7_modal-footer-text-filled': step>=2}" @click="setStep(2)">3. Údaje objednatele</p>
                        <p class="s7_modal-footer-text text-white m-0" :class="{'s7_modal-footer-text-filled': step>=3}" @click="setStep(3)">4. Platba</p>
                        <p class="s7_modal-footer-text text-white m-0">5. Potvrzení</p>
                    </div>

                    <form :action="home_url + '/objednavka/'" method="post">
                        <input type="hidden" name="action" value="createNewOrder">

                        <input type="hidden" :name="'db_' + index" :value="field" v-for="(field,index) in form_data">
                        <button ref="formSubmit" name="submit" value="1" type="submit"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import { required, minLength, email, integer, requiredIf } from 'vuelidate/lib/validators';
    import Axios from "axios";
    import VueAxios from 'vue-axios';
    import VueGoogleAutocomplete from 'vue-google-autocomplete'

    export default {
        name: "ReservationForms",
        components: {
            VueGoogleAutocomplete
        },
        props: {
            destination_from : {
                required: true,
                type: String
            },
            destination_from_lat_lng: {
                required: true,
                type: Object
            },
            destination_to : {
                required: true,
                type: String
            },
            destination_to_lat_lng: {
                required: true,
                type: Object
            },
            distance: {
                required: true,
                type: Number
            },
            duration: {
                required: true,
                type: Number
            },
            currency: {
                required: true,
                type: Number
            },
            selected_offer: {
                required: true,
                type: Object | Boolean
            },
            selected_way_option: {
                required: true,
                type: Number | Boolean
            },
            precalculated_price: {
                required: true,
                type: Number
            },
            images_path: {
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
            }
        },
        data: function () {
            return {
                step: 0,
                data_destination_from_lat_lng: false,
                data_destination_to_lat_lng: false,
                data_distance: 0,
                data_duration: 0,
                data_final_price: 0,
                data_currency: false,
                step_first: {
                    data_destination_from: "",
                    data_destination_to: "",
                },
                step_second: {
                    time_date: "",
                    time_date_two_way: "",
                    persons: 1,
                },
                step_third: {
                    name: "",
                    surename: "",
                    email: "",
                    telephone: "",
                    pickupsign: "",
                    transport_id: "",
                    note: "",
                    kid_seat: false,
                    large_baggage: false,
                },
                step_fourth: {
                    payment: 1
                },
                loading: false,

            }
        },
        validations: {
            step_first: {
                data_destination_from: {
                    required,
                    minLength: minLength(3)
                },
                data_destination_to: {
                    required,
                    minLength: minLength(3)
                }
            },
            step_second: {
                time_date: {
                    required
                },
                time_date_two_way: {
                    requiredIf: requiredIf(function(){
                        return this.selected_way_option === true;
                    })
                },
                persons: {
                    required
                }
            },
            step_third: {
                name: {
                    required,
                    minLength: minLength(3)
                },
                surename: {
                    required,
                    minLength: minLength(3)
                },
                email: {
                    required,
                    email
                },
                telephone: {
                    required
                }
            },
        },
        mounted() {
            var _this = this;

            this.$root.$on("openPopup",function () {
                setTimeout(function () {
                    _this.step = 0;
                    _this.step_first.data_destination_from = _this.destination_from;
                    _this.step_first.data_destination_to = _this.destination_to;
                    _this.data_destination_from_lat_lng = _this.destination_from_lat_lng;
                    _this.data_destination_to_lat_lng = _this.destination_to_lat_lng;
                    _this.data_distance = _this.distance;
                    _this.data_duration = _this.duration;
                    _this.data_currency = _this.currency;
                    _this.data_final_price = _this.precalculated_price;
                    _this.data_conversion_rate = this.conversion_rate;
                },100);

            });

            this.$root.$on("googleMapsInitialized",function () {
                _this.initAutocomplete();
            });

        },
        methods: {

            initAutocomplete: function(){
                var inputs = document.querySelectorAll(".js-vue-autocomplete");
                var _this = this;

                inputs.forEach(function (value) {
                    var input = value;

                    var autocomplete = new google.maps.places.Autocomplete(input);
                    autocomplete.addListener('place_changed', function() {
                        input.dispatchEvent(new Event('input'));
                        input.dispatchEvent(new Event('change'));
                        input.dispatchEvent(new Event("blur"));
                        var dataName = input.getAttribute("name");
                        _this[dataName] = {
                            lat: autocomplete.getPlace().geometry.location.lat(),
                            lng: autocomplete.getPlace().geometry.location.lng()
                        };

                        _this.getNewDistance();
                    });

                });

            },

            increasePersons: function(){
                this.step_second.persons++;
                this.checkForNewPrice();
            },
            decreasePersons: function(){
                if(this.step_second.persons > 1){
                    this.step_second.persons--;
                    this.checkForNewPrice();
                }
            },

            nextStep: function () {
                var toValidate = null;
                switch (this.step) {
                    case 0: toValidate = this.$v.step_first;break;
                    case 1: toValidate = this.$v.step_second;break;
                    case 2: toValidate = this.$v.step_third;break;
                    case 3: toValidate = true;break;
                }
                if(toValidate === true){
                    this.$refs['formSubmit'].click();
                    return true;
                }

                toValidate.$touch();
                if (!toValidate.$invalid) {
                    this.step++;
                }
            },
            setStep: function(step){
                if(this.step > step){
                    this.step = step;
                }
            },
            getNewDistance: function () {
                this.loading = true;
                var directionsService = new google.maps.DirectionsService();
                var _this = this;

                var selectedMode = 'DRIVING';
                var request = {
                    origin: this.data_destination_from_lat_lng,
                    destination: this.data_destination_to_lat_lng,
                    travelMode: google.maps.TravelMode[selectedMode]
                };

                directionsService.route(request, function(response, status) {
                    if (status == 'OK') {

                        _this.data_distance = Math.round(response.routes[0].legs[0].distance.value / 1000);
                        _this.data_duration = response.routes[0].legs[0].duration.value * 1000;
                        _this.checkForNewPrice();
                    }
                });
            },
            checkForNewPrice: function () {

                this.loading = true;
                var request = {
                    persons: this.step_second.persons,
                    destination_from: this.step_first.data_destination_from,
                    destination_to: this.step_first.data_destination_to,
                    selected_offer: this.selected_offer,
                    precalculated_price: this.precalculated_price,
                    duration: this.data_duration,
                    distance: this.data_distance,
                    selected_way_option: this.selected_way_option,
                    currency: this.data_currency
                };

                var _this = this;
                var finalurl = _this.api_url + "?action=checkCarPrice";

                Axios.post(finalurl, request).then(function (response) {
                    if (response){
                        if(typeof response.data == "object"){
                            if(response.data.status == 1){
                                if(response.data.payload.final_price !== _this.precalculated_price){
                                    _this.data_final_price = response.data.payload.final_price;
                                }
                            }else if(response.data.status == -1){
                                _this.decreasePersons();
                                alert(response.data.message);
                            }
                        }else{
                            console.error("Data is not type of Object");
                        }
                    }
                    _this.loading = false;
                }).catch(function (error) {
                    console.error(error);
                });
            }
        },
        filters: {
            format_price: function (price) {
                let val = price;
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            }
        },
        computed: {
            data_destination_from: function () {
                return this.step_first.data_destination_from;
            },
            data_destination_to: function () {
                return this.step_first.data_destination_to;
            },
            persons: function () {
                return this.step_second.persons;
            },
            currency_label: function () {
                return (this.data_currency == 1 ? "€" : "Kč");
            },
            form_data: function () {
                let result = {
                    ...this.step_first,
                    ...this.step_second,
                    ...this.step_third,
                    ...this.step_fourth,
                    'final_price' : this.data_final_price,
                    'currency' : this.data_currency,
                    'selected_way_option' : this.selected_way_option,
                    'car_id' : this.selected_offer.db_id
                };
                return result;
            }
        }
    }
</script>

<style>

    .form-field-error{
        display: none;
    }

    .form-field--error .form-field-error{
        display: block;
        color: red;
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
        margin-top: 5px;
    }

    .form-field--error input {
        outline: 1px solid red;
    }

    .pac-container{
        z-index: 99999999;
    }

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