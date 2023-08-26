<?php
/**
 * Add new mime types.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */

namespace WritePoetry\Base;


/**
*
*/
class AddMimeTypes {
	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {

		add_filter( 'upload_mimes', array( $this, 'add_mime_type' ) );
	}

	public function add_mime_type( $mimes ) {
		// New allowed mime types.
		$mimes['svg']  = 'image/svg+xml';
 		$mimes['doc']  = 'application/msword';
		// SVGZ allowed mime types.
		$mimes['svgz'] = 'application/x-gzip';

		// Allow uploading fonts files.
		$mimes['ttf']   = 'font/ttf';
		$mimes['woff']  = 'font/woff';
		$mimes['woff2'] = 'font/woff2';

		// Allow CSV file type.
		$types['csv'] = 'text/csv';

		// To upload photos in format WebP
		$mimes['webp'] = 'image/webp';


		// Optional. Remove a mime type.
		unset( $mimes['exe'] );

		return $mimes;
	}

}

