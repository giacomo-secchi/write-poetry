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

use WritePoetry\Base\Base_Controller;

/**
 * Class Portfolio
 *
 * @package WritePoetry\Plugins\Jetpack
 */
class Portfolio extends Base_Controller {

	const CUSTOM_POST_TYPE = 'jetpack-portfolio';

	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {
		add_filter(
			'wp_loaded',
			function () {
				if ( ! post_type_exists( self::CUSTOM_POST_TYPE ) ) {
					return;
				}

 				add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_block_assets' ) );
				// Add meta box to ensure backward compatibility with the Classic Editor.
				add_action( 'add_meta_boxes', array( $this, 'add_portfolio_meta_box' ) );
				$this->register_portfolio_meta();
			}
		);


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
			"{$this->prefix}-gutenberg-sidebar",
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
		$meta_fields = array(
			'_writepoetry_project_url',
			'_writepoetry_project_date_from',
			'_writepoetry_project_date_to',
			'_writepoetry_project_client',
			'_writepoetry_project_expertise',
			'_writepoetry_project_industry',
		);
		foreach( $meta_fields as $meta_field ){
			$this->register_post_meta( $meta_field, array( 'type' => 'string' ) );
		}
	}

	/**
	 * Register post meta.
	 *
	 * @param string $meta_key Meta key.
	 * @param array  $args Meta args.
	 *
	 * @return void
	 */
	private function register_post_meta( $meta_key, $args ) {
		register_post_meta(
			self::CUSTOM_POST_TYPE,
			$meta_key,
			array(
				'show_in_rest'  => true,
				'type'          => $args['type'],
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
			"{$this->prefix}_post_options_metabox",
			'Post Options',
			"{$this->prefix}_post_options_metabox_html",
			self::CUSTOM_POST_TYPE,
			'normal',
			'default',
			array( '__back_compat_meta_box' => true )
		);
	}
}
