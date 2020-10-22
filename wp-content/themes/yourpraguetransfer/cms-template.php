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
?>
     
<div class="wp-block-group container-fluid s7_us_sec1"><div class="wp-block-group__inner-container">
<div class="wp-block-group s7_sw-sec mx-auto"><div class="wp-block-group__inner-container">
<h1 class="has-text-align-center font-weight-bold text-uppercase"><?php the_title(); ?></h1>
<div class="s7_breadcrumbs"></div>
</div></div>
</div></div>                         

<?php
                the_post();
                the_content();
            }
        }
        ?>
    </section>

<?php get_footer() ?>
