<?php get_header(); ?>

<div class="wp-block-group container-fluid s7_us_sec1">
    <div class="wp-block-group__inner-container">
        <div class="wp-block-group s7_sw-sec mx-auto">
            <div class="wp-block-group__inner-container">
                <h1 class="has-text-align-center font-weight-bold text-uppercase"><?php _e("404 - Nenalezeno", "realsys"); ?></h1>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid position-relative pt-5 pb-5">
    <div class="s7_sw-sec mx-auto text-center">
        <h1>
            <?php _e("404 - STRANA NENALEZENA", "realsys"); ?>
        </h1>
        <p><?php _e("Litujeme, tuto stránku jsme nenalezli. Zkuste prosím něco jiného.", "realsys"); ?></p>
        <div class="phaseone-content">
            <a class="btn" href="<?php home_url(); ?>">
                <?php _e("Zpět na úvod", "realsys"); ?>
            </a>
        </div>
    </div>
</section>
<?php get_footer(); ?>
