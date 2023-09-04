<?php
/**
 * Register custom post types
 *
 * @package           MyCustomFunctions
 * @subpackage        MyCustomFunctions/includes
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */

namespace WritePoetry;

class RegisterPostTypes {

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


		foreach ( apply_filters( 'writepoetry_add_custom_post_types', array() ) as $post_type => $args ) {
			if ( post_type_exists( $post_type ) ) {
				return;
			}

			$args = array_merge( $default_args , $args );

			register_post_type( $post_type, $args ); // Register Custom Post Type
		}
    }
}
