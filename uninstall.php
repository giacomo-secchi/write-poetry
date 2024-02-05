<?php
/**
 * Functionality that is executed when WritePoetry is uninstalled via built-in WordPress commands.
 */


// if uninstall.php is not called by WordPress, die
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

if ( is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

use WritePoetry\Api\PluginConfig;

$config      = PluginConfig::getInstance();
$all_options = wp_load_alloptions();

// Delete all plugin options in wp_otions table
foreach ( $all_options as $option_name => $option_value ) {
	if ( stristr( $option_name, $config->prefix ) ) {
		delete_option( $option_name );

		// for site options in Multisite
		delete_site_option( $option_name );
	}
}

// Clear any cached data that has been removed.
wp_cache_flush();
