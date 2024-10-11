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
 * Version:           0.3.7
 * Requires at least: 5.9
 * Requires PHP:      7.2
 * Author:            Giacomo Secchi
 * Author URI:        https://resume.giacomosecchi.com
 * Text Domain:       write-poetry
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://github.com/giacomo-secchi/write-poetry/
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


if ( is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}


/**
 * The code that runs during plugin activation
 */
register_activation_hook(
	__FILE__,
	function () {
		WritePoetry\Base\Activate::activate();
	}
);


/**
 * The code that runs during plugin deactivation
 */
register_deactivation_hook(
	__FILE__,
	function () {
		WritePoetry\Base\Deactivate::deactivate();
	}
);


/**
 * Initialize all the core classes of the plugin
 *
 * @since 0.2.2
 */
if ( class_exists( 'WritePoetry\\Init' ) ) {
	WritePoetry\Init::register_services();
}
