<?php
/**
 * Manage Thme.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/FSE
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.5
 */

namespace WritePoetry\FSE\Theme;

use WritePoetry\Base\BaseController;

/**
*
*/
class Assets extends BaseController {
/**
	 * Initialize the class
	 */
	public function register() {

		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 1 );
		add_action( 'after_setup_theme', array( $this, 'load_blocks_styles' ) );
	}

	/**
	 * Get theme version.
	 */
	public function get_theme_version() {

		$theme_version  = wp_get_theme()->get( 'Version' );
		$version_string = is_string( $theme_version ) ? $theme_version : false;

		return $version_string;
	}

	/**
	 * Get active theme name.
	 *
	 */
	public function get_theme_slug() {
		return get_stylesheet();
	}

	/**
	 * Enqueue styles.
	 *
	 * @return void
	 */
	function scripts() {

		// Get configuration data from write-poetry-theme.json
		$wp_theme_json_file =  get_theme_file_path( '/write-poetry-theme.json' );

		// Check if the file exists
		if ( ! file_exists( $wp_theme_json_file ) ) {
			return;
		}

		// Get the JSON string from the file
		// Decode the JSON string to a PHP array
 		$decoded_file = json_decode( file_get_contents( $wp_theme_json_file ), true );

		// Check if the necessary keys exist in the theme data.
		if ( ! array_key_exists( 'files', $decoded_file ) ) {
			return false;
		}

		foreach ( $decoded_file['files'] as $key => $value ) {
			$this->enqueue_theme_files( $value, $key );
		}
	}



	/**
	 *
	 *
	 * @param [type] $rules
	 * @return void
	 */
	private function check_conditional_tags( $params ) {


		foreach ( $params as $conditional_tag => $param ) {

			if ( strpos( $conditional_tag, 'is_' ) === 0 ) {

				if ( ! function_exists( $conditional_tag ) ) {
					return false;
				}

				foreach ( $param as $condition ) {
					if ( ! call_user_func( $conditional_tag, $condition ) ) {
						return false;
					}
				}
			}

		}

		return true; // All conditions are met.
	}


	/**
	 * Enqueue theme scripts or styles.
	 *
	 * @param array  $files
	 * @param string $type
	 */
	private function enqueue_theme_files( $files, $type ) {

		$version_string = empty( $file['ver'] ) ?  $this->get_theme_version() : $file['ver'];


		foreach ( $files as $file ) {
			// Check required dependencies
			// when loading assets from theme.json
			// Load the asset only if conditionals tags return true
			$this->check_conditional_tags( $file );

			$params = array(
				$file['handle']
			);

			if ( ! empty( $file['src'] ) ) {
				$params[] = get_theme_file_uri() . $file['src'];
			}

			if ( ! empty( $file['deps'] ) ) {
				$params[] = $file['deps'];
			} else {
				$params[] = array();
			}

			// avoid to print version if there is only handle param
			if ( count( $params ) > 1 ) {
				$params[] = $version_string;
			}

			if ( 'scripts' === $type ) {
				// Enqueue theme scripts.
				wp_enqueue_script( ...$params );
			}

			if ( 'styles' === $type ) {
				if ( ! empty( $file['media'] ) ) {
					$params[] = $file['media'];
				}

				// Enqueue theme stylesheet.
				wp_enqueue_style( ...$params );
			}
		}
	}

	/**
	 * Enqueues a stylesheet for a specific block.
	 *
	 * @return void
	 */
	function load_blocks_styles() {

		// Retrieve active theme name in order to prefix the handle for the stylesheet.
		$theme_slug = $this->get_theme_slug();

		// Get the base assets path using a filter hook.
		// This allows customization of the path through the 'writepoetry_blocks_styles_asset_path' filter.
		$base_assets_path = apply_filters( "{$this->prefix}_blocks_styles_asset_path", join( DIRECTORY_SEPARATOR, array('assets', 'css', 'blocks') ) );

		// Use glob to get the list of stylesheets files in the assets folder
		$blocks_path = glob( get_theme_file_path( $base_assets_path ) .'/*/*.css' );

		/*
		* Load additional block styles.
		*/
		foreach ( $blocks_path as $block_path ) {

			$block_info = pathinfo( $block_path );

			// Reconstruct block name core/site-title
			$block_name = basename( $block_info['dirname'] ) . '/' . $block_info['filename'];

			// Replace slash with hyphen for filename.
			$block_slug = str_replace( '/', '-', $block_name );

			// Enqueue asset.
			wp_enqueue_block_style( $block_name, array(
				'handle' => "$theme_slug-block-$block_slug",
				'src'    => get_theme_file_uri( "$base_assets_path/$block_name.css" ),
				'path'   => wp_normalize_path( $block_path ),
				'ver'	 => $this->get_theme_version()
			) );
		}
	}
}

