<?php 
function Business_Responsiveness_typography_settings( $wp_customize ){
	$range_path = Business_Responsiveness_TEMPLATE_DIR . '/functions/customizer/customizer-range-value/class/class-business-responsive-customizer-range-value-control.php';
	if ( file_exists( $range_path ) ) { require_once($range_path); }
	/* TYPOGRAPHY SETTINGS */
	$wp_customize->add_panel( 'typography_settings', array(
		'priority'       => 50,
		'capability'     => 'edit_theme_options',
		'title'      => __('Typography', 'business-responsiveness'),
	) );
	
		/* general content */
		$wp_customize->add_section( 'postcontent_section_title' , array(
			'title'      => __('General Contents', 'business-responsiveness'),
			'panel'  => 'typography_settings'
		) );
			
			// general content
			$wp_customize->add_setting( 'business_r_option[general_fontfamily]' , array(
			'default'    => 'Roboto',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control( 'business_r_option[general_fontfamily]' , array(
			'label' => __('Font Family','business-responsiveness'),
			'section' => 'postcontent_section_title',
			'type'=>'select',
			'choices'=> Business_Responsiveness_font_family(),
			) );
			
			$wp_customize->register_control_type( 'Business_Responsiveness_Customizer_Range_Value_Control' );
			
			// general content font size
			$wp_customize->add_setting( 'business_r_option[general_fontsize]' , array(
			'default'    => 16,
			'sanitize_callback' => 'absint',
			'type'=>'option'
			));

			$wp_customize->add_control( new Business_Responsiveness_Customizer_Range_Value_Control(
				$wp_customize, 'business_r_option[general_fontsize]', array(
					'label' => esc_html__( 'Body','business-responsiveness' ) . ' ' . esc_html__( 'Font Size', 'business-responsiveness' ) . ' ( ' . esc_html__( 'px','business-responsiveness' ) . ' )',
					'section' => 'postcontent_section_title',
					'type' => 'range-value',
					'input_attr' => array(
						'min' => 10,
						'max' => 20,
						'step' => 1,
					),
				)
			) );
			
			// general content font style
			$wp_customize->add_setting( 'business_r_option[general_fontstyle]' , array(
			'default'    => 'normal',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control( 'business_r_option[general_fontstyle]' , array(
			'label' => __('Font Style','business-responsiveness'),
			'section' => 'postcontent_section_title',
			'type'=>'select',
			'choices'=> Business_Responsiveness_font_style(),
			) );
			
		/* h1 settings */
		$wp_customize->add_section( 'h1_settings' , array(
			'title'      => __('H1 heading', 'business-responsiveness'),
			'panel'  => 'typography_settings'
		) );
			
			// h1 family
			$wp_customize->add_setting( 'business_r_option[h1_fontfamily]' , array(
			'default'    => 'Roboto Slab',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control( 'business_r_option[h1_fontfamily]' , array(
			'label' => __('H1 Font Family','business-responsiveness'),
			'section' => 'h1_settings',
			'type'=>'select',
			'choices'=> Business_Responsiveness_font_family(),
			) );
			
			// h1 size
			$wp_customize->add_setting( 'business_r_option[h1_fontsize]' , array(
			'default'    => 36,
			'sanitize_callback' => 'absint',
			'type'=>'option'
			));

			$wp_customize->add_control( new Business_Responsiveness_Customizer_Range_Value_Control(
				$wp_customize, 'business_r_option[h1_fontsize]', array(
					'label' => esc_html__( 'H1','business-responsiveness' ) . ' ' . esc_html__( 'Font Size', 'business-responsiveness' ) . ' ( ' . esc_html__( 'px','business-responsiveness' ) . ' )',
					'section' => 'h1_settings',
					'type' => 'range-value',
					'input_attr' => array(
						'min' => 15,
						'max' => 50,
						'step' => 1,
					),
				)
			) );
			
			// h1 style
			$wp_customize->add_setting( 'business_r_option[h1_fontstyle]' , array(
			'default'    => 'normal',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control( 'business_r_option[h1_fontstyle]' , array(
			'label' => __('H1 Font Style','business-responsiveness'),
			'section' => 'h1_settings',
			'type'=>'select',
			'choices'=> Business_Responsiveness_font_style(),
			) );
			
		/* h2 settings */
		$wp_customize->add_section( 'h2_settings' , array(
			'title'      => __('H2 heading', 'business-responsiveness'),
			'panel'  => 'typography_settings'
		) );
			
			// h2 family
			$wp_customize->add_setting( 'business_r_option[h2_fontfamily]' , array(
			'default'    => 'Roboto Slab',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control( 'business_r_option[h2_fontfamily]' , array(
			'label' => __('H2 Font Family','business-responsiveness'),
			'section' => 'h2_settings',
			'type'=>'select',
			'choices'=> Business_Responsiveness_font_family(),
			) );
			
			// h2 size
			$wp_customize->add_setting( 'business_r_option[h2_fontsize]' , array(
			'default'    => 30,
			'sanitize_callback' => 'absint',
			'type'=>'option'
			));

			$wp_customize->add_control( new Business_Responsiveness_Customizer_Range_Value_Control(
				$wp_customize, 'business_r_option[h2_fontsize]', array(
					'label' => esc_html__( 'H2','business-responsiveness' ) . ' ' . esc_html__( 'Font Size', 'business-responsiveness' ) . ' ( ' . esc_html__( 'px','business-responsiveness' ) . ' )',
					'section' => 'h2_settings',
					'type' => 'range-value',
					'input_attr' => array(
						'min' => 15,
						'max' => 50,
						'step' => 1,
					),
				)
			) );
			
			// h2 style
			$wp_customize->add_setting( 'business_r_option[h2_fontstyle]' , array(
			'default'    => 'normal',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control( 'business_r_option[h2_fontstyle]' , array(
			'label' => __('H2 Font Style','business-responsiveness'),
			'section' => 'h2_settings',
			'type'=>'select',
			'choices'=> Business_Responsiveness_font_style(),
			) );
			
		/* h3 settings */
		$wp_customize->add_section( 'h3_settings' , array(
			'title'      => __('H3 heading', 'business-responsiveness'),
			'panel'  => 'typography_settings'
		) );
			
			// h3 family
			$wp_customize->add_setting( 'business_r_option[h3_fontfamily]' , array(
			'default'    => 'Roboto Slab',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control( 'business_r_option[h3_fontfamily]' , array(
			'label' => __('H3 Font Family','business-responsiveness'),
			'section' => 'h3_settings',
			'type'=>'select',
			'choices'=> Business_Responsiveness_font_family(),
			) );
			
			// h3 size
			$wp_customize->add_setting( 'business_r_option[h3_fontsize]' , array(
			'default'    => 24,
			'sanitize_callback' => 'absint',
			'type'=>'option'
			));

			$wp_customize->add_control( new Business_Responsiveness_Customizer_Range_Value_Control(
				$wp_customize, 'business_r_option[h3_fontsize]', array(
					'label' => esc_html__( 'H3','business-responsiveness' ) . ' ' . esc_html__( 'Font Size', 'business-responsiveness' ) . ' ( ' . esc_html__( 'px','business-responsiveness' ) . ' )',
					'section' => 'h3_settings',
					'type' => 'range-value',
					'input_attr' => array(
						'min' => 15,
						'max' => 50,
						'step' => 1,
					),
				)
			) );
			
			// h3 style
			$wp_customize->add_setting( 'business_r_option[h3_fontstyle]' , array(
			'default'    => 'normal',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control( 'business_r_option[h3_fontstyle]' , array(
			'label' => __('H3 Font Style','business-responsiveness'),
			'section' => 'h3_settings',
			'type'=>'select',
			'choices'=> Business_Responsiveness_font_style(),
			) );
			
		/* h4 settings */
		$wp_customize->add_section( 'h4_settings' , array(
			'title'      => __('H4 heading', 'business-responsiveness'),
			'panel'  => 'typography_settings'
		) );
			
			// h4 family
			$wp_customize->add_setting( 'business_r_option[h4_fontfamily]' , array(
			'default'    => 'Roboto Slab',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control( 'business_r_option[h4_fontfamily]' , array(
			'label' => __('H4 Font Family','business-responsiveness'),
			'section' => 'h4_settings',
			'type'=>'select',
			'choices'=> Business_Responsiveness_font_family(),
			) );
			
			// h4 size
			$wp_customize->add_setting( 'business_r_option[h4_fontsize]' , array(
			'default'    => 18,
			'sanitize_callback' => 'absint',
			'type'=>'option'
			));

			$wp_customize->add_control( new Business_Responsiveness_Customizer_Range_Value_Control(
				$wp_customize, 'business_r_option[h4_fontsize]', array(
					'label' => esc_html__( 'H4','business-responsiveness' ) . ' ' . esc_html__( 'Font Size', 'business-responsiveness' ) . ' ( ' . esc_html__( 'px','business-responsiveness' ) . ' )',
					'section' => 'h4_settings',
					'type' => 'range-value',
					'input_attr' => array(
						'min' => 15,
						'max' => 50,
						'step' => 1,
					),
				)
			) );
			
			// h4 style
			$wp_customize->add_setting( 'business_r_option[h4_fontstyle]' , array(
			'default'    => 'normal',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control( 'business_r_option[h4_fontstyle]' , array(
			'label' => __('H4 Font Style','business-responsiveness'),
			'section' => 'h4_settings',
			'type'=>'select',
			'choices'=> Business_Responsiveness_font_style(),
			) );
			
		/* h5 settings */
		$wp_customize->add_section( 'h5_settings' , array(
			'title'      => __('H5 heading', 'business-responsiveness'),
			'panel'  => 'typography_settings'
		) );
			
			// h5 family
			$wp_customize->add_setting( 'business_r_option[h5_fontfamily]' , array(
			'default'    => 'Roboto Slab',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control( 'business_r_option[h5_fontfamily]' , array(
			'label' => __('H5 Font Family','business-responsiveness'),
			'section' => 'h5_settings',
			'type'=>'select',
			'choices'=> Business_Responsiveness_font_family(),
			) );
			
			// h5 size
			$wp_customize->add_setting( 'business_r_option[h5_fontsize]' , array(
			'default'    => 14,
			'sanitize_callback' => 'absint',
			'type'=>'option'
			));

			$wp_customize->add_control( new Business_Responsiveness_Customizer_Range_Value_Control(
				$wp_customize, 'business_r_option[h5_fontsize]', array(
					'label' => esc_html__( 'H5','business-responsiveness' ) . ' ' . esc_html__( 'Font Size', 'business-responsiveness' ) . ' ( ' . esc_html__( 'px','business-responsiveness' ) . ' )',
					'section' => 'h5_settings',
					'type' => 'range-value',
					'input_attr' => array(
						'min' => 15,
						'max' => 50,
						'step' => 1,
					),
				)
			) );
			
			// h5 style
			$wp_customize->add_setting( 'business_r_option[h5_fontstyle]' , array(
			'default'    => 'normal',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control( 'business_r_option[h5_fontstyle]' , array(
			'label' => __('H5 Font Style','business-responsiveness'),
			'section' => 'h5_settings',
			'type'=>'select',
			'choices'=> Business_Responsiveness_font_style(),
			) );
			
		/* h6 settings */
		$wp_customize->add_section( 'h6_settings' , array(
			'title'      => __('H6 heading', 'business-responsiveness'),
			'panel'  => 'typography_settings'
		) );
			
			// h5 family
			$wp_customize->add_setting( 'business_r_option[h6_fontfamily]' , array(
			'default'    => 'Roboto Slab',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control( 'business_r_option[h6_fontfamily]' , array(
			'label' => __('H6 Font Family','business-responsiveness'),
			'section' => 'h6_settings',
			'type'=>'select',
			'choices'=> Business_Responsiveness_font_family(),
			) );
			
			// h6 size
			$wp_customize->add_setting( 'business_r_option[h6_fontsize]' , array(
			'default'    => 12,
			'sanitize_callback' => 'absint',
			'type'=>'option'
			));

			$wp_customize->add_control( new Business_Responsiveness_Customizer_Range_Value_Control(
				$wp_customize, 'business_r_option[h6_fontsize]', array(
					'label' => esc_html__( 'H6','business-responsiveness' ) . ' ' . esc_html__( 'Font Size', 'business-responsiveness' ) . ' ( ' . esc_html__( 'px','business-responsiveness' ) . ' )',
					'section' => 'h6_settings',
					'type' => 'range-value',
					'input_attr' => array(
						'min' => 15,
						'max' => 50,
						'step' => 1,
					),
				)
			) );
			
			// h6 style
			$wp_customize->add_setting( 'business_r_option[h6_fontstyle]' , array(
			'default'    => 'normal',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control( 'business_r_option[h6_fontstyle]' , array(
			'label' => __('H6 Font Style','business-responsiveness'),
			'section' => 'h6_settings',
			'type'=>'select',
			'choices'=> Business_Responsiveness_font_style(),
			) );
}
add_action( 'customize_register', 'Business_Responsiveness_typography_settings' );