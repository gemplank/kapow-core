<?php
/**
 * Remove Comments
 *
 * Functionality to remove comments.
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

/**
 * Disable comments.
 */
function kapow_core_disable_all_comments_and_pings() {

	// Turn off comments.
	if ( '' !== get_option( 'default_ping_status' ) ) {
		update_option( 'default_ping_status', '' );
	}

	// Turn off pings.
	if ( '' !== get_option( 'default_comment_status' ) ) {
		update_option( 'default_comment_status', '' );
	}

}
add_action( 'after_setup_theme', 'kapow_core_disable_all_comments_and_pings' );

/**
 * Hide the comments menu item.
 */
function kapow_core_remove_comments_menu_item() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'kapow_core_remove_comments_menu_item' );
