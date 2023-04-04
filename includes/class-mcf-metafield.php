<?php
/**
 * Remove unwanted assets
 *
 * @package     MCF
 * @subpackage  MCF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class MCF_Metadata {

	/**
	 * Initialize the class
	 */
	public function __construct() {

		add_action		( 'enqueue_block_editor_assets', 		array( $this, 'enqueue_block_assets' ) );
		// add_action		( 'add_meta_boxes',						array( $this, 'add_portfolio_meta_box' ) );
		add_action		( 'init', 								array( $this, 'register_portfolio_meta' ) );

	}



	/**
	 * Requre build file
	 *
	 * @param [type] $src
	 * @return void
	 */
	public static function enqueue_block_assets() {
		wp_enqueue_script( 'mcf-gutenberg-sidebar', plugins_url( 'build/index.js', __DIR__ ), array( 'wp-plugins', 'wp-edit-post', 'wp-element', 'wp-components', 'wp-data' )
	);
	}


	public function register_portfolio_meta() {

		register_post_meta(
			'jetpack-portfolio',
			'_mcf_project_year',
			 array(
				'show_in_rest' => true,
				'type' => 'number',
				'single' => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				}
			)
		);

		register_post_meta(
			'jetpack-portfolio',
			'_mcf_project_client',
				array(
					'show_in_rest' => true,
					'type' => 'string',
					'single' => true,
					'auth_callback' => function () {
						return current_user_can( 'edit_posts' );
					}
			)
		);

		register_post_meta(
			'jetpack-portfolio',
			'_mcf_project_expertise',
				array(
					'show_in_rest' => true,
					'type' => 'string',
					'single' => true,
					'auth_callback' => function () {
						return current_user_can( 'edit_posts' );
					}
			)
		);

		register_post_meta(
			'jetpack-portfolio',
			'_mcf_project_industry',
				array(
					'show_in_rest' => true,
					'type' => 'string',
					'single' => true,
					'auth_callback' => function () {
						return current_user_can( 'edit_posts' );
					}
			)
		);
	}

	public function add_portfolio_meta_box() {
		add_meta_box(
			'myprefix_post_options_metabox',
			'Post Options',
			'myprefix_post_options_metabox_html',
			'jetpack-portfolio',
			'normal',
			'default',
			array( '__back_compat_meta_box' => true )
		);
	}
}

