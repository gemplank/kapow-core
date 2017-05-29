<?php
/**
 * Yoast WPML Sitemap Per Trainslation
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * If using WPML and Yoast SEO, create a sitemap per translation.
 */
class Site_Map_Per_Language {

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		add_filter( 'wpseo_posts_join', array( $this, 'kapow_core_yoast_wpml_sitemap_per_translation' ), 10, 2 );
	}

	/**
	 * Yoast SEO Posts Join
	 *
	 * Create a sitemap per page in WPML.
	 *
	 * @param  mixed  $join false or a join string.
	 * @param  string $type Post Type.
	 * @return mixed        false or a join string
	 */
	function kapow_core_yoast_wpml_sitemap_per_translation( $join, $type ) {
		global $wpdb, $sitepress;
		if ( isset( $sitepress ) ) {
			$lang = $sitepress->get_current_language();
			return ' JOIN ' . $wpdb->prefix . "icl_translations ON element_id = ID AND element_type = 'post_$type' AND language_code = '$lang'";
		}
		return $join;
	}
}
