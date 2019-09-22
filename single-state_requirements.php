<?php
/**
 * The template for displaying a State's Apostille Requirements
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */


add_action( 'genesis_after_loop', 'go_back_link');
function go_back_link() {
	echo '<a href="https://nationwideapostille.dev.cc/state_requirements/">Go back to all State Requirements</a>';
}


genesis();
