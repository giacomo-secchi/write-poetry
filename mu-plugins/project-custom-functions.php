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


define( 'GTM4WP_HARDCODED_GTM_ID', 'GTM-XXXXXX' );
define( 'GTM4WP_HARDCODED_GTM_ENV_AUTH', '' );
define( 'GTM4WP_HARDCODED_GTM_ENV_PREVIEW', '' );



add_filter( 'pre_option_writepoetry_product_zoom', function ( $default ) {
	return 'yes';
} );

add_filter( 'pre_option_writepoetry_product_quantity_layout', function ( $default ) {
	// 'hidden';
	// 'input';
	// 'buttons';
	// 'select';
	return 'buttons';
} );



add_filter( 'option_writepoetry_redirect_after_add', function ( $default ) {
	// 'product-checkout';
	// 'product-cart';
	// 'checkout';
	// 'cart';
	return 'checkout';
} );

add_filter( 'pre_option_writepoetry_redirect_after_add', function ( $default ) {
	// 'product-checkout';
	// 'product-cart';
	// 'checkout';
	// 'cart';
	return 'checkout';
} );


add_filter( 'pre_option_writepoetry_product_max_quantity', function ( $default ) {
	return 20;
} );


add_filter( 'pre_option_writepoetry_product_min_quantity', function ( $default ) {
	return 2;
} );



add_filter( 'pre_option_writepoetry_quantity_input_step', function ( $default ) {
	return 5;
} );


add_filter( 'pre_option_writepoetry_maintenance_mode', function ( $default ) {
	return 1;
} );

// If maintenance mode is enable with this filter
// you can add or remove the pages exluded from being under maintenance
add_filter( 'writepoetry_maintenance_excluded_pages', function ( $condition ) {
	$condition[''] = 'index.php';
	return $condition;
} );

// Possible vaules are accordion, tabs or list
add_filter( 'pre_option_writepoetry_product_infos_layout', function ( $default ) {
	// 'tabs'
	// 'list'
	// 'accordion'
	return 'tabs';
} );


// add elements to disable
add_filter( 'writepoetry_disable_features', function ( $args ) {
	$args[] = 'woocommerce_sale_flash';
	// $args[] = 'woocommerce_twenty_twenty_two_styles';

	return $args;
}, 10, 1 );


add_filter( 'writepoetry_remove_query_strings', '__return_true' );


// Limit this hook here in order to keep clean production env.
if ( in_array( wp_get_environment_type(), array( 'development', 'local' ) ) ) {
	// Add parameters to url
	add_filter( 'writepoetry_query_vars', function () {
		// Test here http://localhost:8888/sample-page/?test-param=ciao&test-param2=caro
		return array( 'test-param', 'test-param2' );
	} );
}


add_filter( 'writepoetry_add_custom_taxonomies', function () {
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





add_filter( 'writepoetry_add_custom_post_types', function () {
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










