<?php
/**
 * My Custom Functions
 *
 * @package           MyCustomFunctions
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       My Custom Functions
 * Plugin URI:        https://github.com/giacomo-secchi/functionality-plugin
 * Description:       This is an awesome custom plugin with functionality that I'd like to keep when switching things.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Giacomo Secchi
 * Author URI:        https://resume.giacomosecchi.com
 * Text Domain:       my-custom-functions
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://github.com/giacomo-secchi/functionality-plugin/
 */

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
			require_once $includes_path . 'class-mcf-register-taxonomies.php';
			require_once $includes_path . 'class-mcf-add-mime-types.php';
			require_once $includes_path . 'class-mcf-remove-unwanted-features.php';
			require_once $includes_path . 'class-mcf-metafield.php';
			require_once $includes_path . 'class-mcf-customize-login-page.php';
			require_once $includes_path . 'class-mcf-gtm.php';
			require_once $includes_path . 'class-mcf-set-query-vars.php';
			require_once $includes_path . 'class-mcf-woocommerce.php';
			require_once $includes_path . 'class-mcf-init.php';

			if ( is_admin() ) {
				// we are in admin mode
				require_once $includes_path . '/admin/functionality-plugin-admin.php';
			}

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
