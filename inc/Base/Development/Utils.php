<?php
/**
 * Multipurpose class designed to help with development common daily problems.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */

namespace WritePoetry\Base\Development;


/**
 * Class Utils
 */
class Utils {
	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {

		if ( is_admin() ) {
			return false;
		}

		if ( apply_filters( 'writepoetry_remove_query_strings', false ) ) {
			add_filter( 'style_loader_src', array( $this, 'remove_query_string_from_static_files' ), 10, 2 );
			add_filter( 'script_loader_src', array( $this, 'remove_query_string_from_static_files' ), 10, 2 );
		}

	}


	/**
	 * Check if you are currently running on an development environment.
	 *
	 * @return boolean
	 */
	public static function is_development() {
		return in_array( wp_get_environment_type(), array( 'development', 'local' ), true );
	}


	// Remove version query string from static CSS files
	public static function remove_query_string_from_static_files( $src ) {
  		if ( strpos( $src, 'ver=' ) ) {
			$src = remove_query_arg( 'ver', $src );
		}

		return $src;
	}

}

