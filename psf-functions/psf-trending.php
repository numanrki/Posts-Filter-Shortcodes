<?php
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
