<header class="container-fluid bg-white px-0 fixed-special-top">
    <nav class="s7_sw-sec navbar navbar-expand-lg mx-auto"> <!-- Bootstrap sticky responsive header -->
        <div class="navbar-brand">

            <?php
            if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                the_custom_logo();
            }else {
            ?>
                <h1><?php echo get_bloginfo( 'name' ); ?></h1>
            <?php } ?>

        </div> <!-- Logo -->
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> <!-- Burger Icon -->
        <div id="navbarCollapse" class="navbar-collapse collapse"> <!-- Responsive menu -->
            <?php if ( has_nav_menu( 'cms_header_menu' ) && get_locale()=="cs_CZ" ) : ?>

                <?php
                $menu_args = array(
                    'theme_location' => 'cms_header_menu',
                    'walker'         => new Realsys_menu(),
                    'container'      => "",
                    'menu_class' => 'navbar-nav ml-auto justify-content-between align-items-md-center align-items-end flex-md-row flex-column'
                );
                wp_nav_menu( $menu_args );
                ?>
            <?php endif; ?>

            <?php if ( has_nav_menu( 'cms_header_menu_en' ) && get_locale()=="en_US" ) : ?>

                <?php
                $menu_args = array(
                    'theme_location' => 'cms_header_menu_en',
                    'walker'         => new Realsys_menu(),
                    'container'      => "",
                    'menu_class' => 'navbar-nav ml-auto justify-content-between align-items-md-center align-items-end flex-md-row flex-column'
                );
                wp_nav_menu( $menu_args );
                ?>
            <?php endif; ?>

        </div>
    </nav>
</header>
<div id="content" class="s7_site-content"> <!-- Page Content START -->