<?php
/**
 * Responsive Embeds
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * Add a responsive wrapper to iframes.
 */
class Responsive_Embeds {

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		add_filter( 'the_content', array( $this, 'kapow_core_embed_wrapper' ) );
	}

	/**
	 * Wrap iFrames and Embeds in a responsive wrapper.
	 *
	 * To give this any real usage it needs to be used with the CSS found in
	 * /droplets/assets/css/_responsive-embeds.css
	 *
	 * Be sure to include this in your styles.
	 *
	 * @param string $content Post content.
	 * @return string Modified Post content
	 */
	public function kapow_core_embed_wrapper( $content ) {

		// Find iframes, or embed tags.
		$pattern = '~<iframe.*</iframe>|<embed.*</embed>~';
		preg_match_all( $pattern, $content, $matches );

		// Wrap each one in a responsive-embed class.
		foreach ( $matches[0] as $match ) {
			$wrapped_frame = '<div class="responsive-embed">' . $match . '</div>';

			$content = str_replace( $match, $wrapped_frame, $content );
		}

		return $content;
	}
}
