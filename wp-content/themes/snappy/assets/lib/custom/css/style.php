<?php
/**
 * Snappy Dynamic Styles
 *
 * @package Snappy
 */

function snappy_dynamic_css()
{

    $snappy_default = snappy_get_default_theme_options();

    $snappy_color_schema = get_theme_mod('snappy_color_schema', $snappy_default['snappy_color_schema']);

    if ($snappy_color_schema == 'dark') {

        $snappy_primary_color = $snappy_default['snappy_primary_color_dark'];
        $snappy_secondary_color = $snappy_default['snappy_secondary_color_dark'];
        $snappy_tertiary_color = $snappy_default['dark_tertiary_color'];

    } else {

        $snappy_primary_color = $snappy_default['snappy_primary_color'];
        $snappy_secondary_color = $snappy_default['snappy_secondary_color'];
        $snappy_tertiary_color = $snappy_default['default_tertiary_color'];


    }

    $background_color = get_theme_mod('background_color', $snappy_default['snappy_background_color']);
    $background_color = '#' . str_replace("#", "", $background_color);


    echo "<style type='text/css' media='all'>"; ?>


    body{
    background-color: <?php echo esc_attr($background_color); ?>;
    }

    .entry-meta-top .entry-meta-categories a{
    color: <?php echo esc_attr($background_color); ?>;
    }

    body, button, input, select, optgroup, textarea{
    color: <?php echo esc_attr($snappy_primary_color); ?>;
    }

    .entry-meta-top .entry-meta-categories a{
    background-color: <?php echo esc_attr($snappy_primary_color); ?>;
    }

    a{
    color: <?php echo esc_attr($snappy_secondary_color); ?>;
    }

    a:hover,
    a:focus{
    color: <?php echo esc_attr($snappy_tertiary_color); ?>;
    }

    .entry-meta-top .entry-meta-categories a:hover,
    .entry-meta-top .entry-meta-categories a:focus{
    background-color: <?php echo esc_attr($snappy_tertiary_color); ?>;
    }

    <?php echo "</style>";
}

add_action('wp_head', 'snappy_dynamic_css', 100);