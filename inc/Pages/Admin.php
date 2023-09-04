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

namespace WritePoetry\Pages;

use \WritePoetry\Api\SettingsApi;
use \WritePoetry\Base\AddMimeTypes;
use \WritePoetry\Base\BaseController;


/**
*
*/
class Admin extends BaseController {

	public $settings;
	public $mime_types;

	public function __construct() {
		// $this->settings = new SettingsApi();

		$this->mime_types = new AddMimeTypes();
		$this->mime_types->register();
	}

	public function wp_setting_init() {

	    // register a new section in the "reading" page
		add_settings_section(
	        "{$this->prefix}_supported_media_types_section",
	        __( 'Supported media types', 'writepoetry' ),
	        array( $this, 'supported_media_types_section_cb' ),
	        'media'
	    );


	}


	/**
	 * callback functions
	 */

	// section content cb
	function supported_media_types_section_cb () {
		esc_html(
			printf( implode( ', ', array_keys(  wp_get_mime_types() ) ) )
		);
	}


	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {

		// $pages = array (
		// 	array(
		// 		'page_title' => 'Write Poetry',
		// 		'menu_title' => 'Write Poetry Plugin',
		// 		'capability' => '',
		// 		'menu_slug' => 'writepoetry_plugin',
		// 		'callback' => '',
		// 		'icon_url' => 'dashicons-admin-settings',
		// 		'position' => 6
		// 	),
		// 	array(
		// 		'page_title' => 'Write Poetry',
		// 		'menu_title' => 'Write Poetry Plugin',
		// 		'capability' => '',
		// 		'menu_slug' => 'writepoetry_plugin',
		// 		'callback' => '',
		// 		'icon_url' => 'dashicons-admin-settings',
		// 		'position' => 110
		// 	)
		// );
		// $this->settings->addPages( $pages )->register();

		/**
		 * register wp_setting_init to the admin_init action hook
		 */
		add_action( 'admin_init', array( $this,'wp_setting_init' ) );

	}
}

