<?php
/**
 * The template for displaying all State Requirements
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 * @package Genesis\Templates
 * @author  Marc RM
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

// Remove post info
add_filter( 'genesis_post_info', 'remove_post_info' );
function remove_post_info ($post_info) {
	$post_info = '';
	return $post_info;
}

genesis();