<?php
/**
 * Register custom post types
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

class MCF_Register_Post_Types {

    /**
     * Initialize the class
     */
    public function __construct() {
	   add_action		( 'init',								array( $this, 'register_post_types'		),			);
    }


    /**
     * Register All Post Type
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function register_post_types() {
		$args = array();

		foreach ( apply_filters( 'mcf_add_custom_post_types',  $args ) as $post_type_slug => $post_type_config ) {
			if ( post_type_exists( $post_type_slug ) ) {
				return;
			}

			register_post_type( $post_type_slug, $post_type_config ); // Register Custom Post Type
		}
    }
}
