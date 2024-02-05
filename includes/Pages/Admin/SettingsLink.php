<?php
/**
 * Add action links to this specific plugin in the Plugins list table.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Pages
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.4
 */

namespace WritePoetry\Pages\Admin;

use WritePoetry\Pages\AdminController;

/**
 *
 */
class SettingsLink extends AdminController {
	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {
		add_action( "plugin_action_links_$this->plugin_name", array( $this, 'add_action_links' ) );
	}

	public function add_action_links( $actions ) {
		$settingsPage = new SettingsPage();

		// Build URL.
		$url = add_query_arg( 'page', $settingsPage->getPageSlug(), get_admin_url() . 'options-general.php' );

		$mylinks = array(
			'<a href="' . esc_url( $url ) . '">' . esc_html__( 'Settings', 'write-poetry' ) . '</a>',
		);

		$actions = array_merge( $mylinks, $actions );
		return $actions;
	}
}
