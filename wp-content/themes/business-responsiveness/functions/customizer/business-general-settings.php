<?php 
if( !function_exists('Business_Responsiveness_genral_settings_fucntion')){
function Business_Responsiveness_genral_settings_fucntion( $wp_customize ){
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	
	/* GENRAL SETTINGS */
	$wp_customize->add_panel( 'general_settings', array(
		'priority'       => 30,
		'capability'     => 'edit_theme_options',
		'title'      => __('Appearance Settings', 'business-responsiveness' ),
	) );
		
		/* Top Header */
		$wp_customize->add_section( 'top_header' , array(
			'title'      => __('Top Header', 'business-responsiveness' ),
			'panel'  => 'general_settings',
			'priority'       => 5,
		) );		
			
			
			
			// facebook url
			$wp_customize->add_setting( 'business_r_option[header-facebook-url]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option',
			));

			$wp_customize->add_control('business_r_option[header-facebook-url]' , array(
			'label' => __('Header Facebook URL','business-responsiveness' ),
			'section' => 'top_header',
			'type'=>'text',
			'input_attrs' => array(
				'placeholder' => __('Facebook URL','business-responsiveness'),
			),
			) );
			
			// twitter url
			$wp_customize->add_setting( 'business_r_option[header-twitter-url]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[header-twitter-url]' , array(
			'label' => __('Header Twitter URL','business-responsiveness' ),
			'section' => 'top_header',
			'type'=>'text',
			'input_attrs' => array(
				'placeholder' => __('Twitter URL','business-responsiveness'),
			),
			) );
			
			// linkedin url
			$wp_customize->add_setting( 'business_r_option[header-linkedin-url]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[header-linkedin-url]' , array(
			'label' => __('Header Linked In URL','business-responsiveness' ),
			'section' => 'top_header',
			'type'=>'text',
			'input_attrs' => array(
				'placeholder' => __('Linked-In URL','business-responsiveness'),
			),
			) );
			
			// googleplus url
			$wp_customize->add_setting( 'business_r_option[header-googleplus-url]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[header-googleplus-url]' , array(
			'label' => __('Header Google Plus URL','business-responsiveness' ),
			'section' => 'top_header',
			'type'=>'text',
			'input_attrs' => array(
				'placeholder' => __('Google+ URL','business-responsiveness'),
			),
			) );
			
			// open window
			$wp_customize->add_setting( 'business_r_option[header-social-target]' , array(
			'default'    => true,
			'sanitize_callback' => 'Business_Responsiveness_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[header-social-target]' , array(
			'label' => __('Social icons open window in new tab','business-responsiveness' ),
			'section' => 'top_header',
			'type'=>'checkbox',
			) );
			
			// hide top header
			$wp_customize->add_setting( 'business_r_option[top-header-hide]' , array(
			'default'    => false,
			'sanitize_callback' => 'Business_Responsiveness_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[top-header-hide]' , array(
			'label' => __('Top header bar hide','business-responsiveness' ),
			'section' => 'top_header',
			'type'=>'checkbox',
			) );
			
		/* Boxed Layout */
		$wp_customize->add_section( 'layout_section' , array(
			'title'      => __('Layout', 'business-responsiveness' ),
			'panel'  => 'general_settings',
			'priority'       => 6,
		) );
		
			// boxed layout settings
			$wp_customize->add_setting( 'business_r_option[layout]' , array(
			'default'    => false,
			'sanitize_callback' => 'Business_Responsiveness_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[layout]' , array(
			'label' => __('Boxed Layout','business-responsiveness' ),
			'section' => 'layout_section',
			'type'=>'checkbox',
			) );
			
		/* footer settings */
		$wp_customize->add_section( 'footer_settings' , array(
			'title'      => __('Footer', 'business-responsiveness' ),
			'panel'  => 'general_settings',
			'priority'  => 7,
		) );
		
			// footer copyright
			$wp_customize->add_setting( 'business_r_option[footer_copyright]' , array(
			'default'    => '',
			'type'=>'option',
			'sanitize_callback' => 'Business_Responsiveness_sanitize_text',
			));

			$wp_customize->add_control('business_r_option[footer_copyright]' , array(
			'label' => __('Footer Copyright Text','business-responsiveness' ),
			'section' => 'footer_settings',
			'type'=>'text',
			) );
			
			// footer social icon enable / disable
			$wp_customize->add_setting( 'business_r_option[footer_socialicon_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'Business_Responsiveness_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[footer_socialicon_enable]' , array(
			'label' => __('Footer Social Icons Enable','business-responsiveness' ),
			'section' => 'footer_settings',
			'type'=>'checkbox',
			) );
			
			// footer social icon title
			$wp_customize->add_setting( 'business_r_option[footer_socialicon_title]' , array(
			'default'    => '',
			'type'=>'option',
			'sanitize_callback' => 'Business_Responsiveness_sanitize_text',
			));

			$wp_customize->add_control('business_r_option[footer_socialicon_title]' , array(
			'label' => __('Footer social icon title','business-responsiveness' ),
			'section' => 'footer_settings',
			'type'=>'text',
			) );
			
			// footer menus
			$wp_customize->add_setting( 'business_r_option[footer_menu]' , array(
			'default'    => true,
			'sanitize_callback' => 'Business_Responsiveness_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[footer_menu]' , array(
			'label' => __('Footer Menu Enable','business-responsiveness' ),
			'section' => 'footer_settings',
			'type'=>'checkbox',
			) );
			
	$wp_customize->get_section( 'colors' )->panel = 'general_settings'; // color settings
	$wp_customize->get_section( 'header_image' )->panel = 'general_settings'; // header settings
	$wp_customize->get_section( 'background_image' )->panel = 'general_settings'; // backround settings
	
			// custom color scheme
			$wp_customize->add_setting( 'business_r_option[custom_color_scheme]' , array(
			'default'    => '#ff8432',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'=>'option'
			));
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize , 'business_r_option[custom_color_scheme]' , array(
			'label' => __('Primary Color','business-responsiveness'),
			'description'      => __('Select your custom color scheme.', 'business-responsiveness'),
			'section' => 'colors',
			'settings'=>'business_r_option[custom_color_scheme]'
			) ) );
			
			$wp_customize->add_setting( 'business_r_option[site_title]', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#242424',
                'transport' => 'postMessage',
				'type'=>'option',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_r_option[site_title]',
                array(
                    'label'       => esc_html__( 'Site Title Color', 'business-responsiveness' ),
                    'section'     => 'colors',
                    'description' => '',
                )
            ));
			
			$wp_customize->add_setting( 'business_r_option[footer_background]', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#2c2c2c',
                'transport' => 'postMessage',
				'type'=>'option',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_r_option[footer_background]',
                array(
                    'label'       => esc_html__( 'Footer Background', 'business-responsiveness' ),
                    'section'     => 'colors',
                    'description' => '',
                )
            ));
			
			$wp_customize->add_setting( 'business_r_option[footer_info_background]', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#242424',
                'transport' => 'postMessage',
				'type'=>'option',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_r_option[footer_info_background]',
                array(
                    'label'       => esc_html__( 'Footer Info Background', 'business-responsiveness' ),
                    'section'     => 'colors',
                    'description' => '',
                )
            ));
}	
}
add_action( 'customize_register', 'Business_Responsiveness_genral_settings_fucntion' );

/*
 * business sanitize text function
 */
function Business_Responsiveness_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/*
 * business sanitize checkbox function
 */
function Business_Responsiveness_sanitize_checkbox( $checked ) {
    // Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
