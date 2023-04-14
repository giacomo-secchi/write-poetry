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

			if ( MCF_WOOCOMMERCE_QUANTITY_AS_SELECT ) {
				add_filter( 'woocommerce_locate_template', array( $this, 'woocommerce_addon_plugin_template' ), 1, 3 );
			}


			if ( ! MCF_WOOCOMMERCE_REDIRECT_CHECKOUT ) {
				return false;
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
}
