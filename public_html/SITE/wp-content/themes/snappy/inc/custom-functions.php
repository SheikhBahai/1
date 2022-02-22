<?php
/**
 * Custom Functions.
 *
 * @package Snappy
 */

if( !function_exists( 'snappy_social_menu_icon' ) ) :

    function snappy_social_menu_icon( $item_output, $item, $depth, $args ) {

        // Add Icon
        if ( isset( $args->theme_location ) && 'snappy-social-menu' === $args->theme_location ) {

            $svg = Snappy_SVG_Icons::get_theme_svg_name( $item->url );

            if ( empty( $svg ) ) {
                $svg = snappy_the_theme_svg( 'link',$return = true );
            }

            $item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
        }

        return $item_output;
    }

endif;

add_filter( 'walker_nav_menu_start_el', 'snappy_social_menu_icon', 10, 4 );

if ( ! function_exists( 'snappy_sub_menu_toggle_button' ) ) :

    function snappy_sub_menu_toggle_button( $args, $item, $depth ) {

        // Add sub menu toggles to the main menu with toggles
        if ( $args->theme_location == 'snappy-primary-menu' && isset( $args->show_toggles ) ) {
            
            // Wrap the menu item link contents in a div, used for positioning
            $args->before = '<div class="submenu-wrapper">';
            $args->after  = '';

            // Add a toggle to items with children
            if ( in_array( 'menu-item-has-children', $item->classes ) ) {

                $toggle_target_string = '.menu-item.menu-item-' . $item->ID . ' > .sub-menu';

                // Add the sub menu toggle
                $args->after .= '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . esc_html__( 'Show sub menu', 'snappy' ) . '</span>' . snappy_get_theme_svg( 'chevron-down' ) . '</span></button>';

            }

            // Close the wrapper
            $args->after .= '</div><!-- .submenu-wrapper -->';
            // Add sub menu icons to the main menu without toggles (the fallback menu)

        }elseif( $args->theme_location == 'snappy-primary-menu' ) {

            if ( in_array( 'menu-item-has-children', $item->classes ) ) {

                $args->before = '<div class="link-icon-wrapper">';
                $args->after  = snappy_get_theme_svg( 'chevron-down' ) . '</div>';

            } else {

                $args->before = '';
                $args->after  = '';

            }

        }

        return $args;

    }

endif;

add_filter( 'nav_menu_item_args', 'snappy_sub_menu_toggle_button', 10, 3 );

/**
 * Snappy SVG Icon helper functions
 *
 * @package Snappy
 * @since 1.0.0
 */
if ( ! function_exists( 'snappy_the_theme_svg' ) ):
    /**
     * Output and Get Theme SVG.
     * Output and get the SVG markup for an icon in the Snappy_SVG_Icons class.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function snappy_the_theme_svg( $svg_name, $return = false ) {

        if( $return ){

            return snappy_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in snappy_get_theme_svg();.

        }else{

            echo snappy_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in snappy_get_theme_svg();.

        }
    }

endif;

if ( ! function_exists( 'snappy_get_theme_svg' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function snappy_get_theme_svg( $svg_name ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            Snappy_SVG_Icons::get_svg( $svg_name ),
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );
        if ( ! $svg ) {
            return false;
        }
        return $svg;

    }

endif;


if( !function_exists( 'snappy_post_category_list' ) ) :

    // Post Category List.
    function snappy_post_category_list( $select_cat = true ){

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        if( $select_cat ){

            $post_cat_cat_array[''] = esc_html__( '-- Select Category --','snappy' );

        }

        foreach ( $post_cat_lists as $post_cat_list ) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;

if( !function_exists('snappy_sanitize_meta_pagination') ):

    /** Sanitize Enable Disable Checkbox **/
    function snappy_sanitize_meta_pagination( $input ) {

        $valid_keys = array('global-layout','no-navigation','theme-normal-navigation','ajax-next-post-load');
        if ( in_array( $input , $valid_keys ) ) {
            return $input;
        }
        return '';

    }

endif;

if( !function_exists('snappy_disable_post_views') ):

    /** Disable Post Views **/
    function snappy_disable_post_views() {

        add_filter('booster_extension_filter_views_ed', 'snappy_disable_post_views_callback');

    }

endif;

if( !function_exists('snappy_disable_post_views_callback') ):

    /** Disable Reaction **/
    function snappy_disable_post_views_callback() {

        return false;

    }

endif;

if( !function_exists('snappy_disable_post_read_time') ):

    /** Disable Read Time **/
    function snappy_disable_post_read_time() {

        add_filter('booster_extension_filter_readtime_ed', 'snappy_disable_post_read_time_callback');

    }

endif;

if( !function_exists('snappy_disable_post_read_time_callback') ):

    /** Disable Reaction **/
    function snappy_disable_post_read_time_callback() {

        return false;

    }

endif;

if( !function_exists('snappy_disable_post_like_dislike') ):

    /** Disable Like Dislike **/
    function snappy_disable_post_like_dislike() {

        add_filter('booster_extension_filter_like_ed', 'snappy_disable_post_like_dislike_callback');

    }

endif;

if( !function_exists('snappy_disable_post_like_dislike_callback') ):

    /** Disable Reaction **/
    function snappy_disable_post_like_dislike_callback() {

        return false;

    }

endif;

if( !function_exists('snappy_disable_post_author_box') ):

    /** Disable Author Box **/
    function snappy_disable_post_author_box() {

        add_filter('booster_extension_filter_ab_ed', 'snappy_disable_post_author_box_callback');

    }

endif;

if( !function_exists('snappy_disable_post_author_box_callback') ):

    /** Disable Reaction **/
    function snappy_disable_post_author_box_callback() {

        return false;

    }

endif;

add_filter('booster_extension_filter_ss_ed', 'snappy_disable_post_social_share_callback');

if( !function_exists('snappy_disable_post_social_share_callback') ):

    /** Disable Reaction **/
    function snappy_disable_post_social_share_callback() {

        return false;

    }

endif;

if( !function_exists('snappy_disable_post_reaction') ):

    /** Disable Reaction **/
    function snappy_disable_post_reaction() {

        add_filter( 'booster_extension_filter_reaction_ed', 'snappy_disable_post_reaction_callback' );

    }

endif;

if( !function_exists('snappy_disable_post_reaction_callback') ):

    /** Disable Reaction **/
    function snappy_disable_post_reaction_callback() {

        return false;

    }

endif;

if( !function_exists('snappy_post_floating_nav') ):

    function snappy_post_floating_nav(){

        $snappy_default = snappy_get_default_theme_options();
        $ed_floating_next_previous_nav = get_theme_mod( 'ed_floating_next_previous_nav',$snappy_default['ed_floating_next_previous_nav'] );

        if( 'post' === get_post_type() && $ed_floating_next_previous_nav ){

            $next_post = get_next_post();
            $prev_post = get_previous_post();

            if( isset( $prev_post->ID ) ){

                $prev_link = get_permalink( $prev_post->ID );?>

                <div class="floating-post-navigation floating-navigation-prev">

                    <?php if( get_the_post_thumbnail( $prev_post->ID,'medium' ) ){ ?>
                            <?php echo wp_kses_post( get_the_post_thumbnail( $prev_post->ID,'medium' ) ); ?>
                    <?php } ?>

                    <a href="<?php echo esc_url( $prev_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Previous post', 'snappy'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                    </a>

                </div>

            <?php }

            if( isset( $next_post->ID ) ){

                $next_link = get_permalink( $next_post->ID );?>

                <div class="floating-post-navigation floating-navigation-next">

                    <?php if( get_the_post_thumbnail( $next_post->ID,'medium' ) ){ ?>
                        <?php echo wp_kses_post( get_the_post_thumbnail( $next_post->ID,'medium' ) ); ?>
                    <?php } ?>

                    <a href="<?php echo esc_url( $next_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Next post', 'snappy'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                    </a>

                </div>

            <?php
            }

        }

    }

endif;

add_action( 'snappy_navigation_action','snappy_post_floating_nav',10 );

if( !function_exists('snappy_single_post_navigation') ):

    function snappy_single_post_navigation(){

        $snappy_default = snappy_get_default_theme_options();
        $twp_navigation_type = esc_attr( get_post_meta( get_the_ID(), 'twp_disable_ajax_load_next_post', true ) );
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;
        if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
            $twp_navigation_type = get_theme_mod('twp_navigation_type', $snappy_default['twp_navigation_type']);
        }

        if( $twp_navigation_type != 'no-navigation' && 'post' === get_post_type() ){

            if( $twp_navigation_type == 'theme-normal-navigation' ){ ?>

                <div class="navigation-wrapper">
                    <?php
                    // Previous/next post navigation.
                    the_post_navigation(array(
                        'prev_text' => '<span class="arrow" aria-hidden="true">' . snappy_the_theme_svg('arrow-left',$return = true ) . '</span><span class="screen-reader-text">' . esc_html__('Previous post:', 'snappy') . '</span><span class="post-title">%title</span>',
                        'next_text' => '<span class="arrow" aria-hidden="true">' . snappy_the_theme_svg('arrow-right',$return = true ) . '</span><span class="screen-reader-text">' . esc_html__('Next post:', 'snappy') . '</span><span class="post-title">%title</span>',
                    )); ?>
                </div>
                <?php

            }else{

                $next_post = get_next_post();
                if( isset( $next_post->ID ) ){

                    $next_post_id = $next_post->ID;
                    echo '<div loop-count="1" next-post="' . absint( $next_post_id ) . '" class="twp-single-infinity"></div>';

                }
            }

        }

    }

endif;

add_action( 'snappy_navigation_action','snappy_single_post_navigation',30 );

if ( ! function_exists( 'snappy_header_toggle_search' ) ):

    /**
     * Header Search
     **/
    function snappy_header_toggle_search() {

        $snappy_default = snappy_get_default_theme_options();
        $ed_header_search = get_theme_mod('ed_header_search', $snappy_default['ed_header_search']);
        if( $ed_header_search ){ ?>
            <div class="header-searchbar">
                <div class="header-searchbar-inner">
                    <div class="wrapper">
                        <div class="header-searchbar-area">
                            <a href="javascript:void(0)" class="skip-link-search-start"></a>
                            <?php get_search_form(); ?>
                            <button type="button" id="search-closer" class="close-popup">
                                <?php snappy_the_theme_svg('cross'); ?>
                            </button>
                            <a href="javascript:void(0)" class="skip-link-search-end"></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }

    }

endif;

add_action( 'snappy_before_footer_content_action','snappy_header_toggle_search',10 );


if( !function_exists('snappy_content_offcanvas') ):

    // Offcanvas Contents
    function snappy_content_offcanvas(){ ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">
                <div class="close-offcanvas-menu">
                    <div class="offcanvas-close">
                        <a href="javascript:void(0)" class="skip-link-menu-start"></a>
                        <button type="button" class="button-offcanvas-close">
                            <span class="offcanvas-close-label">
                                <?php echo esc_html__('Close', 'snappy'); ?>
                            </span>
                        </button>
                    </div>
                </div>
                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'snappy'); ?>" role="navigation">
                        <ul class="primary-menu theme-menu">
                            <?php
                            if (has_nav_menu('snappy-primary-menu')) {
                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'snappy-primary-menu',
                                        'show_toggles' => true,
                                    )
                                );
                            }else{

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new Snappy_Walker_Page(),
                                    )
                                );
                            }
                            ?>
                        </ul>
                    </nav><!-- .primary-menu-wrapper -->
                </div>
                <?php if (has_nav_menu('snappy-social-menu')) { ?>
                    <div id="social-nav-offcanvas" class="offcanvas-item offcanvas-social-navigation">
                        <?php wp_nav_menu(array(
                            'theme_location' => 'snappy-social-menu',
                            'link_before' => '<span class="screen-reader-text">',
                            'link_after' => '</span>',
                            'container' => 'div',
                            'container_class' => 'social-menu',
                            'depth' => 1,
                        )); ?>
                    </div>
                <?php } ?>

                <a href="javascript:void(0)" class="skip-link-menu-end"></a>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'snappy_before_footer_content_action','snappy_content_offcanvas',30 );

if( !function_exists('snappy_footer_content_widget') ):

    function snappy_footer_content_widget(){

        $snappy_default = snappy_get_default_theme_options();
        if (is_active_sidebar('snappy-footer-widget-0') ||
            is_active_sidebar('snappy-footer-widget-1') ||
            is_active_sidebar('snappy-footer-widget-2')):
            $x = 1;
            $footer_sidebar = 0;
            do {
                if ($x == 3 && is_active_sidebar('snappy-footer-widget-2')) {
                    $footer_sidebar++;
                }
                if ($x == 2 && is_active_sidebar('snappy-footer-widget-1')) {
                    $footer_sidebar++;
                }
                if ($x == 1 && is_active_sidebar('snappy-footer-widget-0')) {
                    $footer_sidebar++;
                }
                $x++;
            } while ($x <= 3);
            if ($footer_sidebar == 1) {
                $footer_sidebar_class = 12;
            } elseif ($footer_sidebar == 2) {
                $footer_sidebar_class = 6;
            } else {
                $footer_sidebar_class = 4;
            }
            $footer_column_layout = absint(get_theme_mod('footer_column_layout', $snappy_default['footer_column_layout'])); ?>

            <div class="footer-widgetarea">
                <div class="wrapper">
                    <div class="column-row">

                        <?php if (is_active_sidebar('snappy-footer-widget-0')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('snappy-footer-widget-0'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('snappy-footer-widget-1')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('snappy-footer-widget-1'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('snappy-footer-widget-2')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('snappy-footer-widget-2'); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        <?php
        endif;

    }

endif;

add_action( 'snappy_footer_content_action','snappy_footer_content_widget',10 );

if( !function_exists('snappy_footer_content_info') ):

    /**
     * Footer Copyright Area
    **/
    function snappy_footer_content_info(){

        $snappy_default = snappy_get_default_theme_options(); ?>
        <div class="site-info">
            <div class="wrapper">
                <div class="column-row">

                    <div class="column column-10">
                        <div class="footer-credits">

                            <div class="footer-copyright">

                            <?php
            $footer_copyright_text = wp_kses_post( get_theme_mod( 'footer_copyright_text', $snappy_default['footer_copyright_text'] ) );
            echo esc_html__('', '') . '' . ' <a href="' . esc_url(home_url('/')) . '" title="'  . '" ><span>'  . '' . esc_html( $footer_copyright_text );
 
             
                echo '<br>';
                echo esc_html__('', '') . '' . esc_html__('', '') . '<a href="' . esc_url('') . '"  title="' . esc_attr__('', '') . '" target="_blank" rel="author"><span>' . esc_html__('', '') . '</span></a>';
                echo esc_html__('تمامی حقوق برای گروه فرهنگی هنری شیخ بهائی محفوظ است', '') . '<a href="' . esc_url('') . '" title="' . esc_attr__('', '') . '" target="_blank"><span>' . esc_html__('', '') . '</span></a>';
             ?>
 
        </div>
    </div>
</div>

                    <div class="column column-2">
                        <a class="to-the-top" href="#site-header">
                            <span class="to-the-top-long">
                                <?php
                                printf( esc_html__( 'To the top %s', 'snappy' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
                                ?>
                            </span>
                            <span class="to-the-top-short">
                                <?php
                                printf( esc_html__( 'Up %s', 'snappy' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
                                ?>
                            </span>
                        </a>

                    </div>


                </div>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'snappy_footer_content_action','snappy_footer_content_info',20 );

if( !function_exists('snappy_color_schema_color') ):

    function snappy_color_schema_color( $current_color ){

        $snappy_default = snappy_get_default_theme_options();

        $colors_schema = array(

            'default' => array(

                'background_color' => $snappy_default['snappy_background_color'],
                'snappy_primary_color' =>  $snappy_default['snappy_primary_color'],
                'snappy_secondary_color' =>  $snappy_default['snappy_secondary_color'],

            ),

            'dark' => array(

                'background_color' => $snappy_default['snappy_background_color_dark'],
                'snappy_primary_color' =>  $snappy_default['snappy_primary_color_dark'],
                'snappy_secondary_color' =>  $snappy_default['snappy_secondary_color_dark'],

            ),

        );

        if( isset( $colors_schema[$current_color] ) ){

            return $colors_schema[$current_color];

        }

        return;

    }

endif;



if ( ! function_exists( 'snappy_color_schema_color_action' ) ) :
    function snappy_color_schema_color_action() {

        if( isset( $_POST['currentColor'] ) && sanitize_text_field( wp_unslash( $_POST['currentColor'] ) ) ){

            $current_color = sanitize_text_field( wp_unslash( $_POST['currentColor'] ) );

            $color_schemes = snappy_color_schema_color( $current_color );

            if ( $color_schemes ) {
                echo json_encode( $color_schemes );
            }
        }

        wp_die();

    }

endif;

add_action( 'wp_ajax_nopriv_snappy_color_schema_color', 'snappy_color_schema_color_action' );
add_action( 'wp_ajax_snappy_color_schema_color', 'snappy_color_schema_color_action' );

if( !function_exists( 'snappy_fonts_url' ) ) :

    //Google Fonts URL
    function snappy_fonts_url(){

        $fonts_url = '';
        $fonts = array();
        $snappy_font = 'Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900:Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap';

        $snappy_fonts = array();
        $snappy_fonts[] = $snappy_font;
        $snappy_fonts_stylesheet = '//fonts.googleapis.com/css?family=';

        $i = 0;
        for ( $i = 0; $i < count( $snappy_fonts ); $i++ ) {

            if ( 'off' !== sprintf( _x( 'on', '%s font: on or off', 'snappy' ), $snappy_fonts[$i] ) ) {
                $fonts[] = $snappy_fonts[$i];
            }

        }

        if( $fonts ){

            $fonts_url = add_query_arg( array(
                'family' => urldecode( implode( '|', $fonts ) ),
            ), 'https://fonts.googleapis.com/css' );

        }

        return esc_url_raw( $fonts_url );
    }

endif;

if( !function_exists( 'snappy_main_slider' ) ) :

    function snappy_main_slider(){

        $snappy_default = snappy_get_default_theme_options();
        $ed_header_banner = get_theme_mod( 'ed_header_banner', $snappy_default['ed_header_banner'] );
        $snappy_header_banner_cat = get_theme_mod( 'snappy_header_banner_cat' );

        if( $ed_header_banner ){

            $rtl = '';
            if( is_rtl() ){
                $rtl = 'dir="rtl"';
            }

          $banner_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 4,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $snappy_header_banner_cat ) ) );

          if( $banner_query->have_posts() ): ?>

            <section class="theme-section theme-banner-section">
                <div class="main-banner-wrapper">
                    <div class="swiper-container theme-main-slider swiper-container" <?php echo $rtl; ?>>

                        <div class="swiper-wrapper">

                          <?php
                          while( $banner_query->have_posts() ):
                            $banner_query->the_post();
                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); ?>

                            <div class="swiper-slide">
                                <div class="column-row column-row-collapse">
                                    <div class="column column-6 column-sm-12 column-order-2">
                                        <div class="main-banner-image swiper-animate-slider animated">
                                            <div class="data-bg data-bg-large" data-background="<?php echo esc_url( $featured_image[0] ); ?>">
                                                <a href="<?php the_permalink(); ?>" class="theme-responsive-image" tabindex="0"></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="column column-6 column-sm-12 column-order-1">
                                        <div class="main-banner-content">


                                            <div class="post-content ">

                                                <header class="entry-header">
                                                    <h2 class="entry-title entry-title-large">
                                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                           <span class="theme-animate-up">
                                                               <span><?php the_title(); ?></span>
                                                           </span>
                                                        </a>
                                                    </h2>
                                                </header>

                                                <div class="post-content-inner">

                                                <div class="entry-meta">
                                                    <?php
                                                    snappy_posted_by($icon = true, $animation_class = 'theme-animate-up');
                                                    snappy_posted_on($icon = true, $animation_class = 'theme-animate-up');
                                                    ?>
                                                </div>

                                                <p class="theme-animate-up">
                                                    <span><?php
                                                        if (has_excerpt()) {

                                                            the_excerpt();

                                                        } else {

                                                            echo esc_html(wp_trim_words(get_the_content(), 25, '...'));

                                                        } ?>
                                                    </span>
                                                </p>

                                                <div class="theme-animate-up hidden-xs-screen">
                                                    <span>
                                                        <a href="<?php the_permalink(); ?>" rel="bookmark"
                                                           class="btn-fancy">
                                                            <span class="btn-arrow"></span>
                                                            <span class="btn-arrow-text"><?php esc_html_e('Continue Reading', 'snappy'); ?></span>
                                                        </a>
                                                    </span>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          <?php endwhile; ?>

                        </div>

                        <!-- Control -->
                        <div class="theme-swiper-control swiper-control">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                        </div>

                    </div>
                </div>
            </section>

          <?php
          wp_reset_postdata();
          endif;

        }

    }

endif;

if( !function_exists( 'snappy_main_carousel' ) ) :

    function snappy_main_carousel(){

        $snappy_default = snappy_get_default_theme_options();
        $ed_carousel_section = get_theme_mod( 'ed_carousel_section', $snappy_default['ed_carousel_section'] );
        $snappy_carousel_section_title = get_theme_mod( 'snappy_carousel_section_title', $snappy_default['snappy_carousel_section_title'] );
        $snappy_carousel_section_cat = get_theme_mod( 'snappy_carousel_section_cat' );

        if( $ed_carousel_section ){

            $rtl = '';
            if( is_rtl() ){
                $rtl = 'dir="rtl"';
            }

            $banner_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 10,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $snappy_carousel_section_cat ) ) );

            if( $banner_query->have_posts() ): ?>

            <section class="theme-section theme-recommendation-section">
                <div class="theme-recommendation-bg"></div>
                <div class="theme-recommendation-main">
                    <div class="wrapper">
                        <div class="theme-area-header">
                            <div class="theme-area-headlines">
                                <h2 class="theme-area-title"><?php echo esc_html($snappy_carousel_section_title); ?></h2>
                                <div class="theme-animated-line"></div>
                            </div>
                            <div class="theme-carousel-control">
                                <div class="twp-carousel-prev"><?php snappy_the_theme_svg('chevron-left') ?></div>
                                <div class="swiper-pagination"></div>
                                <div class="twp-carousel-next"><?php snappy_the_theme_svg('chevron-right') ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper-fluid">
                        <div class="swiper-container twp-carousel-slider" <?php echo $rtl; ?>>
                            <div class="swiper-wrapper">
                                <?php
                                while ($banner_query->have_posts()):
                                    $banner_query->the_post();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); ?>

                                    <div class="swiper-slide swiper-slide-item">
                                        <article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-carousel-post'); ?>>

                                            <div class="data-bg data-bg-medium" data-background="<?php echo esc_url($featured_image[0]); ?>">
                                                <a href="<?php the_permalink(); ?>" class="theme-responsive-image" tabindex="0"></a>
                                            </div>

                                            <div class="entry-meta">

                                                <?php
                                                snappy_entry_footer($cats = true, $tags = false, $edits = false);
                                                ?>

                                            </div>

                                            <h2 class="entry-title entry-title-medium">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h2>

                                            <div class="entry-meta">

                                                <?php
                                                snappy_posted_by();
                                                snappy_posted_on();
                                                ?>

                                            </div>


                                        </article>

                                    </div>


                                <?php endwhile; ?>

                            </div>
                        </div>

                    </div>
                </div>
            </section>

          <?php
          wp_reset_postdata();
          endif;

        }

    }

endif;

if( !function_exists('snappy_404_posts') ):

    function snappy_404_posts(){

        $lead_post_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 3,'post__not_in' => get_option("sticky_posts") ) );

        if( $lead_post_query ->have_posts() ): ?>
                <div class="wrapper">
                    <div class="column-row column-row-small">

                        <div class="column column-12 column-sm-12 column-order-2">
                            <div class="column-row column-row-small">

                                <?php
                                while( $lead_post_query->have_posts() ){
                                    $lead_post_query->the_post();

                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); ?>

                                    <div class="column column-4 mb-xs-15 column-xs-12">
                                        <div class="content-main content-main-bg">
                                            <div class="content-list">
                                                <article
                                                        id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article'); ?>>

                                                    <?php if ( isset( $featured_image[0] ) && $featured_image[0]) { ?>
                                                        <div class="post-thumbnail">
                                                            <div class="img-hover-scale">

                                                                <a href="<?php the_permalink(); ?>" tabindex="0">
                                                                    <img title="<?php the_title_attribute(); ?>"
                                                                         alt="<?php the_title_attribute(); ?>"
                                                                         src="<?php echo esc_url($featured_image[0]); ?>">
                                                                </a>

                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <div class="article-content">

                                                        <div class="entry-meta">
                                                            <?php snappy_entry_footer( $cats = true, $tags = false, $edits = false ); ?>
                                                        </div>

                                                        <h3 class="entry-title entry-title-small">
                                                            <a href="<?php the_permalink(); ?>"
                                                               rel="bookmark"><?php the_title(); ?></a>
                                                        </h3>

                                                        <div class="entry-meta">
                                                            <?php snappy_posted_on(); ?>
                                                        </div>

                                                        <div class="entry-content entry-content-muted entry-content-small">

                                                            <?php
                                                            if( has_excerpt() ){

                                                                the_excerpt();

                                                            }else{

                                                                echo esc_html(wp_trim_words(get_the_content(), 20, '...'));

                                                            } ?>

                                                        </div>
                                                    </div>

                                                </article>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>

                            </div>
                        </div>

                    </div>
                </div>
        <?php
        wp_reset_postdata();
        endif;

    }

endif;

if( !function_exists('snappy_related_posts') ):

    // Single Posts Related Posts.
    function snappy_related_posts(){

        $snappy_default = snappy_get_default_theme_options();
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;

        if( is_single() && 'post' === get_post_type() ){

            $cats = get_the_category( $post->ID );
            $category = array();
            if( $cats ){
                foreach( $cats as $cat ){
                    $category[] = $cat->term_id; 
                }
            }

            $related_posts_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 6, 'post__not_in' => array( $post->ID ), 'category__in' => $category ) );
            $ed_related_post = absint( get_theme_mod( 'ed_related_post',$snappy_default['ed_related_post'] ) );

            if( $ed_related_post && $related_posts_query->have_posts() ): ?>

                <section class="theme-section theme-related-section">

                    <?php $related_post_title = esc_html( get_theme_mod( 'related_post_title',$snappy_default['related_post_title'] ) ); 
                    if( $related_post_title ){ ?>

                        <div class="theme-area-header">
                            <div class="theme-area-headlines">
                                <h2 class="theme-area-title">  <?php echo esc_html( $related_post_title ); ?></h2>
                                <div class="theme-animated-line"></div>
                            </div>
                        </div>
                        
                    <?php } ?>

                    <div class="related-posts">

                        <?php
                        while( $related_posts_query->have_posts() ):
                            $related_posts_query->the_post();

                            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'medium_large' ); ?>


                            <article id="post-<?php the_ID(); ?>" <?php post_class('related-post-item theme-article-post theme-article-animate'); ?>>
                                <div class="column-row">

                                <?php
                                if( isset( $featured_image[0] ) && has_post_thumbnail() ): ?>
                                    <div class="column column-5 column-sm-12">
                                        <div class="post-thumbnail">

                                            <div class="data-bg data-bg-small" data-background="<?php echo esc_url( $featured_image[0] ); ?>">
                                                <a href="<?php the_permalink(); ?>" class="theme-responsive-image" tabindex="0"></a>
                                            </div>

                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="column column-7 column-sm-12">
                                    <div class="post-content">

                                        <header class="entry-header">
                                            <h3 class="entry-title entry-title-medium">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                        </header>

                                        <div class="entry-meta">

                                            <?php
                                            snappy_posted_by();
                                            snappy_posted_on();
                                            ?>

                                        </div>

                                        <div class="entry-content entry-content-muted entry-content-small">

                                            <?php
                                            if( has_excerpt() ){

                                                the_excerpt();

                                            }else{

                                                echo esc_html(wp_trim_words(get_the_content(), 20, '...'));

                                            } ?>

                                        </div>

                                    </div>
                                </div>

                            </div>
                            </article>

                        <?php endwhile; ?>

                    </div>

                </section>

            <?php
            wp_reset_postdata();
            endif;

        }

    }

endif;
add_action( 'snappy_navigation_action','snappy_related_posts',20 );