<?php
/**
* Posts Settings.
*
* @package Snappy
*/

$snappy_default = snappy_get_default_theme_options();

// Single Post Section.
$wp_customize->add_section( 'posts_settings',
	array(
	'title'      => esc_html__( 'Posts Settings', 'snappy' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_post_author',
    array(
        'default' => $snappy_default['ed_post_author'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'snappy_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_author',
    array(
        'label' => esc_html__('Enable Posts Author', 'snappy'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_date',
    array(
        'default' => $snappy_default['ed_post_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'snappy_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_date',
    array(
        'label' => esc_html__('Enable Posts Date', 'snappy'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_category',
    array(
        'default' => $snappy_default['ed_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'snappy_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'snappy'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_tags',
    array(
        'default' => $snappy_default['ed_post_tags'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'snappy_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_tags',
    array(
        'label' => esc_html__('Enable Posts Tags', 'snappy'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);