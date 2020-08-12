<?php
/*
Template Name: CMS Template
*/
get_header();
?>

<section>
	<div class="cms-con">
		<div class="wrapper">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					the_content();
					//
					// Post Content here
					//
				} // end while
			} // end if
			?>
		</div>
	</div>
</section>

<?php get_footer() ?>
