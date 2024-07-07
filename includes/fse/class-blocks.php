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

use WritePoetry\Base\Base_Controller;

/**
 * Class Blocks
 */
class Blocks extends Base_Controller {

	/**
	 * The block name.
	 *
	 * @var array
	 */
	private $block_name = array();

	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'init', array( $this, 'register_multiple_blocks' ) );
	}


	/**
	 * Register multiple blocks.
	 *
	 * @return void
	 */
	public function register_multiple_blocks() {

		$build_dir = $this->build_path . '/blocks';

		foreach ( scandir( $build_dir ) as $result ) {
			$block_location = $build_dir . '/' . $result;

			if ( ! is_dir( $block_location ) || '.' === $result || '..' === $result ) {
				continue;
			}

			if ( $result ) {
				$this->block_name[] = $result;
			}

			$block_type = $block_location;

			register_block_type( $block_type );
		}
	}

	/**
	 * Register multiple blocks callback.
	 *
	 * @param array  $attributes The block attributes.
	 * @param string $content The block content.
	 * @param object $block The block object.
	 *
	 * @return string
	 */
	public function register_multiple_blocks_callback( $attributes, $content, $block ) {
		ob_start();

		foreach ( $this->block_name as $block_name ) {
			$template_path = $this->build_path . '/blocks/' . $block_name . '/template.php';

			if ( ! empty( $block->block_type->view_script_handles ) ) {
				// viewScript is defined.
				wp_enqueue_script( $block->block_type->view_script_handles );
			}

			if ( file_exists( $template_path ) ) {
				require_once $template_path;
			}
		}
		return ob_get_clean();
	}
}
