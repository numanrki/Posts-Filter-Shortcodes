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
    $css_file_path = plugin_dir_url( __FILE__ ) . '/psf-includes/psf-main.css';

    // Enqueue the CSS file
    wp_enqueue_style( 'psf-main-css', $css_file_path );
}
add_action( 'wp_enqueue_scripts', 'psf_enqueue_custom_css' );

include_once( plugin_dir_path( __FILE__ ) . 'psf-core/psf-updated-gif.php' );
include_once( plugin_dir_path( __FILE__ ) . 'psf-core/psf-updated-nogif.php' );


//PSF Trending Posts Show
// Shortcode callback function
add_shortcode('psf-trending', 'psf_trending_posts');
function psf_trending_posts($atts) {
    // Extract attributes from the shortcode
    $atts = shortcode_atts(array(
        'show' => '',    // Comma-separated category slugs
        'hide' => '',    // Comma-separated category slugs to hide
        'posts' => 5,    // Number of posts to display
    ), $atts);

    // Get the trending posts based on the shortcode attributes
    $trending_posts = psf_get_trending_posts($atts['show'], $atts['hide'], $atts['posts']);

    // Start building the output
    $output = '<ul class="psf-trending-posts">';

    foreach ($trending_posts as $post) {
        $output .= '<li><a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></li>';
    }

    $output .= '</ul>';

    return $output;
}
function psf_get_trending_posts($show_categories, $hide_categories, $posts) {
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $posts,
        'meta_key' => 'post_views_count', // Replace 'post_views_count' with your post view count meta key
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
    );

    // If 'show' attribute is provided and not 'all', include specified categories
    if ($show_categories && $show_categories !== 'all') {
        $args['category_name'] = $show_categories;
    }

    // If 'hide' attribute is provided, exclude specified categories
    if ($hide_categories) {
        $args['category__not_in'] = explode(',', $hide_categories);
    }

    $trending_query = new WP_Query($args);
    return $trending_query->posts;
}
