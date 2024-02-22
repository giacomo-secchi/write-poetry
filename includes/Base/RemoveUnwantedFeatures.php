<?php
/**
 * Disable fatures that you don't want
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.5
 */

namespace WritePoetry\Base;

use WritePoetry\Base\BaseController;

/**
 * RemoveUnwantedFeatures
 */
class RemoveUnwantedFeatures extends BaseController {

	/**
	 * Initialize the class
	 */
	public function register() {

		$this->turn_off_stuff();
	}



	/**
	 * Disable features
	 *
	 * @since  0.2.5
	 * @access public
	 * @return void
	 */
	public function turn_off_stuff() {

		$hook_names = apply_filters(
			"{$this->prefix}_disable_features",
			array(
				'big_image_size_threshold',  // https://make.wordpress.org/core/2019/10/09/introducing-handling-of-big-images-in-wordpress-5-3/.
			)
		);

		foreach ( $hook_names as $hook_name ) {
			if ( empty( $hook_name ) ) {
				return;
			}

			add_filter( $hook_name, '__return_false' );
		}
	}
}
