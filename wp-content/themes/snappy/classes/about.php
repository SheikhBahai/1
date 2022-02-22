<?php

/**
 * Snappy About Page
 * @package Snappy
 *
*/

if( !class_exists('Snappy_About_page') ):

	class Snappy_About_page{

		function __construct(){

			add_action('admin_menu', array($this, 'snappy_backend_menu'),999);

		}

		// Add Backend Menu
        function snappy_backend_menu(){

            add_theme_page(esc_html__( 'Snappy Options','snappy' ), esc_html__( 'Snappy Options','snappy' ), 'activate_plugins', 'snappy-about', array($this, 'snappy_main_page'));

        }

        // Settings Form
        function snappy_main_page(){

            require get_template_directory() . '/classes/about-render.php';

        }

	}

	new Snappy_About_page();

endif;