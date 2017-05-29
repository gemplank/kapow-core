<?php
/**
 * Post Slug
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 *  Rename the post slug.
 */
class Post_Slug {

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		add_action( 'admin_menu', array( $this, 'kapow_core_remove_default_post_type' ) );
		add_action( 'init', array( $this, 'kapow_core_add_blog_to_post_slug' ), 1 );
		add_action( 'wp', array( $this, 'kapow_core_add_blog_to_post_slug_routing' ), 99 );
	}

	/**
	 * Remove the 'post' post type
	 */
	public function kapow_core_remove_default_post_type() {
		remove_menu_page( 'edit.php' );
	}

	/**
	 * Re-add the 'post' post type
	 */
	public function kapow_core_add_blog_to_post_slug() {
		$labels = array(
			'name'                  => _x( 'Blog', 'Post Type General Name', 'kapow-core' ),
			'singular_name'         => _x( 'Blog', 'Post Type Singular Name', 'kapow-core' ),
			'menu_name'             => __( 'Blog', 'kapow-core' ),
			'name_admin_bar'        => __( 'Blog Posts', 'kapow-core' ),
			'archives'              => __( 'Blog Archives', 'kapow-core' ),
			'parent_item_colon'     => __( 'Parent Blog:', 'kapow-core' ),
			'all_items'             => __( 'All Blog Posts', 'kapow-core' ),
			'add_new_item'          => __( 'Add New Blog', 'kapow-core' ),
			'add_new'               => __( 'Add New', 'kapow-core' ),
			'new_item'              => __( 'New Blog', 'kapow-core' ),
			'edit_item'             => __( 'Edit Blog', 'kapow-core' ),
			'update_item'           => __( 'Update Blog', 'kapow-core' ),
			'view_item'             => __( 'View Blog', 'kapow-core' ),
			'search_items'          => __( 'Search Blog Posts', 'kapow-core' ),
			'not_found'             => __( 'Not found', 'kapow-core' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'kapow-core' ),
			'featured_image'        => __( 'Featured Image', 'kapow-core' ),
			'set_featured_image'    => __( 'Set featured image', 'kapow-core' ),
			'remove_featured_image' => __( 'Remove featured image', 'kapow-core' ),
			'use_featured_image'    => __( 'Use as featured image', 'kapow-core' ),
			'insert_into_item'      => __( 'Insert into Blog', 'kapow-core' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Blog', 'kapow-core' ),
			'items_list'            => __( 'Blog Posts list', 'kapow-core' ),
			'items_list_navigation' => __( 'Blog Posts list navigation', 'kapow-core' ),
			'filter_items_list'     => __( 'Filter Blog Posts list', 'kapow-core' ),
		);
		register_post_type(
			'post',
			array(
				'label'               => __( 'Blog', 'kapow-core' ),
				'description'         => __( 'Blog Posts', 'kapow-core' ),
			    'labels'          => $labels,
				'menu_position'   => 5,
			    'public'          => true,
			    '_builtin'        => false,
			    '_edit_link'      => 'post.php?post=%d',
			    'capability_type' => 'post',
			    'map_meta_cap'    => true,
			    'hierarchical'    => false,
			    'rewrite'         => array( 'slug' => 'blog' ),
			    'query_var'       => false,
			    'supports'        => array(
					'title',
					'editor',
					'author',
					'thumbnail',
					'excerpt',
					'trackbacks',
					'custom-fields',
					'comments',
					'revisions',
					'post-formats',
				),
			)
		);
	}

	/**
	 * Handle conflicts with categories now the posts use the slug /blog.
	 */
	public function kapow_core_add_blog_to_post_slug_routing() {

		global $wp_query, $post;

		if ( ! is_admin() && is_404() ) {

			$name = '';
			$url  = $_SERVER['REQUEST_URI']; // WPCS: input var okay.

			// Get the product name.
			if ( isset( $wp_query->query_vars['category_name'] ) ) {
				$name = $wp_query->query_vars['category_name'];
			}

			if ( false !== stripos( $url, 'blog' ) ) {

				// Check to see if this is a post.
				if ( ! empty( $name ) ) {
					$post = get_page_by_path( $name, OBJECT, $this->post_type ); // WPCS: ok.

					if ( is_object( $post ) ) {
						status_header( 200 );

						$args = array(
							'post_type'        => $this->post_type,
							'p'                => $post->ID,
							'suppress_filters' => false,
						);
						$GLOBALS['post']         = $post; // WPCS: override ok.
						$GLOBALS['post_id']      = $post->ID; // WPCS: override ok.
						$GLOBALS['the_post']     = $post; // WPCS: override ok.
						$GLOBALS['wp_query']     = $wp_query = new \WP_Query( $args ); // WPCS: override ok.
						$GLOBALS['wp_the_query'] = $GLOBALS['wp_query']; // WPCS: override ok.

					} else {
						// Otherwise this might be a post archive page.
						$paged = 1;

						if ( false !== stripos( $url, 'page/' ) ) {
							$url_clean = preg_replace( '/\/page\/[0-9]/', '', $url );
							$url       = str_replace( $url_clean, '', $url );
							$paged     = preg_replace( '/[^0-9 ]/', '', $url );
							if ( ! is_numeric( $paged ) ) {
								$paged = 1;
							}
						}

						$args = array(
							'post_type'        => $this->post_type,
							'suppress_filters' => false,
							'paged'            => $paged,
						);

						$query = new \WP_Query( $args );

						if ( ! empty( $query->posts ) ) {
							status_header( 200 );

							$query->is_post_type_archive = null;
							$GLOBALS['wp_query']         = $wp_query = $query; // WPCS: override ok.
							$GLOBALS['wp_the_query']     = $GLOBALS['wp_query']; // WPCS: override ok.
						}
					}
				}
			}
		}
	}
}
