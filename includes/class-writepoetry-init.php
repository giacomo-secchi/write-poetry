<?php
/**
 * Main Init Class
 *
 * @package           MyCustomFunctions
 * @subpackage        MyCustomFunctions/includes
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */


class WritePoetry_Init {

	/**
	 * Initialize the class
	 */
	public function __construct() {

		$register_taxonomies		= new WritePoetry_Register_Taxonomies();
		$add_mime_types				= new WritePoetry_Add_Mime_Types();
		$remove_features			= new WritePoetry_Remove_Unwated_Features();
		$custom_login				= new WritePoetry_Customize_Login_Page();
		$metadata					= new WritePoetry_Metadata();
		$gtm						= new WritePoetry_GTM();
		$woocommerce				= new WritePoetry_WooCommerce();

		if ( is_admin() ) {
			$admin					= new WritePoetry_Admin();
		}


	}

}
