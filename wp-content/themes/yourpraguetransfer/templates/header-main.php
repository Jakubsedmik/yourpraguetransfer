<header class="container-fluid bg-white px-0 fixed-special-top">
    <nav class="s7_sw-sec navbar navbar-expand-lg mx-auto"> <!-- Bootstrap sticky responsive header -->
        <a href="/" class="navbar-brand"><img src="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/page-logo.png" alt="logo-icon-car"></a> <!-- Logo -->
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> <!-- Burger Icon -->
        <div id="navbarCollapse" class="navbar-collapse collapse"> <!-- Responsive menu -->
            <?php if ( has_nav_menu( 'cms_header_menu' ) ) : ?>

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
        </div>
    </nav>
</header>
<div id="content" class="s7_site-content"> <!-- Page Content START -->