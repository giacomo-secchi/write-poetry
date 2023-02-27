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

class MCF_Remove_Unwated_Features {

	/**
	 * Initialize the class
	 */
	public function __construct() {

		$hook_names = array(
			'big_image_size_threshold'	// https://make.wordpress.org/core/2019/10/09/introducing-handling-of-big-images-in-wordpress-5-3/
		);

		foreach ( $hook_names as $hook_name ) {
			if ( empty( $hook_name ) ) {
				return;
			}

			add_filter( $hook_name, '__return_false' );
		}

	}

}
