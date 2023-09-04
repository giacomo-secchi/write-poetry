<?php
/**
 * Example class.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.4
 */

namespace WritePoetry\FSE;

use \WritePoetry\Base\BaseController;

/**
*
*/
class Blocks extends BaseController {
	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {
		// add_action( 'init', array( $this, 'register_multiple_blocks' ) );
		add_action( 'init', array( $this, 'register_block_styles' ) );
	}


	public function register_multiple_blocks() {

		$build_dir = $this->plugin_path . 'build/blocks';

		foreach ( scandir( $build_dir ) as $result ) {
			$block_location = $build_dir . '/' . $result;

			if ( ! is_dir( $block_location ) || '.' === $result || '..' === $result ) {
				continue;
			}

			register_block_type( $block_location );
		}

	}

	/**
	 * Register each block style with its label and CSS style
	 *
	 * @return void
	 */
	function register_block_styles() {
		// Check if it is possible to use the `register_block_style` function
		if ( function_exists( 'register_block_style' ) ) {

			foreach ( apply_filters( 'writepoetry_register_block_style', array() ) as $block_name => $style_properties ) {

				// Check for the presence of an inner array key
				// to correctly determine whether a particular element in the `$block_styles` array
				// is a single block style definition or an array of block style definitions.
				if ( isset( $style_properties['name'] ) ) {
					register_block_style( $block_name, $style_properties );
				} else {
					foreach ( $style_properties as $style ) {
						// Register the block style
						register_block_style( $block_name, $style );
					}
				}
			}
		}
	}
}

