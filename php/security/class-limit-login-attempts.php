<?php
/**
 * Limit Login Attempts
 *
 * Prevent Mass WordPress Login Attacks by setting locking the system when login
 * fails.
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * Limit Login Attempts
 *
 * Prevent Mass WordPress Login Attacks by setting locking the system when
 * login fails.
 *
 * @see http://stackoverflow.com/questions/20498556/wordpress-limit-login-attempt-plugin-in-custom-login-form
 */
class Limit_Login_Attempts {

	/**
	 * The ammount of login attempts allowed.
	 *
	 * @var 	int
	 * @access	private
	 * @since	0.1.0
	 */
	var $failed_login_limit;

	/**
	 * The ammount of time a user should be locked out for.
	 *
	 * @var 	int
	 * @access	private
	 * @since	0.1.0
	 */
	var $lockout_duration;

	/**
	 * The name of the transient the login attempt will be stored in.
	 *
	 * @var 	string
	 * @access	private
	 * @since	0.1.0
	 */
	var $transient_name;

	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {
		$this->failed_login_limit = 3; // Number of authentification accepted.
		$this->lockout_duration   = 1800; // Stop authentification process for 30 minutes: 60*30 = 1800.
		$this->transient_name     = 'mkdo_attempted_login'; // Transient used.
	}

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		add_filter( 'authenticate', array( $this, 'check_attempted_login' ), 30, 3 );
		add_action( 'wp_login_failed', array( $this, 'login_failed' ), 10, 1 );
	}

	/**
	 * Lock login attempts of failed login limit is reached
	 *
	 * @param  object $user     The User Object.
	 * @param  string $username The Username.
	 * @param  string $password The Password.
	 * @return object           The User Object.
	 */
	public function check_attempted_login( $user, $username, $password ) {

		if ( defined( 'KAPOW_CORE_IS_LOCKOUT_GLOBAL' ) && KAPOW_CORE_IS_LOCKOUT_GLOBAL ) {
			$this->transient_name = 'kapow_core_attempted_login';
		} else {
			$this->transient_name = 'kapow_core_attempted_login_' . $username;
		}

		if ( get_transient( $this->transient_name ) ) {
	        $datas = get_transient( $this->transient_name );

	        if ( $datas['tried'] >= $this->failed_login_limit ) {
	            $until = get_option( '_transient_timeout_' . $this->transient_name );
	            $time = $this->when( $until );

	            // Display error message to the user when limit is reached.
				wp_die( sprintf( esc_html__( '%1$sWARNING%2$s: You have attempted to login incorrectly too many times. You will be able to try again in %3$s.', 'mkdo-droplets' ), '<strong>', '</strong>', esc_html( $time ) ) );
	        }
	    }

	    return $user;
	}

	/**
	 * Add transient
	 *
	 * @param  string $username The Username.
	 */
	public function login_failed( $username ) {
	    if ( get_transient( $this->transient_name ) ) {
	        $datas = get_transient( $this->transient_name );
	        $datas['tried']++;

	        if ( $datas['tried'] <= $this->failed_login_limit ) {
	            set_transient( $this->transient_name, $datas, $this->lockout_duration );
			}
	    } else {
	        $datas = array(
	            'tried' => 1,
	        );
	        set_transient( $this->transient_name, $datas , $this->lockout_duration );
	    }
	}


	/**
	 * Return difference between 2 given dates
	 *
	 * <a href="/param">@param</a>  int      $time   Date as Unix timestamp
	 *
	 * @param  string $time Datetime.
	 * @return string       Return string
	 */
	private function when( $time ) {
	    if ( ! $time ) {
	        return;
		}

	    $right_now = time();

	    $diff = abs( $right_now - $time );

	    $second = 1;
	    $minute = $second * 60;
	    $hour = $minute * 60;
	    $day = $hour * 24;

	    if ( $diff < $minute ) {
	        return floor( $diff / $second ) . ' seconds';
		}

	    if ( $diff < $minute * 2 ) {
	        return 'about 1 minute ago';
		}

	    if ( $diff < $hour ) {
	        return floor( $diff / $minute ) . ' minutes';
		}

	    if ( $diff < $hour * 2 ) {
	        return 'about 1 hour';
		}

	    return floor( $diff / $hour ) . ' hours';
	}
}
