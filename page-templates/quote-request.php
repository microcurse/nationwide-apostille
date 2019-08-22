<?php
/**
 *
 * Template for displaying the quote request page. Shows the form in the main content and the estimated total on the side.
 *
 * Template Name: Quote Request
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

// Remove page title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// Hero Banner
add_action( 'genesis_after_header', 'hero_banner_open', 5 );
// Add page title
add_action( 'genesis_after_header', 'genesis_do_post_title', 6 );
// Close Hero Banner
add_action( 'genesis_after_header', 'hero_banner_close', 15 );

add_action( 'genesis_entry_content', 'custom_loop' );

function custom_loop() { ?>
<?php acf_form_head(); ?>
<?php get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				
				<h1><?php the_title(); ?></h1>
				
				<?php the_content(); ?>
				
				<p>My custom field: <?php the_field('country'); ?></p>
				
				<?php acf_form(); ?>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php }

// Runs the Genesis loop.
genesis();