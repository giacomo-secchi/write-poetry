<?php
/**
 * The template for displaying a static page with slug `sample-page`.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * @package WritePoetry
 * @subpackage Twenty_Twenty_Child
 * @since Twenties Child 0.1
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

		<?php wp_body_open(); ?>
		<div class="wp-site-blocks">


			<header class="wp-block-template-part site-header">
				<?php block_header_area(); ?>
			</header>

			<?php
			// Example url: http://localhost:8888/sample-page/?test-param=ciao&test-param2=caro.
			$twenties_param1 = get_query_var( 'test-param' );
			$twenties_param2 = get_query_var( 'test-param2' );
			?>

			<h1>
				<?php
					/* translators: %1$s and %2$s: parameters values from url */
					printf( esc_html__( 'The test-param value is: %1$s and test-param2 is: %2$s', 'twenties' ), esc_html( $twenties_param1 ), esc_html( $twenties_param2 ) );
				?>
			</h1>

			<?php
			// Display link to custom post type archive.
			$twenties_archive_link = get_post_type_archive_link( 'punti_di_interesse' );

			if ( $twenties_archive_link ) {
				echo 'Archive Link: <a href="' . esc_url( $twenties_archive_link ) . '" rel="nofollow ugc">Books Archive</a>';
			} else {
				echo 'The "book" post type does not have an archive.';
			}
			?>

			<footer class="wp-block-template-part site-footer">
				<?php block_footer_area(); ?>
			</footer>
		</div>

		<?php wp_footer(); ?>

	</body>
</html>
