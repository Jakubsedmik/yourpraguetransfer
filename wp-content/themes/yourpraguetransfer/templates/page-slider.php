<!-- Main slider -->
<section id="main-slider" class="container-fluid">
    <div class="s7_main-slider-sw s7_sw-sec mx-auto">
        <h1 class="font-weight-bold text-center text-uppercase pb-2 mb-4 animate__animated animate__fadeInDown animate__delay-1s"><?php echo_lang_theme_mod( "slider_text_main" ); ?></h1>
        <p class="s7_slider-under-title-text text-center animate__animated animate__fadeInDown animate__delay-2s"><?php echo_lang_theme_mod( "slider_text_secondary" ); ?></p>
        <form action="<?php echo Tools::getFERoute("vozidloClass",false,"listing"); ?>" method="GET" class="s7_ftw text-center w-100 mx-auto animate__animated animate__bounceIn animate__delay-3s">
            <div class="s7_slider-inputs d-flex align-items-center justify-content-between flex-md-row flex-column">
                <div class="s7_form-field">
                    <img src="<?php echo FRONTEND_IMAGES_PATH; ?>/input1.png">
                    <input type="text" placeholder="Z místa (např. Letiště Václava ..." class="w-100 border-0 px-5 py-0 js-autocomplete" name="destination_from" required>
                </div>
                <div class="s7_ftw-arrown">
                    <i class="fas fa-caret-right active mr-2 "></i>
                    <i class="fas fa-caret-right mr-2"></i>
                    <i class="fas fa-caret-right mr-2"></i>
                    <i class="fas fa-caret-right mr-2"></i>
                    <i class="fas fa-caret-right mr-2"></i>
                    <i class="fas fa-caret-right"></i>
                </div>
                <div class="s7_form-field">
                    <img src="<?php echo FRONTEND_IMAGES_PATH; ?>/input2.png">
                    <input type="text" placeholder="Do místa (např. centrum Praha)" class="w-100 border-0 px-5 py-0 js-autocomplete" name="destination_to" required>
                </div>
            </div>
            <div type="submit" class="btn mx-auto border-0 rounded-0 font-weight-bold d-flex justify-content-between align-items-center w-100 py-3 mb-4">
                <span class="text-white text-uppercase"><?php echo_lang_theme_mod( "slider_button_text" ); ?></span>
                <i class="fas fa-chevron-right text-white"></i>
            </div>
        </form>
        <p class="text-center font-italic mb-5 animate__animated animate__fadeInUp animate__delay-4s">
            <?php echo_lang_theme_mod( "slider_perex_text" ); ?>
        </p>
        <div class="row s7_slider-usps animate__animated animate__fadeInUp animate__delay-5s">
            <div class="s7_slider-ico col text-center">
                <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/images_frontend/drink.png" alt="láhev vody" class="s7_slider-ico-img">
                <p class="s7_slider-ico-text text-uppercase font-weight-bold"><?php echo_lang_theme_mod( "usp1" ); ?></p>
            </div>
            <div class="s7_slider-ico col text-center">
                <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/images_frontend/pay-cards.png" alt="platební karty" class="s7_slider-ico-img">
                <p class="s7_slider-ico-text text-uppercase font-weight-bold"><?php echo_lang_theme_mod( "usp2" ); ?></p>
            </div>
            <div class="s7_slider-ico col text-center">
                <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/images_frontend/Safety.png" alt="štít" class="s7_slider-ico-img">
                <p class="s7_slider-ico-text text-uppercase font-weight-bold"><?php echo_lang_theme_mod( "usp3" ); ?></p>
            </div>
            <div class="s7_slider-ico col text-center">
                <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/images_frontend/wifi.png" alt="wifi" class="s7_slider-ico-img">
                <p class="s7_slider-ico-text text-uppercase font-weight-bold"><?php echo_lang_theme_mod( "usp4" ); ?></p>
            </div>
            <div class="s7_slider-ico col text-center">
                <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/images_frontend/24-7-ico.png" alt="nonstop" class="s7_slider-ico-img">
                <p class="s7_slider-ico-text text-uppercase font-weight-bold"><?php echo_lang_theme_mod( "usp5" ); ?></p>
            </div>
        </div>
        <div class="text-center animate__animated animate__fadeInUp animate__delay-5s">
            <a href="<?php echo_lang_theme_mod( "slider_covid_url" ); ?>" class="s7_slider-covid d-flex mx-auto w-100 align-items-center justify-content-center"><img src="<?php echo FRONTEND_IMAGES_PATH; ?>/virus.png" alt="virus" class="s7_virus-img w-100 mr-2"><span class="s7_slider-covid-text text-white text-uppercase"><?php echo_lang_theme_mod( "slider_covid_text" ); ?></span></a>
        </div>
    </div>
</section>