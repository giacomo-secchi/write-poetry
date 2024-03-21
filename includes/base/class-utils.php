<?php
/**
 * Utilities class.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.0
 */

namespace WritePoetry\Base;

use WritePoetry\Base\Base_Controller;
/**
 * Utilities class.
 *
 * @since  0.2.0
 * @access public
 */
class Utils extends Base_Controller {
	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'query_vars', array( $this, 'add_query_vars' ) );
	}


	/**
	 * Add query string parameters site-wide.
	 *
	 * @param array $qvars The current query string parameters.
	 * @since  0.2.2
	 * @access public
	 *
	 * @return array The updated query string parameters.
	 */
	public function add_query_vars( $qvars ) {

		foreach ( apply_filters( "{$this->prefix}_query_vars", array() ) as $qv ) {
			$qvars[] = $qv;
		}

		return $qvars;
	}

	/**
	 * This method attempts to retrieve the user's IP address by checking
	 * the 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', and 'REMOTE_ADDR'
	 * server variables in that order, and returns the first valid IP address.
	 *
	 * @since  0.2.6
	 * @access public
	 * @return string The user's IP address or an empty string if not found.
	 */
	public static function get_user_ip() {
		return $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
	}
}
