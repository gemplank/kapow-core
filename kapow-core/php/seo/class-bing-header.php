<?php
/**
 * WPML Bing Compatible Header
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * Add Bing Compatible language links
 */
class Bing_Header {

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		add_filter( 'wp_head', array( $this, 'kapow_core_wpml_bing_compatible_header' ), 0 );
	}

	/**
	 * Add Bing Compatible language links
	 */
	public function kapow_core_wpml_bing_compatible_header() {
		global $post;

		if ( function_exists( 'icl_get_languages' ) ) {
			$langs = icl_get_languages();
			foreach ( $langs as $lang ) {
				// Get the language ID.
				$id = icl_object_id( $post->ID, $post->post_type, false, $lang['code'] );

				// If there is a translation.
				if ( ! empty( $id ) && (int) $id === (int) $post->ID ) {
					echo '<meta http-equiv="content-language" content="' . esc_attr( $lang['code'] ) . '"/>' . "\n";
				}
			}
		}
	}
}
