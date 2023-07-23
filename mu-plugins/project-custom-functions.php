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

// define( 'MCF_WOOCOMMERCE_REDIRECT_CHECKOUT', true );
 define( 'MCF_WOOCOMMERCE_DISABLE_SINGLE_PRODUCT_QTY', false );
// define( 'MCF_WOOCOMMERCE_ENABLE_PRODUCT_ZOOM', true );

// define( 'MCF_WOOCOMMERCE_QUANTITY_INPUT_LAYOUT', 'input' );
// define( 'MCF_WOOCOMMERCE_MAX_QUANTITY_INPUT', 20 );


// Possible vaules are accordion, tabs or list
// define( 'MCF_WOOCOMMERCE_SINGLE_PRODUCT_ADDITIONAL_INFORMATIONS_LAYOUT', 'list' );

// add elements to disable
add_filter( 'mcf_disable_features', function () {
	$args[] = 'woocommerce_sale_flash';
	// $args[] = 'woocommerce_twenty_twenty_two_styles';

	return $args;
}, 10, 1 );


// Add parameters to url
add_filter( 'mcf_query_vars', function () {
    return array( 'show-wheel', 'test-1' );
} );


add_filter( 'woocommerce_quantity_input_step', function ( $step, $product ) {
	return 5;
}, 10, 2 );


add_filter( 'mcf_add_custom_taxonomies', function () {
 	$string = array(
		'product-type' => array(
			'post_type' => 'product',
			'labels' => array(
				'name' => esc_html( 'Product Type' )
			),
			'show_ui'                    => true,
			// 'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true
		),
		'product-format' => array(
			'post_type' => 'product',
			'labels' => array(
				'name' => esc_html( 'Product Format' )
			),
			'show_ui'                    => true,
			'show_tagcloud'              => true
		),
	);

	return $string;
}, 10, 3 );





add_filter( 'mcf_add_custom_post_types', function () {
	$string = array(
		'come-raggiungerci' =>
			array(
				'labels' => array(
					'name' => esc_html( 'Come Raggiungerci' ),
					'singular_name' => esc_html( 'Come Raggiungerci' )
				),
				'publicly_queryable'  => true,
			),
		'punti_di_interesse' =>
			array(
				'labels' => array(
					'name' => esc_html( 'Napoli e Dintorni' ),
					'singular_name' => esc_html( 'Napoli e Dintorni' )
				)
			),

		'escursioni' =>
			array(
				'labels' => array(
					'name' => 'Transfer ed Escursioni',
					'singular_name' => 'Escursione'
				),
				'publicly_queryable'  => true,
			)
	);

	return $string;
}, 10, 3 );










