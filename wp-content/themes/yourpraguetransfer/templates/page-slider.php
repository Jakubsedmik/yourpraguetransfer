<!-- Main slider -->
<section id="main-slider" class="container-fluid">
    <div class="s7_main-slider-sw s7_sw-sec mx-auto">
        <h1 class="text-center text-white text-uppercase pb-2 mb-4"><?php echo get_theme_mod( "slider_text_main" ); ?></h1>
        <p class="s7_slider-under-title-text text-center text-white"><?php echo get_theme_mod( "slider_text_secondary" ); ?></p>
        <form action="" class="s7_ftw text-center w-100 mx-auto">
            <div class="s7_slider-inputs d-flex align-items-center justify-content-between flex-md-row flex-column">
                <input type="text" placeholder="Z místa (např. Letiště Václava ..." class="w-100 border-0 px-3 py-0">
                <div class="s7_ftw-arrown">
                    <i class="fas fa-caret-right active mr-2 text-white"></i>
                    <i class="fas fa-caret-right mr-2 text-white"></i>
                    <i class="fas fa-caret-right mr-2 text-white"></i>
                    <i class="fas fa-caret-right mr-2 text-white"></i>
                    <i class="fas fa-caret-right mr-2 text-white"></i>
                    <i class="fas fa-caret-right text-white"></i>
                </div>

                <input type="text" placeholder="Do místa (např. centrum Praha)" class="w-100 border-0 px-3 py-0">
            </div>
            <button type="submit" class="btn mx-auto border-0 rounded-0 font-weight-bold d-flex justify-content-between align-items-center w-100 py-3 mb-4">
                <span class="text-white text-uppercase"><?php echo get_theme_mod( "slider_button_text" ); ?></span>
                <i class="fas fa-chevron-right text-white"></i>
            </button>
        </form>
        <p class="text-center text-white font-italic mb-5">
            <?php echo get_theme_mod( "slider_perex_text" ); ?>
        </p>
        <div class="row">
            <div class="s7_slider-ico col text-center">
                <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/drink.png" alt="láhev vody" class="s7_slider-ico-img">
                <p class="s7_slider-ico-text text-white text-uppercase font-weight-bold">Pití zdarma</p>
            </div>
            <div class="s7_slider-ico col text-center">
                <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/pay-cards.png" alt="platební karty" class="s7_slider-ico-img">
                <p class="s7_slider-ico-text text-white text-uppercase font-weight-bold">Platba online</p>
            </div>
            <div class="s7_slider-ico col text-center">
                <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/Safety.png" alt="štít" class="s7_slider-ico-img">
                <p class="s7_slider-ico-text text-white text-uppercase font-weight-bold">Bezpečnost</p>
            </div>
            <div class="s7_slider-ico col text-center">
                <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/wifi.png" alt="wifi" class="s7_slider-ico-img">
                <p class="s7_slider-ico-text text-white text-uppercase font-weight-bold">Wifi na palubě</p>
            </div>
            <div class="s7_slider-ico col text-center">
                <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/24-7-ico.png" alt="nonstop" class="s7_slider-ico-img">
                <p class="s7_slider-ico-text text-white text-uppercase font-weight-bold">Nonstop 24/7</p>
            </div>
        </div>
        <div class="text-center">
            <a href="#" class="s7_slider-covid d-flex mx-auto w-100 align-items-center justify-content-center"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/virus.png" alt="virus" class="s7_virus-img w-100 mr-2"><span class="s7_slider-covid-text text-white text-uppercase"><strong class="text-white">Covid19 </strong>opatření</span></a>
        </div>
    </div>
</section>