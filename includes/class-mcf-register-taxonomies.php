<?php
/**
 * Register Custom Taxonomies
 *
 * @package     MCF
 * @subpackage  MCF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

class MCF_Register_Taxonomies {

    /**
     * Initialize the class
     */
    public function __construct() {
        add_action( 'init', array( $this, 'register_sustom_taxonomies' ) );
    }

    /**
     * Register Custom Taxonomies
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function register_sustom_taxonomies() {


		$default_args = array(
			'hierarchical'               => true,
			'public'                     => true,
        );


		foreach ( apply_filters( 'mcf_add_custom_taxonomies', array() ) as $taxonomy => $args ) {
			if ( taxonomy_exists( $taxonomy ) ) {
				return;
			}

			$args = array_merge( $default_args, $args );

			$object_type = $args["post_type"];

			register_taxonomy( $taxonomy, $object_type, $args ); // Register Custom Post Type
		}
    }
}
