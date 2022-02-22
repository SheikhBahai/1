<?php
/**
* Body Classes.
*
* @package Snappy
*/
 
 if (!function_exists('snappy_body_classes')) :

    function snappy_body_classes($classes) {

        $snappy_default = snappy_get_default_theme_options();
        global $post;
        // Adds a class of hfeed to non-singular pages.
        if ( !is_singular() ) {
            $classes[] = 'hfeed';
        }

        if( is_singular('post') ){

            $snappy_ed_post_reaction = esc_attr( get_post_meta( $post->ID, 'snappy_ed_post_reaction', true ) );
            if( $snappy_ed_post_reaction ){
                $classes[] = 'hide-comment-rating';
            }

        }
        
        return $classes;
    }

endif;

add_filter('body_class', 'snappy_body_classes');