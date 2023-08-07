<?php
/**
 * Remove unwanted assets
 *
 * @package           MyCustomFunctions
 * @subpackage        MyCustomFunctions/includes
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */


class WritePoetry_GTM {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action		( 'wp_body_open', 		array( $this, 'GTM_noscript_container_code' ) );

	}



	/**
	 * Manually coded Container code compatibility mode
	 *
	 * @return void
	 */
	public static function GTM_noscript_container_code() {
		if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); }
	}


}


