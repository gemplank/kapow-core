<?php
/**
 * Class Controller_SEO
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * The main loader for the permalinks
 */
class Controller_SEO {

	/**
	 * Correct language header for Bing
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $bing_header;

	/**
	 * Set the content language header
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $content_language;

	/**
	 * Add WPML sitemap links to Yoast SEO
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $site_map_links;

	/**
	 * Add WPML sitemap for each language to Yoast SEO
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $site_map_per_language;

	/**
	 * Constructor.
	 *
	 * @param Bing_Header           $bing_header           Correct language header for Bing.
	 * @param Content_Language      $content_language      Set the content language header.
	 * @param Site_Map_Links        $site_map_links        Add WPML sitemap links to Yoast SEO.
	 * @param Site_Map_Per_Language $site_map_per_language Add WPML sitemap for each language to Yoast SEO.
	 *
	 * @since 0.1.0
	 */
	public function __construct(
		Bing_Header $bing_header,
		Content_Language $content_language,
		Site_Map_Links $site_map_links,
		Site_Map_Per_Language $site_map_per_language
	) {
		$this->bing_header           = $bing_header;
		$this->content_language      = $content_language;
		$this->site_map_links        = $site_map_links;
		$this->site_map_per_language = $site_map_per_language;
	}

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		$this->bing_header->run();
		$this->content_language->run();
		$this->site_map_links->run();
		$this->site_map_per_language->run();
	}
}
