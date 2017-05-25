<?php
/**
 * Class Controller_Main
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * The main loader for this plugin
 */
class Controller_Main {

	/**
	 * Enqueue the public and admin assets.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $controller_assets;

	/**
	 * Define the settings page.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $settings;

	/**
	 * Notices on the admin screens.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $notices_admin;

	/**
	 * Control Admin Behaviour.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $controller_admin;

	/**
	 * Control Content.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $controller_content;

	/**
	 * Control Formatting.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $controller_formatting;

	/**
	 * Control Permalinks.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $controller_permalinks;

	/**
	 * Constructor.
	 *
	 * @param Settings              $settings              Define the settings page.
	 * @param Controller_Assets     $controller_assets     Enqueue the public and admin assets.
	 * @param Notices_Admin         $notices_admin         Notices on the admin screens.
	 * @param Controller_Admin      $controller_admin      Control Admin Behaviour.
	 * @param Controller_Content    $controller_content    Control Content.
	 * @param Controller_Formatting $controller_formatting Control Formatting.
	 * @param Controller_Permalinks $controller_permalinks Control Permalinks.
	 *
	 * @since 0.1.0
	 */
	public function __construct(
		Settings $settings,
		Controller_Assets $controller_assets,
		Notices_Admin $notices_admin,
		Controller_Admin $controller_admin,
		Controller_Content $controller_content,
		Controller_Formatting $controller_formatting,
		Controller_Permalinks $controller_permalinks
	) {
		$this->settings              = $settings;
		$this->controller_assets     = $controller_assets;
		$this->notices_admin         = $notices_admin;
		$this->controller_admin      = $controller_admin;
		$this->controller_content    = $controller_content;
		$this->controller_formatting = $controller_formatting;
		$this->controller_permalinks = $controller_permalinks;
	}

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		load_plugin_textdomain(
			'kapow-core',
			false,
			KAPOW_CORE_ROOT . '\languages'
		);

		// $this //->settings->run();
		$this->controller_assets->run();
		// $this //->notices_admin->run();
		$this->controller_admin->run();
		$this->controller_content->run();
		$this->controller_formatting->run();
		$this->controller_permalinks->run();
	}
}
