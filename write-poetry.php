<?php
/**
 * Write Poetry
 *
 * @package           WritePoetry
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Write Poetry
 * Plugin URI:        https://github.com/giacomo-secchi/write-poetry
 * Description:       The Swiss knife plugin designed for developers and advanced users. Unlock the full potential of WordPress with this versatile tool. Empower your workflow without getting your hands dirty.
 * Version:           0.2.4
 * Requires at least: 5.9
 * Requires PHP:      7.2
 * Author:            Giacomo Secchi
 * Author URI:        https://resume.giacomosecchi.com
 * Text Domain:       writepoetry
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://github.com/giacomo-secchi/write-poetry/
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


if ( is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
    require __DIR__ . '/vendor/autoload.php';
}



/**
 * Check plugin version and update it
 *
 * @link https://www.smashingmagazine.com/2015/08/deploy-wordpress-plugins-with-github-using-transients/
 */



define( 'WRITEPOETRY_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );


if ( ! defined( 'WRITEPOETRY_GITHUB_USERNAME' ) ) {
	define( 'WRITEPOETRY_GITHUB_USERNAME', 'giacomo-secchi'  );
}

if ( ! defined( 'WRITEPOETRY_GITHUB_REPO' ) ) {
	define( 'WRITEPOETRY_GITHUB_REPO', 'write-poetry' );
}

if ( ! class_exists( 'Smashing_Updater' ) ){
	include_once( plugin_dir_path( __FILE__ ) . 'updater.php' );
}

$updater = new Smashing_Updater( __FILE__ );
$updater->set_username( WRITEPOETRY_GITHUB_USERNAME );
$updater->set_repository( WRITEPOETRY_GITHUB_REPO );
/*
	$updater->authorize( 'abcdefghijk1234567890' ); // Your auth code goes here for private repos
*/
$updater->initialize();



if ( ! class_exists( 'WritePoetry_Plugin' ) ) {
    class WritePoetry_Plugin {
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
		 * @return WritePoetry_Plugin
		 */

		public static function getInstance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof WritePoetry_Plugin ) ) {
				self::$instance = new WritePoetry_Plugin;
			}
 			self::$instance->includes();
			self::$instance->init = new WritePoetry_Init();


			return self::$instance;
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

			require_once $includes_path . 'class-writepoetry-register-taxonomies.php';
			require_once $includes_path . 'class-writepoetry-remove-unwanted-features.php';
			require_once $includes_path . 'class-writepoetry-woocommerce.php';
			require_once $includes_path . 'class-writepoetry-init.php';




			if ( is_admin() ) {
				// we are in admin mode
				require_once $includes_path . '/admin/class-writepoetry-admin.php';
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
function WritePoetry_Run() {
	return WritePoetry_Plugin::getInstance();
}
WritePoetry_Run();


/**
 * Initialize all the core classes of the plugin
 * @since 0.2.2
 */
if ( class_exists( 'WritePoetry\\Init' ) ) {
	WritePoetry\Init::register_services();
}
