<?php
/**
 * TwentyTwentychild Class
 *
 * @since    2.0.0
 * @package  storefront
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Twentytwentychild' ) ) :

	/**
	 * The main Twentytwentychild class
	 */
	class Twentytwentychild {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			// add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 10 );
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 30 ); // After WooCommerce.
		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		public function setup() {
			/*
			 * Load Localisation files.
			 *
			 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
			 */

			// Loads wp-content/languages/themes/storefront-it_IT.mo.
			load_theme_textdomain( 'storefront', trailingslashit( WP_LANG_DIR ) . 'themes' );

			// Loads wp-content/themes/child-theme-name/languages/it_IT.mo.
			load_theme_textdomain( 'storefront', get_stylesheet_directory() . '/languages' );

			// Loads wp-content/themes/storefront/languages/it_IT.mo.
			load_theme_textdomain( 'storefront', get_template_directory() . '/languages' );

			/**
			 * Add default posts and comments RSS feed links to head.
			 */
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#Post_Thumbnails
			 */
			add_theme_support( 'post-thumbnails' );

			/**
			 * Enable support for site logo.
			 */
			add_theme_support(
				'custom-logo',
				apply_filters(
					'storefront_custom_logo_args',
					array(
						'height'      => 110,
						'width'       => 470,
						'flex-width'  => true,
						'flex-height' => true,
					)
				)
			);

			/**
			 * Register menu locations.
			 */
			register_nav_menus(
				apply_filters(
					'storefront_register_nav_menus',
					array(
						'primary'   => __( 'Primary Menu', 'storefront' ),
						'secondary' => __( 'Secondary Menu', 'storefront' ),
						'handheld'  => __( 'Handheld Menu', 'storefront' ),
					)
				)
			);

			/*
			 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
			 * to output valid HTML5.
			 */
			add_theme_support(
				'html5',
				apply_filters(
					'storefront_html5_args',
					array(
						'search-form',
						'comment-form',
						'comment-list',
						'gallery',
						'caption',
						'widgets',
						'style',
						'script',
					)
				)
			);

			/**
			 * Setup the WordPress core custom background feature.
			 */
			add_theme_support(
				'custom-background',
				apply_filters(
					'storefront_custom_background_args',
					array(
						'default-color' => apply_filters( 'storefront_default_background_color', 'ffffff' ),
						'default-image' => '',
					)
				)
			);

			/**
			 * Setup the WordPress core custom header feature.
			 */
			add_theme_support(
				'custom-header',
				apply_filters(
					'storefront_custom_header_args',
					array(
						'default-image' => '',
						'header-text'   => false,
						'width'         => 1950,
						'height'        => 500,
						'flex-width'    => true,
						'flex-height'   => true,
					)
				)
			);

			/**
			 *  Add support for the Site Logo plugin and the site logo functionality in JetPack
			 *  https://github.com/automattic/site-logo
			 *  http://jetpack.me/
			 */
			add_theme_support(
				'site-logo',
				apply_filters(
					'storefront_site_logo_args',
					array(
						'size' => 'full',
					)
				)
			);

			/**
			 * Declare support for title theme feature.
			 */
			add_theme_support( 'title-tag' );

			/**
			 * Declare support for selective refreshing of widgets.
			 */
			add_theme_support( 'customize-selective-refresh-widgets' );

			/**
			 * Add support for Block Styles.
			 */
			add_theme_support( 'wp-block-styles' );

			/**
			 * Add support for full and wide align images.
			 */
			add_theme_support( 'align-wide' );

			/**
			 * Add support for editor styles.
			 */
			add_theme_support( 'editor-styles' );

			/**
			 * Add support for editor font sizes.
			 */
			add_theme_support(
				'editor-font-sizes',
				array(
					array(
						'name' => __( 'Small', 'storefront' ),
						'size' => 14,
						'slug' => 'small',
					),
					array(
						'name' => __( 'Normal', 'storefront' ),
						'size' => 16,
						'slug' => 'normal',
					),
					array(
						'name' => __( 'Medium', 'storefront' ),
						'size' => 23,
						'slug' => 'medium',
					),
					array(
						'name' => __( 'Large', 'storefront' ),
						'size' => 26,
						'slug' => 'large',
					),
					array(
						'name' => __( 'Huge', 'storefront' ),
						'size' => 37,
						'slug' => 'huge',
					),
				)
			);

			/**
			 * Enqueue editor styles.
			 */
			add_editor_style( array( 'assets/css/base/gutenberg-editor.css', $this->google_fonts() ) );

			/**
			 * Add support for responsive embedded content.
			 */
			add_theme_support( 'responsive-embeds' );

			add_theme_support(
				'amp',
				array(
					'nav_menu_toggle' => array(
						'nav_container_id'           => 'site-navigation',
						'nav_container_toggle_class' => 'toggled',
						'menu_button_id'             => 'site-navigation-menu-toggle',
						'menu_button_toggle_class'   => 'toggled',
					),
				)
			);
		}



		/**
		 * Enqueue scripts and styles.
		 *
		 * @since  1.0.0
		 */
		public function scripts() {
			global $version_string;

			/**
			 * Styles
			 */
			wp_enqueue_style( 'storefront-style', get_template_directory_uri() . '/style.css', '', $version_string );

			/**
			 * Scripts
			 */
			wp_enqueue_script( 'storefront-navigation', get_stylesheet_uri() . '/assets/js/navigation.js', array(), $version_string, true );

		}



	}
endif;

return new Twentytwentychild();
