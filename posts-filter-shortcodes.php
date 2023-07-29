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
include_once( plugin_dir_path( __FILE__ ) . 'psf-core/psf-trending-gif.php' );
include_once( plugin_dir_path( __FILE__ ) . 'psf-core/psf-trending-nogif.php' );



