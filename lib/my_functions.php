<?php
/*
*   My Custom Functions 
*
*/

// Async load
function na_async_scripts( $url ) {
	if( strpos( $url, '#asyncload' ) === false)
		return $url;
	else if( is_admin() )
		return str_replace( '#asyncload', '', $url );
	else
		return str_replace( '#asyncload', '', $url )."' async='async";
}
add_filter( 'clean_url', 'na_async_scripts', 11, 1);

function add_scripts_styles() {
  	wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css?family=Hind:400,700|Merriweather&display=swap', false);
		wp_enqueue_script( 'sticky-sidebar', get_stylesheet_directory_uri() . '/js/sticky-sidebar/sticky-sidebar.js#asyncload', array( 'jquery' ), '1.0', true);
		wp_enqueue_style( 'color-styles', get_stylesheet_directory_uri() . '/colors.css' );
	}
add_action( 'wp_enqueue_scripts', 'add_scripts_styles', 10 );

function load_custom_wp_admin_style() {
	wp_register_style( 'custom_wp_admin_css', get_stylesheet_directory_uri() . '/admin-style.css', false, '1.0.0' );
	wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

function na_color_palette() {
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  =>  __( 'White', 'genesis-sample' ),
			'slug'  =>  'white',
			'color' =>  '#ffffff',
		),      
		array(
			'name'  =>  __( 'Light gray', 'genesis-sample' ),
			'slug'  =>  'light-gray',
			'color' =>  '#f5f5f5',
		),
		array(
			'name'  =>  __( 'Medium gray', 'genesis-sample' ),
			'slug'  =>  'medium-gray',
			'color' =>  '#999',
		),
		array(
			'name'  =>  __( 'Dark gray', 'genesis-sample' ),
			'slug'  =>  'dark-gray', 'genesis-sample',
			'color' =>  '#333',
		),
		array(
			'name'  =>  __( 'Primary blue', 'genesis-sample' ),
			'slug'  =>  'primary-blue', 'genesis-sample',
			'color' =>  '#0D3B66',
		),
		array(
			'name'  =>  __( 'Primary button blue', 'genesis-sample' ),
			'slug'  =>  'primary-button-blue', 'genesis-sample',
			'color' =>  '#1275d1',
		),
		array(
			'name'  =>  __( 'Secondary tan', 'genesis-sample' ),
			'slug'  =>  'secondary-tan', 'genesis-sample',
			'color' =>  '#CBC0AD',
		),
	));
}
add_action( 'after_setup_theme', 'na_color_palette' );

 /************ Advanced Custom Fields */ 

/*** Hero banner */
function hero_banner_open() {

	$image = get_field( 'hero_banner' );
	$size = 'full';

	if( $image ) {
		echo wp_get_attachment_image( $image, $size );
	}

	echo '<div class="hero" style="background-image: url(' . $image . ');"><div class="wrap">';
}

function hero_banner_close() {
	echo '</div></div>';
}

function add_hero_banner() {
	$image = get_field( 'image' );
	$size = 'full';

	if( $image ) {
		echo wp_get_attachment_image( $image, $size );
	}
}

/*** Why choose us section */
function open_why_choose_us() {
	echo '<div class="widget yellow-bg why-choose-us"><h2 class="widgettitle widget-title">Why Choose Us?</h3>';
}

function add_why_choose_us() {
	the_field( 'why_choose_us' );
}

function sidebar_get_quote() {
	$link = get_field( 'get_quote_link' );

	if( $link ): ?>
	 <a class="standard-btn has-background" href="<?php echo $link; ?>">Get a Quote</a>
	
	<?php endif;
}

function close_why_choose_us() {
	echo '</div>';
}

// 4 Column Footer Widgets
add_theme_support( 'genesis-footer-widgets', 4 );

function na_add_copyright() {
	$copyright = '<div class="creds"><p>Copyright &copy; ' . date('Y') . ' Nationwide Apostille - All Rights Reserved</p></div>';
	return $copyright;
}
add_filter( 'genesis_footer_creds_text', 'na_add_copyright' );


// Add new taxonomy, NOT hierarchical (like tags)
function create_states_taxonomy() {
	if(!taxonomy_exists('states')) {
		register_taxonomy('states', array('post'),array(
			'show_ui' => false
		));
	}
}
add_action('init', 'create_states_taxonomy');

/** When the post is saved, saves our custom data */
function save_first_letter( $post_id ) {
	// verify if this is an auto save routine
	// If it is our form has not been submitted, so we don't want to do anything
	if ( defined('DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;

	// check location (only run for posts)
	if ( !in_array($_POST['post_type'], $limitPostTypes ))
		return $post_id;

	// check permissions
	if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;

	// OK, we're authenticated: we need to find and save the data
	$taxonomy = 'states';

	// set term as first letter of post title, lower case
	wp_set_post_terms( $post_id, strtolower(substr($_POST['post_title'], 0, 1)), $taxonomy );

	// delete the transient that is storing the alphabet letters
	delete_transient( 'archive_alphabet' );
}
add_action( 'save_post', 'save_first_letter' );

$taxonomy = 'states';

// create array from existing posts
function run_once() {
	
	if ( false === get_transient( 'run_once' ) ) {

		$taxonomy = 'states';
		$alphabet = array();

		$posts = get_posts(array('numberposts' => -1) );

		foreach( $posts as $p ) :
			// set term as first letter of post title, lower case
			wp_set_post_terms( $p->ID, strtolower(substr($p->post_title, 0, 1)), $taxonomy);
		endforeach; 

		set_transient( 'run_once', 'true' );
	}
}
add_action('init', 'run_once');