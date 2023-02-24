<?php
/**
 * Plugin Name: My Custom Functions
 * Plugin URI: http://yoursite.com
 * Description: This is an awesome custom plugin with functionality that I'd like to keep when switching things.
 * Author: Giacomo Secchi
 * Author URI: https://giacomosecchi.com
 * Version: 0.1.0
 */

/* Place custom code below this line. */


// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'MCF_Plugin' ) ) {
    class MCF_Plugin {
		/**
		 * Instance of the class
		 *
		 * @since 1.0.0
		 * @var Instance of CTF class
		 */
		private static $instance;

		/**
		 * This is our constructor
		 *
		 * @return void
		 */
		private function __construct() {
			// back end
			// add_action		( 'plugins_loaded', 					array( $this, 'textdomain'				) 			);
			// add_action		( 'admin_enqueue_scripts',				array( $this, 'admin_scripts'			)			);
			// add_action		( 'do_meta_boxes',						array( $this, 'create_metaboxes'		),	10,	2	);
			// add_action		( 'save_post',							array( $this, 'save_custom_meta'		),	1		);

			// front end
			// add_action		( 'wp_enqueue_scripts',					array( $this, 'front_scripts'			),	10		);
			// add_filter		( 'comment_form_defaults',				array( $this, 'custom_notes_filter'		) 			);
			add_filter		( 'style_loader_src',					array( $this, 'remove_query_string_from_static_files'	), 10, 2 );
			add_filter		( 'script_loader_src',					array( $this, 'remove_query_string_from_static_files'	), 10, 2 );

		}

		/**
		 * If an instance exists, this returns it.  If not, it creates one and
		 * retuns it.
		 *
		 * @return MCF_Plugin
		 */

		public static function getInstance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof MCF_Plugin ) ) {
				self::$instance = new MCF_Plugin;
			}
 			self::$instance->includes();


			return self::$instance;
		}


        // public static function init() {
        //     register_setting( 'wporg_settings', 'wporg_option_foo' );
        // }

        // public static function get_foo() {
        //     return get_option( 'wporg_option_foo' );
        // }

		public static function is_development_environment() {
			return in_array( wp_get_environment_type(), array( 'development', 'local' ), true );
		}

		// // Remove query string from static CSS files
		public static function remove_query_string_from_static_files( $src ) {

			if ( ! self::is_development_environment() ) {
				return;
			}

			if( strpos( $src, '?ver=' ) ) {
				$src = remove_query_arg( 'ver', $src );
			}

			return $src;
		}

		public static function disable_stuff() {

			$hook_names = array(
				'big_image_size_threshold'	// https://make.wordpress.org/core/2019/10/09/introducing-handling-of-big-images-in-wordpress-5-3/
			);

			foreach ( $hook_names as $hook_name ) {
				if ( empty( $hook_name ) ) {
					return;
				}

				add_filter( $hook_name, '__return_false' );
			}
		}

				/**
		 * Load the required files
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function includes() {
			$includes_path = plugin_dir_path( __FILE__ ) . 'includes/';
			// require_once $includes_path . 'includes/class-mcf-register-post-types.php';
			// require_once $includes_path . 'includes/class-mcf-register-taxonomies.php';
			// require_once $includes_path . 'includes/class-mcf-remove-admin-bar.php';
			// require_once $includes_path . 'includes/class-mcf-clean-up-head.php';
			// require_once $includes_path . 'includes/class-mcf-close-comments.php';
			// require_once $includes_path . 'includes/class-mcf-custom-feed-link.php';
			// require_once $includes_path . 'includes/class-mcf-insert-figure.php';
			// require_once $includes_path . 'includes/class-mcf-rcp-auto-renew.php';
			// require_once $includes_path . 'includes/class-mcf-long-url-spam.php';
			// require_once $includes_path . 'includes/class-mcf-remove-jetpack-bar.php';
			// require_once $includes_path . 'includes/class-mcf-add-mime-types.php';
			// require_once $includes_path . 'includes/class-mcf-remove-markdown-support.php';
			// require_once $includes_path . 'includes/class-mcf-add-email-feed.php';
			// require_once $includes_path . 'includes/class-mcf-increase-postmeta-form-limit.php';
			// require_once $includes_path . 'includes/class-mcf-limit-users-delete.php';
			// require_once $includes_path . 'includes/class-mcf-remove-unwanted-assets.php';
			// require_once $includes_path . 'includes/class-mcf-remove-post-author-url.php';
			// require_once $includes_path . 'includes/class-mcf-custom-pagi.php';
			// require_once $includes_path . 'includes/class-mcf-allowed-tags.php';


			// require_once $includes_path . 'includes/template-functions.php';
			// require_once $includes_path . 'includes/class-mcf-init.php';

			foreach ( glob($includes_path . "custom/*.php") as $file ) {
				require_once $file;
			}

		}

    }

    //MCF_Plugin::remove_query_string_from_static_files();

}




// Instantiate our class
$MCF_Plugin = MCF_Plugin::getInstance();
