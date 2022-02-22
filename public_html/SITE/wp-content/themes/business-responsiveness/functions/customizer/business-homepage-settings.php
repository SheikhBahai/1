<?php 

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * A class to create a dropdown for all categories in your wordpress site
 */
 class Business_Responsiveness_category_dropdown_custom_control extends WP_Customize_Control
 {
    private $cats = false;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->cats = get_categories($options);

        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
       {
            if(!empty($this->cats))
            {
                ?>
                    <label>
                      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                      <select <?php $this->link(); ?>>
                           <?php
                                foreach ( $this->cats as $cat )
                                {
                                    printf('<option value="%s" %s>%s</option>', esc_attr( $cat->term_id ), selected( $this->value(), esc_attr( $cat->term_id ), false), esc_attr( $cat->name ) );
                                }
                           ?>
                      </select>
                    </label>
                <?php
            }
       }
 }
 
function Business_Responsiveness_slider_sanitize( $value ) {
    if ( ! in_array( $value, array( 'Uncategorized','category' ) ) )    
    return $value;
}
	
function Business_Responsiveness_homepage_settings_fucntion( $wp_customize ){

	/* FRONT PAGE */
	$wp_customize->add_panel( 'frontpage', array(
		'priority'       => 35,
		'capability'     => 'edit_theme_options',
		'title'      => __('FrontPage Sections', 'business-responsiveness' ),
	) );
	
	/* Woocommerce info section */
		$wp_customize->add_section( 'woocommerce_section' , array(
			'title'      => __('Woocommerce Recommended Plugin', 'business-responsiveness' ),
			'panel'  => 'frontpage',
		) );
			
			$wp_customize->add_setting(
				'Business_Responsiveness_woo_info', array(
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				new Business_Responsiveness_Woocommerce_Info(
					$wp_customize, 'Business_Responsiveness_woo_info', array(
						'label' => esc_html__( 'Instructions', 'business-responsiveness' ),
						'section' => 'woocommerce_section',
						'capability' => 'install_plugins',
					)
				)
			);
	
	
		/* Slider Settings */
		$wp_customize->add_section( 'slider_section' , array(
			'title'      => __('Big Slider Section', 'business-responsiveness' ),
			'panel'  => 'frontpage',
			'description'=> 'Show your slider in your front page. First you setup your front page. <a target="_blank" href="'.admin_url('options-reading.php').'">Click Here!</a><p>Create a post ( <a target="_blank" href="'.admin_url('post-new.php').'">link</a> ) and assign it a category. and Choose a category from given below category setting.</p>',
		) );
	
			// slider enable
			$wp_customize->add_setting( 'business_r_option[slider_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'Business_Responsiveness_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[slider_enable]' , array(
			'label' => __('Enable Slider','business-responsiveness' ),
			'section' => 'slider_section',
			'type'=>'checkbox',
			) );
			
			// slider animation type
			$wp_customize->add_setting( 'business_r_option[slider_animation_type]' , array(
			'default'    => 'slide',
			'sanitize_callback' => 'Business_Responsiveness_sanitize_select',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[slider_animation_type]' , array(
			'label' => __('Slider Effects','business-responsiveness' ),
			'section' => 'slider_section',
			'type'=>'select',
			'choices'=>array(
				'slide'=>__('Slide','business-responsiveness'),
				'fade'=>__('Fade','business-responsiveness'),
			),
			) );
			
			// slider speed
			$wp_customize->add_setting( 'business_r_option[slider_speed]' , array(
			'default'    => 3000,
			'sanitize_callback' => 'Business_Responsiveness_sanitize_select',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[slider_speed]' , array(
			'label' => __('Slider animation speed','business-responsiveness' ),
			'section' => 'slider_section',
			'type'=>'select',
			'choices'=>array(
				500 => __('500','business-responsiveness'),
				1000 => __('1000','business-responsiveness'),
				2000 => __('2000','business-responsiveness'),
				3000 => __('3000','business-responsiveness'),
				4000 => __('4000','business-responsiveness'),
				5000 => __('5000','business-responsiveness'),
				6000 => __('6000','business-responsiveness'),
				7000 => __('7000','business-responsiveness'),
				8000 => __('8000','business-responsiveness'),
				9000 => __('9000','business-responsiveness'),
				10000 => __('10000','business-responsiveness'),
			),
			) );
		
			// slider cat
			$wp_customize->add_setting('business_r_option[slider_cat]',array(
			'default' => 1,
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'Business_Responsiveness_slider_sanitize',
			'type'=>'option',
			) );
			
			$wp_customize->add_control( new Business_Responsiveness_category_dropdown_custom_control( $wp_customize, 'business_r_option[slider_cat]', array(
			'label'   => __('Category','business-responsiveness' ),
			'section' => 'slider_section',
			'settings'   =>  'business_r_option[slider_cat]',
			) ) );
			
			
		/* Service Settings */
		$wp_customize->add_section( 'service_section' , array(
			'title'      => __('Service', 'business-responsiveness' ),
			'panel'  => 'frontpage',
			'description'=> sprintf(__('Show your services in your front page. First you setup your front page. <a target="_blank" href="%s">Click Here!</a>','business-responsiveness'),esc_url( admin_url('options-reading.php') )),
		) );
			
			// service section enable/disable
			$wp_customize->add_setting( 'business_r_option[service_section_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'Business_Responsiveness_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[service_section_enable]' , array(
			'label' => __('Enable Service Section','business-responsiveness' ),
			'section' => 'service_section',
			'type'=>'checkbox',
			) );
		
			// service section title
			$wp_customize->add_setting( 'business_r_option[service_section_title]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[service_section_title]' , array(
			'label' => __('Service Section Title','business-responsiveness' ),
			'section' => 'service_section',
			'type'=>'text',
			) );
			
			// service section description
			$wp_customize->add_setting( 'business_r_option[service_section_description]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[service_section_description]' , array(
			'label' => __('Service Section Description','business-responsiveness' ),
			'section' => 'service_section',
			'type'=>'text',
			) );
			
			// service section background color
			$wp_customize->add_setting( 'business_r_option[service_section_backgorund_color]' , array(
			'default'    => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'=>'option'
			));
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize , 'business_r_option[service_section_backgorund_color]' , array(
			'label' => __('Section Background Color','business-responsiveness' ),
			'section' => 'service_section',
			'settings'=>'business_r_option[service_section_backgorund_color]'
			) ) );
			
			// service section image
			$wp_customize->add_setting( 'business_r_option[service_section_image]' , array(
			'default' => '',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'Business_Responsiveness_sanitize_image',
			'type'=>'option'
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'business_r_option[service_section_image]' ,
			array(
			'label'          => __( 'Service Section Image', 'business-responsiveness' ),
			'description'=> __('Upload your background image minimum size ( 1600 x 900 ).','business-responsiveness'),
			'section'        => 'service_section',
		    ) )	);
			
			$wp_customize->add_setting( 'business_r_option[service_section_image_repeat]', array(
				'default'        => 'repeat',
				'sanitize_callback' => 'Business_Responsiveness_sanitize_select',
				'type'=>'option'
			) );
			$wp_customize->add_control(
				'business_r_option[service_section_image_repeat]', 
				array(
					'label'    => __( 'Background Repeat', 'business-responsiveness' ),
					'section'  => 'service_section',
					'settings' => 'business_r_option[service_section_image_repeat]',
					'type'     => 'select',
					'choices'  => array(
						'no-repeat'  => __('No Repeat','business-responsiveness'),
						'repeat'     => __('Tile','business-responsiveness'),
						'repeat-x'   => __('Tile Horizontally','business-responsiveness'),
						'repeat-y'   => __('Tile Vertically','business-responsiveness'),
					),
				)
			);

			// service icon 1
			$wp_customize->add_setting( 'business_r_option[service_icon_one]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[service_icon_one]' , array(
			'label' => __('Service Icon One','business-responsiveness' ),
			'description' => sprintf(
				__('Please enter service icon like: fa-desktop. To find more icons please <a href="%s" target="_blank">click here</a>','business-responsiveness'),
				esc_url('https://fontawesome.com/icons')
				),
			'section' => 'service_section',
			'type'=>'text',
			) );

			$wp_customize->add_setting( 'business_r_option[service_content_one]' , array(
			'default'    => 0,
			'sanitize_callback' => 'absint',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[service_content_one]' , array(
			'label' => __('Select Content Page','business-responsiveness' ),
			'section' => 'service_section',
			'type'=>'dropdown-pages'
			) );

			// service icon 2
			$wp_customize->add_setting( 'business_r_option[service_icon_two]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[service_icon_two]' , array(
			'label' => __('Service Icon Two','business-responsiveness' ),
			'description' => sprintf(
				__('Please enter service icon like: fa-desktop. To find more icons please <a href="%s" target="_blank">click here</a>','business-responsiveness'),
				esc_url('https://fontawesome.com/icons')
				),
			'section' => 'service_section',
			'type'=>'text',
			) );

			$wp_customize->add_setting( 'business_r_option[service_content_two]' , array(
			'default'    => 0,
			'sanitize_callback' => 'absint',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[service_content_two]' , array(
			'label' => __('Select Content Page','business-responsiveness' ),
			'section' => 'service_section',
			'type'=>'dropdown-pages'
			) );

			// service icon 3
			$wp_customize->add_setting( 'business_r_option[service_icon_three]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[service_icon_three]' , array(
			'label' => __('Service Icon Three','business-responsiveness' ),
			'description' => sprintf(
				__('Please enter service icon like: fa-desktop. To find more icons please <a href="%s" target="_blank">click here</a>','business-responsiveness'),
				esc_url('https://fontawesome.com/icons')
				),
			'section' => 'service_section',
			'type'=>'text',
			) );

			$wp_customize->add_setting( 'business_r_option[service_content_three]' , array(
			'default'    => 0,
			'sanitize_callback' => 'absint',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[service_content_three]' , array(
			'label' => __('Select Content Page','business-responsiveness' ),
			'section' => 'service_section',
			'type'=>'dropdown-pages'
			) );

   
			
	if ( class_exists( 'WooCommerce' ) ){

		/* shop Settings */
		$wp_customize->add_section( 'shop_sections' , array(
			'title'      => __('Shop', 'business-responsiveness' ),
			'panel'  => 'frontpage'
		) );

			// shop section enable/disable
			$wp_customize->add_setting( 'business_r_option[shop_section_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'Business_Responsiveness_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[shop_section_enable]' , array(
			'label' => __('Enable Shop Section','business-responsiveness' ),
			'section' => 'shop_sections',
			'type'=>'checkbox',
			) );
		
			// shop section title
			$wp_customize->add_setting( 'business_r_option[shop_section_title]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[shop_section_title]' , array(
			'label' => __('Section Title','business-responsiveness' ),
			'section' => 'shop_sections',
			'type'=>'text',
			) );
			
			// shop section description
			$wp_customize->add_setting( 'business_r_option[shop_section_description]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[shop_section_description]' , array(
			'label' => __('Section Subtitle','business-responsiveness' ),
			'section' => 'shop_sections',
			'type'=>'text',
			) );
			
			// shop no of show
			$wp_customize->add_setting( 'business_r_option[shop_no_of_show]' , array(
			'default'    => 4,
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[shop_no_of_show]' , array(
			'label' => __('Products No Of Show','business-responsiveness' ),
			'section' => 'shop_sections',
			'type'=>'number',
			) );
		
			// shop section background color
			$wp_customize->add_setting( 'business_r_option[shop_section_backgorund_color]' , array(
			'default'    => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'=>'option'
			));
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize , 'business_r_option[shop_section_backgorund_color]' , array(
			'label' => __('Section Background Color','business-responsiveness' ),
			'section' => 'shop_sections',
			'settings'=>'business_r_option[shop_section_backgorund_color]'
			) ) );
			
			// Shop section image
			$wp_customize->add_setting( 'business_r_option[shop_section_image]' , array(
			'default' => '',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'Business_Responsiveness_sanitize_image',
			'type'=>'option'
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'business_r_option[shop_section_image]' ,
			array(
			'label'          => __( 'Shop Section Image', 'business-responsiveness' ),
			'section'        => 'shop_sections',
		    ) )	);
			
			$wp_customize->add_setting( 'business_r_option[shop_section_image_repeat]', array(
				'default'        => 'repeat',
				'sanitize_callback' => 'Business_Responsiveness_sanitize_select',
				'type'=>'option'
			) );
			$wp_customize->add_control(
				'business_r_option[shop_section_image_repeat]', 
				array(
					'label'    => __( 'Background Repeat', 'business-responsiveness' ),
					'section'  => 'shop_sections',
					'settings' => 'business_r_option[shop_section_image_repeat]',
					'type'     => 'select',
					'choices'  => array(
						'no-repeat'  => __('No Repeat','business-responsiveness'),
						'repeat'     => __('Tile','business-responsiveness'),
						'repeat-x'   => __('Tile Horizontally','business-responsiveness'),
						'repeat-y'   => __('Tile Vertically','business-responsiveness'),
					),
				)
			);
			
	}
	
	
		/* News Settings */
		$wp_customize->add_section( 'news_section' , array(
			'title'      => __('Blog', 'business-responsiveness' ),
			'panel'  => 'frontpage',
			'description'=> 'Show your latest news in your front page. First you setup your front page. <a target="_blank" href="'.esc_url( admin_url('options-reading.php') ).'">Click Here!</a> <p>If you want to access latest blogs in FrontPage. Please create a post and add a category in this post. And then select this category given below News Category setting.</p>',
		) );

			// news section enable/disable
			$wp_customize->add_setting( 'business_r_option[news_section_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'Business_Responsiveness_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[news_section_enable]' , array(
			'label' => __('Enable News Section','business-responsiveness' ),
			'section' => 'news_section',
			'type'=>'checkbox',
			) );
		
			// news section title
			$wp_customize->add_setting( 'business_r_option[news_section_title]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[news_section_title]' , array(
			'label' => __('News Section Title','business-responsiveness' ),
			'section' => 'news_section',
			'type'=>'text',
			) );
			
			// news section description
			$wp_customize->add_setting( 'business_r_option[news_section_description]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[news_section_description]' , array(
			'label' => __('News Section Description','business-responsiveness' ),
			'section' => 'news_section',
			'type'=>'text',
			) );
			
			// news no of show
			$wp_customize->add_setting( 'business_r_option[news_no_of_show]' , array(
			'default'    => 4,
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[news_no_of_show]' , array(
			'label' => __('News No Of Show','business-responsiveness' ),
			'section' => 'news_section',
			'type'=>'number',
			) );
			
			// news category show
			$wp_customize->add_setting( 'business_r_option[news_category_show]' , array(
			'default'    => 1,
			'sanitize_callback' => 'Business_Responsiveness_sanitize_select',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[news_category_show]' , array(
			'label' => __('News Category Show','business-responsiveness' ),
			'section' => 'news_section',
			'type'=>'select',
			'choices'=> Business_Responsiveness_get_post_category(),
			) );
		
			// news section background color
			$wp_customize->add_setting( 'business_r_option[news_section_backgorund_color]' , array(
			'default'    => '#3c3c3c',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'=>'option'
			));
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize , 'business_r_option[news_section_backgorund_color]' , array(
			'label' => __('Section Background Color','business-responsiveness' ),
			'section' => 'news_section',
			'settings'=>'business_r_option[news_section_backgorund_color]'
			) ) );
			
			// News section image
			$wp_customize->add_setting( 'business_r_option[news_section_image]' , array(
			'default' => '',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'Business_Responsiveness_sanitize_image',
			'type'=>'option'
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'business_r_option[news_section_image]' ,
			array(
			'label'          => __( 'News Section Image', 'business-responsiveness' ),
			'description'=> __('Upload your background image minimum size ( 1600 x 900 ).','business-responsiveness'),
			'section'        => 'news_section',
		    ) )	);
			
			$wp_customize->add_setting( 'business_r_option[news_section_image_repeat]', array(
				'default'        => 'repeat',
				'sanitize_callback' => 'Business_Responsiveness_sanitize_select',
				'type'=>'option'
			) );
			$wp_customize->add_control(
				'business_r_option[news_section_image_repeat]', 
				array(
					'label'    => __( 'Background Repeat', 'business-responsiveness' ),
					'section'  => 'news_section',
					'settings' => 'business_r_option[news_section_image_repeat]',
					'type'     => 'select',
					'choices'  => array(
						'no-repeat'  => __('No Repeat','business-responsiveness'),
						'repeat'     => __('Tile','business-responsiveness'),
						'repeat-x'   => __('Tile Horizontally','business-responsiveness'),
						'repeat-y'   => __('Tile Vertically','business-responsiveness'),
					),
				)
			);


    
		/* Contact Settings */
		$wp_customize->add_section( 'contact_section' , array(
			'title'      => __('Contact', 'business-responsiveness' ),
			'panel'  => 'frontpage',
			'description'=> sprintf(__('Show your contact information in your front page. First you setup your front page. <a target="_blank" href="%s">Click Here!</a><p>To add your contact form. Please install Contact Form 7 plugin. And copy contact form shortcode and add this shorcode given below Contact Form 7 Shortcode settings.</p>','business-responsiveness'),esc_url( admin_url('options-reading.php') )),
		) );
			
			// Contact section enable/disable
			$wp_customize->add_setting( 'business_r_option[contact_section_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'Business_Responsiveness_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[contact_section_enable]' , array(
			'label' => __('Enable Contact Section', 'business-responsiveness'),
			'section' => 'contact_section',
			'type'=>'checkbox',
			) );
		
			// Contact section title
			$wp_customize->add_setting( 'business_r_option[contact_section_title]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[contact_section_title]' , array(
			'label' => __('Contact Section Title', 'business-responsiveness'),
			'section' => 'contact_section',
			'type'=>'text',
			) );
			
			// Contact section description
			$wp_customize->add_setting( 'business_r_option[contact_section_description]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_r_option[contact_section_description]' , array(
			'label' => __('Contact Section Description', 'business-responsiveness'),
			'section' => 'contact_section',
			'type'=>'text',
			) );
			
			/* Contact Form & info section */			
			$wp_customize->add_setting(
				'
Business_Responsiveness_contactform_info', array(
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				new Business_Responsiveness_Contactform_Info(
					$wp_customize, '
Business_Responsiveness_contactform_info', array(
						'label' => esc_html__( 'Instructions', 'business-responsiveness' ),
						'section' => 'contact_section',
						'capability' => 'install_plugins',
					)
				)
			);
			
			$wp_customize->add_setting( 'business_r_option[contact_contactform_shortcode]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_textarea_field',
			'type'=>'option'
			));
			$wp_customize->add_control('business_r_option[contact_contactform_shortcode]' , array(
			'label' => __('Contact Form 7 Shortcode:', 'business-responsiveness'),
			'section' => 'contact_section',
			'type'=>'textarea',
			) );
}
add_action( 'customize_register', 'Business_Responsiveness_homepage_settings_fucntion' );

function Business_Responsiveness_get_post_category(){
	$cats = get_categories();
	$arr = array();
	foreach($cats as $cat){
		$arr[$cat->term_id] = esc_html($cat->name);
	}
	return $arr;
}


/**
 * Sanitize repeater control.
 */
function Business_Responsiveness_Repeater_sanitize( $input ) {
    $input_decoded = json_decode( $input,true );

    if ( ! empty( $input_decoded ) ) {
        foreach ( $input_decoded as $boxk => $box ) {
            foreach ( $box as $key => $value ) {

                $input_decoded[ $boxk ][ $key ] = wp_kses_post( force_balance_tags( $value ) );

            }
        }
        return json_encode( $input_decoded );
    }
    return $input;
}


function Business_Responsiveness_sanitize_image( $image, $setting ) {
 /*
  * Array of valid image file types.
  *
  * The array includes image mime types that are included in wp_get_mime_types()
  */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
 // Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
 // If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}


function Business_Responsiveness_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}