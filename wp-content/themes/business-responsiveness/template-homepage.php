<?php 
/**
 * Template Name: Home Page
 * This is custm home page template file
 *
 * @package WordPress
 * @subpackage business-responsiveness
 * @since Business Responsiveness 1.0.0
 */
$business_obj = new Business_Responsiveness_settings_array();
$option = wp_parse_args(  get_option( 'business_r_option', array() ), $business_obj->default_data() );
get_header();

	get_template_part('homepage','slider');

	get_template_part('homepage','service');
	
	get_template_part('homepage','shop');    

	get_template_part('homepage','news');
	 
	get_template_part('homepage','contact');
		
get_footer(); ?>