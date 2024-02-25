<?php
/**
 * Twenties Child Theme
 *
 * @package Twenty_Twenty_Child
 */

/*
Use this filter to change the default path for additional blocks styles.
add_filter( 'writepoetry_blocks_styles_asset_path', function () {
	return 'assets/block';
} );
*/

/**
 * Copy the following lines in your functions.php theme file
 * if you want to remove some particular mime type
 * added by this plugin
 */

add_filter(
	'upload_mimes',
	function ( $mimes ) {
		// Optional. Remove a mime type.
		unset( $mimes['exe'] );
		unset( $mimes['svg'] );
		unset( $mimes['svgz'] );

		return $mimes;
	}
);

add_filter(
	'mime_types',
	function ( $wp_get_mime_types ) {
		// Optional. Remove a mime type.
		unset( $wp_get_mime_types['exe'] );
		unset( $wp_get_mime_types['svg'] );
		unset( $wp_get_mime_types['svgz'] );

		return $wp_get_mime_types;
	}
);




add_filter(
	'writepoetry_register_block_style',
	function () {
		// Define block styles with their labels and CSS styles.
		$block_styles = array(
			'core/group' => array(
				'name'         => 'inline',
				'label'        => __( 'Inline', 'twenties' ),
				'is_default'   => true,
				'inline_style' => '.wp-block-group.is-style-inline { display: inline-flex; }',
			),
			'core/cover' => array(
				array(
					'name'         => 'inline1',
					'label'        => __( 'Inline1', 'twenties' ),
					'is_default'   => true,
					'inline_style' => '  .is-style-inline1 { display: block; }',
				),
				array(
					'name'         => 'inline2',
					'label'        => __( 'Inline2', 'twenties' ),
					'inline_style' => '  .is-style-inline2 { display: inline-flex; }',
				),
			),
		);

		return $block_styles;
	}
);
