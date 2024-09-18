<?php
/*
 * Plugin Name: Posts Filter Shortcodes
 * Plugin URI: https://wordpress.org/plugins/Posts-Filter-Shortcodes/
 * Description: Post Filters Shortcodes is a powerful WordPress plugin that allows effortless post filtering through user-friendly shortcodes.
 * Version: 1.0
 * Requires at least: 4.7
 * Tested up to: 6.6
 * Author: Numan Rasheed 
 * Author URI: https://www.numanrki.com
 * License: GPL3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
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


function psf_trending_nogif_shortcode($atts) {
    $atts = shortcode_atts(array(
        'show' => '',   // Comma-separated list of categories to show trending posts from
        'posts' => '5', // Number of posts to display
        'hide' => ''    // Comma-separated list of categories to hide posts from
    ), $atts);

    // Get the category names from shortcode attributes
    $show_categories = explode(',', $atts['show']);
    $hide_categories = explode(',', $atts['hide']);

    // Query arguments for trending posts
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => intval($atts['posts']),
        'orderby' => 'comment_count', // You can use a different metric for trending posts if you prefer
        'order' => 'desc',
    );

    // If 'show' attribute is provided and is not equal to 'all'
    if ($atts['show'] !== 'all' && !empty($show_categories)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $show_categories,
        );
    }

    // If 'hide' attribute is provided
    if (!empty($hide_categories)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $hide_categories,
            'operator' => 'NOT IN',
        );
    }

    // Run the query to get trending posts
    $trending_posts = new WP_Query($args);

    // Output the list of trending posts
    ob_start();
    if ($trending_posts->have_posts()) {
        echo '<ul class="psf-trending-posts">';
        while ($trending_posts->have_posts()) {
            $trending_posts->the_post();
            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo 'No trending posts found.';
    }
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('psf-trending-nogif', 'psf_trending_nogif_shortcode');



// PSF Show Trending Posts with GIF
function psf_trending_shortcode($atts) {
    $atts = shortcode_atts(array(
        'show' => '',    // Comma-separated list of categories to show trending posts from
        'posts' => '5',  // Number of posts to display
        'hide' => '' // Comma-separated list of categories to hide posts from
    ), $atts);

    // Get the category names from shortcode attributes
    $show_categories = explode(',', $atts['show']);
    $hide_from_categories = explode(',', $atts['hide']);

    // Query arguments for trending posts
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => intval($atts['posts']),
        'orderby' => 'comment_count', // You can use a different metric for trending posts if you prefer
        'order' => 'desc',
    );

    // If 'show' attribute is provided and is not equal to 'all'
    if ($atts['show'] !== 'all' && !empty($show_categories)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $show_categories,
        );
    }

    // If 'hide_from' attribute is provided
    if (!empty($hide_from_categories)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $hide_from_categories,
            'operator' => 'NOT IN',
        );
    }

    // Run the query to get trending posts
    $trending_posts = new WP_Query($args);

    // Get the URL of the blinking GIF from the plugin directory
    $plugin_directory_url = plugin_dir_url(__FILE__);
    $blinking_gif_url = $plugin_directory_url . './assets/gifs/hot.gif';

    // Output the list of trending posts with blinking GIF and HTML class
    ob_start();
    if ($trending_posts->have_posts()) {
        echo '<ul class="psf-trending-posts">';
        while ($trending_posts->have_posts()) {
            $trending_posts->the_post();
            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '<img src="' . esc_url($blinking_gif_url) . '" alt="Hot Gif" class="psf-blinking-gif" width="32" height="32"></a> </li>';
        }
        echo '</ul>';
    } else {
        echo 'No trending posts found.';
    }
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('psf-trending', 'psf_trending_shortcode');



// Last updated Posts Filters With GIF
function psf_last_updated_posts_shortcode($atts) {
  $atts = shortcode_atts( array(
      'show' => '',
      'hide' => '',
      'posts' => -1, // Default to show all posts
  ), $atts );

  $args = array(
      'post_type' => 'post',
      'posts_per_page' => $atts['posts'],
      'orderby' => 'modified',
      'order' => 'DESC',
  );

  // Include specific categories
  if (!empty($atts['show']) && $atts['show'] !== 'all') {
      $category_slugs = explode(',', $atts['show']);
      $category_ids = array_map('get_category_by_slug', $category_slugs);
      $args['category__in'] = wp_list_pluck($category_ids, 'term_id');
  }

  // Exclude specific categories
  if (!empty($atts['hide'])) {
      $category_slugs = explode(',', $atts['hide']);
      $category_ids = array_map('get_category_by_slug', $category_slugs);
      $args['category__not_in'] = wp_list_pluck($category_ids, 'term_id');
  }

  $last_updated_posts = new WP_Query($args);

  if ($last_updated_posts->have_posts()) {
      $output = '<ul class="psf-last-updated-posts">';

      while ($last_updated_posts->have_posts()) {
          $last_updated_posts->the_post();
          $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '<img src="' . plugin_dir_url(__FILE__) . './assets/gifs/new.gif" alt="New" class="psf-new-gif" width="32" height="32" /></a></li>';
      }

      $output .= '</ul>';

      wp_reset_postdata();

      return $output;
  }
}

add_shortcode('psf-updated', 'psf_last_updated_posts_shortcode');

//Last updated Posts Filters Without GIF
function psf_last_updated_posts_shortcode_nogif($atts) {
  $atts = shortcode_atts( array(
      'show' => '',
      'hide' => '',
      'posts' => -1, // Default to show all posts
  ), $atts );

  $args = array(
      'post_type' => 'post',
      'posts_per_page' => $atts['posts'],
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

add_shortcode('psf-updated-nogif', 'psf_last_updated_posts_shortcode_nogif');