<?php
/**
* Widget FUnctions.
*
* @package Snappy
*/

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function snappy_widgets_init(){

    $snappy_default = snappy_get_default_theme_options();
    $footer_column_layout = absint( get_theme_mod( 'footer_column_layout',$snappy_default['footer_column_layout'] ) );

    for( $i = 0; $i < $footer_column_layout; $i++ ){
    	
    	if( $i == 0 ){ $count = esc_html__('One','snappy'); }
    	if( $i == 1 ){ $count = esc_html__('Two','snappy'); }
    	if( $i == 2 ){ $count = esc_html__('Three','snappy'); }

	    register_sidebar( array(
	        'name' => esc_html__('Footer Widget ', 'snappy').$count,
	        'id' => 'snappy-footer-widget-'.$i,
	        'description' => esc_html__('Add widgets here.', 'snappy'),
	        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '<h2 class="widget-title">',
	        'after_title' => '</h2>',
	    ));
	}

}

add_action('widgets_init', 'snappy_widgets_init');

require get_template_directory() . '/inc/widgets/widget-base.php';
require get_template_directory() . '/inc/widgets/author.php';
require get_template_directory() . '/inc/widgets/category.php';
require get_template_directory() . '/inc/widgets/recent-post.php';
require get_template_directory() . '/inc/widgets/social-link.php';
require get_template_directory() . '/inc/widgets/tab-posts.php';