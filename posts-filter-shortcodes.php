<?php
/*
 * Plugin Name: Posts Filter Shortcodes
 * Plugin URI: https://wordpress.org/plugins/Posts-Filter-Shortcodes/
 * Description: Post Filters Shortcodes is a powerful WordPress plugin that allows effortless post filtering through user-friendly shortcodes.
 * Version: 1.1
 * Requires at least: 5.0
 * Tested up to: 6.6
 * Author: Numan Rasheed
 * Author URI: https://www.numanrki.com
 * License: GPL3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if (!defined('WPINC')) {
    die;
}

define('Posts_Filter_Shortcodes', '1.1');

function psf_enqueue_custom_css() {
    $css_file_path = plugin_dir_url(__FILE__) . '/psf-includes/psf-main.css';
    wp_enqueue_style('psf-main-css', $css_file_path);
}
add_action('wp_enqueue_scripts', 'psf_enqueue_custom_css');

function psf_generate_custom_css($bg_color, $txt_color, $font_size) {
    return "background-color: {$bg_color}; color: {$txt_color}; padding: 2px 8px; font-weight: bold; font-size: {$font_size}px; border-radius: 3px; display: inline-block; animation: blink 1s infinite;";
}

function psf_trending_shortcode($atts) {
    $atts = shortcode_atts([
        'show' => '',
        'posts' => '5',
        'hide' => '',
        'bg-color' => '#ff0000',
        'txt-color' => '#ffffff',
        'font-size' => '12'
    ], $atts, 'psf-trending');

    $args = [
        'post_type' => 'post',
        'posts_per_page' => intval($atts['posts']),
        'orderby' => 'comment_count',
        'order' => 'desc',
    ];

    if (!empty($atts['show'])) {
        $args['category_name'] = $atts['show'];
    }

    $query = new WP_Query($args);
    ob_start();
    echo '<div class="psf-trending-posts">';
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo '<div><a href="' . get_permalink() . '">' . get_the_title() . '<span style="' . esc_attr(psf_generate_custom_css($atts['bg-color'], $atts['txt-color'], $atts['font-size'])) . '">Hot</span></a></div>';
        }
    } else {
        echo '<div>No trending posts found.</div>';
    }
    echo '</div>';
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('psf-trending', 'psf_trending_shortcode');

function psf_last_updated_posts_shortcode($atts) {
    $atts = shortcode_atts([
        'show' => '',
        'hide' => '',
        'posts' => -1,
        'bg-color' => '#00ff00',
        'txt-color' => '#ffffff',
        'font-size' => '12'
    ], $atts, 'psf-updated');

    $args = [
        'post_type' => 'post',
        'posts_per_page' => $atts['posts'],
        'orderby' => 'modified',
        'order' => 'DESC'
    ];

    if (!empty($atts['show'])) {
        $args['category_name'] = $atts['show'];
    }

    $query = new WP_Query($args);
    ob_start();
    echo '<div class="psf-last-updated-posts">';
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo '<div><a href="' . get_permalink() . '">' . get_the_title() . '<span style="' . esc_attr(psf_generate_custom_css($atts['bg-color'], $atts['txt-color'], $atts['font-size'])) . '">New</span></a></div>';
        }
    } else {
        echo '<div>No updated posts found.</div>';
    }
    echo '</div>';
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('psf-updated', 'psf_last_updated_posts_shortcode');
