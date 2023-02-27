<?php
/**
 * Remove unwanted assets
 *
 * @package     MCF
 * @subpackage  MCF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class MCF_Dev_Tools {

	/**
	 * Initialize the class
	 */
	public function __construct() {

		add_filter		( 'style_loader_src',					array( $this, 'remove_query_string_from_static_files'	), 10, 2 );
		add_filter		( 'script_loader_src',					array( $this, 'remove_query_string_from_static_files'	), 10, 2 );

	}



	// Remove query string from static CSS files
	public static function remove_query_string_from_static_files( $src ) {
		if ( ! MCF_Plugin::is_development_environment() ) {
			return;
		}

		if( strpos( $src, '?ver=' ) ) {
			$src = remove_query_arg( 'ver', $src );
		}

		return $src;
	}

}
