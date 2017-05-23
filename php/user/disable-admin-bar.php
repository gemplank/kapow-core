<?php
/**
 * Remove Admin Bar
 *
 * Prevent non-administrators from viewing the admin bar.
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

/**
 * Prevent non-administrators from viewing the admin bar.
 */
function kapow_core_remove_admin_bar() {
	if ( ! current_user_can( 'administrator' ) && !is_admin() ) {
		show_admin_bar( false );
	}
}

add_action( 'after_setup_theme', 'kapow_core_remove_admin_bar' );
