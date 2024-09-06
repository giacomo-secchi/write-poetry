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
use WritePoetry\Api\Register_Custom_Fields;

/**
 * Class Portfolio
 *
 * @package WritePoetry\Plugins\Jetpack
 */
class Portfolio extends Base_Controller {

	const CUSTOM_POST_TYPE = 'jetpack-portfolio';

	private $register_custom_fields;


	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {

		$this->register_custom_fields = new Register_Custom_Fields();

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
	 * Register portfolio custom meta fields.
	 *
	 * @return void
	 */
	public function register_portfolio_meta() {
		$default_args = array(
        	'type'			=> 'string',
			'default'       => 'project_',
		);

		$meta_fields = array(
			"{$this->prefix}_project_url" =>  $default_args,
			"{$this->prefix}_project_year" => array(
				'type' => 'number',
				'default' => date( 'Y' ),
				'description' =>  'Year of the project',
			),
			"{$this->prefix}_project_client" =>  $default_args,
			"{$this->prefix}_project_expertise" =>  $default_args,
			"{$this->prefix}_project_industry" =>  $default_args
		);

		// Register custom fields for the portfolio post type.
		$this->register_custom_fields->register_custom_field( $meta_fields, self::CUSTOM_POST_TYPE );
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
