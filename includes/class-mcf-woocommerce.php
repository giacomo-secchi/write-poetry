<?php
/**
 * Add new mime types
 *
 * @package     MCF
 * @subpackage  MCF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

if ( ! defined( 'MCF_WOOCOMMERCE_REDIRECT_CHECKOUT' ) ) {
	define( 'MCF_WOOCOMMERCE_REDIRECT_CHECKOUT', false );
}

if ( ! defined( 'MCF_WOOCOMMERCE_QUANTITY_AS_SELECT' ) ) {
	define( 'MCF_WOOCOMMERCE_QUANTITY_AS_SELECT', false );
}

if ( ! defined( 'MCF_WOOCOMMERCE_DISABLE_SINGLE_PRODUCT_QTY' ) ) {
	define( 'MCF_WOOCOMMERCE_DISABLE_SINGLE_PRODUCT_QTY', false );
}

if ( ! defined( 'MCF_WOOCOMMERCE_DISABLE_PRODUCT_ZOOM' ) ) {
	define( 'MCF_WOOCOMMERCE_DISABLE_PRODUCT_ZOOM', false );
}



class MCF_WooCommerce {

	/**
	 * Initialize the class
	 */
	public function __construct() {

		// Add Authorization Token to download_package
		add_filter( 'plugins_loaded', function() {

			if ( ! class_exists( 'WooCommerce' ) ) {
				return false;
			}

			if ( defined( 'MCF_WOOCOMMERCE_SINGLE_PRODUCT_ADDITIONAL_INFORMATIONS_LAYOUT' ) ) {
				add_filter( 'woocommerce_locate_template', array( $this, 'woocommerce_addon_plugin_template' ), 1, 3 );
			}

			if ( ! MCF_WOOCOMMERCE_QUANTITY_AS_SELECT ) {
				add_filter( 'mcf_exclude_woocommerce_template', function() {
					return 'global/quantity-input.php';
				} );
			} else {
				$this->change_quantity_input( MCF_WOOCOMMERCE_QUANTITY_AS_SELECT_MAX_QTY );
				add_filter( 'woocommerce_locate_template', array( $this, 'woocommerce_addon_plugin_template' ), 1, 3 );
			}

			if ( MCF_WOOCOMMERCE_DISABLE_SINGLE_PRODUCT_QTY ) {
				$this->change_quantity_input( 1 );
			}

			if ( MCF_WOOCOMMERCE_DISABLE_PRODUCT_ZOOM ) {
				$this->disable_product_zoom();
			}

			if ( ! MCF_WOOCOMMERCE_REDIRECT_CHECKOUT ) {
				return false;
			}

			if (
				defined( 'MCF_WOOCOMMERCE_SINGLE_PRODUCT_ADDITIONAL_INFORMATIONS_LAYOUT' ) &&
				'tabs' == MCF_WOOCOMMERCE_SINGLE_PRODUCT_ADDITIONAL_INFORMATIONS_LAYOUT
			) {
				//
				add_filter( 'mcf_exclude_woocommerce_template', function() {
					return 'single-product/tabs/tabs.php';
				} );
			}

			if (
				defined( 'MCF_WOOCOMMERCE_SINGLE_PRODUCT_ADDITIONAL_INFORMATIONS_LAYOUT' ) &&
				'accordion' == MCF_WOOCOMMERCE_SINGLE_PRODUCT_ADDITIONAL_INFORMATIONS_LAYOUT
			) {
				//
				add_filter( 'wp_enqueue_scripts', function() {
					wp_enqueue_script( 'jquery-ui-accordion' );
					wp_add_inline_script( 'jquery-ui-accordion', '
						jQuery( function( $ ) {
							$( "#accordion" ).accordion();
						});'
					);
				} );
			}









			$this->disable_ajax_cart();

			add_filter( 'woocommerce_add_to_cart_redirect', array( $this, 'skip_cart_redirect_checkout' ) );
			add_filter( 'woocommerce_product_add_to_cart_text', array( $this, 'woocommerce_product_add_to_cart_text' ), 10, 2 );
			add_filter( 'woocommerce_product_single_add_to_cart_text', array( $this, 'woocommerce_product_add_to_cart_text' ), 10, 2 );
			add_filter( 'woocommerce_loop_add_to_cart_link', array( $this, 'woocommerce_loop_add_to_cart_link' ) );
			add_filter( 'wc_add_to_cart_message_html', array( $this, 'remove_add_to_cart_message' ) );


		} );
	}


	// https://wisdmlabs.com/blog/override-woocommerce-templates-plugin/
	public function woocommerce_addon_plugin_template( $template, $template_name, $template_path ) {
		global $woocommerce;
		$_template = $template;

		if ( ! $template_path ) {
			$template_path = $woocommerce->template_url;
		}

		$plugin_path  = untrailingslashit( MCF__PLUGIN_DIR )  . '/woocommerce/';

		// Apply filter to exclude specific template
		$excluded_template = apply_filters( 'mcf_exclude_woocommerce_template', 'excluded-template.php' );
		if ( $template_name === $excluded_template ) {
			return $template;
		}

		// Look within passed path within the theme - this is priority
		$template = locate_template(
			array(
				$template_path . $template_name,
				$template_name
			)
		);


		if( ! $template && file_exists( $plugin_path . $template_name ) ) {
			$template = $plugin_path . $template_name;
		}

		if ( ! $template ) {
			$template = $_template;
		}

		return $template;
	}

	/**
     * Go to checkout page bypassing cart
	 * based on the story of https://rudrastyh.com/woocommerce/redirect-to-checkout-skip-cart.html
     *
     * @since  1.0.0
     * @access public
     * @return viod
     */
	public function disable_ajax_cart( ){

		if ( 'no' === get_option( 'woocommerce_enable_ajax_add_to_cart' ) ) {
			return;
		}

		update_option( 'woocommerce_enable_ajax_add_to_cart', 'no' );
	}

	// define the woocommerce_product_add_to_cart_text callback
	public function woocommerce_product_add_to_cart_text( $text, $product ){
		return $product->is_purchasable() && $product->is_in_stock() ? __( 'Buy now', 'woocommerce' ) : __( 'Read more', 'woocommerce' );
	}

	public function skip_cart_redirect_checkout( $url ) {
		return wc_get_checkout_url();
	}

	public function woocommerce_loop_add_to_cart_link( $add_to_cart_html ) {
		return str_replace( 'Add to cart', 'Buy now', $add_to_cart_html );
	}


	public function remove_add_to_cart_message( $message ){
		return '';
	}


	// Disable quantity selector for product and product variation
	public function change_quantity_input( $max_qty ) {

		add_filter( 'woocommerce_quantity_input_args', function ( $args, $product ) use ( $max_qty ) {
			$args['max_value'] = $max_qty;

			return $args;
		}, 10, 2 );

		add_filter( 'woocommerce_available_variation', function  ( $data, $product, $variation ) use ( $max_qty ) {
			$data['max_qty'] = $max_qty;

			return $data;
		}, 10, 3);
	}

	// Disable zoom
	public function disable_product_zoom() {
		add_action( 'wp', function () {
			remove_theme_support( 'wc-product-gallery-zoom' );
			// remove_theme_support( 'wc-product-gallery-lightbox' );
			// remove_theme_support( 'wc-product-gallery-slider' );
		} , 100 );

		add_filter( 'woocommerce_single_product_image_thumbnail_html', function ( $html ) {
			return strip_tags( $html, '<div><img>' );
		} );
	}

	public function woocommerce_custom_tabs () {
		add_filter( 'woocommerce_product_tabs', function( $tabs ) {

			// Remove additional information tab on Product Page
			unset( $tabs['reviews'] );
			unset( $tabs['additional_information'] );


			// Insert additional information into description tab on Product Page
			$tabs['description']['callback'] = function() {
				global $product;
				wc_get_template( 'single-product/tabs/description.php' );

				if ( $product && ( $product->has_attributes() || apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() ) ) ) {
					wc_get_template( 'single-product/tabs/additional-information.php' );
				}
			};

			return $tabs;
		}, 20 );
	}
}
