<?php


// custom code for the current project



// Added ability to fix the Google Tag Manager ID and GTM Environment parameters in wp-config.php. To use it, create PHP constants with the names

define( 'GTM4WP_HARDCODED_GTM_ID', '1' );
define( 'GTM4WP_HARDCODED_GTM_ENV_AUTH', '' );
define( 'GTM4WP_HARDCODED_GTM_ENV_PREVIEW', '' );




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
		'camere' =>
			array(
				'labels' => array(
					'name' => 'Camere',
					'singular_name' => 'Camera'
				),
				'publicly_queryable'  => true
			),
	);

	return $string;
}, 10, 3 );


// add elements to disable
add_filter( 'mcf_disable_features', function () {
	$args[] = 'trp_add_region_independent_hreflang_tags';
	return $args;
}, 10, 1 );
