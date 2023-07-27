<?php
/**
 * Manage theme
 *
 * @package           MyCustomFunctions
 * @subpackage        MyCustomFunctions/includes
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */

class MCF_Theme {

	/**
	 * Initialize the class
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 1 );
		add_action( 'after_setup_theme', array( $this, 'load_blocks_styles' ) );

		add_action( 'init', array( $this, 'register_block_styles' ) );



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
	 * Enqueue styles.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function scripts() {

		if ( ! wp_theme_has_theme_json() ) {
			return;
		}

 		$theme_data = WP_Theme_JSON_Resolver::get_THEME_data()->get_raw_data();

		if (
			! array_key_exists( 'custom', $theme_data['settings'] ) ||
			! array_key_exists( 'scripts', $theme_data['settings']['custom'] ) ||
			! array_key_exists( 'styles', $theme_data['settings']['custom'] )
		) {
			return false;
		}

		$scripts	= $theme_data['settings']['custom']['scripts']['files'];
		$styles		= $theme_data['settings']['custom']['styles']['files'];


		$this->enqueue_theme_files( $styles, 'style' );
		$this->enqueue_theme_files( $scripts, 'script' );



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

			// Check required plugin dependencies
			// when loading assets from theme.json
			if ( isset( $file['plugins_deps'] ) ) {

				foreach ( $file['plugins_deps'] as $plugin ) {

					if ( ! is_plugin_active(  "$plugin.php" ) ) {
						return false;
					}

				}
			}



			if ( 'script' === $type ) {
				// Register theme scripts.
				wp_register_script(
					$file['handle'],
					get_theme_file_uri() . $file['src'],
					$file['deps'],
					$version_string
				);

				// Enqueue theme scripts.
				wp_enqueue_script( $file['handle'] );

			}

			if ( 'style' === $type ) {
				// Register theme stylesheet.
				wp_register_style(
					$file['handle'],
					get_theme_file_uri() . $file['src'],
					$file['deps'],
					$version_string
				);

				// Enqueue theme stylesheet.
				wp_enqueue_style( $file['handle'] );
			}
		}

	}
	function load_blocks_styles() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		$theme_slug = get_stylesheet();

		/*
		* Load additional block styles.
		*/
		foreach ( apply_filters( 'mcf_enqueue_block_style', array() ) as $blocks => $block ) {

			// Replace slash with hyphen for filename.
			$slug = str_replace( '/', '-', $block );

			// Enqueue asset.
			wp_enqueue_block_style( $block, array(
				'handle' => "$theme_slug-block-$slug",
				'src'    => get_theme_file_uri( "assets/blocks/$slug.css" ),
				'path'   => get_theme_file_path( "assets/blocks/$slug.css" ),
				'ver'	 => $this->get_theme_version()
			) );

		}


	}

	function register_block_styles() {

		// Register each block style with its label and CSS style
		if ( function_exists( 'register_block_style' ) ) {
			foreach ( apply_filters( 'mcf_register_block_style', array() ) as $block_name => $style_properties ) {

				register_block_style( $block_name, $style_properties );
			}
		}
	}
}
