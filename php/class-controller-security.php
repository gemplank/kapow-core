<?php
/**
 * Class Controller_Security
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * The main loader for the security
 */
class Controller_Security {

	/**
	 * Limit login attempts
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $limit_login_attempts;

	/**
	 * Allow one user instance
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $login_one_user_instance;

	/**
	 * Constructor.
	 *
	 * @param Limit_Login_Attempts    $limit_login_attempts    Limit login attempts.
	 * @param Login_One_User_Instance $login_one_user_instance Allow one user instance.
	 *
	 * @since 0.1.0
	 */
	public function __construct(
		Limit_Login_Attempts $limit_login_attempts,
		Login_One_User_Instance $login_one_user_instance
	) {
		$this->limit_login_attempts    = $limit_login_attempts;
		$this->login_one_user_instance = $login_one_user_instance;
	}

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		$this->limit_login_attempts->run();
		$this->login_one_user_instance->run();
	}
}
