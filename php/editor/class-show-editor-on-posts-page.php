<?php
/**
 * Show Editor on Posts Page
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * In WordPress 4.2 the editor was removed on whichever page was assigned to
 * show Latest Posts. The following function below will re-add the editor
 * and remove the notification:
 *
 * @see https://wordpress.stackexchange.com/questions/193755/show-default-editor-on-blog-page-administration-panel
 */
class Show_Editor_On_Posts_Page {

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		add_action( 'edit_form_after_title', array( $this, 'kapow_core_show_editor_on_posts_page' ), 0 );
	}

	/**
	 * Add the wp-editor back into WordPress after it was removed in 4.2.2.
	 *
	 * @param object $post The post object.
	 */
	public function kapow_core_show_editor_on_posts_page( $post ) {

		if ( isset( $post ) && get_option( 'page_for_posts' ) !== $post->ID ) {
			return;
		}

		remove_action( 'edit_form_after_title', '_wp_posts_page_notice' );
		add_post_type_support( 'page', 'editor' );
	}
}
