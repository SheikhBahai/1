<?php
/**
* Header Options.
*
* @package Snappy
*/

$snappy_default = snappy_get_default_theme_options();

// Header Advertise Area Section.
$wp_customize->add_section( 'main_header_setting',
	array(
	'title'      => esc_html__( 'Header Settings', 'snappy' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Enable Disable Search.
$wp_customize->add_setting('ed_day_night_mode_switch',
    array(
        'default' => $snappy_default['ed_day_night_mode_switch'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'snappy_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_day_night_mode_switch',
    array(
        'label' => esc_html__('Enable Day and Night Switch', 'snappy'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

// Enable Disable Search.
$wp_customize->add_setting('ed_header_search',
    array(
        'default' => $snappy_default['ed_header_search'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'snappy_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_search',
    array(
        'label' => esc_html__('Enable Search', 'snappy'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_responsive_menu',
    array(
        'default' => $snappy_default['ed_header_responsive_menu'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'snappy_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_responsive_menu',
    array(
        'label' => esc_html__('Display Off-canvas Menu on Desktop View', 'snappy'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

// Archive Layout.
$wp_customize->add_setting(
    'snappy_header_layout',
    array(
        'default'           => $snappy_default['snappy_header_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'snappy_sanitize_header_layout'
    )
);
$wp_customize->add_control(
    new Snappy_Custom_Radio_Image_Control( 
        $wp_customize,
        'snappy_header_layout',
        array(
            'settings'      => 'snappy_header_layout',
            'section'       => 'main_header_setting',
            'label'         => esc_html__( 'Header Layout', 'snappy' ),
            'choices'       => array(
                'layout-1'  => get_template_directory_uri() . '/assets/images/header-layout-1.png',
                'layout-2'  => get_template_directory_uri() . '/assets/images/header-layout-2.png',
            )
        )
    )
);

$wp_customize->add_setting('header_ad_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
    'header_ad_image',
        array(
            'label'      => esc_html__( 'Top Header AD Image', 'snappy' ),
            'section'    => 'main_header_setting',
            // 'active_callback' => 'snappy_header_ad_ac',
        )
    )
);

$wp_customize->add_setting('header_ad_image_link',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('header_ad_image_link',
    array(
        'label' => esc_html__('AD Image Link Search', 'snappy'),
        'section' => 'main_header_setting',
        'type' => 'text',
    )
);

$wp_customize->add_setting( 'dark_mode_logo', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw'
));

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'dark_mode_logo', array(
    'label' => esc_html__( 'Dark Mode Logo', 'snappy' ),
    'priority' => 20,
    'section' => 'title_tagline',
    'settings' => 'dark_mode_logo',
)));