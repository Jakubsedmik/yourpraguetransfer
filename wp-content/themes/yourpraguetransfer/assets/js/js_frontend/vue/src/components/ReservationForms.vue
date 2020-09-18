<template>
    <div>
        <!--  Buttons -> Just for view forms by modals-->
        <div class="bg-light" style="height: 100vh">
            <section class="s7_sw-sec mx-auto p-5">
                <div class="row">
                    <div class="col-3">
                        <button type="button" class="text-white btn bg-primary" data-toggle="modal" data-target="#Modal-form-1">Form 1</button>
                    </div>
                    <div class="col-3">
                        <button type="button" class="text-white btn bg-secondary" data-toggle="modal" data-target="#Modal-form-2">Form 2</button>
                    </div>
                    <div class="col-3">
                        <button type="button" class="text-white btn bg-danger" data-toggle="modal" data-target="#Modal-form-3">Form 3</button>
                    </div>
                    <div class="col-3">
                        <button type="button" class="text-white btn bg-warning" data-toggle="modal" data-target="#Modal-form-4">Form 4</button>
                    </div>
                </div>
            </section>
        </div>


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

                    <div class="modal-body">
                        <div class="s7_modal-body-content s7_modal-body-content-start-1">
                            <h3 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i>Vyzvedneme Vás</h3>
                            <label for="s7_input-form-start" class="s7_modal-body-undertext text-uppercase">Adresa * <span class="s7_modal-body-lower-text">(při změně adresy může dojít k přepočítání ceny)</span></label>
                            <input type="text" name="s7_input-form-start" placeholder="Letiště Václava Havla (PRG), Aviatická, Praha 6, Česko" class="border-0 w-100" required>
                        </div>
                        <div class="s7_modal-body-content s7_modal-body-content-end-1">
                            <h3 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i>Odvezeme Vás</h3>
                            <label for="s7_input-form-goal" class="s7_modal-body-undertext text-uppercase">Adresa * <span class="s7_modal-body-lower-text">(při změně adresy může dojít k přepočítání ceny)</span></label>
                            <input type="text" name="s7_input-form-goal" placeholder="ROXY, Dlouhá, Staré Město, Česko" class="border-0 w-100" required>
                        </div>
                        <div class="s7_form-1-end row flex-sm-row flex-column">
                            <div class="col-md-4 col-sm-6 col-12 d-flex align-items-center justify-content-center mb-md-0 mb-4">
                                <figure class="mb-0">
                                    <img src="/yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/Form-way.png" alt="">
                                </figure>
                                <p class="s7_form-1-end-big-text font-weight-bold mb-0">14.3 <span class="font-weight-light">Km</span></p>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12 d-flex align-items-center justify-content-center mb-md-0 mb-4">
                                <figure class="mb-0">
                                    <img src="/yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/Form-time.png" alt="">
                                </figure>
                                <p class="s7_form-1-end-big-text font-weight-bold mb-0">28 <span class="font-weight-light">min</span></p>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12 d-flex align-items-center justify-content-center mb-md-0 mb-4">
                                <figure class="mb-0">
                                    <img src="/yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/Form-cash.png" alt="">
                                </figure>
                                <p class="s7_form-1-end-big-text font-weight-bold mb-0">580 <span class="font-weight-light">Kč</span></p>
                            </div>
                        </div>
                        <div class="s7_form-next-btn-div">
                            <button type="submit" class="s7_form-next-btn btn mx-auto border-0 rounded-0 font-weight-bold d-flex justify-content-between align-items-center w-100">
                                <span class="text-white text-uppercase">Pokračovat</span>
                                <i class="fas fa-chevron-right text-white"></i>
                            </button>
                        </div>
                    </div>

                    <div class="modal-footer border-0 d-flex flex-wrap justify-content-between">
                        <p class="s7_modal-footer-text s7_modal-footer-text-filled text-white m-0">1. Místo</p>
                        <p class="s7_modal-footer-text text-white m-0">2. Osoby a datum</p>
                        <p class="s7_modal-footer-text text-white m-0">3. Údaje objednatele</p>
                        <p class="s7_modal-footer-text text-white m-0">4. Platba</p>
                        <p class="s7_modal-footer-text text-white m-0">5. Potvrzení</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- /*--- Modal 2 ---*/ -->
        <div class="modal fade" id="Modal-form-2" tabindex="-1" role="dialog" aria-labelledby="Modal-form-2-Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content border-0">
                    <div class="modal-header flex-column align-items-center border-0">
                        <h2 class="s7_underlink modal-title position-relative font-weight-bold text-center text-uppercase" id="Modal-form-2-Label">Rezervace <span class="font-weight-light">cesty</span></h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="s7_modal-header-text text-center">Proveďte rezervaci Vaší cesty a nic Vám neunikne</p>
                    </div>

                    <div class="modal-body">
                        <div class="s7_modal-body-content s7_modal-body-content-start-2">
                            <h3 class="font-weight-bold"><i class="far fa-clock"></i>Kdy pro Vás přijedeme</h3>
                            <label for="s7_input-form-date" class="s7_modal-body-undertext text-uppercase">Adresa * <span class="s7_modal-body-lower-text">(při změně adresy může dojít k přepočítání ceny)</span></label>
                            <input type="datetime-local" value="2020-06-22T19:30" name="s7_input-form-date" class="border-0 w-100" required>
                        </div>
                        <div class="s7_modal-body-content s7_modal-body-content-mid-2 disabled">
                            <h3 class="font-weight-bold"><i class="far fa-clock"></i>Kdy pro Vás přijedeme (cesta zpět)</h3>
                            <label for="s7_input-form-goal-date" class="s7_modal-body-undertext text-uppercase">Adresa * <span class="s7_modal-body-lower-text">(při změně adresy může dojít k přepočítání ceny)</span></label>
                            <input type="datetime-local" value="2020-06-22T19:30" name="s7_input-form-goal-date" class="border-0 w-100" disabled required>
                        </div>
                        <div class="s7_modal-body-content s7_modal-body-content-end-2 position-relative">
                            <h3 class="font-weight-bold"><i class="fas fa-male"></i>Kdy pro Vás přijedeme (cesta zpět)</h3>
                            <label for="s7_input-form-count-passenger" class="s7_modal-body-undertext text-uppercase">Adresa * <span class="s7_modal-body-lower-text">(při změně adresy může dojít k přepočítání ceny)</span></label>
                            <input type="number" name="s7_input-form-count-passenger" value="3" class="border-0 w-100" required>
                            <div class="s7_buttons-p-m position-absolute d-flex flex-column justify-content-between">
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="s7_button-plus-minus d-flex align-items-center p-0 justify-content-center border-0 text-white minus">+</button>
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="s7_button-plus-minus d-flex align-items-center p-0 justify-content-center border-0 text-white plus">-</button>
                            </div>
                        </div>
                        <div class="s7_form-next-btn-div">
                            <button type="submit" class="s7_form-next-btn btn mx-auto border-0 rounded-0 font-weight-bold d-flex justify-content-between align-items-center w-100">
                                <span class="text-white text-uppercase">Pokračovat</span>
                                <i class="fas fa-chevron-right text-white"></i>
                            </button>
                        </div>
                    </div>

                    <div class="modal-footer modal-footer-2 border-0 d-flex flex-wrap justify-content-between">
                        <p class="s7_modal-footer-text s7_modal-footer-text-filled text-white m-0">1. Místo</p>
                        <p class="s7_modal-footer-text s7_modal-footer-text-filled text-white m-0">2. Osoby a datum</p>
                        <p class="s7_modal-footer-text text-white m-0">3. Údaje objednatele</p>
                        <p class="s7_modal-footer-text text-white m-0">4. Platba</p>
                        <p class="s7_modal-footer-text text-white m-0">5. Potvrzení</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- /*--- Modal 3 ---*/ -->
        <div class="modal fade" id="Modal-form-3" tabindex="-1" role="dialog" aria-labelledby="Modal-form-3-Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content border-0">
                    <div class="modal-header flex-column align-items-center border-0">
                        <h2 class="s7_underlink modal-title position-relative font-weight-bold text-center text-uppercase" id="Modal-form-3-Label">Rezervace <span class="font-weight-light">cesty</span></h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="s7_modal-header-text text-center">Proveďte rezervaci Vaší cesty a nic Vám neunikne</p>
                    </div>

                    <div class="modal-body">
                        <div class="s7_modal-body-content s7_modal-body-content-start-3">
                            <h3 class="font-weight-bold"><i class="fas fa-user-alt"></i>Vaše údaje</h3>
                            <div class="s7_input-personal-info-row row">
                                <div class="col-md-6 col-12">
                                    <label for="s7_input-form-first-name" class="s7_modal-body-undertext text-uppercase">Jméno *</label>
                                    <input type="text" name="s7_input-form-first-name" class="border-0 w-100" placeholder="Jan" required>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="s7_input-form-last-name" class="s7_modal-body-undertext text-uppercase">Jméno *</label>
                                    <input type="text" name="s7_input-form-last-name" class="border-0 w-100" placeholder="Novák" required>
                                </div>
                            </div>
                            <div class="s7_input-personal-info-row row">
                                <div class="col-md-6 col-12">
                                    <label for="s7_input-form-email" class="s7_modal-body-undertext text-uppercase">Email *</label>
                                    <input type="email" name="s7_input-form-email" class="border-0 w-100" placeholder="test@yourpraguetransfer.cz" required>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="s7_input-form-tel" class="s7_modal-body-undertext text-uppercase">Telefon *</label>
                                    <input type="text" name="s7_input-form-tel" class="border-0 w-100" placeholder="+420 777 888 999" pattern="[0-9]{3} [0-9]{3} [0-9]{3}" required>
                                </div>
                            </div>
                            <div class="s7_input-personal-info-row row">
                                <div class="col-md-6 col-12">
                                    <label for="s7_input-form-sign" class="s7_modal-body-undertext text-uppercase">Pickup sign</label>
                                    <input type="text" name="s7_input-form-sign" class="border-0 w-100" placeholder="JANNOVAK">
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="s7_input-form-travel" class="s7_modal-body-undertext text-uppercase">Číslo letu/vlaku/autobusu</label>
                                    <input type="text" name="s7_input-form-travel" class="border-0 w-100" placeholder="CX-8875">
                                </div>
                            </div>
                            <label for="s7_input-form-note" class="s7_modal-body-undertext text-uppercase">Poznámka</label>
                            <input type="text" name="s7_input-form-note" class="s7_input-form-note border-0 w-100" placeholder="Přivezte mi něco k jídlu prosím">
                            <h3 class="s7_custom-checkboxes-title font-weight-bold"><i class="fas fa-star"></i>Speciální požadavky</h3>
                            <div class="s7_form-special-checkboxes form-check p-0 d-flex">
                                <label class="container">Velká zavazadla
                                    <input type="checkbox" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Dětská sedačka
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="s7_form-next-btn-div">
                            <button type="submit" class="s7_form-next-btn btn mx-auto border-0 rounded-0 font-weight-bold d-flex justify-content-between align-items-center w-100">
                                <span class="text-white text-uppercase">Pokračovat</span>
                                <i class="fas fa-chevron-right text-white"></i>
                            </button>
                        </div>
                    </div>

                    <div class="modal-footer modal-footer-3 border-0 d-flex flex-wrap justify-content-between">
                        <p class="s7_modal-footer-text s7_modal-footer-text-filled text-white m-0">1. Místo</p>
                        <p class="s7_modal-footer-text s7_modal-footer-text-filled text-white m-0">2. Osoby a datum</p>
                        <p class="s7_modal-footer-text s7_modal-footer-text-filled text-white m-0">3. Údaje objednatele</p>
                        <p class="s7_modal-footer-text text-white m-0">4. Platba</p>
                        <p class="s7_modal-footer-text text-white m-0">5. Potvrzení</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- /*--- Modal 4 ---*/ -->
        <div class="modal fade" id="Modal-form-4" tabindex="-1" role="dialog" aria-labelledby="Modal-form-4-Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content border-0">
                    <div class="modal-header flex-column align-items-center border-0 pb-0">
                        <h2 class="s7_underlink modal-title position-relative font-weight-bold text-center text-uppercase" id="Modal-form-4-Label">Rezervace <span class="font-weight-light">cesty</span></h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="s7_modal-header-text text-center">Proveďte rezervaci Vaší cesty a nic Vám neunikne</p>
                    </div>

                    <div class="modal-body pt-0">
                        <div class="s7_modal-body-content s7_modal-body-content-start-4">
                            <h3 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i>Rekapitulace</h3>
                            <div class="s7_content-ico-row s7_recap-dates-times d-flex align-items-baseline">
                                <i class="s7_content-ico far fa-calendar-alt"></i>
                                <p class="s7_recap-date-time-start mb-0">22. 6. 2020 16:30</p>
                                <i class="s7_content-ico fas fa-history"></i>
                                <p class="s7_recap-date-time-goal mb-0">25.6.2020 18:30</p>
                            </div>
                            <div class="s7_content-ico-row s7_recap-persons d-flex align-items-baseline">
                                <i class="s7_content-ico fas fa-user-alt"></i>
                                <p class="s7_recap-name mb-0">Jakub Sedmík</p>
                                <p class="s7_recap-count mb-0"> (4 osoby)</p>
                            </div>
                            <div class="s7_content-ico-row s7_recap-start-goal d-flex align-items-baseline mb-0">
                                <i class="s7_content-ico fas fa-map-marker-alt"></i>
                                <p class="s7_recap-start mb-0">Letiště Praha</p>
                                <i class="s7_content-ico fas fa-long-arrow-alt-right"></i>
                                <p class="s7_recap-goal mb-0">Roxy Praha</p>
                            </div>
                        </div>
                        <div class="s7_modal-body-content s7_modal-body-content-mid-4">
                            <h3 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i>Jak zaplatíte <span class="s7_payment-title">(580 Kč)</span></h3>
                            <div class="s7_chose-payment-method">
                                <label for="s7_payment-methods" class="s7_modal-body-undertext text-uppercase">Vyberte platební metodu</label>
                                <select name="s7_payment-methods" id="methods" class="border-0 w-100">
                                    <option value="online">Platba online - kartou / online bankovním převodem</option>
                                    <option value="cash">Platba hotově v cíli</option>
                                </select>
                            </div>
                        </div>
                        <div class="s7_form-4-end row flex-sm-row flex-column">
                            <div class="col-md-4 col-sm-6 col-12 d-flex align-items-center justify-content-center mb-md-0 mb-4">
                                <figure class="mb-0">
                                    <img src="/yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/Form-way.png" alt="">
                                </figure>
                                <p class="s7_form-1-end-big-text font-weight-bold mb-0">14.3 <span class="font-weight-light">Km</span></p>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12 d-flex align-items-center justify-content-center mb-md-0 mb-4">
                                <figure class="mb-0">
                                    <img src="/yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/Form-time.png" alt="">
                                </figure>
                                <p class="s7_form-1-end-big-text font-weight-bold mb-0">28 <span class="font-weight-light">min</span></p>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12 d-flex align-items-center justify-content-center mb-md-0 mb-4">
                                <figure class="mb-0">
                                    <img src="/yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/Form-cash.png" alt="">
                                </figure>
                                <p class="s7_form-1-end-big-text font-weight-bold mb-0">580 <span class="font-weight-light">Kč</span></p>
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

                    <div class="modal-footer modal-footer-3 border-0 d-flex flex-wrap justify-content-between">
                        <p class="s7_modal-footer-text s7_modal-footer-text-filled text-white m-0">1. Místo</p>
                        <p class="s7_modal-footer-text s7_modal-footer-text-filled text-white m-0">2. Osoby a datum</p>
                        <p class="s7_modal-footer-text s7_modal-footer-text-filled text-white m-0">3. Údaje objednatele</p>
                        <p class="s7_modal-footer-text s7_modal-footer-text-filled text-white m-0">4. Platba</p>
                        <p class="s7_modal-footer-text text-white m-0">5. Potvrzení</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ReservationForms"
    }
</script>

<style scoped>

</style>