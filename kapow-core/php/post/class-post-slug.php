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
	 * Post Slug.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $post_slug;

	/**
	 * Post Name Label.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $post_name_label;

	/**
	 * Post Name description.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $post_name_description;

	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {
		$this->post_slug        = apply_filters( KAPOW_CORE_PREFIX . '_post_slug', 'blog' );
		$this->post_name_labels = apply_filters(
			KAPOW_CORE_PREFIX . '_post_name_labels',
			array(
				'name'                  => _x( 'Post', 'Post Type General Name', 'kapow-core' ),
				'singular_name'         => _x( 'Post', 'Post Type Singular Name', 'kapow-core' ),
				'menu_name'             => __( 'Post', 'kapow-core' ),
				'name_admin_bar'        => __( 'Posts', 'kapow-core' ),
				'archives'              => __( 'Post Archives', 'kapow-core' ),
				'parent_item_colon'     => __( 'Parent Post:', 'kapow-core' ),
				'all_items'             => __( 'All Posts', 'kapow-core' ),
				'add_new_item'          => __( 'Add New Post', 'kapow-core' ),
				'add_new'               => __( 'Add New', 'kapow-core' ),
				'new_item'              => __( 'New Post', 'kapow-core' ),
				'edit_item'             => __( 'Edit Post', 'kapow-core' ),
				'update_item'           => __( 'Update Post', 'kapow-core' ),
				'view_item'             => __( 'View Post', 'kapow-core' ),
				'search_items'          => __( 'Search Posts', 'kapow-core' ),
				'not_found'             => __( 'Not found', 'kapow-core' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'kapow-core' ),
				'featured_image'        => __( 'Featured Image', 'kapow-core' ),
				'set_featured_image'    => __( 'Set featured image', 'kapow-core' ),
				'remove_featured_image' => __( 'Remove featured image', 'kapow-core' ),
				'use_featured_image'    => __( 'Use as featured image', 'kapow-core' ),
				'insert_into_item'      => __( 'Insert into Post', 'kapow-core' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Post', 'kapow-core' ),
				'items_list'            => __( 'Posts list', 'kapow-core' ),
				'items_list_navigation' => __( 'Posts list navigation', 'kapow-core' ),
				'filter_items_list'     => __( 'Filter Posts list', 'kapow-core' ),
			)
		);
		$this->post_name_label       = apply_filters( KAPOW_CORE_PREFIX . '_post_name_label', __( 'Post', 'kapow-core' ) );
		$this->post_name_description = apply_filters( KAPOW_CORE_PREFIX . '_post_name_description', __( 'Posts', 'kapow-core' ) );
	}

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {

		// Settings check.
		$do_run = apply_filters( KAPOW_CORE_PREFIX . '_alter_post_slug', false );
		if ( ! $do_run ) {
			return;
		}

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

		register_post_type(
			'post',
			array(
				'label'           => $this->post_name_label,
				'description'     => $this->post_name_description,
			    'labels'          => $this->post_name_labels,
				'menu_position'   => 5,
			    'public'          => true,
			    '_builtin'        => false,
			    '_edit_link'      => 'post.php?post=%d',
			    'capability_type' => 'post',
			    'map_meta_cap'    => true,
			    'hierarchical'    => false,
			    'rewrite'         => array( 'slug' => $this->post_slug ),
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
			// @codingStandardsIgnoreStart
			$url  = $_SERVER['REQUEST_URI']; // @codingStandardsIgnoreEnd

			// Get the product name.
			if ( isset( $wp_query->query_vars['category_name'] ) ) {
				$name = $wp_query->query_vars['category_name'];
			}

			if ( false !== stripos( $url, $this->post_slug ) ) {

				// Check to see if this is a post.
				if ( ! empty( $name ) ) {
					// @codingStandardsIgnoreStart
					$post = get_page_by_path( $name, OBJECT, $this->post_type ); // @codingStandardsIgnoreEnd

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
