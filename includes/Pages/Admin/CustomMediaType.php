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

use WritePoetry\Base\AddMimeTypes;
use WritePoetry\Pages\AdminController;


/**
 *
 */
class CustomMediaType extends AdminController {

	public $settings;
	public $mime_types;

	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {

		/**
		 * register wp_setting_init to the admin_init action hook
		 */
		add_action( 'admin_init', array( $this, 'wp_setting_init' ) );
	}

	public function __construct() {
		parent::__construct();

		$this->mime_types = new AddMimeTypes();
		$this->mime_types->register();
	}


	/**
	 * callback functions section content
	 */
	public function supported_media_types_section_cb() {
		esc_html(
			printf( implode( ', ', array_keys( wp_get_mime_types() ) ) )
		);
	}

	/**
	 * register wp_setting_init to the admin_init action hook
	 */
	public function wp_setting_init() {
		// register a new section in the "reading" page.
		add_settings_section(
			"{$this->prefix}_supported_media_types_section",
			__( 'Supported media types', 'write-poetry' ),
			array( $this, 'supported_media_types_section_cb' ),
			'media'
		);
	}
}
