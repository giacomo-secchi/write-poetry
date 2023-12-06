<?php
/**
 * Add WooCommerce administration fields for Settings subpage.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Pages
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.4
 */

 namespace WritePoetry\Pages\Admin;

 use \WritePoetry\Pages\AdminController;


/**
*
*/
class WooCommercePage extends AdminController {

	/**
	 * Initialize the class
	 */
	public function register() {
 		add_filter( 'woocommerce_get_sections_products', array( $this, 'add_section' ), 10, 2 );
		add_filter( 'woocommerce_get_settings_products', array( $this, 'all_settings' ), 10, 2 );
	}

	private function setCustomAttribute( $option ) {

		if ( $this->hasFiltersForOption( $option ) ) {
			return array( 'disabled' => 'disabled' );
		}

		return array();
	}

	/**
	 * Create the section beneath the products tab
	 **/
	function add_section( $sections ) {

		$sections['appearance'] = __( 'Appearance', 'write-poetry' );
		return $sections;

	}

	/**
	 * Add settings to the specific section we created before
	 */
	function all_settings( $settings, $current_section ) {
		$regeneration_aborted_warning =
			$this->regeneration_was_aborted() ?
			sprintf(
				"<p><strong style='color: #E00000'>%s</strong></p><p>%s</p>",
				__( 'WARNING: The product attributes lookup table regeneration process was aborted.', 'write-poetry' ),
				__( 'This means that the table is probably in an inconsistent state. It\'s recommended to run a new regeneration process or to resume the aborted process (Status - Tools - Regenerate the product attributes lookup table/Resume the product attributes lookup table regeneration) before enabling the table usage.', 'write-poetry' )
			) : null;

		/**
		 * Check the current section is general
		 **/
		if ( $current_section == '' ) {

			// Add redirect checkout checkbox option

			// Loop through the settings to find the one you want to modify
			foreach ( $settings as $index => $setting ) {
				if ( isset( $setting['id'] ) && $setting['id'] == 'woocommerce_cart_redirect_after_add' ) {
					$settings[$index] = array(
						'name'     => __( 'Add to cart behaviour', 'woocommerce' ),
						// 'desc_tip' => $regeneration_aborted_warning,
						'id'       => "{$this->prefix}_redirect_after_add",
						'type'     => 'select',
						'default'  => '',
						// 'css'      => 'min-width:300px;',
						'desc'     => __( 'Choose which page to redirect after a successful addition', 'write-poetry' ),
						'options' => array(
							''			=> __( 'Default (No redirect)', 'write-poetry' ),
							'cart'		=> __( 'Redirect to the cart page', 'write-poetry' ),
							'checkout'	=> __( 'Redirect to the checkout page', 'write-poetry' ),
							// 'product-cart'			=> __( 'Redirect to cart page (only from single product page)', 'write-poetry' ),
							// 'product-checkout'		=> __( 'Redirect to checkout page (only from single product page)', 'write-poetry' ),
							), // array of options for select/multiselects only
						'custom_attributes' =>  $this->setCustomAttribute( "{$this->prefix}_redirect_after_add" )
					);
				}
				if ( isset( $setting['id'] ) && $setting['id'] == 'woocommerce_enable_ajax_add_to_cart' ) {
					$settings[$index]['checkboxgroup'] ='start';

				}
			}

			return $settings;
		}

		/**
		 * Check the current section is what we want
		 **/
		if ( $current_section == 'appearance' ) {
			$settings_appearance = array();

			// Add Title to the Settings
			$settings_appearance[] = array( 'name' => __( 'Appearence', 'write-poetry' ), 'type' => 'title', 'desc' => __( 'The following options are used to configure single product page design', 'write-poetry' ), 'id' => 'appeareance' );


			// Add quantity layout field option
			$settings_appearance[] = array(
				'name'     => __( 'Product quantity selector', 'write-poetry' ),
				'id'       => "{$this->prefix}_product_quantity_layout",
				'default'  => 'input',
				'type'     => 'select',
				'value'    => get_option( "{$this->prefix}_product_quantity_layout" ),
				'desc'     => __( 'Choose the layout of quantity selector on the product page', 'write-poetry' ),
				'options' => array(
					'hidden' =>  __( 'Hidden (Product quantity will be always forced to one item)', 'write-poetry' ),
					'input'	 =>  __( 'Input', 'write-poetry' ),
					'select' =>  __( 'Select', 'write-poetry' ),
					'buttons' =>  __( 'Buttons', 'write-poetry' )
			   	), // array of options for select/multiselects only
				'custom_attributes' => $this->setCustomAttribute( "{$this->prefix}_product_quantity_layout" )

			);


			// Add single product checkbox option
			$settings_appearance[] = array(
				'id'       => "{$this->prefix}_product_max_quantity",
				'type'     => 'number',
				'css'      => 'width:80px;',
				'desc'     => __( 'Max quantity input', 'write-poetry' ),
				'custom_attributes' => $this->setCustomAttribute( "{$this->prefix}_product_max_quantity" )
			);

			// Add single product minal quantity option
			$settings_appearance[] = array(
				'id'       => "{$this->prefix}_product_min_quantity",
				'type'     => 'number',
				'css'      => 'width:80px;',
				'desc'     => __( 'Min quantity input', 'write-poetry' ),
				'custom_attributes' => $this->setCustomAttribute( "{$this->prefix}_product_min_quantity" )
			);


			// Add single product checkbox option quantity input steps values
			$settings_appearance[] = array(
				'desc_tip' => __( 'Adjust the quantity input steps values', 'write-poetry' ),
				'id'       => "{$this->prefix}_quantity_input_step",
				'type'     => 'number',
				'css'      => 'width:80px;',
				'desc'     => __( 'Product quantity input steps', 'write-poetry' ),
				'custom_attributes' => $this->setCustomAttribute( "{$this->prefix}_quantity_input_step" )
			);


			// Add product zoom checkbox option
			$settings_appearance[] = array(
				'name'     => __( 'Zoom behaviour', 'write-poetry' ),
				'desc_tip' => __( 'This will enable or disable product image zoom on single product page', 'write-poetry' ),
				'id'       => "{$this->prefix}_product_zoom",
				'type'     => 'checkbox',
				'default'  => 'yes',
				'value'	   => get_option( "{$this->prefix}_product_zoom" ),
				'css'      => 'min-width:300px;',
				'desc'     => __( 'Enable Product Zoom', 'write-poetry' ),
				'custom_attributes' => $this->setCustomAttribute( "{$this->prefix}_product_zoom" )
			);




			// Add additional info layout field option
			$settings_appearance[] = array(
				'name'     => __( 'Additional infos layout', 'write-poetry' ),
				'id'       => "{$this->prefix}_product_infos_layout",
				'type'     => 'select',
				'desc'     => __( 'Choose the layout of additional informations box with this option!', 'write-poetry' ),
				'default'  => 'tabs',
				'options' => array(
					'tabs' => 'Tabs',
					'list' => 'List',
					'accordion' => 'Accordion',
				), // array of options for select/multiselects only
				'custom_attributes' => $this->setCustomAttribute( "{$this->prefix}_product_infos_layout" )
			);

			$settings_appearance[] = array( 'type' => 'sectionend', 'id' => 'appearance' );
			return $settings_appearance;

		/**
		 * If not, return the standard settings
		 **/
		} else {
			return $settings;
		}
	}

}

