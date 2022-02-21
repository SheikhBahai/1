<?php
/**
 * Header file for the Snappy WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Snappy
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
if( function_exists('wp_body_open') ){
    wp_body_open();
}
$snappy_default = snappy_get_default_theme_options();
$ed_preloader = get_theme_mod( 'ed_preloader', $snappy_default['ed_preloader'] );
$ed_cursor_option = get_theme_mod( 'ed_cursor_option', $snappy_default['ed_cursor_option'] ); ?>

<?php if( $ed_preloader ){ ?>

    <div class="preloader hide-no-js">
        <div class="preloader-wrapper">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

<?php } ?>
<?php if ($ed_cursor_option) { ?>
    <div class="theme-custom-cursor theme-cursor-primary"></div>
    <div class="theme-custom-cursor theme-cursor-secondary"></div>
<?php }?>


<div id="snappy-page" class="snappy-hfeed snappy-site">
<a class="skip-link screen-reader-text" href="#site-content"><?php esc_html_e('Skip to the content', 'snappy'); ?></a>

<?php
$snappy_header_layout = get_theme_mod( 'snappy_header_layout', $snappy_default['snappy_header_layout'] );
get_template_part( 'template-parts/header/header', $snappy_header_layout );

if( !is_paged() && ( is_home() || is_front_page() ) ){ snappy_main_slider(); } ?>

<div id="content" class="site-content">
