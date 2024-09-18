<?php
function psf_new_ticker_shortcode($atts) {
    $atts = shortcode_atts([
        'bg-color' => '#00ff00',  // Default background color (green)
        'txt-color' => '#ffffff', // Default text color (white)
        'font-size' => '12',      // Default font size
        'width' => '60',          // Default width
        'height' => '20',         // Default height
    ], $atts, 'psf-new-ticker');

    $style = "background-color: {$atts['bg-color']}; color: {$atts['txt-color']}; font-size: {$atts['font-size']}px; width: {$atts['width']}px; height: {$atts['height']}px; display: inline-block; text-align: center; line-height: {$atts['height']}px; font-weight: bold; border-radius: 3px; animation: blink 1s infinite;";
    
    return "<div style='" . esc_attr($style) . "'>New</div>";
}
add_shortcode('psf-new-ticker', 'psf_new_ticker_shortcode');
