<?php
/**
 * Remove unwanted assets
 *
 * @package           MyCustomFunctions
 * @subpackage        MyCustomFunctions/includes
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */

class WritePoetry_Dev_Tools {

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

}
