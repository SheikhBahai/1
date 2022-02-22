<?php
/**
 * Snappy Theme Customizer
 *
 * @package Snappy
 */

/** Sanitize Functions. **/
	require get_template_directory() . '/inc/customizer/default.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('snappy_customize_register')) :

function snappy_customize_register( $wp_customize ) {

	require get_template_directory() . '/inc/customizer/custom-classes.php';
	require get_template_directory() . '/inc/customizer/sanitize.php';
	require get_template_directory() . '/inc/customizer/preloader.php';
	require get_template_directory() . '/inc/customizer/header.php';
	require get_template_directory() . '/inc/customizer/pagination.php';
	require get_template_directory() . '/inc/customizer/post.php';
	require get_template_directory() . '/inc/customizer/single.php';
	require get_template_directory() . '/inc/customizer/footer.php';
	require get_template_directory() . '/inc/customizer/color-schema.php';
	require get_template_directory() . '/inc/customizer/homepage-content.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'colors' )->panel = 'theme_colors_panel';
	$wp_customize->get_section( 'colors' )->title = esc_html__('Color Options','snappy');
	$wp_customize->get_section( 'title_tagline' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'header_image' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'background_image' )->panel = 'theme_general_settings';

	if ( isset( $wp_customize->selective_refresh ) ) {
		
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'snappy_customize_partial_blogname',
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'snappy_customize_partial_blogdescription',
		) );

	}

	// Theme Options Panel.
	$wp_customize->add_panel( 'theme_option_panel',
		array(
			'title'      => esc_html__( 'Theme Options', 'snappy' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_general_settings',
		array(
			'title'      => esc_html__( 'General Settings', 'snappy' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_colors_panel',
		array(
			'title'      => esc_html__( 'Color Settings', 'snappy' ),
			'priority'   => 15,
			'capability' => 'edit_theme_options',
		)
	);

	// Theme Options Panel.
	$wp_customize->add_panel( 'theme_footer_option_panel',
		array(
			'title'      => esc_html__( 'Footer Setting', 'snappy' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	// Template Options
	$wp_customize->add_panel( 'theme_home_pannel',
		array(
			'title'      => esc_html__( 'Frontpage Settings', 'snappy' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	// Register custom section types.
	$wp_customize->register_section_type( 'Snappy_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Snappy_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Snappy Pro', 'snappy' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'snappy' ),
				'pro_url'  => esc_url('https://www.themeinwp.com/theme/snappy-pro/'),
				'priority'  => 1,
			)
		)
	);

}

endif;
add_action( 'customize_register', 'snappy_customize_register' );

/**
 * Customizer Enqueue scripts and styles.
 */

if (!function_exists('snappy_customizer_scripts')) :

    function snappy_customizer_scripts(){   
    	
    	wp_enqueue_script('jquery-ui-button');
    	wp_enqueue_style('snappy-customizer', get_template_directory_uri() . '/assets/lib/custom/css/customizer.css');
        wp_enqueue_script('snappy-customizer', get_template_directory_uri() . '/assets/lib/custom/js/customizer.js', array('jquery','customize-controls'), '', 1);

        $ajax_nonce = wp_create_nonce('snappy_ajax_nonce');
        wp_localize_script( 
		    'snappy-customizer', 
		    'snappy_customizer',
		    array(
		        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
		        'ajax_nonce' => $ajax_nonce,
		     )
		);
    }

endif;

add_action('customize_controls_enqueue_scripts', 'snappy_customizer_scripts');
add_action('customize_controls_init', 'snappy_customizer_scripts');

function snappy_customize_preview_js() {
	wp_enqueue_script( 'snappy-customizer-preview', get_template_directory_uri() . '/assets/lib/custom/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'snappy_customize_preview_js' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('snappy_customize_partial_blogname')) :

	function snappy_customize_partial_blogname() {
		bloginfo( 'name' );
	}
endif;

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('snappy_customize_partial_blogdescription')) :

	function snappy_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

endif;