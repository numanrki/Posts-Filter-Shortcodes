<?php
/*
 * Plugin Name: Posts Filter Shortcodes
 * Plugin URI: https://wordpress.org/plugins/Posts-Filter-Shortcodes/
 * Description: Post Filters Shortcodes is a powerful WordPress plugin that allows effortless post filtering through user-friendly shortcodes.
 * Version: 1.0
 * Requires at least: 4.7
 * Tested up to: 6.2
 * Author: Numan Rasheed 
 * Author URI: https://www.numanrki.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 */

 if ( ! defined( 'WPINC' ) ) {
    die;
  }

  define( 'Posts_Filter_Shortcodes', '1.0' );

// Enqueue the custom CSS file
function psf_enqueue_custom_css() {
    // Get the path to the CSS file
    $css_file_path = plugin_dir_url( __FILE__ ) . 'psf-includes/psf-main.css';

    // Enqueue the CSS file
    wp_enqueue_style( 'psf-main-css', $css_file_path );
}
add_action( 'wp_enqueue_scripts', 'psf_enqueue_custom_css' );


//Last updated Posts Filters
function psf_last_updated_posts_shortcode($atts) {
    $atts = shortcode_atts( array(
        'show' => '',
        'hide' => '',
        'num_posts' => -1, // Default to show all posts
    ), $atts );

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $atts['num_posts'],
        'orderby' => 'modified',
        'order' => 'DESC',
    );

    // Include specific categories
    if ( ! empty( $atts['show'] ) && $atts['show'] !== 'all' ) {
        $category_slugs = explode( ',', $atts['show'] );
        $category_ids = array_map( 'get_category_by_slug', $category_slugs );
        $args['category__in'] = wp_list_pluck( $category_ids, 'term_id' );
    }

    // Exclude specific categories
    if ( ! empty( $atts['hide'] ) ) {
        $category_slugs = explode( ',', $atts['hide'] );
        $category_ids = array_map( 'get_category_by_slug', $category_slugs );
        $args['category__not_in'] = wp_list_pluck( $category_ids, 'term_id' );
    }

    $last_updated_posts = new WP_Query($args);

    if ($last_updated_posts->have_posts()) {
        $output = '<ul class="psf-last-updated-posts">'; // Add the custom class here

        while ($last_updated_posts->have_posts()) {
            $last_updated_posts->the_post();
            $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }

        $output .= '</ul>';

        wp_reset_postdata();

        return $output;
    }
}

add_shortcode('psf-updated', 'psf_last_updated_posts_shortcode');

//PSF Trending Posts Show
function psf_trending_posts_shortcode($atts) {
    $atts = shortcode_atts( array(
        'show' => '',
        'posts' => 5,
    ), $atts );

    // Query arguments to get trending posts from the specified category
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => intval($atts['posts']), // Convert to integer for safety
        'orderby' => 'meta_value_num', // You can use 'meta_value' if you have a custom field storing the trending metric
        'meta_key' => 'post_views', // Change 'post_views' to the actual meta key used for trending metric
        'order' => 'DESC',
    );

    // Include specific category
    if (!empty($atts['show']) && $atts['show'] !== 'all') {
        $category = get_category_by_slug($atts['show']);
        if ($category) {
            $args['category__in'] = array($category->term_id);
        }
    }

    // Query the trending posts
    $trending_posts = new WP_Query($args);

    // Display the list of trending posts
    if ($trending_posts->have_posts()) {
        $output = '<ul class="psf-trending-posts">'; // Add the custom class here

        while ($trending_posts->have_posts()) {
            $trending_posts->the_post();
            $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }

        $output .= '</ul>';

        wp_reset_postdata();

        return $output;
    }
}

add_shortcode('psf-trending', 'psf_trending_posts_shortcode');
