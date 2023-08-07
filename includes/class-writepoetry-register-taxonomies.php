<?php
/**
 * Register Custom Taxonomies
 *
 * @package           MyCustomFunctions
 * @subpackage        MyCustomFunctions/includes
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */

class WritePoetry_Register_Taxonomies {

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
			'show_in_nav_menus'          => true
        );


		foreach ( apply_filters( 'writepoetry_add_custom_taxonomies', array() ) as $taxonomy => $args ) {
			if ( taxonomy_exists( $taxonomy ) ) {
				return;
			}

			$args = array_merge( $default_args, $args );

			$object_type = $args["post_type"];

			register_taxonomy( $taxonomy, $object_type, $args ); // Register Custom Post Type
		}
    }
}
