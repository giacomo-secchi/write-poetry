<?php
/**
 * Add metafields to portfolio CPT.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.4
 */

namespace WritePoetry\Plugins\Jetpack;

use WritePoetry\Base\BaseController;

/**
 * Class Portfolio
 *
 * @package WritePoetry\Plugins\Jetpack
 */
class Portfolio extends BaseController {
	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_block_assets' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_portfolio_meta_box' ) );
		add_action( 'init', array( $this, 'register_portfolio_meta' ) );
	}


	/**
	 * Require build file
	 *
	 * @return void
	 */
	public function enqueue_block_assets() {
		$file_name = 'plugin-jetpack';

		// Automatically load imported dependencies and assets version.
		$asset_file = include sprintf( '%s%s%s.asset.php', $this->build_path, DIRECTORY_SEPARATOR, $file_name );

		$args = array(
			'in_footer' => true,
		);

		wp_enqueue_script(
			'writepoetry-gutenberg-sidebar',
			sprintf( '%s/%s.js', $this->build_url, $file_name ),
			$asset_file['dependencies'],
			$asset_file['version'],
			$args
		);
	}

	/**
	 * Register portfolio meta.
	 *
	 * @return void
	 */
	public function register_portfolio_meta() {

		register_post_meta(
			'jetpack-portfolio',
			'_writepoetry_project_year',
			array(
				'show_in_rest'  => true,
				'type'          => 'number',
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_post_meta(
			'jetpack-portfolio',
			'_writepoetry_project_client',
			array(
				'show_in_rest'  => true,
				'type'          => 'string',
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_post_meta(
			'jetpack-portfolio',
			'_writepoetry_project_expertise',
			array(
				'show_in_rest'  => true,
				'type'          => 'string',
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_post_meta(
			'jetpack-portfolio',
			'_writepoetry_project_industry',
			array(
				'show_in_rest'  => true,
				'type'          => 'string',
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}

	/**
	 * Add portfolio meta box.
	 *
	 * @return void
	 */
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
