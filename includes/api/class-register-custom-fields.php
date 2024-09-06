<?php
/**
 * Register custom post types
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Api
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.3.5
 */

namespace WritePoetry\Api;

use WritePoetry\Base\Base_Controller;


/**
 * Registers meta keys for posts class.
 */
class Register_Custom_Fields extends Base_Controller {


	/**
	 * Initialize the class
	 */
	public function register() {
		add_action( 'wp_loaded', array( $this, 'register_post_meta' ) );
	}


	/**
	 * Register All Post Type
	 *
	 * @since  0.3.5
	 * @access public
	 * @return void
	 */
	public function register_post_meta() {
    	// Get all post types.
		$post_types = get_post_types( array(), 'names' );

		// Loop through each post type and register custom fields.
		foreach ( $post_types as $post_type ) {
			$this->register_custom_field(
				apply_filters( "{$this->prefix}_add_custom_fields_to_{$post_type}", array() ),
				$post_type
			);
		}
	}

	/**
	 * Registers custom fields for a specific post type.
	 *
	 * @param array  $custom_fields Array of custom fields.
	 * @param string $post_type     Post type to register custom fields for.
	 */
	public function register_custom_field( $custom_fields, $post_type ) {

		// Default Post Type Arguments.
		$default_args = array(
			'show_in_rest'	=> true,
        	'single'		=> true,
        	'type'			=> 'string',
			'default'       => 'ciaone',
		);

		foreach ( $custom_fields as $custom_field => $args ) {
			if ( ! post_type_exists( $post_type ) ) {
				continue; // Use continue instead of return to avoid breaking the entire function
			}

			// Merge default arguments with specific arguments.
			$args = array_merge( $default_args, $args );

			// Register the meta field for the post type.
			register_post_meta( $post_type, $custom_field, $args );
		}

	}
}
