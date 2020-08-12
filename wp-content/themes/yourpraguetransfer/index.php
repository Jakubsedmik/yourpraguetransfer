<?php include "header.php"; ?>

<section id="your-way" class="container-fluid text-white">
    <div class="s7_underpage-slider-sw s7_sw-sec mx-auto">
        <h1 class="text-center text-white text-uppercase font-weight-bold pb-2">Vaše cesta</h1>
        <div class="s7_place-ftw d-flex align-items-center flex-md-row flex-column justify-content-center">
            <div class="s7_place-start d-flex align-items-center">
                <i class="fas text-white fa-map-marker-alt mr-3"></i>
                <p class="text-white font-weight-light mb-0">Praha, Letiště Václava Havla</p>
            </div>
            <div class="s7_ftw-arrows">
                <i class="fas fa-caret-right mr-2 text-white"></i>
                <i class="fas fa-caret-right mr-2 text-white"></i>
                <i class="fas fa-caret-right text-white"></i>
            </div>
            <div class="s7_place-finish d-flex align-items-center">
                <i class="fas text-white fa-map-marker-alt mr-3"></i>
                <p class="text-white font-weight-light mb-0">Praha, Vodičkova 24</p>
            </div>
        </div>
        <div class="s7_underpage-col-row mx-auto d-flex justify-content-center">
            <div class="s7_underpage-ico d-flex align-items-center">
                <figure class="mb-0"><img src="../yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/route.png" alt="" class="w-100"></figure>
                <p class="s7_underpage-text font-weight-light text-white mb-0"><strong class="text-white">14.3</strong> Km</p>
            </div>
            <div class="s7_underpage-ico d-flex align-items-center">
                <figure class="mb-0"><img src="../yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/time.png" alt="" class="w-100"></figure>
                <p class="s7_underpage-text font-weight-light text-white mb-0"><strong class="text-white">28</strong> min</p>
            </div>
            <div class="s7_underpage-ico d-flex align-items-center">
                <figure class="mb-0"><img src="../yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/money.png" alt="" class="w-100"></figure>
                <p class="s7_underpage-text font-weight-light text-white mb-0">od <strong class="text-white">580</strong> Kč</p>
            </div>
        </div>
        <a href="#" class="btn rounded-0 w-100 font-weight-bold d-flex align-items-center justify-content-between mx-auto text-uppercase"><span class="text-white">Změnit cestu</span><i class="fas fa-chevron-right text-white"></i></a>
    </div>
</section>
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
            <div class="s7_nabidka-aut-info d-flex">
                <figure class="s7_res-car-img mb-0 position-relative"><img src="../yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/auto-reservation.png" alt=""></figure>
                <div class="s7_car-text">
                    <div class="d-flex align-items-center">
                        <h3 class="font-weight-bold mr-3 mb-0">High Class</h3>
                        <div class="s7_nabidka-aut-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="s7_nabidka-aut-typ-auto font-italic mb-1">Škoda Superb Laurint Clement</div>
                    <p class="s7_nabidka-aut-popis">Etiam aliquam, arcu tristique ultrices vestibulum, augue erat convallis dui, a sodales quam augue ut ligula. <button class="border-0 radius-0"><i class="far fa-image"></i>Více fotografií</button></p>
                </div>
                <div class="s7_reservation-buttons w-100">
                    <div class="s7_res-button-one-way d-flex align-items-center">
                        <div class="s7_res-price w-100 font-weight-bold"><p class="s7_res-big-text">580 <span class="s7_res-normal-text">Kč</span></p><p class="s7_res-small-text mb-0">jednosměrná</p></div>
                        <a href="#" class="s7_res-btn w-100 btn rounded-0 border-0 text-uppercase d-flex justify-content-between align-items-center"><span class="text-white">Rezervovat</span><i class="fas fa-chevron-right text-white"></i></a>
                    </div>
                    <div class="s7_res-button-two-way d-flex align-items-center">
                        <div class="s7_res-price w-100 font-weight-bold"><p class="s7_res-big-text">1.000 <span class="s7_res-normal-text">Kč</span></p><p class="s7_res-small-text mb-0">obousměrná</p></div>
                        <a href="#" class="s7_res-btn w-100 btn rounded-0 border-0 text-uppercase d-flex justify-content-between align-items-center"><span class="text-white">Rezervovat</span><i class="fas fa-chevron-right text-white"></i></a>
                    </div>
                </div>
            </div>
            <div class="s7_nabidka-aut-sluzby d-flex flex-row">
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-4.png" alt="láhev vody" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Pití zdarma</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-1.png" alt="platební karty" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Platba online</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-3.png" alt="štít" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Bezpečnost</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-2.png" alt="wifi" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Wifi na palubě</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-4.png" alt="nonstop" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Pití zdarma</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-1.png" alt="platební karty" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Platba online</p>
                </div>
            </div>
        </div>
        <div class="s7_nabidka-aut">
            <div class="s7_nabidka-aut-info d-flex">
                <figure class="s7_res-car-img mb-0 position-relative"><img src="../yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/auto-reservation.png" alt=""></figure>
                <div class="s7_car-text">
                    <div class="d-flex align-items-center">
                        <h3 class="font-weight-bold mr-3 mb-0">High Class</h3>
                        <div class="s7_nabidka-aut-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="s7_nabidka-aut-typ-auto font-italic mb-1">Škoda Superb Laurint Clement</div>
                    <p class="s7_nabidka-aut-popis">Etiam aliquam, arcu tristique ultrices vestibulum, augue erat convallis dui, a sodales quam augue ut ligula. <button class="border-0 radius-0"><i class="far fa-image"></i>Více fotografií</button></p>
                </div>
                <div class="s7_reservation-buttons w-100">
                    <div class="s7_res-button-one-way d-flex align-items-center">
                        <div class="s7_res-price w-100 font-weight-bold"><p class="s7_res-big-text">580 <span class="s7_res-normal-text">Kč</span></p><p class="s7_res-small-text mb-0">jednosměrná</p></div>
                        <a href="#" class="s7_res-btn w-100 btn rounded-0 border-0 text-uppercase d-flex justify-content-between align-items-center"><span class="text-white">Rezervovat</span><i class="fas fa-chevron-right text-white"></i></a>
                    </div>
                    <div class="s7_res-button-two-way d-flex align-items-center">
                        <div class="s7_res-price w-100 font-weight-bold"><p class="s7_res-big-text">1.000 <span class="s7_res-normal-text">Kč</span></p><p class="s7_res-small-text mb-0">obousměrná</p></div>
                        <a href="#" class="s7_res-btn w-100 btn rounded-0 border-0 text-uppercase d-flex justify-content-between align-items-center"><span class="text-white">Rezervovat</span><i class="fas fa-chevron-right text-white"></i></a>
                    </div>
                </div>
            </div>
            <div class="s7_nabidka-aut-sluzby d-flex flex-row">
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-4.png" alt="láhev vody" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Pití zdarma</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-1.png" alt="platební karty" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Platba online</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-3.png" alt="štít" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Bezpečnost</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-2.png" alt="wifi" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Wifi na palubě</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-4.png" alt="nonstop" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Pití zdarma</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-1.png" alt="platební karty" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Platba online</p>
                </div>
            </div>
        </div>
        <div class="s7_nabidka-aut">
            <div class="s7_nabidka-aut-info d-flex">
                <figure class="s7_res-car-img mb-0 position-relative"><img src="../yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/auto-reservation.png" alt=""></figure>
                <div class="s7_car-text">
                    <div class="d-flex align-items-center">
                        <h3 class="font-weight-bold mr-3 mb-0">High Class</h3>
                        <div class="s7_nabidka-aut-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="s7_nabidka-aut-typ-auto font-italic mb-1">Škoda Superb Laurint Clement</div>
                    <p class="s7_nabidka-aut-popis">Etiam aliquam, arcu tristique ultrices vestibulum, augue erat convallis dui, a sodales quam augue ut ligula. <button class="border-0 radius-0"><i class="far fa-image"></i>Více fotografií</button></p>
                </div>
                <div class="s7_reservation-buttons w-100">
                    <div class="s7_res-button-one-way d-flex align-items-center">
                        <div class="s7_res-price w-100 font-weight-bold"><p class="s7_res-big-text">580 <span class="s7_res-normal-text">Kč</span></p><p class="s7_res-small-text mb-0">jednosměrná</p></div>
                        <a href="#" class="s7_res-btn w-100 btn rounded-0 border-0 text-uppercase d-flex justify-content-between align-items-center"><span class="text-white">Rezervovat</span><i class="fas fa-chevron-right text-white"></i></a>
                    </div>
                    <div class="s7_res-button-two-way d-flex align-items-center">
                        <div class="s7_res-price w-100 font-weight-bold"><p class="s7_res-big-text">1.000 <span class="s7_res-normal-text">Kč</span></p><p class="s7_res-small-text mb-0">obousměrná</p></div>
                        <a href="#" class="s7_res-btn w-100 btn rounded-0 border-0 text-uppercase d-flex justify-content-between align-items-center"><span class="text-white">Rezervovat</span><i class="fas fa-chevron-right text-white"></i></a>
                    </div>
                </div>
            </div>
            <div class="s7_nabidka-aut-sluzby d-flex flex-row">
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-4.png" alt="láhev vody" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Pití zdarma</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-1.png" alt="platební karty" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Platba online</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-3.png" alt="štít" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Bezpečnost</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-2.png" alt="wifi" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Wifi na palubě</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-4.png" alt="nonstop" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Pití zdarma</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-1.png" alt="platební karty" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Platba online</p>
                </div>
            </div>
        </div>
        <div class="s7_nabidka-aut">
            <div class="s7_nabidka-aut-info d-flex">
                <figure class="s7_res-car-img mb-0 position-relative"><img src="../yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/auto-reservation.png" alt=""></figure>
                <div class="s7_car-text">
                    <div class="d-flex align-items-center">
                        <h3 class="font-weight-bold mr-3 mb-0">High Class</h3>
                        <div class="s7_nabidka-aut-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="s7_nabidka-aut-typ-auto font-italic mb-1">Škoda Superb Laurint Clement</div>
                    <p class="s7_nabidka-aut-popis">Etiam aliquam, arcu tristique ultrices vestibulum, augue erat convallis dui, a sodales quam augue ut ligula. <button class="border-0 radius-0"><i class="far fa-image"></i>Více fotografií</button></p>
                </div>
                <div class="s7_reservation-buttons w-100">
                    <div class="s7_res-button-one-way d-flex align-items-center">
                        <div class="s7_res-price w-100 font-weight-bold"><p class="s7_res-big-text">580 <span class="s7_res-normal-text">Kč</span></p><p class="s7_res-small-text mb-0">jednosměrná</p></div>
                        <a href="#" class="s7_res-btn w-100 btn rounded-0 border-0 text-uppercase d-flex justify-content-between align-items-center"><span class="text-white">Rezervovat</span><i class="fas fa-chevron-right text-white"></i></a>
                    </div>
                    <div class="s7_res-button-two-way d-flex align-items-center">
                        <div class="s7_res-price w-100 font-weight-bold"><p class="s7_res-big-text">1.000 <span class="s7_res-normal-text">Kč</span></p><p class="s7_res-small-text mb-0">obousměrná</p></div>
                        <a href="#" class="s7_res-btn w-100 btn rounded-0 border-0 text-uppercase d-flex justify-content-between align-items-center"><span class="text-white">Rezervovat</span><i class="fas fa-chevron-right text-white"></i></a>
                    </div>
                </div>
            </div>
            <div class="s7_nabidka-aut-sluzby d-flex flex-row">
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-4.png" alt="láhev vody" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Pití zdarma</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-1.png" alt="platební karty" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Platba online</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-3.png" alt="štít" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Bezpečnost</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-2.png" alt="wifi" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Wifi na palubě</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-4.png" alt="nonstop" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Pití zdarma</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-1.png" alt="platební karty" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Platba online</p>
                </div>
            </div>
        </div>
        <div class="s7_nabidka-aut">
            <div class="s7_nabidka-aut-info d-flex">
                <figure class="s7_res-car-img mb-0 position-relative"><img src="../yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/auto-reservation.png" alt=""></figure>
                <div class="s7_car-text">
                    <div class="d-flex align-items-center">
                        <h3 class="font-weight-bold mr-3 mb-0">High Class</h3>
                        <div class="s7_nabidka-aut-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="s7_nabidka-aut-typ-auto font-italic mb-1">Škoda Superb Laurint Clement</div>
                    <p class="s7_nabidka-aut-popis">Etiam aliquam, arcu tristique ultrices vestibulum, augue erat convallis dui, a sodales quam augue ut ligula. <button class="border-0 radius-0"><i class="far fa-image"></i>Více fotografií</button></p>
                </div>
                <div class="s7_reservation-buttons w-100">
                    <div class="s7_res-button-one-way d-flex align-items-center">
                        <div class="s7_res-price w-100 font-weight-bold"><p class="s7_res-big-text">580 <span class="s7_res-normal-text">Kč</span></p><p class="s7_res-small-text mb-0">jednosměrná</p></div>
                        <a href="#" class="s7_res-btn w-100 btn rounded-0 border-0 text-uppercase d-flex justify-content-between align-items-center"><span class="text-white">Rezervovat</span><i class="fas fa-chevron-right text-white"></i></a>
                    </div>
                    <div class="s7_res-button-two-way d-flex align-items-center">
                        <div class="s7_res-price w-100 font-weight-bold"><p class="s7_res-big-text">1.000 <span class="s7_res-normal-text">Kč</span></p><p class="s7_res-small-text mb-0">obousměrná</p></div>
                        <a href="#" class="s7_res-btn w-100 btn rounded-0 border-0 text-uppercase d-flex justify-content-between align-items-center"><span class="text-white">Rezervovat</span><i class="fas fa-chevron-right text-white"></i></a>
                    </div>
                </div>
            </div>
            <div class="s7_nabidka-aut-sluzby d-flex flex-row">
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-4.png" alt="láhev vody" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Pití zdarma</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-1.png" alt="platební karty" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Platba online</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-3.png" alt="štít" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Bezpečnost</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-2.png" alt="wifi" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Wifi na palubě</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-4.png" alt="nonstop" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Pití zdarma</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-1.png" alt="platební karty" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Platba online</p>
                </div>
            </div>
        </div>
        <div class="s7_nabidka-aut">
            <div class="s7_nabidka-aut-info d-flex">
                <figure class="s7_res-car-img mb-0 position-relative"><img src="../yourpraguetransfer/wp-content/themes/yourpraguetransfer/assets/images/auto-reservation.png" alt=""></figure>
                <div class="s7_car-text">
                    <div class="d-flex align-items-center">
                        <h3 class="font-weight-bold mr-3 mb-0">High Class</h3>
                        <div class="s7_nabidka-aut-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="s7_nabidka-aut-typ-auto font-italic mb-1">Škoda Superb Laurint Clement</div>
                    <p class="s7_nabidka-aut-popis">Etiam aliquam, arcu tristique ultrices vestibulum, augue erat convallis dui, a sodales quam augue ut ligula. <button class="border-0 radius-0"><i class="far fa-image"></i>Více fotografií</button></p>
                </div>
                <div class="s7_reservation-buttons w-100">
                    <div class="s7_res-button-one-way d-flex align-items-center">
                        <div class="s7_res-price w-100 font-weight-bold"><p class="s7_res-big-text">580 <span class="s7_res-normal-text">Kč</span></p><p class="s7_res-small-text mb-0">jednosměrná</p></div>
                        <a href="#" class="s7_res-btn w-100 btn rounded-0 border-0 text-uppercase d-flex justify-content-between align-items-center"><span class="text-white">Rezervovat</span><i class="fas fa-chevron-right text-white"></i></a>
                    </div>
                    <div class="s7_res-button-two-way d-flex align-items-center">
                        <div class="s7_res-price w-100 font-weight-bold"><p class="s7_res-big-text">1.000 <span class="s7_res-normal-text">Kč</span></p><p class="s7_res-small-text mb-0">obousměrná</p></div>
                        <a href="#" class="s7_res-btn w-100 btn rounded-0 border-0 text-uppercase d-flex justify-content-between align-items-center"><span class="text-white">Rezervovat</span><i class="fas fa-chevron-right text-white"></i></a>
                    </div>
                </div>
            </div>
            <div class="s7_nabidka-aut-sluzby d-flex flex-row">
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-4.png" alt="láhev vody" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Pití zdarma</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-1.png" alt="platební karty" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Platba online</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-3.png" alt="štít" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Bezpečnost</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-2.png" alt="wifi" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Wifi na palubě</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-4.png" alt="nonstop" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Pití zdarma</p>
                </div>
                <div class="s7_reservation-ico text-center d-flex align-items-center">
                    <figure class="s7_res-ico mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/res-ico-1.png" alt="platební karty" class="s7_reservation-ico-img"></figure>
                    <p class="s7_reservation-ico-text text-uppercase font-weight-bold mb-0">Platba online</p>
                </div>
            </div>
        </div>
    </div>
    <div class="s7_map-col col-xl-6 col-12 px-0">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d327864.24120414926!2d14.18544508487069!3d50.05933245499073!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470b939c0970798b%3A0x400af0f66164090!2sPraha!5e0!3m2!1scs!2scz!4v1595241988737!5m2!1scs!2scz" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" class="s7_mapitself"></iframe>
    </div>
</section>
<section id="res-contact" class="container-fluid d-flex justify-content-center">
    <div class="s7_res-contact-phone d-flex align-items-center">
        <figure class="mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/phone.png" alt="phone" class="s7_res-contact-ico-img w-100"></figure>
        <a href="tel:+420 722 855 989" class="s7_res-contact-ico-text font-weight-bold text-decoration-none">+420 722 855 989</a>
    </div>
    <div class="s7_res-contact-envelope d-flex align-items-center">
        <figure class="mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/envelope.png" alt="phone" class="s7_res-contact-ico-img w-100"></figure>
        <a href="mailto:info@yourpraguetransfers.cz" class="s7_res-contact-ico-text font-weight-bold text-decoration-none">info@yourpraguetransfers.cz</a>
    </div>
    <div class="s7_res-contact-map d-flex align-items-center">
        <figure class="mb-0"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/map-mark.png" alt="phone" class="s7_res-contact-ico-img w-100"></figure>
        <span class="s7_res-contact-ico-text font-weight-bold">Evropská 27, 247 89, Praha 6</span>
    </div>
</section>
<?php include "footer.php"; ?>