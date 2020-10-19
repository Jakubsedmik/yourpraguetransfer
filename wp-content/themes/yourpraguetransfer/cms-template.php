<?php
/*
Template Name: CMS Template
*/
get_header();
?>

    <section class="wrapper">


        <?php
        /* OBSAH JDOUCÍ Z POSTU */
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                the_content();
            }
        }
        ?>
    </section>

<?php get_footer() ?>
