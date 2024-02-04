<?php
/**
 * Add new mime types.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.5
 */

namespace WritePoetry\Base;

/**
 *
 */
class AddMimeTypes {

	public $media_types = array();

	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {

		// New allowed mime types.
		$this->media_types = array(
			'svg'   => 'image/svg+xml',

			// SVGZ allowed mime types.
			'svgz'  => 'application/x-gzip',

			// Allow uploading fonts files.
			'ttf'   => 'font/ttf',
			'woff'  => 'font/woff',
			'woff2' => 'font/woff2',
		);

		add_filter( 'upload_mimes', array( $this, 'addMimeType' ) );
		add_filter( 'mime_types', array( $this, 'addMimeType' ) );
	}


	public function addMimeType( $mimes ) {

		foreach ( $this->media_types as $t => $media_type ) {
			$mimes[ $t ] = $media_type;
		}

		return $mimes;
	}
}
