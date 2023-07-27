<?php
/**
 * Twenties Child Theme
 *
 * @package Twenty_Twenty_Child
 */


add_filter( 'mcf_enqueue_block_style', function () {
	$blocks = array(
		'core/navigation',
        'core/site-title',
		'jetpack/mailchimp',
		'jetpack/slideshow',
		'yoast/reading-time'
    );

	return $blocks;
} );


add_filter( 'mcf_register_block_style', function () {
	// Define block styles with their labels and CSS styles
	$block_styles = array(
		'core/group'	=> array(
			'name'			=> 'inline',
			'label'			=> __( 'Inline', 'twenties' ),
			// 'is_default'	=> true,
			'inline_style'	=> '.wp-block-group .is-style-inline { display: inline-flex; }'
		),
		'core/cover'	=> array(
			'name'			=> 'inline1',
			'label'			=> __( 'Inline1', 'twenties' ),
			// 'is_default'	=> true,
			'inline_style'	=> '  .is-style-inline1 { display: block; }'
		),
		'core/cover'	=> array(
			'name'			=> 'cicao',
			'label'			=> __( 'Inline2', 'twenties' ),
			// 'is_default'	=> true,
			'inline_style'	=> '  .is-style-inline2 { display: inline-flex; }'
		)
	);

	return $block_styles;

} );
