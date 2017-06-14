<?php
/**
 * Body Classes
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * Adds usful body classes to the body tag.
 */
class Body_Classes {

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {

		// Settings check.
		$do_run = apply_filters( KAPOW_CORE_PREFIX . '_add_body_classes', true );
		if ( ! $do_run ) {
			return;
		}

		add_filter( 'body_class', array( $this, 'kapow_core_body_classes' ) );
	}

	/**
	 * Adds custom classes to the array of body classes
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	public function kapow_core_body_classes( $classes ) {
		global $post;

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		// Adds the slug if this is a single page.
		if ( is_singular() ) {
			$classes[] = 'slug-' . $post->post_name;
		}

		// Add the slug of the parent page if this is a single post/page.
		if ( is_singular() ) {

			// Get an array of Ancestors and Parents if they exist.
			$ancestors = get_post_ancestors( $post->ID );

			if ( ! empty( $ancestors ) ) {

				// Get the ID of the immediate parent and the farthest ancestor.
				$parent_id   = ($ancestors) ? $ancestors[0]: '';
				$ancestor_id = ($ancestors) ? $ancestors[ count( $ancestors ) -1 ]: '';

				// Parent.
				$parent    = get_post( $id );
				$classes[] = 'slug-parent-' . $parent->post_name;

				// Ancestor.
				if ( ! empty( $ancestor_id ) && $parent_id !== $ancestor_id ) {
					$ancestor  = get_post( $id );
					$classes[] = 'slug-ancestor-' . $ancestor->post_name;
				}
			}
		}
		
		return $classes;
	}
}
