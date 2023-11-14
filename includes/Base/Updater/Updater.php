<?php

/**
 * Wrap the Smashing_Updater class
 *
 */

namespace WritePoetry\Base\Updater;

use WritePoetry\Base\BaseController;


class Updater extends BaseController {

	public function register() {

		$updater = new Smashing_Updater( $this->plugin_main_file );
		$updater->set_username( $this->github_username );
		$updater->set_repository( $this->github_repo );
		// $updater->authorize( $this->github_auth ); // Your auth code goes here for private repos

		$updater->initialize();
	}
}
