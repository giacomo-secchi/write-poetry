<?php
/**
 * Settings Interface Class.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Interfaces
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.4
 */

namespace WritePoetry\Interfaces;

interface Settings_Interface {
	/**
	 * Register the settings.
	 */
	public function register_settings();
	/**
	 * Add the settings page.
	 */
	public function display();
	/**
	 * Sanitize the input.
	 *
	 * @param array $input The input.
	 * @return array
	 */
	public function sanitize( $input );
}
