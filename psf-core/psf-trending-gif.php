<?php
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
        // Add the image path for the new.gif directly in the image tag
       

        $output .= '<li><a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '<img src="' . plugin_dir_url(__FILE__) . '../assets/gifs/hot.gif" alt="Hot" class="psf-new-gif" width="32" height="32" /></a></li>';
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
