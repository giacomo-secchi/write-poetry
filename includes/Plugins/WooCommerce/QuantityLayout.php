<?php
/**
 * Quantity layout.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Plugins
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.4
 */

namespace WritePoetry\Plugins\WooCommerce;

use \WritePoetry\Base\BaseController;

/**
*
*/
class QuantityLayout extends WooCommerceController {
	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {

		$min_quantity = 10;
		$max_quantity = 7;

		// product max quantity configurations
		if ( get_option( "{$this->prefix}_product_max_quantity" ) ) {
			$max_quantity = get_option( "{$this->prefix}_product_max_quantity" );
		}

		if ( get_option( "{$this->prefix}_product_min_quantity" ) ) {
			$min_quantity = get_option( "{$this->prefix}_product_min_quantity" );
		}


		// product quantity selector configurations

		// this filter prevent to override the `quantity-input.php` template
		add_filter( "{$this->prefix}_exclude_woocommerce_template", function( $templates ) {
 			$templates[] = 'global/quantity-input.php';
			return $templates;
		} );


		if ( 'input' == get_option( "{$this->prefix}_product_quantity_layout" ) ) {
			return false;
		}

		// Set product quantity to one item at a time if added to cart
		if ( 'hidden' == get_option( "{$this->prefix}_product_quantity_layout" ) ) {
			$this->change_quantity_input( $min_quantity );
		}

		if ( 'buttons' === get_option("{$this->prefix}_product_quantity_layout" ) ) {
			add_action( 'woocommerce_before_quantity_input_field', array( $this, 'display_quantity_minus' ) );
			add_action( 'woocommerce_after_quantity_input_field', array( $this, 'display_quantity_plus' ) );
			add_action( 'wp_footer', array( $this, 'add_cart_quantity_plus_minus' ) );
			add_action( 'wp_head', array( $this, 'custom_styles' ) );
			$this->change_quantity_input( $max_quantity, $min_quantity );

		}

		if ( 'select' === get_option("{$this->prefix}_product_quantity_layout" ) ) {
			$this->change_quantity_input( $max_quantity, $min_quantity );


			// this readd quantity input to the filter
			add_filter( "{$this->prefix}_exclude_woocommerce_template", function( $templates ) {
			 return array_filter( $templates, fn($template) => strpos( $template, 'global/quantity-input.php' ) === false );
		   } );


		}

		// product quantity input configurations
		if ( get_option( "{$this->prefix}_quantity_input_step" ) ) {
			add_filter( 'woocommerce_quantity_input_step', function ( $step, $product ) {
				return get_option( "{$this->prefix}_quantity_input_step" );
			}, 10, 2 );
		}

	}



	public function custom_styles() {
		echo '<style>
			/* Chrome, Safari, Edge, Opera */
			input::-webkit-outer-spin-button,
			input::-webkit-inner-spin-button {
				-webkit-appearance: none;
				margin: 0;
			}

			/* Firefox */
			input[type=number] {
				-moz-appearance: textfield;
			}
		</style>';
	}

	public function display_quantity_minus() {
		echo '<button type="button" class="quantity__button quantity__minus wp-element-button">-</button>';
	}

	public function display_quantity_plus() {
		echo '<button type="button" class="quantity__button quantity__plus wp-element-button">+</button>';
	}

	function add_cart_quantity_plus_minus() {
		if ( ! is_product() && ! is_cart() ) {

			return false;
		}

		wc_enqueue_js( "

			$(document).on( 'click', 'button.quantity__plus, button.quantity__minus', function() {

			var forms = $('.woocommerce-cart-form, form.cart');
			forms.find('.quantity.hidden').prev( '.quantity__button' ).hide();
			forms.find('.quantity.hidden').next( '.quantity__button' ).hide();


				var qty = $( this ).parent( '.quantity' ).find( '.qty' );
				var val = parseFloat(qty.val());
				var max = parseFloat(qty.attr( 'max' ));
				var min = parseFloat(qty.attr( 'min' ));
				var step = parseFloat(qty.attr( 'step' ));

				if ( $( this ).is( '.quantity__plus' ) ) {
					if ( max && ( max <= val ) ) {
						qty.val( max ).change();
					} else {
						qty.val( val + step ).change();
					}
				} else {
					if ( min && ( min >= val ) ) {
					qty.val( min ).change();
					} else if ( val > 1 ) {
					qty.val( val - step ).change();
					}
				}

			});

		" );



		wp_add_inline_style( 'woocommerce-blocktheme', '
		/* Works for Chrome, Safari, Edge, Opera */
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		/* Works for Firefox */
		input[type="number"] {
			-moz-appearance: textfield;
		}
		');
	}

}

