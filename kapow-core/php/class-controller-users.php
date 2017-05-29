<?php
/**
 * Class Controller_Users
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * The main loader for the permalinks
 */
class Controller_Users {

	/**
	 * Show/Hide Admin Bar
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $admin_bar;

	/**
	 * Constructor.
	 *
	 * @param Admin_Bar $admin_bar Show/Hide Admin Bar.
	 *
	 * @since 0.1.0
	 */
	public function __construct(
		Admin_Bar $admin_bar
	) {
		$this->admin_bar = $admin_bar;
	}

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		$this->admin_bar->run();
	}
}
