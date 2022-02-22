<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Snappy
 * @since 1.0.0
 */
get_header();

    $snappy_default = snappy_get_default_theme_options();
    $twp_navigation_type = esc_attr( get_post_meta( get_the_ID(), 'twp_disable_ajax_load_next_post', true ) );
    global $post;
    $single_layout_class = '';

    if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
        $twp_navigation_type = get_theme_mod('twp_navigation_type', $snappy_default['twp_navigation_type']);
    }
    
    $snappy_ed_post_rating = esc_html( get_post_meta( $post->ID, 'snappy_ed_post_rating', true ) ); ?>

    <div class="singular-main-block">
        <div class="wrapper">
            <div class="column-row">

                <div id="primary" class="content-area">
                    <main id="site-content" class="<?php if( $snappy_ed_post_rating ){ echo 'snappy-no-comment'; } ?>" role="main">

                        <?php
                        if( isset( $breadcrumb ) ) {
                            snappy_breadcrumb();
                        }

                        if( have_posts() ): ?>

                            <div class="article-wraper <?php echo esc_attr($single_layout_class); ?>">

                                <?php while (have_posts()) :
                                    the_post();

                                    get_template_part('template-parts/content', 'single');

                                    /**
                                     *  Output comments wrapper if it's a post, or if comments are open,
                                     * or if there's a comment number – and check for password.
                                    **/

                                    if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && !post_password_required() ) { ?>

                                        <div class="comments-wrapper">
                                            <?php comments_template(); ?>
                                        </div><!-- .comments-wrapper -->

                                    <?php
                                    }

                                endwhile; ?>

                            </div>

                        <?php
                        else :

                            get_template_part('template-parts/content', 'none');

                        endif;

                        /**
                         * Navigation
                         * 
                         * @hooked snappy_post_floating_nav - 10
                         * @hooked snappy_related_posts - 20  
                         * @hooked snappy_single_post_navigation - 30  
                        */

                        do_action('snappy_navigation_action'); ?>

                    </main><!-- #main -->
                </div>

            </div>
        </div>
    </div>

<?php
get_footer();
