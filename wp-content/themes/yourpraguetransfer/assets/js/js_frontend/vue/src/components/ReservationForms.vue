<template>
    <div>

        <!-- /*------  Modals  ------*/ -->
        <!-- /*--- Modal 1 ---*/ -->
        <div class="modal fade" id="Modal-form-1" tabindex="-1" role="dialog" aria-labelledby="Modal-form-1-Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content border-0">

                    <div class="modal-header flex-column align-items-center border-0">
                        <h2 class="s7_underlink modal-title position-relative font-weight-bold text-center text-uppercase" id="Modal-form-1-Label">Rezervace <span class="font-weight-light">cesty</span></h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="s7_modal-header-text text-center">Proveďte rezervaci Vaší cesty a nic Vám neunikne</p>
                    </div>

                    <div class="modal-body" v-if="step == 0">
                        <div class="s7_modal-body-content s7_modal-body-content-start-1">
                            <h3 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i>Vyzvedneme Vás</h3>
                            <div class="form-field">
                                <label for="s7_input-form-start" class="s7_modal-body-undertext text-uppercase">Adresa * <span class="s7_modal-body-lower-text">(při změně adresy může dojít k přepočítání ceny)</span></label>
                                <input type="text" name="s7_input-form-start" class="border-0 w-100" v-model.trim="$v.step_first.data_destination_from.$model">
                                <div class="form-field-error" v-if="!$v.step_first.data_destination_from.required">Toto pole je povinné</div>
                                <div class="form-field-error" v-if="!$v.step_first.data_destination_from.minLength">Toto pole musí mít minimálně 3 znaky</div>
                            </div>
                        </div>
                        <div class="s7_modal-body-content s7_modal-body-content-end-1">
                            <h3 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i>Odvezeme Vás</h3>
                            <div class="form-field">
                                <label for="s7_input-form-goal" class="s7_modal-body-undertext text-uppercase">Adresa * <span class="s7_modal-body-lower-text">(při změně adresy může dojít k přepočítání ceny)</span></label>
                                <input type="text" name="s7_input-form-goal" class="border-0 w-100" v-model.trim="$v.step_first.data_destination_to.$model">
                                <div class="form-field-error" v-if="!$v.step_first.data_destination_to.required">Toto pole je povinné</div>
                                <div class="form-field-error" v-if="!$v.step_first.data_destination_to.minLength">Toto pole musí mít minimálně 3 znaky</div>
                            </div>
                        </div>
                        <div class="s7_form-1-end row flex-sm-row flex-column">
                            <div class="col-md-4 col-sm-6 col-12 d-flex align-items-center justify-content-center mb-md-0 mb-4">
                                <figure class="mb-0">
                                    <img :src="this.images_path + '/Form-way.png'" alt="">
                                </figure>
                                <p class="s7_form-1-end-big-text font-weight-bold mb-0">{{distance}} <span class="font-weight-light">Km</span></p>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12 d-flex align-items-center justify-content-center mb-md-0 mb-4">
                                <figure class="mb-0">
                                    <img :src="this.images_path + '/Form-time.png'" alt="">
                                </figure>
                                <p class="s7_form-1-end-big-text font-weight-bold mb-0">{{Math.round(duration/1000/60/60*100)/100}} <span class="font-weight-light">h</span></p>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12 d-flex align-items-center justify-content-center mb-md-0 mb-4">
                                <figure class="mb-0">
                                    <img :src="this.images_path + '/Form-cash.png'" alt="">
                                </figure>
                                <p class="s7_form-1-end-big-text font-weight-bold mb-0">{{precalculated_price | format_price}} <span class="font-weight-light">Kč</span></p>
                            </div>
                        </div>
                        <div class="s7_form-next-btn-div">
                            <button type="submit" @click.prevent="nextStep" class="s7_form-next-btn btn mx-auto border-0 rounded-0 font-weight-bold d-flex justify-content-between align-items-center w-100">
                                <span class="text-white text-uppercase">Pokračovat</span>
                                <i class="fas fa-chevron-right text-white"></i>
                            </button>
                        </div>
                    </div>

                    <div class="modal-body" v-if="step == 1">
                        <div class="s7_modal-body-content s7_modal-body-content-start-2">
                            <h3 class="font-weight-bold"><i class="far fa-clock"></i>Kdy pro Vás přijedeme</h3>
                            <div class="form-field">
                                <label for="s7_input-form-date" class="s7_modal-body-undertext text-uppercase">Adresa * <span class="s7_modal-body-lower-text">(při změně adresy může dojít k přepočítání ceny)</span></label>
                                <input type="datetime-local" value="2020-06-22T19:30" name="s7_input-form-date" class="border-0 w-100" v-model.trim="$v.step_second.time_date.$model">
                                <div class="form-field-error" v-if="!$v.step_second.time_date.required">Toto pole je povinné</div>
                            </div>
                        </div>
                        <div class="s7_modal-body-content s7_modal-body-content-mid-2" :class="{'disabled': !selected_way_option}">
                            <h3 class="font-weight-bold"><i class="far fa-clock"></i>Kdy pro Vás přijedeme (cesta zpět)</h3>
                            <div class="form-field">
                                <label for="s7_input-form-goal-date" class="s7_modal-body-undertext text-uppercase">Adresa * <span class="s7_modal-body-lower-text">(při změně adresy může dojít k přepočítání ceny)</span></label>
                                <input type="datetime-local" value="2020-06-22T19:30" name="s7_input-form-goal-date" v-model.trim="$v.step_second.time_date_two_way.$model" class="border-0 w-100" :disabled="!selected_way_option">
                                <div class="form-field-error" v-if="!$v.step_second.time_date_two_way.required">Toto pole je povinné</div>
                            </div>
                        </div>
                        <div class="s7_modal-body-content s7_modal-body-content-end-2 position-relative">
                            <h3 class="font-weight-bold"><i class="fas fa-male"></i>Počet osob</h3>
                            <div class="form-field">
                                <label for="s7_input-form-count-passenger" class="s7_modal-body-undertext text-uppercase">Adresa * <span class="s7_modal-body-lower-text">(při změně adresy může dojít k přepočítání ceny)</span></label>
                                <input type="number" name="s7_input-form-count-passenger" class="border-0 w-100" v-model.trim="$v.step_second.persons.$model">
                                <div class="s7_buttons-p-m position-absolute d-flex flex-column justify-content-between">
                                    <button class="s7_button-plus-minus d-flex align-items-center p-0 justify-content-center border-0 text-white minus">+</button>
                                    <button class="s7_button-plus-minus d-flex align-items-center p-0 justify-content-center border-0 text-white plus">-</button>
                                </div>
                                <div class="form-field-error" v-if="!$v.step_second.persons.required">Toto pole je povinné</div>
                            </div>
                        </div>
                        <div class="s7_form-next-btn-div">
                            <button type="submit"  @click.prevent="nextStep" class="s7_form-next-btn btn mx-auto border-0 rounded-0 font-weight-bold d-flex justify-content-between align-items-center w-100">
                                <span class="text-white text-uppercase">Pokračovat</span>
                                <i class="fas fa-chevron-right text-white"></i>
                            </button>
                        </div>
                    </div>

                    <div class="modal-body" v-if="step == 2">
                        <div class="s7_modal-body-content s7_modal-body-content-start-3">
                            <h3 class="font-weight-bold"><i class="fas fa-user-alt"></i>Vaše údaje</h3>
                            <div class="s7_input-personal-info-row row">
                                <div class="col-md-6 col-12">
                                    <div class="form-field">
                                        <label for="s7_input-form-first-name" class="s7_modal-body-undertext text-uppercase">Jméno *</label>
                                        <input type="text" name="s7_input-form-first-name" class="border-0 w-100" placeholder="Jan" v-model.trim="$v.step_third.name.$model">
                                        <div class="form-field-error" v-if="!$v.step_third.name.required">Toto pole je povinné</div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-field">
                                        <label for="s7_input-form-last-name" class="s7_modal-body-undertext text-uppercase">Příjmení *</label>
                                        <input type="text" name="s7_input-form-last-name" class="border-0 w-100" placeholder="Novák" v-model.trim="$v.step_third.surename.$model">
                                        <div class="form-field-error" v-if="!$v.step_third.surename.required">Toto pole je povinné</div>
                                    </div>
                                </div>
                            </div>
                            <div class="s7_input-personal-info-row row">
                                <div class="col-md-6 col-12">
                                    <div class="form-field">
                                        <label for="s7_input-form-email" class="s7_modal-body-undertext text-uppercase">Email *</label>
                                        <input type="email" name="s7_input-form-email" class="border-0 w-100" placeholder="test@yourpraguetransfer.cz" v-model.trim="$v.step_third.email.$model">
                                        <div class="form-field-error" v-if="!$v.step_third.email.required">Toto pole je povinné</div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-field">
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
                        <div class="s7_form-next-btn-div">
                            <button type="submit" @click.prevent="nextStep" class="s7_form-next-btn btn mx-auto border-0 rounded-0 font-weight-bold d-flex justify-content-between align-items-center w-100">
                                <span class="text-white text-uppercase">Pokračovat</span>
                                <i class="fas fa-chevron-right text-white"></i>
                            </button>
                        </div>
                    </div>


                    <div class="modal-body pt-0" v-if="step == 3">
                        <div class="s7_modal-body-content s7_modal-body-content-start-4">
                            <h3 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i>Rekapitulace</h3>
                            <div class="s7_content-ico-row s7_recap-dates-times d-flex align-items-baseline">
                                <i class="s7_content-ico far fa-calendar-alt"></i>
                                <p class="s7_recap-date-time-start mb-0">{{time_date}}</p>
                                <i class="s7_content-ico fas fa-history"></i>
                                <p class="s7_recap-date-time-goal mb-0">{{time_date_two_way}}</p>
                            </div>
                            <div class="s7_content-ico-row s7_recap-persons d-flex align-items-baseline">
                                <i class="s7_content-ico fas fa-user-alt"></i>
                                <p class="s7_recap-name mb-0">{{name}} {{surename}}</p>
                                <p class="s7_recap-count mb-0"> ({{persons}} osoby)</p>
                            </div>
                            <div class="s7_content-ico-row s7_recap-start-goal d-flex align-items-baseline mb-0">
                                <i class="s7_content-ico fas fa-map-marker-alt"></i>
                                <p class="s7_recap-start mb-0">{{destination_from}}</p>
                                <i class="s7_content-ico fas fa-long-arrow-alt-right"></i>
                                <p class="s7_recap-goal mb-0">{{destination_to}}</p>
                            </div>
                        </div>
                        <div class="s7_modal-body-content s7_modal-body-content-mid-4">
                            <h3 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i>Jak zaplatíte <span class="s7_payment-title">({{precalculated_price | format_price}} Kč)</span></h3>
                            <div class="s7_chose-payment-method">
                                <label for="s7_payment-methods" class="s7_modal-body-undertext text-uppercase">Vyberte platební metodu</label>
                                <select name="s7_payment-methods" id="methods" class="border-0 w-100" v-model="step_fourth.payment">
                                    <option value="online">Platba online - kartou / online bankovním převodem</option>
                                    <option value="cash">Platba hotově v cíli</option>
                                </select>
                            </div>
                        </div>
                        <div class="s7_form-4-end row flex-sm-row flex-column">
                            <div class="col-md-4 col-sm-6 col-12 d-flex align-items-center justify-content-center mb-md-0 mb-4">
                                <figure class="mb-0">
                                    <img :src="this.images_path + '/Form-way.png'" alt="">
                                </figure>
                                <p class="s7_form-1-end-big-text font-weight-bold mb-0">{{distance}} <span class="font-weight-light">Km</span></p>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12 d-flex align-items-center justify-content-center mb-md-0 mb-4">
                                <figure class="mb-0">
                                    <img :src="this.images_path + '/Form-time.png'" alt="">
                                </figure>
                                <p class="s7_form-1-end-big-text font-weight-bold mb-0">{{Math.round(duration/1000/60/60*100)/100}} <span class="font-weight-light">h</span></p>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12 d-flex align-items-center justify-content-center mb-md-0 mb-4">
                                <figure class="mb-0">
                                    <img :src="this.images_path + '/Form-cash.png'" alt="">
                                </figure>
                                <p class="s7_form-1-end-big-text font-weight-bold mb-0">{{precalculated_price | format_price}} <span class="font-weight-light">Kč</span></p>
                            </div>
                        </div>
                        <p class="s7_form-4-text-links text-center">Pokračováním souhlasíte s <a href="#" class="font-weight-bold">podmínkami</a> a s <a href="#" class="font-weight-bold">obchodními podmínkami</a></p>
                        <div class="s7_form-next-btn-div">
                            <button type="submit" class="s7_form-next-btn btn mx-auto border-0 rounded-0 font-weight-bold d-flex justify-content-between align-items-center w-100">
                                <span class="text-white text-uppercase">Pokračovat</span>
                                <i class="fas fa-chevron-right text-white"></i>
                            </button>
                        </div>
                    </div>

                    <div class="modal-footer border-0 d-flex flex-wrap justify-content-between">
                        <p class="s7_modal-footer-text text-white m-0" :class="{'s7_modal-footer-text-filled': step>=0}" @click="step=0">1. Místo</p>
                        <p class="s7_modal-footer-text text-white m-0" :class="{'s7_modal-footer-text-filled': step>=1}" @click="step=1">2. Osoby a datum</p>
                        <p class="s7_modal-footer-text text-white m-0" :class="{'s7_modal-footer-text-filled': step>=2}" @click="step=2">3. Údaje objednatele</p>
                        <p class="s7_modal-footer-text text-white m-0" :class="{'s7_modal-footer-text-filled': step>=3}" @click="step=3">4. Platba</p>
                        <p class="s7_modal-footer-text text-white m-0">5. Potvrzení</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import { required, minLength, email, integer } from 'vuelidate/lib/validators'

    export default {
        name: "ReservationForms",
        props: {
            destination_from : {
                required: true,
                type: String
            },
            destination_to : {
                required: true,
                type: String
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
            }
        },
        data: function () {
            return {
                step: 0,

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
                    payment: "online"
                }

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
                    required
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

            this.step_first.data_destination_from = this.destination_from;
            this.step_first.data_destination_to = this.destination_to;

            this.$root.$on("openPopup",function () {
                _this.step = 0;
            });
        },
        methods: {
            nextStep: function () {
                this.step++;
            }
        },
        filters: {
            format_price: function (price) {
                let val = price;
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            }
        }
    }
</script>

<style scoped>

</style>