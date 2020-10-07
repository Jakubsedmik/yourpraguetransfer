<?php
/*
Template Name: CMS Template
*/
get_header();
?>

<section class="pt-3 pb-5 bg-light">
    <div class="s7_sw-sec mx-auto">
        <div class="wrapper">


			<?php
            /* OBSAH JDOUCÍ Z POSTU */
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					the_content();
				}
			}
			?>
		</div>
	</div>
</section>

<?php get_footer() ?>
