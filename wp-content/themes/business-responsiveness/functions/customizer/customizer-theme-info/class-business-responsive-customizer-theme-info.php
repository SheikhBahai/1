<?php
/**
 * Class Business_Responsiveness_Customizer_Theme_Info
 *
 * @access public
 */
final class Business_Responsiveness_Customizer_Theme_Info {

	/**
	 * Returns the instance.
	 *
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 * @access private
	 * @return void
	 */
	private function __construct() {
	}

	/**
	 * Sets up initial actions.
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @access public
	 *
	 * @param  object $manager - the wp_customizer object.
	 *
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		$theme_info_main_path = trailingslashit( get_template_directory() ) . 'functions/customizer/customizer-theme-info/class-business-responsive-customizer-theme-info-main.php';
		if ( file_exists( $theme_info_main_path ) ) {
			require_once( $theme_info_main_path );
		}
		$theme_info_section_path = trailingslashit( get_template_directory() ) . 'functions/customizer/customizer-theme-info/class-business-responsive-customizer-theme-info-section.php';
		if ( file_exists( $theme_info_section_path ) ) {
			require_once( $theme_info_section_path );
		}

		if ( class_exists( 'Business_Responsiveness_Customizer_Theme_Info_Main' ) ) {
			// Register custom section types.
			$manager->register_section_type( 'Business_Responsiveness_Customizer_Theme_Info_Main' );

			// Main Documentation Link In Customizer Root.
			$manager->add_section(
				new Business_Responsiveness_Customizer_Theme_Info_Main(
					$manager, 'business-theme-info', array(
						'theme_info_title' => esc_html__( 'Theme', 'business-responsiveness' ),
						'label_url'    => esc_url( '#' ),
						'label_text'   => esc_html__( 'Documentation', 'business-responsiveness' ),
					)
				)
			);
		}

		if ( class_exists( 'Business_Responsiveness_Customizer_Theme_Info_Section' ) ) {
			// Register custom section types.
			$manager->register_section_type( 'Business_Responsiveness_Customizer_Theme_Info_Section' );

			// Frontpage Sections Upsell.
			$manager->add_section(
				new Business_Responsiveness_Customizer_Theme_Info_Section(
					$manager, 'business-theme-info-section', array(
						'panel'       => 'Business_Responsiveness_frontpage_sections',
						'priority'    => 500,
						'options'     => array(
							esc_html__( 'Jetpack Portfolio', 'business-responsiveness' ),
							esc_html__( 'Pricing Plans Section', 'business-responsiveness' ),
							esc_html__( 'Section Reordering', 'business-responsiveness' ),
						),

						'button_url'  => esc_url( 'http://bangalorethemes.com/themes/business-responsive/' ),
						'button_text' => esc_html__( 'Get the PRO version!', 'business-responsiveness' ),
						'explained_features' => array(
							esc_html__( 'Portfolio section with two possible layouts.', 'business-responsiveness' ),
							esc_html__( 'A fully customizable pricing plans section.', 'business-responsiveness' ),
							esc_html__( 'The ability to reorganize your Frontpage sections more easily and quickly.', 'business-responsiveness' ),
						),
					)
				)
			);
		}
	}

	/**
	 * Loads theme customizer CSS.
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'Business_Responsiveness_theme-info-js', trailingslashit( get_template_directory_uri() ) . 'functions/customizer/customizer-theme-info/js/businessa-theme-info-customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'Business_Responsiveness_theme-info-style', trailingslashit( get_template_directory_uri() ) . 'functions/customizer/customizer-theme-info/css/businessa-theme-info-customize-controls.css', array() );
	}
}

Business_Responsiveness_Customizer_Theme_Info::get_instance();