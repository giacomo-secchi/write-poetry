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



/**
 * Initialize all the core classes of the plugin
 * @since 0.2.2
 */
if ( class_exists( 'WritePoetry\\Init' ) ) {
	WritePoetry\Init::register_services();
}
