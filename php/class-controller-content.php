<?php
/**
 * Class Controller_Content
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * The main loader for this plugin
 */
class Controller_Content {

	/**
	 * Clean post content
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $post_content_clean;

	/**
	 * Show editor on posts page
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $show_editor_on_posts_page;

	/**
	 * TinyMCE overrides
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $tinymce;

	/**
	 * Emoji overrides
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $emoji;

	/**
	 * Disable post formats
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $post_formats;

	/**
	 * Constructor.
	 *
	 * @param Post_Content_Clean        $post_content_clean        Clean post content.
	 * @param Show_Editor_On_Posts_Page $show_editor_on_posts_page Show editor on posts page.
	 * @param TinyMCE                   $tinymce                   TinyMCE overrides.
	 * @param Emoji                     $emoji                     Emoji overrides.
	 * @param Post_Formats              $post_formats              Disable post formats.
	 *
	 * @since 0.1.0
	 */
	public function __construct(
		Post_Content_Clean $post_content_clean,
		Show_Editor_On_Posts_Page $show_editor_on_posts_page,
		TinyMCE $tinymce,
		Emoji $emoji,
		Post_Formats $post_formats
	) {
		$this->post_content_clean        = $post_content_clean;
		$this->show_editor_on_posts_page = $show_editor_on_posts_page;
		$this->tinymce                   = $tinymce;
		$this->emoji                     = $emoji;
		$this->post_formats              = $post_formats;
	}

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		$this->post_content_clean->run();
		$this->show_editor_on_posts_page->run();
		$this->tinymce->run();
		$this->emoji->run();
		$this->post_formats->run();
	}
}
