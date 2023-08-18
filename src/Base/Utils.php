<?php
/**
 * Utilities class.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */

namespace WritePoetry\Base;


/**
*
*/
class Utils {
	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'query_vars', array( $this, 'add_query_vars' ) );
	}


	/**
     * Add query string parameters site-wide
     *
     * @since  0.2.2
     * @access public
     * @return viod
     */
	public function add_query_vars( $qvars ) {

		foreach( apply_filters( 'writepoetry_query_vars', array() ) as $qv ) {
			$qvars[] = $qv;
		}

		return $qvars;
	}

}
