<?php
/**
 * Example class.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.4
 */

namespace WritePoetry\Plugins\WooCommerce;

use WritePoetry\Base\BaseController;

/**
 *
 */
class CartRedirect extends WooCommerceController {
	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {
		// redirect checkout
		if ( '' === get_option( "{$this->prefix}_redirect_after_add" ) ) {
			return false;
		}

		add_filter( 'woocommerce_add_to_cart_redirect', array( $this, 'skip_cart_redirect_checkout' ) );
		add_filter( 'woocommerce_product_add_to_cart_text', array( $this, 'product_add_to_cart_text' ), 10, 2 );
		add_filter( 'woocommerce_product_single_add_to_cart_text', array( $this, 'product_add_to_cart_text' ), 10, 2 );
		add_filter( 'woocommerce_loop_add_to_cart_link', array( $this, 'loop_add_to_cart_link' ) );
		add_filter( 'wc_add_to_cart_message_html', array( $this, 'remove_add_to_cart_message' ) );
	}

	public function skip_cart_redirect_checkout( $url ) {
		$this->disable_ajax_cart();

		if ( 'cart' === get_option( "{$this->prefix}_redirect_after_add" ) ) {
			return wc_get_cart_url();
		}

		return wc_get_checkout_url();
	}

	/**
	 * Go to checkout page bypassing cart
	 * based on the story of https://rudrastyh.com/woocommerce/redirect-to-checkout-skip-cart.html
	 *
	 * @since  0.2.5
	 * @access public
	 * @return viod
	 */
	public function disable_ajax_cart() {

		if ( 'no' === get_option( 'woocommerce_enable_ajax_add_to_cart' ) ) {
			return;
		}

		update_option( 'woocommerce_enable_ajax_add_to_cart', 'no' );
	}

	// define the product_add_to_cart_text callback
	public function product_add_to_cart_text( $text, $product ) {
		return $product->is_purchasable() && $product->is_in_stock() || $product->is_type( 'grouped' ) ? __( 'Buy now', 'woocommerce' ) : __( 'Read more', 'woocommerce' );
	}


	public function loop_add_to_cart_link( $add_to_cart_html ) {
		return str_replace( 'Add to cart', 'Buy now', $add_to_cart_html );
	}


	public function remove_add_to_cart_message( $message ) {
		return '';
	}
}
