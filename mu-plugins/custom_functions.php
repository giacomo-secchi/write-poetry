<?php
/**
 * Plugin Name: Funzionalità custom del progetto
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


define( 'GTM4WP_HARDCODED_GTM_ID', 'GTM-W9CRL5D' );
define( 'GTM4WP_HARDCODED_GTM_ENV_AUTH', 'Dhr_-0vJuMvL70-rUd1YPA' );
define( 'GTM4WP_HARDCODED_GTM_ENV_PREVIEW', 'env-1' );

define( 'MCF_WOOCOMMERCE_REDIRECT_CHECKOUT', true );




// add elements to disable
add_filter( 'mcf_disable_features', function () {
	$args[] = 'woocommerce_sale_flash';
	// $args[] = 'woocommerce_twenty_twenty_two_styles';

	return $args;
}, 10, 1 );

 // Display or hide wheel based on show-wheel parameter
function eewc_query_vars( $qv ) {

    return array ( 'show-wheel', 'test-1');
};
// add the filter
add_filter( 'mcf_query_vars', 'eewc_query_vars' );




// add elements to disable
add_filter( 'mcf_disable_features', function () {
	$args[] = 'woocommerce_sale_flash';
	// $args[] = 'woocommerce_twenty_twenty_three_styles';

	return $args;
}, 10, 1 );



add_action( 'plugins_loaded', function () {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
});



add_filter( 'woocommerce_product_tabs', function( $tabs ) {

	// Remove additional information tab on Product Page
	unset( $tabs['reviews'] );
	unset( $tabs['additional_information'] );


	// Insert additional information into description tab on Product Page
	// $tabs['description']['callback'] = function() {
	// 	global $product;
	// 	wc_get_template( 'single-product/tabs/description.php' );

	// 	if ( $product && ( $product->has_attributes() || apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() ) ) ) {
	// 		wc_get_template( 'single-product/tabs/additional-information.php' );
	// 	}
	// };

	return $tabs;
}, 20 );




// Disable quantity selector for product and product variation
add_filter( 'woocommerce_quantity_input_args', function ( $args, $product ) {
    $args['max_value'] = 1;

    return $args;
}, 10, 2 );

add_filter( 'woocommerce_available_variation', function  ( $data, $product, $variation ) {
    $data['max_qty'] = 1;

    return $data;
}, 10, 3);










