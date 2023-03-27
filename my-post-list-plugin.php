<?php

/**
 * Plugin Name:  My Post List By Category
 * Description:  Brings the posts using category
 * Plugin URI:   https://taiguaras.xyz
 * Author:       taiguaras
 * Version:      1.0
 * Text Domain:  get_posts_by_category
 * License:      MIT
 *
 * @package get_posts_by_category
 */

/**
 * Get posts by category.
 */
function my_post_list_plugin($atts) {

	$atts = shortcode_atts(
		array(
			'posts_per_page'        => '10',
			'category'              => '',
			'template'              => 'row'
		),
		$atts,
		'get_posts_by_category'
	);

    //var_dump($atts);

    $max_posts = $atts['posts_per_page'];
    $cat = $atts['category'];
    $template = $atts['template'];

    $args = array (
		'category_name'              => $cat,
        'posts_per_page'        => $max_posts,
    );
    
    $posts = get_posts($args);

    //var_dump($posts);

    // If there are posts.
	if ( ! empty( $posts ) ) {

        if($template == 'row'){
            echo '<div class="d-flex row">';
        }
        if($template == 'column'){
            echo '<div class="d-flex column">';
        }

		// For each post.
		foreach ( $posts as $post ) {

            echo '<ul class="card">';
            echo '<li><a href="'. get_permalink( $post->ID) . '"> ' . get_the_title( $post->ID) .' </a> </li>';
            echo '</ul>';

        }

        echo '</div>';

    }else echo '<p>No posts found.</p>';


}

    // Register as a shortcode to be used on the site.
add_shortcode( 'get_posts_by_category', 'my_post_list_plugin' );