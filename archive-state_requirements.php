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

// save the terms that have posts in an array as a transient
if ( false === ($alphabet = get_transient( 'archive_alphabet'))) {
	// it wasn't there, so regenerate the data and save the transient
	$terms = get_terms($taxonomy);

	$alphabet = array();
	if($terms) {
		foreach ($terms as $term) {
			$alphabet[] = $term->slug;
		}
	}
	set_transient( 'archive_alphabet', $alphabet );
}

?>
<div id="archive-menu" class="menu">
	<ul id="alphabet-menu">
		<?php
			foreach(range('a', 'z') as $i ) :
				$current = ($i == get_query_var($taxonomy)) ? "current-menu-item" : "menu-item";
				
				if (in_array( $i, $alphabet )) {
					printf( '<li class="az-char %s"><a href="%s">%s</a></li>', $current, get_term_link( $i, $taxonomy ), strtoupper($i) );
				} else {
					printf ( '<li class="az-char %s">%s</li>', $current, strtoupper($i) );
				}
			endforeach;
			?>
	</ul>
</div>
<?php

genesis();