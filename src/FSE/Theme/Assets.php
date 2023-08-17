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

		// add_action( 'init', array( $this, 'register_block_styles' ) );



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

				foreach ($param as $condition ) {

					if ( ! call_user_func( $conditional_tag, $condition ) ) {
						return false;
					}
				}
			}
		}


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

		$assets_path = apply_filters( 'writepoetry_blocks_additional_asset_path', 'assets/blocks' );
		/*
		* Load additional block styles.
		*/
		foreach ( apply_filters( 'writepoetry_enqueue_blocks_style', array() ) as $styled_blocks => $block ) {

			// Replace slash with hyphen for filename.
			$slug = str_replace( '/', '-', $block );

			// Enqueue asset.
			wp_enqueue_block_style( $block, array(
				'handle' => "$theme_slug-block-$slug",
				'src'    => get_theme_file_uri( "$assets_path/$slug.css" ),
				'path'   => get_theme_file_path( "$assets_path/$slug.css" ),
				'ver'	 => $this->get_theme_version()
			) );

		}


	}

	function register_block_styles() {

		// Register each block style with its label and CSS style
		if ( function_exists( 'register_block_style' ) ) {
			foreach ( apply_filters( 'writepoetry_register_block_style', array() ) as $block_name => $style_properties ) {

				register_block_style( $block_name, $style_properties );
			}
		}
	}
}

