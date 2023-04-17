<?php
/**
 * Plugin Name: Project engine room
 * Author: Giacomo Secchi
 * Author URI: https://giacomosecchi.com
 * Version: 1.0.0
 */

/* Place custom code below this line. */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}



 // custom code for the current project


define( 'GTM4WP_HARDCODED_GTM_ID', '' );
define( 'GTM4WP_HARDCODED_GTM_ENV_AUTH', '' );
define( 'GTM4WP_HARDCODED_GTM_ENV_PREVIEW', '' );

define( 'MCF_WOOCOMMERCE_REDIRECT_CHECKOUT', true );
define( 'MCF_WOOCOMMERCE_DISABLE_SINGLE_PRODUCT_QTY', true );
define( 'MCF_WOOCOMMERCE_DISABLE_PRODUCT_ZOOM', true );
// define( 'MCF_WOOCOMMERCE_QUANTITY_AS_SELECT', true );

define( 'MCF_WOOCOMMERCE_SINGLE_PRODUCT_ADDITIONAL_INFORMATIONS_LAYOUT', 'list' );

// add elements to disable
add_filter( 'mcf_disable_features', function () {
	$args[] = 'woocommerce_sale_flash';
	// $args[] = 'woocommerce_twenty_twenty_two_styles';

	return $args;
}, 10, 1 );


// Add parameters to url
add_filter( 'mcf_query_vars', function ( $qv ) {

    return array ( 'show-wheel', 'test-1');
} );






















