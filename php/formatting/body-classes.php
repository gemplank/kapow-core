<?php
/**
 * Body Classes
 *
 * Adds usful body classes to the body tag.
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

/**
 * Adds custom classes to the array of body classes
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function kapow_core_body_classes( $classes ) {
	global $post;

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds the slug if this is a single page.
	if ( is_singular() ) {
		$classes[] = 'slug-' . $post->post_name;
	}

	return $classes;
}
add_filter( 'body_class', 'kapow_core_body_classes' );
