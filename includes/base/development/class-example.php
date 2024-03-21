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

namespace WritePoetry\Base\Development;

use WritePoetry\Base\Base_Controller;

/**
 * Class Example.
 */
class Example extends Base_Controller {
	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {

		add_action( 'admin_enqueue_scripts', array( $this, 'test' ) );
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @return void
	 */
	public function test() {
	}
}
