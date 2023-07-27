<?php
/**
 * Add metafields to portfolio CPT
 *
 * @package           MyCustomFunctions
 * @subpackage        MyCustomFunctions/includes
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */

class MCF_Metadata {

	/**
	 * Initialize the class
	 */
	public function __construct() {

		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_block_assets' ) );
		// add_action( 'add_meta_boxes', array( $this, 'add_portfolio_meta_box' ) );
		add_action( 'init', array( $this, 'register_portfolio_meta' ) );
	}



	/**
	 * Require build file
	 *
	 * @param [type] $src
	 * @return void
	 */
	public static function enqueue_block_assets() {
		// Automatically load imported dependencies and assets version.
		$asset_file = include( MCF__PLUGIN_DIR . 'build/index.asset.php' );

		wp_enqueue_script(
			'mcf-gutenberg-sidebar',
			plugins_url( 'build/index.js', __DIR__ ),
			$asset_file['dependencies'],
    		$asset_file['version']
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

