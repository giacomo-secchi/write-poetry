<?php
/**
 * Manage Thme.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/FSE
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */

namespace WritePoetry\FSE\Theme;


/**
*
*/
class Assets {
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

		if ( ! wp_theme_has_theme_json() ) {
			return;
		}

		// Get configuration data from theme.json
 		$theme_data = \WP_Theme_JSON_Resolver::get_THEME_data()->get_raw_data();

		if (
			! array_key_exists( 'custom', $theme_data['settings'] ) ||
			! array_key_exists( 'scripts', $theme_data['settings']['custom'] ) ||
			! array_key_exists( 'styles', $theme_data['settings']['custom'] )
		) {
			return false;
		}

		$scripts	= $theme_data['settings']['custom']['scripts']['files'];
		$styles		= $theme_data['settings']['custom']['styles']['files'];

		// $this->enqueue_theme_files( $styles, 'style' );
		$this->enqueue_theme_files( $scripts, 'script' );
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

			$default_options = array(
				$file['handle'],
				get_theme_file_uri() . $file['src'],
				$file['deps'],
				$version_string
			);

			if ( 'script' === $type ) {
				// Enqueue theme scripts.
				wp_enqueue_script( ...$default_options );

			}

			if ( 'style' === $type ) {
				// Enqueue theme stylesheet.
				wp_enqueue_style( ...$default_options );
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
		$base_assets_path = apply_filters( 'writepoetry_blocks_styles_asset_path', 'assets/css/blocks' );

		// Use glob to get the list of stylesheets files in the assets folder
		$blocks = glob( get_theme_file_path( $base_assets_path ) .'/*/*.css' );

		/*
		* Load additional block styles.
		*/
		foreach ( $blocks as $block ) {

			$file_path = pathinfo( $block );

			// Reconstruct block name core/site-title
			$block_name = basename( $file_path['dirname'] ) . '/' . $file_path['filename'];

			// Replace slash with hyphen for filename.
			$block_slug = str_replace( '/', '-', $block_name );

			// Enqueue asset.
			wp_enqueue_block_style( $block_name, array(
				'handle' => "$theme_slug-block-$block_slug",
				'src'    => get_theme_file_uri( $base_assets_path . '/' . $file_path['basename'] ),
				'path'   => $block,
				'ver'	 => $this->get_theme_version()
			) );

		}


	}


}

