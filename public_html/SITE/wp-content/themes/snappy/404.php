<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Snappy
 */

get_header();
?>
    <div class="singular-main-block">
        <section class="theme-section theme-error-section error-block-heading">
            <div class="wrapper">
                <div class="theme-area-header">
                    <div class="theme-area-headlines">
                        <h2 class="theme-area-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'snappy'); ?></h2>
                        <div class="theme-animated-line"></div>
                    </div>
                </div>

            </div>
        </section>


        <section class="theme-section theme-error-section error-block-middle">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-12">
                        <h2><?php esc_html_e('Maybe it’s out there, somewhere...', 'snappy'); ?></h2>
                        <p><?php esc_html_e('You can always find insightful stories on our', 'snappy'); ?>
                            <a href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e('Homepage','snappy'); ?></a></p>
                    </div>
                </div>
            </div>
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-12">
                        <h2><?php esc_html_e('Still feeling lost? You’re not alone.', 'snappy'); ?></h2>
                        <p><?php esc_html_e('Enjoy these stories about getting lost, losing things, and finding what you never knew you were looking for.', 'snappy'); ?></p>
                    </div>
                </div>
            </div>

            <?php
            snappy_404_posts();
            ?>
        </section>




    </div>

<?php
get_footer();
