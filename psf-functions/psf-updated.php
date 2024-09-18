<?php

function psf_last_updated_posts_shortcode($atts) {
    $atts = shortcode_atts([
        'show' => '',
        'hide' => '',
        'posts' => -1,
        'bg-color' => '#00ff00',
        'txt-color' => '#ffffff',
        'font-size' => '12',
        'width' => '30',  // Default width of the ticker
        'height' => '15', // Default height of the ticker
        'ticker-pos' => 'after'  // Default position after the link
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
            // Generate ticker with custom dimensions
            $ticker_html = '<span style="' . esc_attr(psf_generate_custom_css($atts['bg-color'], $atts['txt-color'], $atts['font-size'], $atts['width'], $atts['height'])) . '">New</span>';
            $post_link = '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';

            switch ($atts['ticker-pos']) {
                case 'after':
                    echo "<div>{$post_link} {$ticker_html}</div>";
                    break;
                case 'top-right':
                    echo "<div style='position: relative;'>{$post_link}<span style='position: absolute; top: 0; right: 0;'>{$ticker_html}</span></div>";
                    break;
                case 'bottom-right':
                    echo "<div style='position: relative;'>{$post_link}<span style='position: absolute; bottom: 0; right: 0;'>{$ticker_html}</span></div>";
                    break;
                default:
                    echo "<div>{$post_link} {$ticker_html}</div>";  // Fallback to default
            }
        }
    } else {
        echo '<div>No updated posts found.</div>';
    }
    echo '</div>';
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('psf-updated', 'psf_last_updated_posts_shortcode');
