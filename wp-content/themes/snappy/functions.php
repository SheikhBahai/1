<?php
/**
 * Snappy functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Snappy
 */


if ( ! function_exists( 'snappy_after_theme_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */

	function snappy_after_theme_support() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'ffffff',
			)
		);

		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( 'snappy_content_width', 1140 );
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 270,
				'width'       => 90,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		/*
		 * Posts Formate.
		 *
		 * https://wordpress.org/support/article/post-formats/
		 */
		add_theme_support( 'post-formats', array(
		    'video',
		    'audio',
		    'gallery',
		    'quote',
		    'image'
		) );

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Snappy, use a find and replace
		 * to change 'snappy' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'snappy', get_template_directory() . '/languages' );

		// Add support for full and wide align images.
        add_theme_support( 'align-wide' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'wp-block-styles' );

	}

endif;

add_action( 'after_setup_theme', 'snappy_after_theme_support' );

/**
 * Register and Enqueue Styles.
 */
function snappy_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );
	$fonts_url = snappy_fonts_url();
    if( $fonts_url ){
    	
    	require_once get_theme_file_path( 'assets/lib/custom/css/wptt-webfont-loader.php' );
        wp_enqueue_style(
			'snappy-google-fonts',
			wptt_get_webfont_url( $fonts_url ),
			array(),
			$theme_version
		);
    }
    
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/lib/swiper/css/swiper-bundle.min.css');
	wp_enqueue_style( 'snappy-style', get_stylesheet_uri(), array(), $theme_version );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	

	wp_enqueue_script( 'imagesloaded' );
    wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'noframework-waypoints', get_template_directory_uri() . '/assets/lib/waypoint/noframework.waypoints.min.js', array('jquery'), '', 1);
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/lib/swiper/js/swiper-bundle.min.js', array('jquery'), '', 1);
	wp_enqueue_script( 'snappy-pagination', get_template_directory_uri() . '/assets/lib/custom/js/pagination.js', array('jquery'), '', 1 );
	wp_enqueue_script( 'snappy-custom', get_template_directory_uri() . '/assets/lib/custom/js/custom.js', array('jquery'), '', 1);

    // Global Query
    if( is_front_page() ){

    	$posts_per_page = absint( get_option('posts_per_page') );
        $c_paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
        $posts_args = array(
            'posts_per_page'        => $posts_per_page,
            'paged'                 => $c_paged,
        );
        $posts_qry = new WP_Query( $posts_args );
        $max = $posts_qry->max_num_pages;

    }else{
        global $wp_query;
        $max = $wp_query->max_num_pages;
        $c_paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
    }

    $snappy_default = snappy_get_default_theme_options();
    $snappy_pagination_layout = get_theme_mod( 'snappy_pagination_layout',$snappy_default['snappy_pagination_layout'] );
    $ajax_nonce = wp_create_nonce('snappy_ajax_nonce');
    // Pagination Data
    wp_localize_script( 
	    'snappy-pagination', 
	    'snappy_pagination',
	    array(
	        'paged'  => absint( $c_paged ),
	        'maxpage'   => absint( $max ),
	        'nextLink'   => next_posts( $max, false ),
	        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
	        'loadmore'   => esc_html__( 'Load More Posts', 'snappy' ),
	        'nomore'     => esc_html__( 'No More Posts', 'snappy' ),
	        'loading'    => esc_html__( 'Loading...', 'snappy' ),
	        'pagination_layout'   => esc_html( $snappy_pagination_layout ),
	        'ajax_nonce' => $ajax_nonce,
	     )
	);

    global $post;
    $single_post = 0;
    $snappy_ed_post_reaction = '';
    if( isset( $post->ID ) && isset( $post->post_type ) && $post->post_type == 'post' ){

    	$snappy_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'snappy_ed_post_reaction', true ) );
    	$single_post = 1;

    }

    $snappy_color_schema = get_theme_mod( 'snappy_color_schema',$snappy_default['snappy_color_schema'] );
	wp_localize_script(
	    'snappy-custom', 
	    'snappy_custom',
	    array(
	    	'single_post'	=> absint( $single_post ),
	        'snappy_ed_post_reaction'  		=> esc_html( $snappy_ed_post_reaction ),
	        'next_svg'   => snappy_the_theme_svg('chevron-right',true),
            'prev_svg' => snappy_the_theme_svg('chevron-left',true),
            'close' => snappy_the_theme_svg('close',true),
            'plus' => snappy_the_theme_svg('plus',true),
            'snappy_color_schema' => $snappy_color_schema,
	     )
	);

}

add_action( 'wp_enqueue_scripts', 'snappy_register_styles' );

/**
 * Admin enqueue script
 */
function snappy_admin_scripts($hook){

	wp_enqueue_media();
    wp_enqueue_style('snappy-admin', get_template_directory_uri() . '/assets/lib/custom/css/admin.css');
    wp_enqueue_script('snappy-admin', get_template_directory_uri() . '/assets/lib/custom/js/admin.js', array('jquery'), '', 1);
    
    $ajax_nonce = wp_create_nonce('snappy_ajax_nonce');
				
	wp_localize_script( 
        'snappy-admin', 
        'snappy_admin',
        array(
            'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
            'ajax_nonce' => $ajax_nonce,
            'upload_image'   =>  esc_html__('Choose Image','snappy'),
            'use_image'   =>  esc_html__('Select','snappy'),
            'active' => esc_html__('Active','snappy'),
	        'deactivate' => esc_html__('Deactivate','snappy'),
         )
    );

}

add_action('admin_enqueue_scripts', 'snappy_admin_scripts');

if( !function_exists( 'snappy_js_no_js_class' ) ) :

	// js no-js class toggle
	function snappy_js_no_js_class() { ?>

		<script>document.documentElement.className = document.documentElement.className.replace( 'no-js', 'js' );</script>
	
	<?php
	}
	
endif;

add_action( 'wp_head', 'snappy_js_no_js_class' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function snappy_menus() {

	$locations = array(
		'snappy-primary-menu'  => esc_html__( 'Primary Menu', 'snappy' ),
		'snappy-social-menu'  => esc_html__( 'Social Menu', 'snappy' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'snappy_menus' );

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/mega-menu/megamenu-custom-fields.php';
require get_template_directory() . '/inc/mega-menu/walkernav.php';
require get_template_directory() . '/assets/lib/tgmpa/recommended-plugins.php';
require get_template_directory() . '/classes/class-svg-icons.php';
require get_template_directory() . '/classes/class-walker-menu.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/custom-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/classes/body-classes.php';
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/metabox.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/assets/lib/breadcrumbs/breadcrumbs.php';
require get_template_directory() . '/assets/lib/custom/css/style.php';
require get_template_directory() . '/woocommerce/woocommerce-functions.php';
require get_template_directory() . '/classes/admin-notice.php';
require get_template_directory() . '/classes/plugin-classes.php';
require get_template_directory() . '/classes/about.php';

if( class_exists('Demo_Import_Kit_Class') ):

	add_filter('themeinwp_enable_demo_import_compatiblity','snappy_demo_import_filter_apply');

	if( !function_exists('snappy_demo_import_filter_apply') ):

		function snappy_demo_import_filter_apply(){

			return true;

		}

	endif;

endif;