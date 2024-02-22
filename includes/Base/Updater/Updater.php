<?php
/**
 * Wrap the Smashing_Updater class.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base/Updater
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.0
 */

namespace WritePoetry\Base\Updater;

use WritePoetry\Base\BaseController;

/**
 * Class Updater
 */
class Updater extends BaseController {

	/**
	 * Register the updater for the plugin.
	 */
	public function register() {

		$updater = new Smashing_Updater( $this->plugin_main_file );
		$updater->set_username( $this->github_username );
		$updater->set_repository( $this->github_repo );
		// @phpcs:disable Squiz.PHP.CommentedOutCode.Found
		// $updater->authorize( $this->github_auth ); // Your auth code goes here for private repos
		// @phpcs:enable

		$updater->initialize();
	}
}
