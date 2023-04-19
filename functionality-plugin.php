<?php
/**
 * Plugin Name: My Custom Functions
 * Plugin URI: https://github.com/giacomo-secchi/functionality-plugin
 * Description: This is an awesome custom plugin with functionality that I'd like to keep when switching things.
 * Author: Giacomo Secchi
 * Author URI: https://giacomosecchi.com
 * Version: 0.1.0
 */

/* Place custom code below this line. */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}



/**
 * Check plugin version and update it
 *
 * @link https://www.smashingmagazine.com/2015/08/deploy-wordpress-plugins-with-github-using-transients/
 */


define( 'MCF__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if ( ! defined( 'MCF__GITHUB_USERNAME' ) ) {
	define( 'MCF__GITHUB_USERNAME', 'giacomo-secchi'  );
}

if ( ! defined( 'MCF__GITHUB_REPO' ) ) {
	define( 'MCF__GITHUB_REPO', 'functionality-plugin' );
}

if ( ! class_exists( 'Smashing_Updater' ) ){
	include_once( plugin_dir_path( __FILE__ ) . 'updater.php' );
}

$updater = new Smashing_Updater( __FILE__ );
$updater->set_username( MCF__GITHUB_USERNAME );
$updater->set_repository( MCF__GITHUB_REPO );
/*
	$updater->authorize( 'abcdefghijk1234567890' ); // Your auth code goes here for private repos
*/
$updater->initialize();



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
		private function __construct() {}

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
			self::$instance->init = new MCF_Init();


			return self::$instance;
		}


		public static function is_development_environment() {
			return in_array( wp_get_environment_type(), array( 'development', 'local' ), true );
		}


		/**
		 * Load the required files
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function includes() {

			$includes_path = MCF__PLUGIN_DIR . 'includes/';
			require_once $includes_path . 'class-mcf-register-post-types.php';
			// require_once $includes_path . 'class-mcf-register-taxonomies.php';
			// require_once $includes_path . 'class-mcf-remove-admin-bar.php';
			// require_once $includes_path . 'class-mcf-clean-up-head.php';
			// require_once $includes_path . 'class-mcf-close-comments.php';
			// require_once $includes_path . 'class-mcf-custom-feed-link.php';
			// require_once $includes_path . 'class-mcf-insert-figure.php';
			// require_once $includes_path . 'class-mcf-rcp-auto-renew.php';
			// require_once $includes_path . 'class-mcf-long-url-spam.php';
			// require_once $includes_path . 'class-mcf-remove-jetpack-bar.php';
			require_once $includes_path . 'class-mcf-add-mime-types.php';
			// require_once $includes_path . 'class-mcf-remove-markdown-support.php';
			// require_once $includes_path . 'class-mcf-add-email-feed.php';
			// require_once $includes_path . 'class-mcf-increase-postmeta-form-limit.php';
			// require_once $includes_path . 'class-mcf-limit-users-delete.php';
			require_once $includes_path . 'class-mcf-remove-unwanted-features.php';
			// require_once $includes_path . 'class-mcf-dev-tools.php';
			require_once $includes_path . 'class-mcf-metafield.php';
			require_once $includes_path . 'class-mcf-customize-login-page.php';
			require_once $includes_path . 'class-mcf-gtm.php';
			require_once $includes_path . 'class-mcf-set-query-vars.php';
			require_once $includes_path . 'class-mcf-woocommerce.php';
			// require_once $includes_path . 'class-mcf-remove-post-author-url.php';
			// require_once $includes_path . 'class-mcf-custom-pagi.php';
			// require_once $includes_path . 'class-mcf-allowed-tags.php';


			// require_once $includes_path . 'template-functions.php';
			require_once $includes_path . 'class-mcf-init.php';

		}
    }
}


/**
 * Return the instance
 *
 * @since 1.0.0
 * @return object The Safety Links instance
 */
function MCF_Run() {
	return MCF_Plugin::getInstance();
}
MCF_Run();
