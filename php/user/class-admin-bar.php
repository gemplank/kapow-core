<?php
/**
 * Remove Admin Bar
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * Prevent certain users from viewing the admin bar.
 */
class Admin_Bar {

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		add_action( 'after_setup_theme', array( $this, 'kapow_core_remove_admin_bar' ) );
	}

	/**
	 * Prevent non-administrators from viewing the admin bar.
	 */
	function kapow_core_remove_admin_bar() {

		$user = wp_get_current_user();

		if ( ! in_array( 'administrator', (array) $user->roles, true ) && ! is_admin() ) {
			// @codingStandardsIgnoreStart
			show_admin_bar( false );
			// @codingStandardsIgnoreEnd
		}
	}
}
