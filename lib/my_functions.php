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