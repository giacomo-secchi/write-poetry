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


		$default_args = array(
			'show_in_rest' => true,
			'can_export' => true, // Allows export in Tools > Export
			'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
			'public' => true,
			'publicly_queryable'  => false,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail'
			),
		);


		foreach ( apply_filters( 'mcf_add_custom_post_types', array() ) as $post_type => $args ) {
			if ( post_type_exists( $post_type ) ) {
				return;
			}

			$args = array_merge( $default_args , $args );

			register_post_type( $post_type, $args ); // Register Custom Post Type
		}
    }
}
