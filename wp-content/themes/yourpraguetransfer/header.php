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

    <ul class="s7-languageSwitcher">
        <?php global $languages; ?>
        <?php foreach ($languages as $key => $val): ?>
            <li>
                <a href="<?php echo home_url() . "?lang=" . $val['code']; ?>" title="<?php echo $val['label']; ?>">
                    <img src="<?php echo $val['label_image'] ?>">
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
