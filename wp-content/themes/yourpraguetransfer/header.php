<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
        <?php wp_head(); ?>

    </head>
    <body <?php body_class(); ?>>

    <?php
        wp_body_open();
        get_template_part("templates/header","main");
    ?>
