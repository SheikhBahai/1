<?php
/**
 * Customizer functionality for the Theme Info section.
 */

$upsell_theme_info_path = trailingslashit( get_template_directory() ) . 'functions/customizer/customizer-theme-info/class-business-responsive-control-upsell-theme-info.php';
if ( file_exists( $upsell_theme_info_path ) ) {
	require_once( $upsell_theme_info_path );
}

$theme_info_path = trailingslashit( get_template_directory() ) . 'functions/customizer/customizer-theme-info/class-business-responsive-customizer-theme-info.php';
if ( file_exists( $theme_info_path ) ) {
	require_once( $theme_info_path );
}

/**
 * Hook controls for Features section to Customizer.
 *
 */
function Business_Responsiveness_theme_info_customize_register( $wp_customize ) {

	if ( ! class_exists( 'Business_Responsiveness_Control_Upsell_Theme_Info' ) ) {
		return;
	}

	$wp_customize->add_section(
		'business_theme_info_main_section', array(
			'title'    => esc_html__( 'PRO Features', 'business-responsiveness' ),
			'priority' => 0,
		)
	);

	$wp_customize->add_setting(
		'business_theme_info_main_control', array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new Business_Responsiveness_Control_Upsell_Theme_Info(
			$wp_customize, 'business_theme_info_main_control', array(
				'section'            => 'business_theme_info_main_section',
				'priority'           => 100,
				'options'            => array(
					esc_html__( 'FrontPage Shop Section', 'business-responsiveness' ),
					esc_html__( 'Full Color Settings', 'business-responsiveness' ),
					esc_html__( 'Portfolio Features', 'business-responsiveness' ),
					esc_html__( 'Testimonial Features', 'business-responsiveness' ),
					esc_html__( 'Pricing Features', 'business-responsiveness' ),
					esc_html__( 'Team Features', 'business-responsiveness' ),
					esc_html__( 'Client Features', 'business-responsiveness' ),
					esc_html__( 'Google Map Features', 'business-responsiveness' ),
					esc_html__( 'Section Manager', 'business-responsiveness' ),
					esc_html__( '1 year quality support', 'business-responsiveness' ),
				),
				'explained_features' => array(
					esc_html__( 'You can access of shop section in FrontPage of Business Responsive Pro theme.', 'business-responsiveness' ),
					esc_html__( 'Full customizable color settings added in Pro version.', 'business-responsiveness' ),
					esc_html__( 'Portfolio section in FrontPage.', 'business-responsiveness' ),
					esc_html__( 'Testimonial section in FrontPage.', 'business-responsiveness' ),
					esc_html__( 'Pricing Support functionality added in Pro version.', 'business-responsiveness' ),
					esc_html__( 'Team Section features available in Business Responsive Pro version.', 'business-responsiveness' ),
					esc_html__( 'Client Section also availble in Pro version.', 'business-responsiveness' ),
					esc_html__( 'Google Map Features support in FrontPage and Contact Page.', 'business-responsiveness' ),
					esc_html__( 'Section Manager settings used to ordering homepage sections.', 'business-responsiveness' ),
					esc_html__( '24/7 Professional Support.', 'business-responsiveness' ),
				),
				'button_url'         => esc_url( 'http://bangalorethemes.com/themes/business-responsive/' ),
				'button_text'        => esc_html__( 'BuyNow Pro Version', 'business-responsiveness' ),
			)
		)
	);

}

add_action( 'customize_register', 'Business_Responsiveness_theme_info_customize_register' );
