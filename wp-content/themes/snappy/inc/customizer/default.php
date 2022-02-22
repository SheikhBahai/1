<?php
/**
 * Default Values.
 *
 * @package Snappy
 */

if ( ! function_exists( 'snappy_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function snappy_get_default_theme_options() {

		$snappy_defaults = array();
		
		// Options.
		$snappy_defaults['snappy_pagination_layout']					= 'numeric';
		$snappy_defaults['footer_column_layout'] 						= 3;
		$snappy_defaults['footer_copyright_text'] 						= esc_html__( 'All rights reserved.', 'snappy' );
                $snappy_defaults['ed_preloader']                                                        = 1;
                $snappy_defaults['ed_cursor_option']                                                        = 1;
		$snappy_defaults['ed_header_search'] 							= 1;
		$snappy_defaults['ed_related_post']                				= 1;
                $snappy_defaults['related_post_title']             				= esc_html__('Related Post','snappy');
                $snappy_defaults['snappy_carousel_section_title']             	= esc_html__('You may have missed','snappy');
                $snappy_defaults['twp_navigation_type']              			= 'theme-normal-navigation';
                $snappy_defaults['ed_post_author']                				= 1;
                $snappy_defaults['ed_post_date']                				= 1;
                $snappy_defaults['ed_post_category']                			= 1;
                $snappy_defaults['ed_post_tags']                				= 1;
                $snappy_defaults['ed_floating_next_previous_nav']               = 1;
                $snappy_defaults['snappy_header_layout']               			= 'layout-1';
                $snappy_defaults['ed_header_banner']               				= 0;
                $snappy_defaults['ed_carousel_section']               			= 0;
                $snappy_defaults['ed_day_night_mode_switch']               		= 1;
                $snappy_defaults['ed_header_responsive_menu']                            = 1;

                $snappy_defaults['snappy_color_schema'] = 'dark';

                $snappy_defaults['snappy_background_color']               		= '#fff';
                $snappy_defaults['snappy_primary_color']               			= '#000';
                $snappy_defaults['snappy_secondary_color']               		= '#000';
                $snappy_defaults['default_tertiary_color'] 						= '#2568ef';
                
                $snappy_defaults['snappy_background_color_dark']               	= '#000';
                $snappy_defaults['snappy_primary_color_dark']               	= '#fff';
                $snappy_defaults['snappy_secondary_color_dark']               	= '#fff';
                $snappy_defaults['dark_tertiary_color'] 						= '#2568ef';

		// Pass through filter.
		$snappy_defaults = apply_filters( 'snappy_filter_default_theme_options', $snappy_defaults );

		return $snappy_defaults;

	}

endif;
