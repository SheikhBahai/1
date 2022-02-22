<?php
/**
 * Pagination Settings
 *
 * @package Snappy
 */

$snappy_default = snappy_get_default_theme_options();

// Pagination Section.
$wp_customize->add_section( 'snappy_pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Settings', 'snappy' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'		 => 'theme_option_panel',
	)
);

// Pagination Layout Settings
$wp_customize->add_setting( 'snappy_pagination_layout',
	array(
	'default'           => $snappy_default['snappy_pagination_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'snappy_pagination_layout',
	array(
	'label'       => esc_html__( 'Pagination Method', 'snappy' ),
	'section'     => 'snappy_pagination_section',
	'type'        => 'select',
	'choices'     => array(
		'next-prev' => esc_html__('Next/Previous Method','snappy'),
		'numeric' => esc_html__('Numeric Method','snappy'),
		'load-more' => esc_html__('Ajax Load More Button','snappy'),
		'auto-load' => esc_html__('Ajax Auto Load','snappy'),
	),
	)
);