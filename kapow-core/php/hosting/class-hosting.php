<?php
/**
 * Hosting - WP Engine
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * Some specific WP Engine Overrides.
 */
class Hosting {

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		add_action( 'admin_menu', array( $this, 'kapow_core_change_wp_engine_name' ), 9999 );
		add_filter( 'pre_option_blog_public', array( $this, 'kapow_core_override_robots_txt_save' ) );
	}

	/**
	 * Change the name of WP Engine in the menu.
	 *
	 * Also removes sub pages if the user isn't the one defined in the KAPOW_CORE_PERMITTED_USERNAME
	 * constant.
	 */
	public function kapow_core_change_wp_engine_name() {

		if ( is_admin() ) {
			global $menu, $submenu;

			if ( strpos( $_SERVER['HTTP_HOST'], '.staging' ) !== false ) { // WPCS: input var okay.
				remove_menu_page( 'wpengine-common' );
			} else {

				$current_user = wp_get_current_user();
				$user_name    = $current_user->user_login;

				// Change menu name and icon.
				if ( is_array( $menu ) ) {
					foreach ( $menu as &$m ) {
						if ( 'WP Engine' === $m[0] ) {
							$m[0] = 'Hosting';
							$m[6] = 'dashicons-admin-site';
						}
					}
				}

				// Change submenu name.
				if ( is_array( $submenu ) && isset( $submenu['wpengine-common'] ) ) {
					foreach ( $submenu['wpengine-common'] as &$m ) {
						if ( 'WP Engine' === $m[0] ) {
							$m[0] = 'Hosting';
						}
					}
				}

				// Get permitted user names.
				$user_names = apply_filters( KAPOW_CORE_PREFIX . '_hosting_menu_permitted_user_names', array( 'makedo' ) );

				// Remove Sub Pages.
				if ( ! in_array( $user_name, (array) $user_names, true ) ) {
					remove_submenu_page( 'wpengine-common', 'wpe-user-portal' );
					remove_submenu_page( 'wpengine-common', 'wpe-support-portal' );
				}
			}
		}
	}

	/**
	 * Override robots.txt setting on save
	 *
	 * Dont allow the staging site to have robots.txt enabled.
	 */
	public function kapow_core_override_robots_txt_save() {

		$allow_robots = '1';

		if ( strpos( $_SERVER['HTTP_HOST'], '.staging' ) !== false ) {
			$allow_robots = '0';
		}

		return $allow_robots;
	}
}
