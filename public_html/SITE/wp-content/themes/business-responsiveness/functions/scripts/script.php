<?php
/*
 * enqueue scripts function
 */ 

if( !function_exists('Business_Responsiveness_Scripts'))
{
	function Business_Responsiveness_Scripts(){
		
		// business stylesheets
		wp_enqueue_style('jquery-bootstrap', Business_Responsiveness_TEMPLATE_DIR_URI . '/css/bootstrap.css' );
		wp_enqueue_style('Business_Responsiveness_style', get_stylesheet_uri() );
		wp_enqueue_style('Business_Responsiveness_font-awesome', Business_Responsiveness_TEMPLATE_DIR_URI . '/css/font-awesome/css/font-awesome.css' );
		wp_enqueue_style('Business_Responsiveness_woocommerce', Business_Responsiveness_TEMPLATE_DIR_URI . '/css/woocommerce.css' );
		
		// business js
		wp_enqueue_script( 'jquery-bootstrap' , Business_Responsiveness_TEMPLATE_DIR_URI . '/js/bootstrap.js' , array('jquery') );
		wp_enqueue_script( 'Business_Responsiveness_custom' , Business_Responsiveness_TEMPLATE_DIR_URI . '/js/custom.js' );
		wp_enqueue_script( 'Business_Responsiveness_menu' , Business_Responsiveness_TEMPLATE_DIR_URI . '/js/menu/menu.js' );
		
		if ( is_singular() ) wp_enqueue_script( "comment-reply" );	
	}
}
add_action('wp_enqueue_scripts','Business_Responsiveness_Scripts');



function Business_Responsiveness_wp_admin_style() {
       wp_enqueue_style('Business_Responsiveness_about', Business_Responsiveness_TEMPLATE_DIR_URI . '/css/about-theme.css' );
}
add_action( 'admin_enqueue_scripts', 'Business_Responsiveness_wp_admin_style' );


// media upload
function Business_Responsiveness_upload_scripts($hook)
{
	if ( 'edit.php' != $hook ) {
        return;
    }

	 wp_enqueue_media();	
	 wp_enqueue_script('media-upload');
     wp_enqueue_script('thickbox');
     wp_enqueue_script('upload_media_widget', Business_Responsiveness_TEMPLATE_DIR_URI . '/js/upload-media.js', array('jquery'));
	 wp_enqueue_style('thickbox');
	 wp_enqueue_style('Business_Responsiveness_drag-drop',Business_Responsiveness_TEMPLATE_DIR_URI.'/css/drag-drop.css');
	 
}
add_action("admin_enqueue_scripts","Business_Responsiveness_upload_scripts");


/**
 * Binds with Customizer preview reload changes.
 */
function Business_Responsiveness_customize_preview_js() {
    wp_enqueue_script( 'jquery-Business_Responsiveness_customizer_liveview', get_template_directory_uri() . '/js/customizer-liveview.js', array( 'customize-preview', 'customize-selective-refresh' ), false, true );
}
add_action( 'customize_preview_init', 'Business_Responsiveness_customize_preview_js', 65 );