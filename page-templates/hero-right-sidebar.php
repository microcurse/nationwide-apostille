<?php
/**
 *
 * A template to force a hero banner and right sidebar 
 *
 * Template Name: Hero with right sidebar
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

//add_action( 'genesis_after', 'add_sticky_sidebar', 20 );
function add_sticky_sidebar() {
  ?>
  <script>
  var sidebar = new StickySidebar('#genesis-sidebar-primary', {
    containerSelector: '#genesis-content',
    innerWrapperSelector: '.sidebar__inner',
    topSpacing: 20,
    bottomSpacing: 20
  });
  </script>
  <?php
}

// Runs the Genesis loop.
genesis();