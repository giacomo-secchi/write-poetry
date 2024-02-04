<?php
/**
 * Register Custom Taxonomies.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Api
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.5
 */

namespace WritePoetry\Api;

use WritePoetry\Base\BaseController;

class RegisterPostTaxonomies extends BaseController {

	/**
	 * Initialize the class
	 */
	public function register() {
		add_action( 'init', array( $this, 'register_custom_taxonomies' ) );
	}

	/**
	 * Register Custom Taxonomies
	 *
	 * @since  0.2.5
	 * @access public
	 * @return void
	 */
	public function register_custom_taxonomies() {

		$default_args = array(
			'hierarchical'      => true,
			'public'            => true,
			'show_in_nav_menus' => true,
		);

		foreach ( apply_filters( "{$this->prefix}_add_custom_taxonomies", array() ) as $taxonomy => $args ) {
			if ( taxonomy_exists( $taxonomy ) ) {
				return;
			}

			$args = array_merge( $default_args, $args );

			$object_type = $args['post_type'];

			register_taxonomy( $taxonomy, $object_type, $args ); // Register Custom Post Type
		}
	}
}
