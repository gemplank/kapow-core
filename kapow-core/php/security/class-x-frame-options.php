<?php
/**
 * X Frame Options
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * X Frame Options
 *
 * Prevent site form being loaded in an iFrame.
 */
class X_Frame_Options {

	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {}

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {

		// Settings check.
		$do_run = apply_filters( KAPOW_CORE_PREFIX . '_x_frame_options_header', true );
		if ( ! $do_run ) {
			return;
		}

		add_action( 'send_headers', array( $this, 'send_headers' ), 10, 1 );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ), 10 );
	}

	/**
	 * Send Headers
	 */
	public function send_headers() {
		header( 'X-FRAME-OPTIONS: SAMEORIGIN' );
	}

	/**
	 * Enqueue clickjack protection script for older browsers
	 */
	public function wp_enqueue_scripts() {
		$script_url = plugins_url( 'assets/js/kapow-core-clickjack-protection.js', KAPOW_CORE_ROOT );
		wp_enqueue_script(
			KAPOW_CORE_PREFIX . '-clickjack-protection-js',
			$script_url,
			array( 'jquery' ),
			'',
			true
		);
		// Clickjack headers not supported below IE8.
		wp_script_add_data( KAPOW_CORE_PREFIX . '-clickjack-protection-js', 'conditional', 'lt IE 8' );
	}
}
