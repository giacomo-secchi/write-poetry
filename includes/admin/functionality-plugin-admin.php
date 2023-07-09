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
				'default'  => defined( 'MCF_WOOCOMMERCE_REDIRECT_CHECKOUT' ) && MCF_WOOCOMMERCE_REDIRECT_CHECKOUT ? 'yes' : false,
				'css'      => 'min-width:300px;',
				'desc'     => __( 'Redirect to the checkout page after successful addition', 'my-custom-functions' ),
				'custom_attributes' => defined( 'MCF_WOOCOMMERCE_REDIRECT_CHECKOUT' ) ? array( 'disabled' => 'disabled' ) : array()
			);


			// Add single product checkbox option
			$settings_appearance[] = array(
				'name'     => __( 'Auto-insert into single product page', 'text-domain' ),
				'desc_tip' => __( 'This will automatically insert your slider into the single product page', 'text-domain' ),
				'id'       => 'wcslider_auto_insert',
				'type'     => 'checkbox',
				'css'      => 'min-width:300px;',
				'desc'     => __( 'Enable Auto-Insert', 'text-domain' ),
			);

			// Add product zoom checkbox option
			$settings_appearance[] = array(
				'name'     => __( 'Auto-insert into single product page', 'text-domain' ),
				'desc_tip' => __( 'This will automatically insert your slider into the single product page', 'text-domain' ),
				'id'       => 'mcf_product_zoom',
				'type'     => 'checkbox',
				'css'      => 'min-width:300px;',
				'desc'     => __( 'Enable Product Zoom', 'text-domain' ),
			);

			// Add quantity layout field option
			$settings_appearance[] = array(
				'name'     => __( 'Slider Title', 'text-domain' ),
				'desc_tip' => __( 'This will add a title to your slider', 'text-domain' ),
				'id'       => 'wcslider_title',
				'type'     => 'select',
				'desc'     => __( 'Any title you want can be added to your slider with this option!', 'text-domain' ),
				'options' => array(
					'key' => 'select',
					'key2' => 'button'
			   	) // array of options for select/multiselects only
			);

			// Add additional info layout field option
			$settings_appearance[] = array(
				'name'     => __( 'Slider Title', 'text-domain' ),
				'desc_tip' => __( 'This will add a title to your slider', 'text-domain' ),
				'id'       => 'wcslider_title',
				'type'     => 'select',
				'desc'     => __( 'Any title you want can be added to your slider with this option!', 'text-domain' ),
				'options' => array(
					'key' => 'tabs',
					'key2' => 'list',
					'key3' => 'accordion',
					) // array of options for select/multiselects only
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
