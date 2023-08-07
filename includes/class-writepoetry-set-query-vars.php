<?php
/**
 * Add new mime types
 *
 * @package           MyCustomFunctions
 * @subpackage        MyCustomFunctions/includes
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */

class WritePoetry_Add_Query_Variables {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action( 'query_vars', array( $this, 'add_val' ) );
	}

	/**
     * Add query string parameters site-wide
     *
     * @since  1.0.0
     * @access public
     * @return viod
     */
	public function add_val( $qvars ) {

		foreach( apply_filters( 'writepoetry_query_vars', array() ) as $qv ) {
			$qvars[] = $qv;
		}

		return $qvars;
	}

}
