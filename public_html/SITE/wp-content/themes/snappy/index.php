<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Snappy
 * @since 1.0.0
 */

get_header();

global $snappy_order_class_1, $snappy_order_class_2; ?>
    <div class="wrapper">
        <div class="column-row">

            <div id="primary" class="content-area">
                <main id="site-content" role="main">

                    <?php

                    if( !is_front_page() ) {
                        snappy_breadcrumb();
                    }

                    if( have_posts() ): ?>

                        <div class="article-wraper">
                            <?php
                            $post_count = 1;
                            while( have_posts() ):
                                the_post();

                                if( $post_count == 1 ){
                                    $snappy_order_class_1 = 'column-order-1';
                                    $snappy_order_class_2 = 'column-order-2';
                                }else{
                                    $snappy_order_class_1 = 'column-order-2';
                                    $snappy_order_class_2 = 'column-order-1';
                                }

                                get_template_part( 'template-parts/content', get_post_format() );

                                $post_count++;
                                if( $post_count == 3 ){
                                    $post_count = 1;
                                }

                            endwhile; ?>
                        </div>

                        <?php
                        if( is_search() ){
                            the_posts_pagination();
                        }else{
                            do_action('snappy_archive_pagination');
                        }

                    else :

                        get_template_part('template-parts/content', 'none');

                    endif; ?>
                </main><!-- #main -->
            </div>

        </div>
    </div>
<?php
get_footer();
