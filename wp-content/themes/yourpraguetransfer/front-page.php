<?php get_header(); ?>




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


