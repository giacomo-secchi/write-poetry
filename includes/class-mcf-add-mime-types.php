<?php
/**
 * Add new mime types
 * 
 * @package           MyCustomFunctions
 * @subpackage        MyCustomFunctions/includes
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */

class MCF_Add_Mime_Types {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_filter( 'upload_mimes', array( $this, 'add_svg' ) );
	}

	/**
     * Add SVG mime type
     *
     * @since  1.0.0
     * @access public
     * @return viod
     */
	public function add_svg( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

}
