<?php
/**
 * Admin Login Screen
 * 
 * @package           MyCustomFunctions
 * @subpackage        MyCustomFunctions/includes
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */

class MCF_Customize_Login_Page {

    /**
     * Initialize the class
     */
    public function __construct() {
		add_action		( 'login_head', 		array( $this, 'custom_loginlogo'	),	);
		add_filter		( 'login_headerurl', 	array( $this, 'custom_loginlogo_url'),	);
		add_filter		( 'login_headertext', 	array( $this, 'custom_login_title'	),	);
		add_filter		( 'login_title', 		array( $this, 'custom_login_title'	),	);
    }


	function custom_loginlogo() {
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );

			echo '<style>
			h1 a {
				background-image:url( ' . $image[0] . ') !important;
				width: 100% !important;
				background-size: contain !important;
			}
			</style>';
		}

	}

	function custom_loginlogo_url( $url ) {
		return esc_url( home_url( '/' ) );
	}


	function custom_login_title() {
		return get_bloginfo( 'name' );
	}
}
