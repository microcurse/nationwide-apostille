<?php
/**
 *
 * A template to force a hero banner and right sidebar and a state requirements dropdown.
 *
 * Template Name: Apostille Page
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

add_action( 'genesis_after_content', 'show_state_requirements_posts', 20);

add_action('genesis_loop', 'custom_loop');

function custom_loop() {

  global $paged;
  $args = array('post_type' => 'state_requirements' );

  genesis_custom_loop( $args );
}

// Runs the Genesis loop.
genesis();