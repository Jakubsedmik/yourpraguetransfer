<?php get_header(); ?>


<?php
    $zona = assetsFactory::getEntity("zonaClass", 4);

    $point = new stdClass();
    $point->lat = 50.098450;
    $point->lng = 14.365457;
    $zona->isVertexInside($point);

?>


<?php
    get_template_part("templates/page","slider");

    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post();
            the_content();
            //
            // Post Content here
            //
        } // end while
    } // end if

    get_template_part("templates/page","vehiclepark");
    get_template_part("templates/page","reviews");
    get_template_part("templates/page","numberone");
    get_template_part("templates/page","contact");
    get_template_part("templates/page","gallery");
?>



<?php get_footer() ?>


