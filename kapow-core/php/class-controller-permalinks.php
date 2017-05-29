<?php
/**
 * Class Controller_Permalinks
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * The main loader for the permalinks
 */
class Controller_Permalinks {

	/**
	 * Post Slug
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $post_slug;

	/**
	 * Constructor.
	 *
	 * @param Post_Slug $post_slug Post Slug.
	 *
	 * @since 0.1.0
	 */
	public function __construct(
		Post_Slug $post_slug
	) {
		$this->post_slug = $post_slug;
	}

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		$this->post_slug->run();
	}
}
