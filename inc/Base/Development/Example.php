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

use \WritePoetry\Base\BaseController;

/**
*
*/
class Example extends BaseController {
	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	function enqueue() {
		// enqueue all our scripts
		wp_enqueue_style( 'mypluginstyle', $this->plugin_url . 'assets/mystyle.css' );
		wp_enqueue_script( 'mypluginscript', $this->plugin_url . 'assets/myscript.js' );
	}

	function wp_setting_init() {
	    // register a new setting for "media" page
	    // register_setting( 'media', 'mime_type' );

		add_settings_field(
			'myprefix_setting-id', // $id
			'This is the setting title', // $title
			'callback_input_myid', // $callback
			'media', //  $page
			'wp_custom_setting_section', //'myprefix_settings-section-name',  $section = 'default'
 			array(  // $args = array()
				'type'         => 'checkbox',
				'option_group' => 'wpdevref_options',
				'name'         => 'wpdevref_removestyles_field',
				'label_for'    => 'wpdevref_removestyles_field', // 'myprefix_setting-id'
				'value'        => (empty(get_option('wpdevref_options')['wpdevref_removestyles_field']))
				? 0 : get_option('unitizr_options')['wpdevref_removestyles_field'],
				'description'  => __( 'Check to remove preset plugin overrides.',
								'wpdevref' ),
				'checked'      => (!isset(get_option('wpdevref_options')['wpdevref_removestyles_field']))
								   ? 0 : get_option('wpdevref_options')['wpdevref_removestyles_field'],
				// Used 0 in this case but will still return Boolean not[see notes below]
				'tip'          => esc_attr__( 'Use if plugin fields drastically changed when installing this plugin.', 'wpdevref' )
			)

		);
	}

	public function callback_input_myid() {
		echo "<input type='checkbox' id='mynewcheckboxID' value='1'";
		if ( get_option('mynewcheckboxID') == '1' ) {
			echo ' checked';
		}
		 echo '/>';
	}
}

