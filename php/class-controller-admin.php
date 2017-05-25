<?php
/**
 * Class Controller_Admin
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * The main loader for this plugin
 */
class Controller_Admin {

	/**
	 * Comment behaviour.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $comments;

	/**
	 * Dashboard Widgets.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $dashboard_widgets;

	/**
	 * Hosting.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $hosting;

	/**
	 * Constructor.
	 *
	 * @param Comments          $comments          Comment behaviour.
	 * @param Dashboard_Widgets $dashboard_widgets Dashboard Widgets.
	 * @param Hosting           $hosting           Hosting.
	 *
	 * @since 0.1.0
	 */
	public function __construct(
		Comments $comments,
		Dashboard_Widgets $dashboard_widgets,
		Hosting $hosting
	) {
		$this->comments          = $comments;
		$this->dashboard_widgets = $dashboard_widgets;
		$this->hosting           = $hosting;
	}

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		$this->comments->run();
		$this->dashboard_widgets->run();
		$this->hosting->run();
	}
}
