<?php
/**
 * Header Layout 1
 *
 * @package Snappy
 */
$snappy_default = snappy_get_default_theme_options();
?>

<header id="site-header" class="site-header-layout header-layout-1" role="banner">
    <div class="header-navbar">
        <div class="wrapper header-wrapper">

            <div class="navbar-item navbar-item-left">
                <div class="header-titles">
                    <?php
                    snappy_site_logo();
                    snappy_site_description();
                    ?>
                </div>
            </div>

            <?php
            $header_ad_image = get_theme_mod('header_ad_image');
            $header_ad_image_link = get_theme_mod('header_ad_image_link');

            if( $header_ad_image ){ ?>

                <div class="navbar-item navbar-item-right">
                    <a href="<?php echo esc_url( $header_ad_image_link ); ?>">
                        <img src="<?php echo esc_url( $header_ad_image ); ?>" alt="<?php esc_attr_e('Header Image','snappy'); ?>" title="<?php esc_attr_e('Header Image','snappy'); ?>">
                    </a>
                </div>

            <?php } ?>

        </div>
    </div>

    <?php
    $ed_header_responsive_menu = get_theme_mod('ed_header_responsive_menu', $snappy_default['ed_header_responsive_menu']);
    ?>
    <div class="site-navigation <?php if ($ed_header_responsive_menu) {
        echo 'show-hamburger-menu';
    } ?>">
        <div class="wrapper header-wrapper">
            <div class="navbar-item navbar-item-left">
                <div class="main-nav-controls twp-hide-js">

                    <button type="button" class="navbar-control navbar-control-offcanvas">
                         <span class="navbar-control-trigger" tabindex="-1">
                            <?php snappy_the_theme_svg('menu'); ?>
                         </span>
                    </button>

                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'snappy'); ?>" role="navigation">
                        <ul class="primary-menu theme-menu">

                            <?php
                            if( has_nav_menu('snappy-primary-menu') ){

                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'snappy-primary-menu',
                                        'walker' => new snappy\Snappy_Walkernav(),
                                    )
                                );

                            }else{

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                        'walker' => new Snappy_Walker_Page(),
                                    )
                                );

                            } ?>

                        </ul>
                    </nav>
                </div>
            </div>
            <div class="navbar-item navbar-item-right">
                <div class="navbar-controls twp-hide-js">

                    <?php
                    $ed_day_night_mode_switch = get_theme_mod( 'ed_day_night_mode_switch', $snappy_default['ed_day_night_mode_switch'] );
                    if( $ed_day_night_mode_switch ){ ?>

                        <button type="button" class="navbar-control navbar-day-night navbar-day-on">
                            <span class="navbar-control-trigger day-night-toggle-icon" tabindex="-1">
                                <span class="moon-toggle-icon">
                                    <i class="moon-icon">
                                        <?php snappy_the_theme_svg('moon'); ?>
                                    </i>
                                </span>

                                <span class="sun-toggle-icon">
                                    <i class="sun-icon">
                                        <?php snappy_the_theme_svg('sun'); ?>
                                    </i>
                                </span>
                            </span>
                        </button>

                    <?php } ?>


                    <?php
                    $ed_header_search = get_theme_mod( 'ed_header_search', $snappy_default['ed_header_search'] );
                    if( $ed_header_search ){ ?>

                        <button type="button" class="navbar-control navbar-control-search">
                            <span class="navbar-control-trigger" tabindex="-1">
                                <?php snappy_the_theme_svg('search'); ?>
                            </span>
                        </button>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

</header>