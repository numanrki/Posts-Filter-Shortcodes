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

//Last updated Posts Filters
function psf_last_updated_posts_shortcode($psf_atts) {
    $psf_atts = shortcode_atts( array(
        'psf_show_categories' => '',
        'psf_hide_categories' => '',
        'psf_num_posts_to_show' => -1, // Default to show all posts
    ), $psf_atts );

    $psf_query_args = array(
        'post_type' => 'post',
        'posts_per_page' => $psf_atts['psf_num_posts_to_show'],
        'orderby' => 'modified',
        'order' => 'DESC',
    );

    // Include specific categories
    if ( ! empty( $psf_atts['psf_show_categories'] ) && $psf_atts['psf_show_categories'] !== 'all' ) {
        $psf_category_slugs = explode( ',', $psf_atts['psf_show_categories'] );
        $psf_category_ids = array_map( 'get_category_by_slug', $psf_category_slugs );
        $psf_query_args['category__in'] = wp_list_pluck( $psf_category_ids, 'term_id' );
    }

    // Exclude specific categories
    if ( ! empty( $psf_atts['psf_hide_categories'] ) ) {
        $psf_category_slugs = explode( ',', $psf_atts['psf_hide_categories'] );
        $psf_category_ids = array_map( 'get_category_by_slug', $psf_category_slugs );
        $psf_query_args['category__not_in'] = wp_list_pluck( $psf_category_ids, 'term_id' );
    }

    $psf_last_updated_posts_query = new WP_Query($psf_query_args);

    if ($psf_last_updated_posts_query->have_posts()) {
        $psf_output = '<ul class="psf-last-updated-posts">'; // Add the custom class here

        while ($psf_last_updated_posts_query->have_posts()) {
            $psf_last_updated_posts_query->the_post();
            $psf_output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }

        $psf_output .= '</ul>';

        wp_reset_postdata();

        return $psf_output;
    }
}

add_shortcode('psf-updated', 'psf_last_updated_posts_shortcode');
