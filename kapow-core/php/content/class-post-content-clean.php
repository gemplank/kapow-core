<?php
/**
 * Post Content Clean
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * Automatically cleans up content on post save, to get rid of any non-html nasties.
 * Lovingly borrowed the idea from https://en-gb.wordpress.org/plugins/safe-paste/.
 */
class Post_Content_Clean {

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {

		// Settings check.
		$do_run = apply_filters( KAPOW_CORE_PREFIX . '_clean_content', true );
		if ( ! $do_run ) {
			return;
		}

		add_filter( 'wp_insert_post_data', array( $this, 'kapow_core_sanitize_post_content' ), 99, 2 );
		add_action( 'wp_insert_post', array( $this, 'kapow_core_sanitize_post_meta' ) );
		add_filter( 'the_content', array( $this, 'kapow_core_remove_empty_p' ), 20, 1 );
		add_filter( 'the_content' , array( $this, 'kapow_core_remove_image_ptags' ) );
	}

	/**
	 * Clean post data on save
	 *
	 * @param  array $data    An array of slashed post data.
	 * @param  array $postarr An array of sanitized, but otherwise unmodified post data.
	 * @return array          The modified post data
	 */
	public function kapow_core_sanitize_post_content( $data, $postarr ) {

		// Clean up the post content.
		$data['post_content'] = $this->kapow_core_sanitize_html( $data['post_content'] );

		// Clean up the post excerpt.
		$data['post_excerpt'] = $this->kapow_core_sanitize_html( $data['post_excerpt'] );

		return $data;
	}

	/**
	 * Clean post meta on save
	 *
	 * @param  int $post_id The post ID.
	 */
	public function kapow_core_sanitize_post_meta( $post_id ) {

		// Remove this hook, otherwise we will cause an infinate loop.
		remove_action( 'wp_insert_post', array( $this, 'kapow_core_sanitize_post_meta' ) );

		// Get all the post meta.
		$post_meta = get_post_meta( $post_id );

		// Loop through the post meta.
		foreach ( (array) $post_meta as $key => $meta ) {

			// If the meta is an array, but not serialised.
			// @codingStandardsIgnoreStart
			if ( is_array( $meta ) && false === @unserialize( $meta ) ) {
			// @codingStandardsIgnoreEnd

				// Setup a return array.
				$new_meta = array();

				foreach ( $meta as $meta_key => $meta_item ) {

					if ( ! empty( $meta_item ) ) {

						// Check if meta is serialised.
						// @codingStandardsIgnoreStart
						$is_serialized = @unserialize( $meta_item );
						// @codingStandardsIgnoreEnd

						// Unserialize the meta.
						if ( false !== $is_serialized ) {
							$meta_item = $this->kapow_core_sanitize_serialised_data( $meta_item );
						} else {
							// Strip the tags, so we can check for HTML.
							$meta_stripped = strip_tags( $meta_item );

							// Tags have been removed, so it must have contained HTML!
							if ( $meta_stripped !== $meta_item ) {

								// Do the sanitization.
								$meta_item = $this->kapow_core_sanitize_html( $meta_item );
							}
						}
					}

					// Update the array.
					$new_meta[ $meta_key ] = $meta_item;
				}

				// Save the meta.
				if ( 1 === count( $new_meta ) && isset( $new_meta[0] ) ) {
					update_post_meta( $post_id, $key, $new_meta[0] );
				} else {
					update_post_meta( $post_id, $key, $new_meta );
				}
			} elseif ( ! empty( $meta ) ) {

				// Set the meta item.
				$meta_item = $meta;

				// Check if meta is serialised.
				// @codingStandardsIgnoreStart
				$is_serialized = @unserialize( $meta_item );
				// @codingStandardsIgnoreEnd

				// Unserialize the meta.
				if ( false !== $is_serialized ) {
					$meta_item = $this->kapow_core_sanitize_serialised_data( $meta_item );
				} else {
					// Strip the tags, so we can check for HTML.
					$meta_stripped = strip_tags( $meta_item );

					// Tags have been removed, so it must have contained HTML!
					if ( $meta_stripped !== $meta_item ) {

						// Do the sanitization.
						$meta_item = $this->kapow_core_sanitize_html( $meta_item );
					}

					// Save the meta.
					update_post_meta( $post_id, $key, $meta_item );
				}
			}
		}

		// Add the hook back in.
		add_action( 'wp_insert_post', array( $this, 'kapow_core_sanitize_post_meta' ) );
	}

	/**
	 * Serialise meta data.
	 *
	 * Function to clean up meta data.
	 *
	 * @param  mixed $data Serialised data.
	 * @return mixed       Serialised data.
	 */
	public function kapow_core_sanitize_serialised_data( $data ) {

		// @codingStandardsIgnoreStart
		$is_serialized = @unserialize( $data );
		// @codingStandardsIgnoreEnd

		// Unserialize the meta.
		if ( false !== $is_serialized ) {
			// @codingStandardsIgnoreStart
			$data = unserialize( $data );
			// @codingStandardsIgnoreEnd

			foreach ( $data as &$unserialized_data ) {

				if ( is_array( $unserialized_data ) ) {
					$unserialized_data = $this->kapow_core_sanitize_serialised_data( $unserialized_data );
				} else {

					// Strip the tags, so we can check for HTML.
					$meta_stripped = strip_tags( $unserialized_data );

					// Tags have been removed, so it must have contained HTML!
					if ( $meta_stripped !== $unserialized_data ) {

						// Do the sanitization.
						$unserialized_data = $this->kapow_core_sanitize_html( $unserialized_data );
					}
				}
			}
		}

		return $data;
	}

	/**
	 * HTML Clean
	 *
	 * Function to clean up HTML.
	 *
	 * @param  string $content Content to be cleaned.
	 * @return string          Cleaned content.
	 */
	public function kapow_core_sanitize_html( $content ) {

		// The tags and attributes that are allowed.
		$allowed_tags = array(
			'p' => array(),
			'a' => array(
				'href'   => array(),
				'title'  => array(),
				'target' => array(),
				'rel'    => array(),
			),
			'img' => array(
				'src'    => array(),
				'alt'    => array(),
				'class'  => array(),
				'width'  => array(),
				'height' => array(),
			),
			'h2'         => array(),
			'h3'         => array(),
			'h4'         => array(),
			'h5'         => array(),
			'h6'         => array(),
			'hr'         => array(),
			'blockquote' => array(),
			'cite'       => array(),
			'ol'         => array(),
			'ul'         => array(),
			'li'         => array(),
			'em'         => array(),
			'strong'     => array(),
			'del'        => array(),
			'div'        => array(
				'id'    => array(),
				'class' => array(),
			),
		);

		// Filter the content tags, so we can add additional.
		$allowed_tags = apply_filters( KAPOW_CORE_PREFIX . '_content_tags', $allowed_tags );

		// Allowed protocols.
		$allowed_protocols = array(
			'http',
			'https',
			'mailto',
			'tel',
			'sms',
			'market',
			'geopoint',
			'ymsgr',
			'msnim',
			'gtalk',
			'skype',
			'sip',
			'whatsapp',
		);

		// Filter the protocols, so we can add additional.
		$allowed_protocols = apply_filters( KAPOW_CORE_PREFIX . '_content_protocols', $allowed_protocols );

		// Clean up the HTML tags.
		$content = wp_kses( $content, $allowed_tags, $allowed_protocols );

		// Replace &nbsp; with real spaces.
		$content = preg_replace( '/&nbsp;/i', ' ', $content );

		return $content;
	}

	/**
	 * Remove empty <p> tags.
	 *
	 * @see https://gist.github.com/Fantikerz/5557617
	 *
	 * @param  string $content Content to be cleaned.
	 * @return string
	 */
	public function kapow_core_remove_empty_p( $content ) {
		$content = force_balance_tags( $content );
		$return = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
		$return = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $return );

		return $return;
	}

	/**
	 * Remove <p> tags around images.
	 *
	 * @param  string $content Content to be cleaned.
	 * @return string
	 */
	public function kapow_core_remove_image_ptags( $content ) {
		return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>|<iframe .*>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	}
}
