<?php
function psf_last_updated_posts_shortcode($atts) {
    $atts = shortcode_atts([
        'show' => '',
        'hide' => '',
        'posts' => -1,
        'bg-color' => '#00ff00',
        'txt-color' => '#ffffff',
        'font-size' => '12'
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
            echo '<div><a href="' . get_permalink() . '">' . get_the_title() . '<span style="' . esc_attr(psf_generate_custom_css($atts['bg-color'], $atts['txt-color'], $atts['font-size'])) . '">New</span></a></div>';
        }
    } else {
        echo '<div>No updated posts found.</div>';
    }
    echo '</div>';
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('psf-updated', 'psf_last_updated_posts_shortcode');
