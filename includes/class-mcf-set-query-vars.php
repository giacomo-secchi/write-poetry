<?php
/**
 * Add new mime types
 *
 * @package     MCF
 * @subpackage  MCF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class MCF_Add_Query_Variables {

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

		foreach( apply_filters( 'mcf_query_vars', array() ) as $qv ) {
			$qvars[] = $qv;
		}

		return $qvars;
	}

}
