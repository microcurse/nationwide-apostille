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


// Runs the Genesis loop.
genesis();