<?php 
function Business_Responsiveness_blog_settings_fucntion( $wp_customize ){

	/* BLOG SETTINGS */
		
		/* Blog Settings Sections */
		$wp_customize->add_section( 'blogsettingssection' , array(
			'title'      => __('BlogPage Settings', 'business-responsiveness' ),
			'priority'       => 40,
		) );
			
			// enable feature image
			$wp_customize->add_setting( 'business_r_option[blog_feature_image_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'Business_Responsiveness_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[blog_feature_image_enable]' , array(
			'label' => __('Enable Post Featured Image','business-responsiveness' ),
			'section' => 'blogsettingssection',
			'type'=>'checkbox',
			) );
			
			// enable post meta
			$wp_customize->add_setting( 'business_r_option[blog_meta_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'Business_Responsiveness_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[blog_meta_enable]' , array(
			'label' => __('Enable Post Meta','business-responsiveness' ),
			'section' => 'blogsettingssection',
			'type'=>'checkbox',
			) );
}
add_action( 'customize_register', 'Business_Responsiveness_blog_settings_fucntion' );