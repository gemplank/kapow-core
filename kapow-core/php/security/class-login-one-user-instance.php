<?php
/**
 * Login One User Instance
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * Only allow one instance of a user to be logged in at any one time.
 */
class Login_One_User_Instance {

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {

		// Settings check.
		$do_run = apply_filters( KAPOW_CORE_PREFIX . '_limit_login_instances', true );
		if ( ! $do_run ) {
			return;
		}

		add_action( 'setup_theme', array( $this, 'kapow_core_login_one_user_instance' ), 0 );
	}

	/**
	 * Only allow one user to be logged on at a time.
	 */
	public function kapow_core_login_one_user_instance() {
		global $sessions;

		// Only allow one user to be logged in at a time.
		$sessions = \WP_Session_Tokens::get_instance( get_current_user_id() );
		$sessions->destroy_others( wp_get_session_token() );
	}
}
