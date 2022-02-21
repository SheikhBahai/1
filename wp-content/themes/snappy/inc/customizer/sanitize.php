<?php
/**
* Custom Functions.
*
* @package Snappy
*/

if( !function_exists( 'snappy_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function snappy_sanitize_sidebar_option( $snappy_input ){

        $snappy_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $snappy_input,$snappy_metabox_options ) ){

            return $snappy_input;

        }

        return;

    }

endif;

if( !function_exists( 'snappy_sanitize_single_pagination_layout' ) ) :

    // Sidebar Option Sanitize.
    function snappy_sanitize_single_pagination_layout( $snappy_input ){

        $snappy_single_pagination = array( 'no-navigation','theme-normal-navigation','ajax-next-post-load' );
        if( in_array( $snappy_input,$snappy_single_pagination ) ){

            return $snappy_input;

        }

        return;

    }

endif;

if( !function_exists( 'snappy_sanitize_archive_layout' ) ) :

    // Sidebar Option Sanitize.
    function snappy_sanitize_archive_layout( $snappy_input ){

        $snappy_archive_option = array( 'default','full','grid','masonry' );
        if( in_array( $snappy_input,$snappy_archive_option ) ){

            return $snappy_input;

        }

        return;

    }

endif;

if( !function_exists( 'snappy_sanitize_header_layout' ) ) :

    // Sidebar Option Sanitize.
    function snappy_sanitize_header_layout( $snappy_input ){

        $snappy_header_options = array( 'layout-1','layout-2' );
        if( in_array( $snappy_input,$snappy_header_options ) ){

            return $snappy_input;

        }

        return;

    }

endif;

if( !function_exists( 'snappy_sanitize_single_post_layout' ) ) :

    // Single Layout Option Sanitize.
    function snappy_sanitize_single_post_layout( $snappy_input ){

        $snappy_single_layout = array( 'layout-1','layout-2' );
        if( in_array( $snappy_input,$snappy_single_layout ) ){

            return $snappy_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'snappy_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function snappy_sanitize_checkbox( $snappy_checked ) {

		return ( ( isset( $snappy_checked ) && true === $snappy_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'snappy_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function snappy_sanitize_select( $snappy_input, $snappy_setting ) {

        // Ensure input is a slug.
        $snappy_input = sanitize_text_field( $snappy_input );

        // Get list of choices from the control associated with the setting.
        $choices = $snappy_setting->manager->get_control( $snappy_setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $snappy_input, $choices ) ? $snappy_input : $snappy_setting->default );

    }

endif;