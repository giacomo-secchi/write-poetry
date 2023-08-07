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

class WritePoetry_Remove_Unwated_Features {

	/**
	 * Initialize the class
	 */
	public function __construct() {

		$this->turn_off_stuff();

	}



	/**
     * Disable features
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
	function turn_off_stuff() {
		$hook_names = array(
			'big_image_size_threshold'	// https://make.wordpress.org/core/2019/10/09/introducing-handling-of-big-images-in-wordpress-5-3/
		);


		foreach ( apply_filters( 'writepoetry_disable_features', $hook_names ) as $hook_name ) {
			if ( empty( $hook_name ) ) {
				return;
			}


			add_filter( $hook_name, '__return_false' );
		}
	}
}
