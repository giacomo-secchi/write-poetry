<?php
/**
 * Add administration fields
 *
 * @package           MyCustomFunctions
 * @subpackage        MyCustomFunctions/includes/admin
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */

class MCF_Admin {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_filter( 'woocommerce_get_sections_products', array( $this, 'add_section' ) );
		add_filter( 'woocommerce_get_settings_products', array( $this, 'all_settings' ), 10, 2 );
	}


	/**
	 * Create the section beneath the products tab
	 **/
	function add_section( $sections ) {

		$sections['appearance'] = __( 'Appearance', 'my-custom-functions' );
		return $sections;

	}

	/**
	 * Add settings to the specific section we created before
	 */
	function all_settings( $settings, $current_section ) {
		/**
		 * Check the current section is what we want
		 **/
		if ( $current_section == 'appearance' ) {
			$settings_appearance = array();

			// Add Title to the Settings
			$settings_appearance[] = array( 'name' => __( 'Appearence', 'my-custom-functions' ), 'type' => 'title', 'desc' => __( 'The following options are used to configure single product page design', 'my-custom-functions' ), 'id' => 'appeareance' );

			// Add redirect checkout checkbox option
			$settings_appearance[] = array(
				'name'     => __( 'Add to cart behaviour', 'my-custom-functions' ),
				'desc_tip' => __( 'This will enable redirect to checkout page after adding product to cart', 'my-custom-functions' ),
				'id'       => 'mcf_redirect_checkout',
				'type'     => 'checkbox',
				'default'  => false,
				'value'	   => defined( 'MCF_WOOCOMMERCE_REDIRECT_CHECKOUT' ) && MCF_WOOCOMMERCE_REDIRECT_CHECKOUT ? 'yes' : get_option( 'mcf_redirect_checkout' ),
				'css'      => 'min-width:300px;',
				'desc'     => __( 'Redirect to the checkout page after successful addition', 'my-custom-functions' ),
				'custom_attributes' => defined( 'MCF_WOOCOMMERCE_REDIRECT_CHECKOUT' ) ? array( 'disabled' => 'disabled' ) : array()
			);

			// Add product zoom checkbox option
			$settings_appearance[] = array(
				'name'     => __( 'Zoom behaviour', 'my-custom-functions' ),
				'desc_tip' => __( 'This will enable or disable product image zoom on single product page', 'my-custom-functions' ),
				'id'       => 'mcf_enable_product_zoom',
				'type'     => 'checkbox',
				'default'  => 'yes',
				'value'	   => defined( 'MCF_WOOCOMMERCE_ENABLE_PRODUCT_ZOOM' ) && MCF_WOOCOMMERCE_ENABLE_PRODUCT_ZOOM ? 'yes' : get_option( 'mcf_enable_product_zoom' ),
				'css'      => 'min-width:300px;',
				'desc'     => __( 'Enable Product Zoom', 'my-custom-functions' ),
				'custom_attributes' => defined( 'MCF_WOOCOMMERCE_ENABLE_PRODUCT_ZOOM' ) ? array( 'disabled' => 'disabled' ) : array()
			);

						// Add disable single product quantity option
						$settings_appearance[] = array(
							'name'     => __( 'Single product quantity option', 'my-custom-functions' ),
							'desc_tip' => __( 'This option will disable quantity option on single product page', 'my-custom-functions' ),
							'id'       => 'mcf_disable_qty',
							'type'     => 'checkbox',
							'default'  => false,
							'value'	   => defined( 'MCF_WOOCOMMERCE_DISABLE_SINGLE_PRODUCT_QTY' ) && MCF_WOOCOMMERCE_DISABLE_SINGLE_PRODUCT_QTY ? 'yes' : get_option( 'mcf_disable_qty' ),
							'css'      => 'min-width:300px;',
							'desc'     => __( 'Disable quantity option', 'my-custom-functions' ),
							'custom_attributes' => defined( 'MCF_WOOCOMMERCE_DISABLE_SINGLE_PRODUCT_QTY' ) ? array( 'disabled' => 'disabled' ) : array()
						);

			// Add single product checkbox option
			$settings_appearance[] = array(
				'name'     => __( 'Max quantity input', 'my-custom-functions' ),
				'desc_tip' => __( 'This will automatically insert your slider into the single product page', 'my-custom-functions' ),
				'id'       => 'mcf_product_max_qty',
				'type'     => 'number',
				'css'      => 'width:80px;',
				'desc'     => __( 'Enable Auto-Insert', 'my-custom-functions' ),
			);


			// Add quantity layout field option
			$settings_appearance[] = array(
				'name'     => __( 'Quantity input layout', 'my-custom-functions' ),
				'id'       => 'mcf_qty_layout',
				'default'  => 'input',
				'type'     => 'select',
				'value'    => defined( 'MCF_WOOCOMMERCE_QUANTITY_INPUT_LAYOUT') ? MCF_WOOCOMMERCE_QUANTITY_INPUT_LAYOUT : get_option( 'mcf_qty_layout' ),
				'desc'     => __( 'Choose the layout of quantity selector on the product page', 'my-custom-functions' ),
				'options' => array(
					'input' => 'input',
					'select' => 'select',
					'buttons' => 'buttons'
			   	), // array of options for select/multiselects only
				'custom_attributes' => defined( 'MCF_WOOCOMMERCE_QUANTITY_INPUT_LAYOUT' ) ? array( 'disabled' => 'disabled' ) : array()

			);

			// Add additional info layout field option
			$settings_appearance[] = array(
				'name'     => __( 'Additional infos layout', 'my-custom-functions' ),
				'id'       => 'mcf_infos_layout',
				'type'     => 'select',
				'desc'     => __( 'Choose the layout of additional informations box with this option!', 'my-custom-functions' ),
				'options' => array(
					'key' => 'tabs',
					'key2' => 'list',
					'key3' => 'accordion',
				), // array of options for select/multiselects only
				'custom_attributes' => defined( 'MCF_WOOCOMMERCE_SINGLE_PRODUCT_ADDITIONAL_INFORMATIONS_LAYOUT' ) ? array( 'disabled' => 'disabled' ) : array()
			);

			$settings_appearance[] = array( 'type' => 'sectionend', 'id' => 'wcslider' );
			return $settings_appearance;

		/**
		 * If not, return the standard settings
		 **/
		} else {
			return $settings;
		}
	}

}
