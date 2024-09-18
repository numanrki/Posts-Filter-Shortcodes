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

// Enqueue the custom CSS file
function psf_enqueue_custom_css() {
    $css_file_path = plugin_dir_url(__FILE__) . '/psf-includes/psf-main.css';
    wp_enqueue_style('psf-main-css', $css_file_path);
}
add_action('wp_enqueue_scripts', 'psf_enqueue_custom_css');

// Helper function to generate custom inline CSS for the shortcodes
function psf_generate_custom_css($bg_color, $txt_color, $font_size) {
    return "background-color: {$bg_color}; color: {$txt_color}; padding: 2px 8px; font-weight: bold; font-size: {$font_size}px; border-radius: 3px; display: inline-block; animation: blink 1s infinite;";
}

// Include the shortcodes from the psf-functions folder
include_once plugin_dir_path(__FILE__) . 'psf-functions/psf-trending.php';
include_once plugin_dir_path(__FILE__) . 'psf-functions/psf-updated.php';
include_once plugin_dir_path(__FILE__) . 'psf-functions/psf-ticker-hot.php';
include_once plugin_dir_path(__FILE__) . 'psf-functions/psf-ticker-new.php';
