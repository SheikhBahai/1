<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Snappy
 * @since 1.0.0
 */

/**
 * Toogle Contents
 * @hooked snappy_header_toggle_search - 10
 * @hooked snappy_content_offcanvas - 30
*/

do_action('snappy_before_footer_content_action'); ?>

</div>

<?php if( !is_paged() && ( is_home() || is_front_page() ) ){ snappy_main_carousel(); } ?>


<footer id="site-footer" role="contentinfo">

    <?php
    /**
     * Footer Content
     * @hooked snappy_footer_content_widget - 10
     * @hooked snappy_footer_content_info - 20
    */

    do_action('snappy_footer_content_action'); ?>

    

</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
