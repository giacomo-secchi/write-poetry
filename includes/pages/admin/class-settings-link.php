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

use WritePoetry\Pages\Admin_Controller;

/**
 * Class Settings_Link
 */
class Settings_Link extends Admin_Controller {
	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {
		add_action( "plugin_action_links_$this->plugin_name", array( $this, 'add_action_links' ) );
	}

	/**
	 * Add action links to this specific plugin in the Plugins list table.
	 *
	 * @param array $actions An array of plugin action links.
	 *
	 * @return array
	 */
	public function add_action_links( $actions ) {
		$settings_page = new Settings_Page();

		// Build URL.
		$url = add_query_arg( 'page', $settings_page->getPageSlug(), get_admin_url() . 'options-general.php' );

		$mylinks = array(
			'<a href="' . esc_url( $url ) . '">' . esc_html__( 'Settings', 'write-poetry' ) . '</a>',
		);

		$actions = array_merge( $mylinks, $actions );
		return $actions;
	}
}
