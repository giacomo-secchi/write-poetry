<?php
/**
 * Main Init Class
 *
 * @package     MCF
 * @subpackage  MCF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class MCF_Init {

	/**
	 * Initialize the class
	 */
	public function __construct() {

		$register_post_types     = new MCF_Register_Post_Types();
		// $register_taxonomies     = new MCF_Register_Taxonomies();
		// $remove_admin_bar 	     = new MCF_Remove_Admin_Bar();
		// $clean_up_head		     = new MCF_Clean_Up_Head();
		// $close_coments		     = new MCF_Close_Comments();
		// $custom_feed_link	     = new MCF_Custom_Feed_Link();
		// $insert_figure		     = new MCF_Insert_Figure();
		// $auto_renew			     = new MCF_RCP_Auto_Renew();
		// $long_url_spam		     = new MCF_Long_URL_Spam();
		// $remove_jetpack_bar      = new MCF_Remove_Jetpack_Bar();
		// $add_mime_types		     = new MCF_Add_Mime_Types();
		// $remove_markdown_support = new MCF_Remove_Markdown_Support();
		// $add_email_feed			 = new MCF_Add_Email_Feed();
		// $increase_form_limit	 = new MCF_Increase_Postmeta_Form_Limit();
		// $limit_users_delete		 = new MCF_Limit_Users_Delete();
		$remove_features			= new MCF_Remove_Unwated_Features();
		$tools						= new MCF_Dev_Tools();
		// $remove_post_author_url  = new MCF_Remove_Post_Author_Url();
		// $allowed_tags			 = new MCF_Allowed_Tags();

	}

}
