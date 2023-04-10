<?php
/**
 * Remove unwanted assets
 *
 * @package     MCF
 * @subpackage  MCF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class MCF_GTM {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action		( 'wp_body_open', 		array( $this, 'GTM_noscript_container_code' ) );

	}



	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public static function GTM_noscript_container_code() {
		if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); }
	}

}


