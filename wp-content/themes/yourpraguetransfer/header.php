<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
    <head>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-1ZYK47M80K"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-1ZYK47M80K');
        </script>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php wp_title(); ?></title>

        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/images_frontend/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/images_frontend/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/images_frontend/icons/favicon-16x16.png">
        <link rel="manifest" href="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/images_frontend/icons/site.webmanifest">
        <link rel="mask-icon" href="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/images_frontend/icons/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/images_frontend/icons/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="<?php echo home_url(); ?>/wp-content/themes/yourpraguetransfer/assets/images/images_frontend/icons/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">

        <?php wp_head(); ?>

    </head>
    <body <?php body_class(); ?>>

    <?php
        wp_body_open();
        get_template_part("templates/header","main");
        get_template_part("templates/language","switcher");
    ?>

