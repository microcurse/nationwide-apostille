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

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_entry_content', 'custom_loop' );

function custom_loop() { ?>
  <article itemtype="http://schema.org/CreativeWork" itemscope="itemscope" class="post-<?php print $pageid; ?> page type-page status-publish entry">
  <div class="entry-content" itemprop="text">
    <?php if( have_posts() ) : while( have_posts() ) : the_post();
    echo get_field('country');
    acf_form(); 
    endwhile; endif;
    ?> 
  </div></article>
<?php }

// Runs the Genesis loop.
genesis();