<?php
/**
 * Example class.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Admin
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.5
 */

namespace WritePoetry\Pages;

use WritePoetry\Base\BaseController;


/**
 * Class AdminController
 *
 * @package WritePoetry\Admin
 */
class AdminController extends BaseController {

	/**
	 * AdminController constructor.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Register the admin page.
	 *
	 * @return false
	 */
	public function regeneration_was_aborted() {
		return true;
	}


	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {}

	/**
	 * Check if there are any filters applied to an option.
	 *
	 * This function checks if there are any filters (actions or hooks) attached to a
	 * specific option. It looks for filters on the option name itself and
	 * on the "pre_option_" variant of the option name.
	 *
	 * @param string $option The name of the option to check for filters.
	 * @return bool Returns true if filters are found, otherwise returns false.
	 */
	public function hasFiltersForOption( $option ) {

		if ( has_filter( "option_$option" ) || has_filter( "pre_option_{$option}" ) ) {
			return true;
		}

		return false;
	}
}
