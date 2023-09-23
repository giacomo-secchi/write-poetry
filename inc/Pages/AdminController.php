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

use \WritePoetry\Api\SettingsApi;
use \WritePoetry\Base\BaseController;


/**
*
*/
class AdminController extends BaseController {

	public $menu_slug;


	public function __construct() {

		parent::__construct();
		$this->menu_slug = "{$this->prefix}-settings";
		// $this->settings = new SettingsApi();



	}


	public function regeneration_was_aborted() {
		return true;
	}


	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {



		// add_action( 'admin_menu', array( $this, 'admin_menu' ) );


	}


	public function admin_menu() {
		$page_title = __( 'Write Poetry', 'writepoetry' );
		$menu_title = __( 'Write Poetry', 'writepoetry' );
		$capability = 'manage_options';
		$menu_slug = $this->menu_slug;
		$callback = array( $this, 'settings_page' );
		$position = 24;

		add_options_page( $page_title, $menu_title, $capability, $menu_slug, $callback, $position );

	}

	public function settings_page() {

		if ( ! current_user_can('manage_options') ) {
			wp_die('Unauthorized user');
		}

		$nonce = 'wpshout_option_page_example_action';

		// check_admin_referer( $nonce );

		if ( isset( $_POST['awesome_text'] ) ) {
			$value = $_POST['awesome_text'];
			update_option( 'awesome_text', $value );
		}

		$value = get_option( 'awesome_text', 'hey-ho' );

		echo \WritePoetry\Pages\Admin\Views\HtmlContent::getForm( $value, $nonce );
	}
}

