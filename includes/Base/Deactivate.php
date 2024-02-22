<?php
/**
 * Example class.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.5
 */

namespace WritePoetry\Base;

/**
 * Deactivate class.
 */
class Deactivate {

	/**
	 * Deactivate the plugin
	 *
	 * @since  0.2.5
	 * @access public
	 * @return void
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}
}
