<?php

// Testing for Anumit Jooloor

// if uninstall.php is not called by WordPress, die
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}


use \WritePoetry\Api\PluginConfig;

$config = PluginConfig::getInstance();
$all_options = wp_load_alloptions();

foreach ( $all_options as $option_name => $option_value ) {
	if ( stristr( $option_name, $config->prefix ) ) {
		delete_option( $option_name );

		// for site options in Multisite
		delete_site_option( $option_name );
	}
}

// Clear any cached data that has been removed.
wp_cache_flush();

