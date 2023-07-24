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


class MCF_Init {

	/**
	 * Initialize the class
	 */
	public function __construct() {

		$register_post_types		= new MCF_Register_Post_Types();
		$register_taxonomies		= new MCF_Register_Taxonomies();
		$add_mime_types				= new MCF_Add_Mime_Types();
		$remove_features			= new MCF_Remove_Unwated_Features();
		$custom_login				= new MCF_Customize_Login_Page();
		$metadata					= new MCF_Metadata();
		$gtm						= new MCF_GTM();
		$qv							= new MCF_Add_Query_Variables();
		$woocommerce				= new MCF_WooCommerce();
		$theme						= new MCF_Theme();

		if ( is_admin() ) {
			$admin					= new MCF_Admin();
		}


	}

}
