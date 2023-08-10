<?php
/**
 * WooCommerce new features
 *
 * @package           MyCustomFunctions
 * @subpackage        MyCustomFunctions/includes
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */






class WritePoetry_WooCommerce {

	/**
	 * Initialize the class
	 */
	public function __construct() {

		// Add Authorization Token to download_package
		add_filter( 'plugins_loaded', function() {

			if ( ! class_exists( 'WooCommerce' ) ) {
				return false;
			}



			// Quantity layout
 			if (
				defined( 'WRITEPOETRY_WOOCOMMERCE_QUANTITY_INPUT_LAYOUT') &&
				'select' === WRITEPOETRY_WOOCOMMERCE_QUANTITY_INPUT_LAYOUT ||
				'select' === get_option('writepoetry_qty_layout')
			) {

				if ( ! defined( 'WRITEPOETRY_WOOCOMMERCE_MAX_QUANTITY_INPUT' ) || get_option( 'writepoetry_product_max_qty' ) ) {
					$this->change_quantity_input( 99 );

				}

				add_filter( 'woocommerce_locate_template', array( $this, 'addon_plugin_template' ), 1, 3 );

			} else if (
				defined( 'WRITEPOETRY_WOOCOMMERCE_QUANTITY_INPUT_LAYOUT') &&
				'buttons' === WRITEPOETRY_WOOCOMMERCE_QUANTITY_INPUT_LAYOUT ||
				'buttons' === get_option('writepoetry_qty_layout')
			) {
 				add_action( 'woocommerce_before_quantity_input_field', array( $this, 'display_quantity_minus' ) );
				add_action( 'woocommerce_after_quantity_input_field', array( $this, 'display_quantity_plus' ) );
				add_action( 'wp_footer', array( $this, 'add_cart_quantity_plus_minus' ) );
				add_action( 'wp_head', array( $this, 'custom_styles' ) );
			}

			else {


				add_filter( 'writepoetry_exclude_woocommerce_template', function() {
					return 'global/quantity-input.php';
				} );
			}



			if (
				defined( 'WRITEPOETRY_WOOCOMMERCE_DISABLE_SINGLE_PRODUCT_QTY' ) &&
				WRITEPOETRY_WOOCOMMERCE_DISABLE_SINGLE_PRODUCT_QTY ||
				get_option( 'writepoetry_disable_qty' )
			) {
				$this->change_quantity_input( 1 );
			} else if ( defined( 'WRITEPOETRY_WOOCOMMERCE_MAX_QUANTITY_INPUT' ) || get_option( 'writepoetry_product_max_qty' ) ) {
				$qty = defined( 'WRITEPOETRY_WOOCOMMERCE_MAX_QUANTITY_INPUT' ) ? WRITEPOETRY_WOOCOMMERCE_MAX_QUANTITY_INPUT : get_option( 'writepoetry_product_max_qty' );
				$this->change_quantity_input( $qty );
			}

			// Product zoom
			if ( defined( 'WRITEPOETRY_WOOCOMMERCE_ENABLE_PRODUCT_ZOOM' ) &&
				false === WRITEPOETRY_WOOCOMMERCE_ENABLE_PRODUCT_ZOOM ||
				'no' === get_option( 'writepoetry_enable_product_zoom' )
			) {
				$this->disable_product_zoom();
			}

			// Additional informations
			if ( defined( 'WRITEPOETRY_WOOCOMMERCE_SINGLE_PRODUCT_ADDITIONAL_INFORMATIONS_LAYOUT' ) || get_option( 'writepoetry_infos_layout' ) ) {
 				add_filter( 'woocommerce_locate_template', array( $this, 'addon_plugin_template' ), 1, 3 );
			}

			if (
				defined( 'WRITEPOETRY_WOOCOMMERCE_SINGLE_PRODUCT_ADDITIONAL_INFORMATIONS_LAYOUT' ) &&
				'tabs' === WRITEPOETRY_WOOCOMMERCE_SINGLE_PRODUCT_ADDITIONAL_INFORMATIONS_LAYOUT ||
				'tabs' === get_option( 'writepoetry_infos_layout' )
			) {

				add_filter( 'writepoetry_exclude_woocommerce_template', function() {
					return 'single-product/tabs/tabs.php';
				} );
			}

			if (
				defined( 'WRITEPOETRY_WOOCOMMERCE_SINGLE_PRODUCT_ADDITIONAL_INFORMATIONS_LAYOUT' ) &&
				'accordion' === WRITEPOETRY_WOOCOMMERCE_SINGLE_PRODUCT_ADDITIONAL_INFORMATIONS_LAYOUT ||
				'accordion' === get_option( 'writepoetry_infos_layout' )
			) {

				add_filter( 'woocommerce_locate_template', array( $this, 'addon_plugin_template' ), 1, 3 );

				add_filter( 'wp_enqueue_scripts', function() {
					wp_enqueue_script( 'jquery-ui-accordion' );
					wp_add_inline_script( 'jquery-ui-accordion', '
						jQuery( function( $ ) {
							$( "#accordion" ).accordion();
						});'
					);
				} );
			}

			// redirect checkout
			if (
				defined( 'WRITEPOETRY_WOOCOMMERCE_REDIRECT_CHECKOUT' ) &&
				WRITEPOETRY_WOOCOMMERCE_REDIRECT_CHECKOUT ||
				'yes' === get_option( 'writepoetry_redirect_checkout' )
			) {

				add_filter( 'woocommerce_add_to_cart_redirect', array( $this, 'skip_cart_redirect_checkout' ) );
				add_filter( 'woocommerce_product_add_to_cart_text', array( $this, 'product_add_to_cart_text' ), 10, 2 );
				add_filter( 'woocommerce_product_single_add_to_cart_text', array( $this, 'product_add_to_cart_text' ), 10, 2 );
				add_filter( 'woocommerce_loop_add_to_cart_link', array( $this, 'loop_add_to_cart_link' ) );
				add_filter( 'wc_add_to_cart_message_html', array( $this, 'remove_add_to_cart_message' ) );
			}



		} );
	}


	// https://wisdmlabs.com/blog/override-woocommerce-templates-plugin/
	public function addon_plugin_template( $template, $template_name, $template_path ) {
		global $woocommerce;
		$_template = $template;

		if ( ! $template_path ) {
			$template_path = $woocommerce->template_url;
		}

		$plugin_path  = untrailingslashit( WRITEPOETRY_PLUGIN_DIR )  . '/woocommerce/';

		// Apply filter to exclude specific template
		$excluded_template = apply_filters( 'writepoetry_exclude_woocommerce_template', 'excluded-template.php' );
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
			return;
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

	// define the product_add_to_cart_text callback
	public function product_add_to_cart_text( $text, $product ) {
		return $product->is_purchasable() && $product->is_in_stock() || $product->is_type( 'grouped') ? __( 'Buy now', 'woocommerce' ) : __( 'Read more', 'woocommerce' );
	}

	public function skip_cart_redirect_checkout( $url ) {
		$this->disable_ajax_cart();
		return wc_get_checkout_url();
	}

	public function loop_add_to_cart_link( $add_to_cart_html ) {
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
		}, 10, 3 );
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