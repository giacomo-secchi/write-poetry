<?php
/**
 * Example class.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */

namespace WritePoetry\Base\Development;

// use \WritePoetry\Base\BaseController;

/**
*
*/
class Environment {
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	function enqueue() {
		// enqueue all our scripts
		wp_enqueue_style( 'mypluginstyle', $this->plugin_url . 'assets/mystyle.css' );
		wp_enqueue_script( 'mypluginscript', $this->plugin_url . 'assets/myscript.js' );
	}

	public static function is_development_environment() {
		return in_array( wp_get_environment_type(), array( 'development', 'local' ), true );
	}

}

	/**
	 * Initialize the class
	 */
	public function __construct() {

		add_filter		( 'style_loader_src',					array( $this, 'remove_query_string_from_static_files'	), 10, 2 );
		add_filter		( 'script_loader_src',					array( $this, 'remove_query_string_from_static_files'	), 10, 2 );

	}




	// Remove query string from static CSS files
	public static function remove_query_string_from_static_files( $src ) {
		if ( ! WritePoetry_Plugin::is_development_environment() ) {
			return;
		}

		if( strpos( $src, '?ver=' ) ) {
			$src = remove_query_arg( 'ver', $src );
		}

		return $src;
	}
