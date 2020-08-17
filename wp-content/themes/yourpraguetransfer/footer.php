        </div><!-- #content -->
        <footer id="footer" class="container-fluid">
            <div class="s7_sw-sec mx-auto">
                <figure class="text-lg-left text-center">
                    <img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/images_frontend/page-logo.png" alt="logo v patičce" class="s7_footer-logo">
                </figure>
                <div class="row text-md-left text-center">
                    <div class="s7_footer-col-menu col-lg-2 col-md-6 col-12">
                        <?php if ( is_active_sidebar( 'first_footer_col' ) ) : ?>
                            <?php dynamic_sidebar('first_footer_col'); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <?php if ( is_active_sidebar( 'second_footer_col' ) ) : ?>
                            <?php dynamic_sidebar('second_footer_col'); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <?php if ( is_active_sidebar( 'third_footer_col' ) ) : ?>
                            <?php dynamic_sidebar('third_footer_col'); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <?php if ( is_active_sidebar( 'fourth_footer_col' ) ) : ?>
                            <?php dynamic_sidebar('fourth_footer_col'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </footer>
        <footer id="copyright">
            <p class="s7_copyright-reference text-uppercase text-center font-weight-light mb-0">Vytvořilo <a href="http://studioseven.cz/" class="text-decoration-none">StudioSeven.cz</a></p>
        </footer>

        <?php wp_footer(); ?>
        <?php
        if(!DEPLOYMENT){
            echo globalUtils::renderDebug();
        }
        ?>
    </body>
</html