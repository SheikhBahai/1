<?php
/**
* Header Banner Options.
*
* @package Snappy
*/

$snappy_default = snappy_get_default_theme_options();
$snappy_post_category_list = snappy_post_category_list();

$wp_customize->add_section( 'header_banner_setting',
    array(
    'title'      => esc_html__( 'Slider Banner Settings', 'snappy' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_home_pannel',
    )
);

$wp_customize->add_setting('ed_header_banner',
    array(
        'default' => $snappy_default['ed_header_banner'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'snappy_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_banner',
    array(
        'label' => esc_html__('Enable Slider Banner', 'snappy'),
        'section' => 'header_banner_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'snappy_header_banner_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'snappy_sanitize_select',
    )
);
$wp_customize->add_control( 'snappy_header_banner_cat',
    array(
    'label'       => esc_html__( 'Slider Post Category', 'snappy' ),
    'section'     => 'header_banner_setting',
    'type'        => 'select',
    'choices'     => $snappy_post_category_list,
    )
);

$wp_customize->add_section( 'header_carousel_setting',
    array(
    'title'      => esc_html__( 'Carousel Section Settings', 'snappy' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_home_pannel',
    )
);

$wp_customize->add_setting('ed_carousel_section',
    array(
        'default' => $snappy_default['ed_carousel_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'snappy_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_carousel_section',
    array(
        'label' => esc_html__('Enable Carousel Section', 'snappy'),
        'section' => 'header_carousel_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'snappy_carousel_section_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'snappy_sanitize_select',
    )
);
$wp_customize->add_control( 'snappy_carousel_section_cat',
    array(
    'label'       => esc_html__( 'Carousel Section Post Category', 'snappy' ),
    'section'     => 'header_carousel_setting',
    'type'        => 'select',
    'choices'     => $snappy_post_category_list,
    )
);

$wp_customize->add_setting('snappy_carousel_section_title',
    array(
        'default' => $snappy_default['snappy_carousel_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('snappy_carousel_section_title',
    array(
        'label' => esc_html__('Section Title', 'snappy'),
        'section' => 'header_carousel_setting',
        'type' => 'text',
    )
);