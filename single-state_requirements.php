<?php
/**
 * The template for displaying a State's Apostille Requirements
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">
		<h1>TEST THIS SHIT</h1>
			<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
