<?php
/**
 * TinyMCE
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * Functions to clean up TinyMCE.
 */
class TinyMCE {

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {

		// Settings check.
		$do_run = apply_filters( KAPOW_CORE_PREFIX . '_remove_tiny_mce_styles', true );
		if ( ! $do_run ) {
			return;
		}

		add_filter( 'tiny_mce_before_init', array( $this, 'kapow_core_tiny_mce_block_formats' ) );
		add_filter( 'mce_buttons_2', array( $this, 'kapow_core_tiny_mce_editor_buttons' ) );
	}

	/**
	 * Define the elements that can be selected via the TinyMCE dropdown.
	 *
	 * @param  array $settings An array of TinyMCE settings.
	 * @return array           The modified TinyMCE settings
	 */
	public function kapow_core_tiny_mce_block_formats( $settings ) {

		// Add only the block format elements you want to show in dropdown.
		$settings['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Address=address;Pre=pre';

		return $settings;
	}

	/**
	 * Remove the Style Select dropdown from TinyMCE
	 *
	 * Styles are part of the theme, so remove this to stop things getting messy.
	 *
	 * @param  array $buttons An array of TinyMCE buttons.
	 * @return array          The modified TinyMCE buttons
	 */
	public function kapow_core_tiny_mce_editor_buttons( $buttons ) {

		// Remove the style dropdown from TinyMCE.
		array_unshift( $buttons, 'styleselect' );

		return $buttons;
	}
}
