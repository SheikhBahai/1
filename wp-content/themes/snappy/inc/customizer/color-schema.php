<?php
/**
* Color Settings.
*
* @package Snappy
*/

$snappy_default = snappy_get_default_theme_options();

$wp_customize->add_section( 'color_schema',
    array(
    'title'      => esc_html__( 'Color Schema', 'snappy' ),
    'priority'   => 60,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_colors_panel',
    )
);

// Color Schema.
$wp_customize->add_setting(
    'snappy_color_schema',
    array(
        'default' 			=> 'default',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'snappy_sanitize_select'
    )
);
$wp_customize->add_control(
    new Snappy_Custom_Radio_Color_Schema( 
        $wp_customize,
        'snappy_color_schema',
        array(
            'settings'      => 'snappy_color_schema',
            'section'       => 'color_schema',
            'label'         => esc_html__( 'Color Schema', 'snappy' ),
            'choices'       => array(
                'default'  => array(
                	'color' => array($snappy_default['snappy_background_color'],$snappy_default['snappy_primary_color'],$snappy_default['snappy_secondary_color'],$snappy_default['default_tertiary_color']),
                	'title' => esc_html__('Default','snappy'),
                ),
                'dark'  => array(
                	'color' => array($snappy_default['snappy_background_color_dark'],$snappy_default['snappy_primary_color_dark'],$snappy_default['snappy_secondary_color_dark'],$snappy_default['dark_tertiary_color']),
                	'title' => esc_html__('Dark','snappy'),
                ),
            )
        )
    )
);

$wp_customize->add_setting( 'snappy_primary_color',
    array(
    'default'           => $snappy_default['snappy_primary_color'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'snappy_primary_color', 
    array(
        'label'      => __( 'Primary Color', 'snappy' ),
        'section'    => 'colors',
        'settings'   => 'snappy_primary_color',
    ) ) 
);

$wp_customize->add_setting( 'snappy_secondary_color',
    array(
    'default'           => $snappy_default['snappy_secondary_color'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'snappy_secondary_color', 
    array(
        'label'      => __( 'Secondary Color', 'snappy' ),
        'section'    => 'colors',
        'settings'   => 'snappy_secondary_color',
    ) ) 
);