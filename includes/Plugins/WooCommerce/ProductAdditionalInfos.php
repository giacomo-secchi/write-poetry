<?php
/**
 * Example class.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Plugins/WooCommerce
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.4
 */

namespace WritePoetry\Plugins\WooCommerce;

use WritePoetry\Base\BaseController;

/**
 * Class ProductAdditionalInfos
 */
class ProductAdditionalInfos extends WooCommerceController {
	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {

		// Additional informations.
		if ( 'tabs' === get_option( "{$this->prefix}_product_infos_layout" ) ) {
			add_filter(
				"{$this->prefix}_exclude_woocommerce_template",
				function ( $templates ) {
					$templates[] = 'single-product/tabs/tabs.php';
					return $templates;
				}
			);
		}

		if ( 'accordion' === get_option( "{$this->prefix}_product_infos_layout" ) ) {
			add_filter(
				'wp_enqueue_scripts',
				function () {
					wp_enqueue_script( 'jquery-ui-accordion' );
					wp_add_inline_script(
						'jquery-ui-accordion',
						'
					jQuery( function( $ ) {
						$( "#accordion" ).accordion();
					});'
					);
				}
			);
		}
	}


	/**
	 * Add additional information to product page.
	 *
	 * @return void
	 */
	public function woocommerce_custom_tabs() {
		add_filter(
			'woocommerce_product_tabs',
			function ( $tabs ) {

				// Remove additional information tab on Product Page.
				unset( $tabs['reviews'] );
				unset( $tabs['additional_information'] );

				// Insert additional information into description tab on Product Page.
				$tabs['description']['callback'] = function () {
					global $product;
					wc_get_template( 'single-product/tabs/description.php' );

					if ( $product && ( $product->has_attributes() || apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() ) ) ) {
						wc_get_template( 'single-product/tabs/additional-information.php' );
					}
				};

				return $tabs;
			},
			20
		);
	}
}
