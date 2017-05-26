<?php
/**
 * Remove Comments
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * Functionality to remove comments.
 */
class Comments {

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		add_action( 'after_setup_theme', array( $this, 'kapow_core_disable_all_comments_and_pings' ) );
		add_action( 'admin_menu', array( $this, 'kapow_core_remove_comments_menu_item' ) );
	}

	/**
	 * Disable comments.
	 */
	public function kapow_core_disable_all_comments_and_pings() {

		// Turn off comments.
		if ( '' !== get_option( 'default_ping_status' ) ) {
			update_option( 'default_ping_status', '' );
		}

		// Turn off pings.
		if ( '' !== get_option( 'default_comment_status' ) ) {
			update_option( 'default_comment_status', '' );
		}

	}

	/**
	 * Hide the comments menu item.
	 */
	public function kapow_core_remove_comments_menu_item() {
		remove_menu_page( 'edit-comments.php' );
	}
}
