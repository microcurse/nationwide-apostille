<?php
/**
 * The template for displaying a State's Apostille Requirements
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */

// Remove post info
add_filter( 'genesis_post_info', 'remove_post_info' );
function remove_post_info ($post_info) {
	$post_info = '';
	return $post_info;
}

genesis();
