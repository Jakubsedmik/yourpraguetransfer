<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
        <?php wp_head(); ?>



        <!--Font Awesome-->
        <link href="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/FontAwesome/fontawesome-free-5.13.1-web/css/fontawesome.css" rel="stylesheet">
        <link href="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/FontAwesome/fontawesome-free-5.13.1-web/css/brands.css" rel="stylesheet">
        <link href="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/FontAwesome/fontawesome-free-5.13.1-web/css/solid.css" rel="stylesheet">
        <link href="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/FontAwesome/fontawesome-free-5.13.1-web/css/regular.css" rel="stylesheet">

        
    </head>
    <body <?php body_class(); ?>>

    <?php
        wp_body_open();
        get_template_part("templates/header","main");
    ?>
