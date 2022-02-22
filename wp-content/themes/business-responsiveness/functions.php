<?php 
/**
 * Business functions and definitions
 *
 * @package WordPress
 * @subpackage business-responsiveness
 * @since Business Responsiveness 1.0.0
 */

/*
 * business theme url variables defining
 */
 
define(
	'Business_Responsiveness_TEMPLATE_DIR_URI' ,
	get_template_directory_uri()
);	
define(
	'Business_Responsiveness_TEMPLATE_DIR' , 
	get_template_directory() 
);
define(
	'Business_Responsiveness_THEME_FUNCTIONS_PATH' , 
	Business_Responsiveness_TEMPLATE_DIR.'/functions'
);


/*
 * business include config file
 */
 require_once( Business_Responsiveness_THEME_FUNCTIONS_PATH.'/class-love/class-love.php');
 require( Business_Responsiveness_TEMPLATE_DIR.'/include/admin_notice.php');
new Business_Responsiveness_notice_bord();
 require_once( Business_Responsiveness_THEME_FUNCTIONS_PATH.'/customizer/customizer-repeater/class/class-business-responsive-repeater.php');
 require_once( Business_Responsiveness_THEME_FUNCTIONS_PATH . '/scripts/script.php');
 require_once( Business_Responsiveness_THEME_FUNCTIONS_PATH.'/customizer/business-general-settings.php');
 require_once( Business_Responsiveness_THEME_FUNCTIONS_PATH.'/customizer/business-homepage-settings.php');
 require_once( Business_Responsiveness_THEME_FUNCTIONS_PATH.'/customizer/business-blog-settings.php');
 require_once( Business_Responsiveness_THEME_FUNCTIONS_PATH.'/customizer/business-page-settings.php');
 require_once( Business_Responsiveness_THEME_FUNCTIONS_PATH.'/customizer/business-typography-settings.php');
 require_once( Business_Responsiveness_THEME_FUNCTIONS_PATH.'/menu/wp_bootstrap_navwalker.php');
 require_once( Business_Responsiveness_THEME_FUNCTIONS_PATH.'/menu/default_menu_walker.php');
 require_once( Business_Responsiveness_THEME_FUNCTIONS_PATH.'/widget/sidebar.php');
 require_once( Business_Responsiveness_THEME_FUNCTIONS_PATH.'/template-tags.php');
 require_once( Business_Responsiveness_THEME_FUNCTIONS_PATH.'/breadcrumbs/breadcrumbs.php');
 require_once( Business_Responsiveness_THEME_FUNCTIONS_PATH.'/font/font.php');
 require_once( Business_Responsiveness_TEMPLATE_DIR.'/include/about-theme/welcome-screen.php');
 require_once( Business_Responsiveness_TEMPLATE_DIR.'/functions/features/feature-theme-info-section.php');
 require_once( Business_Responsiveness_TEMPLATE_DIR . '/woocommerce/functions.php');
	$plugin_installer_file = Business_Responsiveness_TEMPLATE_DIR.'/functions/install/class-business-responsive-install-helper.php';
	if ( file_exists( $plugin_installer_file ) ) { require_once( $plugin_installer_file ); }
	$wooinfo_path = Business_Responsiveness_TEMPLATE_DIR . '/functions/customizer/customizer-woocommerce-info/class-business-responsive-woocommerce-info.php';
	if ( file_exists( $wooinfo_path ) ) { require_once( $wooinfo_path ); }
	$contactinfo_path = Business_Responsiveness_TEMPLATE_DIR . '/functions/customizer/customizer-contactform-info/class-business-responsive-contactform-info.php';
	if ( file_exists( $contactinfo_path ) ) { require_once($contactinfo_path); }
	if ( file_exists( $wooinfo_path ) ) { require_once( $wooinfo_path ); }
 
if ( ! function_exists( 'Business_Responsiveness_setup' ) ) :
function Business_Responsiveness_setup(){
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'business-responsiveness', get_template_directory() . '/lang' );
	
	
	/*
	 * Add default posts and comments RSS feed links to head.
	 */
	add_theme_support( 'automatic-feed-links' );
	
	/*
	 * manage the document title.
	 */
	add_theme_support( 'title-tag' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 */
	add_theme_support( 'post-thumbnails' );
	
	/*
	 * This theme uses wp_nav_menu() in primary locations.
	 *
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'business-responsiveness' ),
		'footer'  => __( 'Footer Menu', 'business-responsiveness' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	/*
	 * Custom logo
	 * Add theme support for custom logo. https://codex.wordpress.org/Theme_Logo
	 */
	$args = array(
		'flex-width'  => true,
	);
	add_theme_support( 'custom-logo', $args );
	
	// Add custom header support. https://codex.wordpress.org/Custom_Headers
	$args = array(
		'width'        => 1600,
		'flex-width'   => true,
		'default-image' => get_template_directory_uri() . '/images/seprator_back.jpg',
		// Header text
		'header-text'   => false,
	);
	add_theme_support( 'custom-header', $args );
	
	$header_image = array(
			'library' => array(
				'url'           => get_template_directory_uri() . '/images/seprator_back.jpg',
				'thumbnail_url' => get_template_directory_uri() . '/images/seprator_back.jpg',
				'description'   => 'Library Ceiling',
			),
		);
	register_default_headers( $header_image );
	
	// Add custom background support. https://codex.wordpress.org/Custom_Backgrounds
	add_theme_support( 'custom-background', array(
			'default-color' => 'ffffff',
		)
	);
	
	/*
	 * woocommerce support
	 */
	add_theme_support( 'woocommerce' );
	add_editor_style( array( 'css/editor-style.css', get_template_directory_uri() ) );
}
endif;  // Business_Responsiveness_setup
add_action( 'after_setup_theme', 'Business_Responsiveness_setup' );
/**
 * Save activation time.
 *
 * @access public
 */
function Business_Responsiveness_time_activated() {
	update_option( 'business_time_activated', time() );
}
add_action( 'after_switch_theme', 'Business_Responsiveness_time_activated' );

/**
 * Check if 12 hours have passed since theme was activated.
 *
 * @access public
 * @return bool
 */
function Business_Responsiveness_ready_for_upsells() {
	$activation_time = get_option( 'business_time_activated' );
	if ( ! empty( $activation_time ) ) {
		$current_time    = time();
		$time_difference = 43200;
		if ( $current_time >= $activation_time + $time_difference ) {
			return true;
		} else {
			return false;
		}
	}
	return true;
}
// wp title       
function Business_Responsiveness_title( $title, $sep )
{	
    global $paged, $page;
	if( is_home() ){
		return $title;
	}
	if ( is_feed() )
        return $title;
		// Add the site name.
		$title .= esc_html( get_bloginfo( 'name' ) );
		// Add the site description for the home/front page.
		$site_description = esc_html(  get_bloginfo( 'description' ) );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";
		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( _e( 'Page', 'business-responsiveness' ), max( $paged, $page ) );
		return $title;
}	
add_filter( 'wp_title', 'Business_Responsiveness_title', 10,2 );
/**
 * Add appropriate classes to body tag.
 *
 */
function Business_Responsiveness_body_classes( $classes ) {
	$business_obj = new Business_Responsiveness_settings_array();
	$option = wp_parse_args(  get_option( 'business_r_option', array() ), $business_obj->default_data() );

	if ( $option['layout'] == true ) {
		$classes[] = 'boxed';
	}
	return $classes;
}
add_filter( 'body_class', 'Business_Responsiveness_body_classes' );