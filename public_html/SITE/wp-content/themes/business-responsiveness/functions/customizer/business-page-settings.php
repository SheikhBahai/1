<?php 
function Business_Responsiveness_page_settings_fucntion( $wp_customize ){

	/* PAGE SETTINGS */
		
		/* PAGE Settings Sections */
		$wp_customize->add_section( 'pagesettingssection' , array(
			'title'      => __('Page Settings', 'business-responsiveness' ),
			'priority'       => 45,
		) );
			
			// enable feature image
			$wp_customize->add_setting( 'business_r_option[page_feature_image_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'Business_Responsiveness_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[page_feature_image_enable]' , array(
			'label' => __('Enable Page Featured Image','business-responsiveness' ),
			'section' => 'pagesettingssection',
			'type'=>'checkbox',
			) );
			
			// enable post meta
			$wp_customize->add_setting( 'business_r_option[page_meta_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'Business_Responsiveness_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[page_meta_enable]' , array(
			'label' => __('Enable Page Meta','business-responsiveness' ),
			'section' => 'pagesettingssection',
			'type'=>'checkbox',
			) );
}
add_action( 'customize_register', 'Business_Responsiveness_page_settings_fucntion' );