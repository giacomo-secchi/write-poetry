<?php
/**
 * Redirect to cart class.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.4
 */

namespace WritePoetry\Plugins\WooCommerce;

use WritePoetry\Base\Base_Controller;

/**
 * Class Cart_Redirect
 *
 * @package WritePoetry\Plugins\WooCommerce
 */
class Cart_Redirect extends WooCommerce_Controller {
	/**
	 * Invoke hooks.
	 *
	 * @return void|bool
	 */
	public function register() {
		// redirect checkout.
		if ( '' === get_option( "{$this->prefix}_redirect_after_add" ) ) {
			return false;
		}

		add_filter( 'woocommerce_add_to_cart_redirect', array( $this, 'skip_cart_redirect_checkout' ) );
		// define the product_add_to_cart_text callback.
		add_filter( 'woocommerce_product_add_to_cart_text', array( $this, 'product_add_to_cart_text' ), 10, 2 );
		add_filter( 'woocommerce_product_single_add_to_cart_text', array( $this, 'product_add_to_cart_text' ), 10, 2 );
		add_filter( 'woocommerce_loop_add_to_cart_link', array( $this, 'loop_add_to_cart_link' ) );
		add_filter( 'wc_add_to_cart_message_html', array( $this, 'remove_add_to_cart_message' ) );
	}


	/**
	 * Redirect to checkout page bypassing cart
	 * based on the story of https://rudrastyh.com/woocommerce/redirect-to-checkout-skip-cart.html
	 *
	 * @since  0.2.5
	 * @access public
	 * @return string
	 */
	public function skip_cart_redirect_checkout() {
		$this->disable_ajax_cart();

		if ( 'cart' === get_option( "{$this->prefix}_redirect_after_add" ) ) {
			return wc_get_cart_url();
		}

		return wc_get_checkout_url();
	}

	/**
	 * Disable ajax cart
	 *
	 * @since  0.2.5
	 * @access public
	 * @return void
	 */
	public function disable_ajax_cart() {

		if ( 'no' === get_option( 'woocommerce_enable_ajax_add_to_cart' ) ) {
			return;
		}

		update_option( 'woocommerce_enable_ajax_add_to_cart', 'no' );
	}

	/**
	 * Change add to cart text
	 *
	 * @since  0.2.5
	 * @access public
	 * @param  string $text The default text.
	 * @param  object $product The product object.
	 * @return string
	 */
	public function product_add_to_cart_text( $text, $product ) {
		$t = $text;
		return $product->is_purchasable() && $product->is_in_stock() || $product->is_type( 'grouped' ) ? __( 'Buy now', 'write-poetry' ) : __( 'Read more', 'write-poetry' );
	}

	/**
	 * Change add to cart text
	 *
	 * @since  0.2.5
	 * @access public
	 * @param  string $add_to_cart_html The default html.
	 * @return string
	 */
	public function loop_add_to_cart_link( $add_to_cart_html ) {
		return str_replace( 'Add to cart', 'Buy now', $add_to_cart_html );
	}

	/**
	 * Remove add to cart message
	 *
	 * @since  0.2.5
	 * @access public
	 * @return string
	 */
	public function remove_add_to_cart_message() {
		return '';
	}
}
