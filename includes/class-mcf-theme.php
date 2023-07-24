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

		$theme_uri 	= is_child_theme() ? get_stylesheet_directory_uri() : get_template_directory_uri();
		$theme_data = WP_Theme_JSON_Resolver::get_THEME_data()->get_raw_data();
		$scripts 	= $theme_data['settings']['custom']['scripts'];
		$styles 	= $theme_data['settings']['custom']['styles'];


		foreach ( $scripts as $script ) {

			$version_string = empty( $script['ver'] ) ?  $this->get_theme_version() : $script['ver'];

			// Register theme stylesheet.
			wp_register_script(
				$script['handle'],
				$theme_uri . $script['src'],
				$script['deps'],
				$version_string
			);

			// Enqueue theme stylesheet.
			wp_enqueue_script( $script['handle'] );
		}


		foreach ( $styles as $style ) {

			$version_string = empty( $style['ver'] ) ?  $this->get_theme_version() : $style['ver'];


			// Register theme stylesheet.
			wp_register_style(
				$style['handle'],
				$theme_uri . $style['src'],
				$style['deps'],
				$version_string
			);

			// Enqueue theme stylesheet.
			wp_enqueue_style( $style['handle'] );
		}


	}

}

