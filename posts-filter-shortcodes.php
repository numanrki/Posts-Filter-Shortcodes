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

 if ( ! defined( 'WPINC' ) ) {
    die;
 }

define( 'Posts_Filter_Shortcodes', '1.1' );

// Enqueue the custom CSS file
function psf_enqueue_custom_css() {
    // Get the path to the CSS file
    $css_file_path = plugin_dir_url( __FILE__ ) . '/psf-includes/psf-main.css';

    // Enqueue the CSS file
    wp_enqueue_style( 'psf-main-css', $css_file_path );
}
add_action( 'wp_enqueue_scripts', 'psf_enqueue_custom_css' );

// Helper function to generate custom inline CSS
function psf_generate_custom_css($bg_color, $txt_color) {
    return "
        background-color: {$bg_color}; 
        color: {$txt_color}; 
        padding: 2px 8px; 
        font-weight: bold; 
        font-size: 12px; 
        border-radius: 3px;
        display: inline-block;
        animation: blink 1s infinite;
    ";
}

// Shortcode for Trending Posts with CSS Ticker (Hot)
function psf_trending_shortcode($atts) {
    $atts = shortcode_atts(array(
        'show' => '',    // Comma-separated list of categories to show trending posts from
        'posts' => '5',  // Number of posts to display
        'hide' => '',    // Comma-separated list of categories to hide posts from
        'bg-color' => '#ff0000', // Default background color for ticker
        'txt-color' => '#ffffff' // Default text color for ticker
    ), $atts);

    // Get the category names from shortcode attributes
    $show_categories = explode(',', $atts['show']);
    $hide_from_categories = explode(',', $atts['hide']);

    // Query arguments for trending posts
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => intval($atts['posts']),
        'orderby' => 'comment_count', // Trending by comments
        'order' => 'desc',
    );

    if ($atts['show'] !== 'all' && !empty($show_categories)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $show_categories,
        );
    }

    if (!empty($hide_from_categories)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $hide_from_categories,
            'operator' => 'NOT IN',
        );
    }

    $trending_posts = new WP_Query($args);

    // Generate custom CSS for ticker
    $custom_css = psf_generate_custom_css($atts['bg-color'], $atts['txt-color']);

    // Output the list of trending posts with ticker
    ob_start();
    if ($trending_posts->have_posts()) {
        echo '<ul class="psf-trending-posts">';
        while ($trending_posts->have_posts()) {
            $trending_posts->the_post();
            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . 
                 '<span style="' . esc_attr($custom_css) . '">Hot</span></a></li>';
        }
        echo '</ul>';
    } else {
        echo 'No trending posts found.';
    }
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('psf-trending', 'psf_trending_shortcode');

// Last Updated Posts with CSS Ticker (New)
function psf_last_updated_posts_shortcode($atts) {
    $atts = shortcode_atts( array(
        'show' => '',
        'hide' => '',
        'posts' => -1, // Show all by default
        'bg-color' => '#00ff00', // Default background color for ticker
        'txt-color' => '#ffffff' // Default text color for ticker
    ), $atts );

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $atts['posts'],
        'orderby' => 'modified',
        'order' => 'DESC',
    );

    if (!empty($atts['show']) && $atts['show'] !== 'all') {
        $category_slugs = explode(',', $atts['show']);
        $category_ids = array_map('get_category_by_slug', $category_slugs);
        $args['category__in'] = wp_list_pluck($category_ids, 'term_id');
    }

    if (!empty($atts['hide'])) {
        $category_slugs = explode(',', $atts['hide']);
        $category_ids = array_map('get_category_by_slug', $category_slugs);
        $args['category__not_in'] = wp_list_pluck($category_ids, 'term_id');
    }

    $last_updated_posts = new WP_Query($args);

    // Generate custom CSS for ticker
    $custom_css = psf_generate_custom_css($atts['bg-color'], $atts['txt-color']);

    ob_start();
    if ($last_updated_posts->have_posts()) {
        echo '<ul class="psf-last-updated-posts">';
        while ($last_updated_posts->have_posts()) {
            $last_updated_posts->the_post();
            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . 
                 '<span style="' . esc_attr($custom_css) . '">New</span></a></li>';
        }
        echo '</ul>';
    } else {
        echo 'No updated posts found.';
    }
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('psf-updated', 'psf_last_updated_posts_shortcode');
