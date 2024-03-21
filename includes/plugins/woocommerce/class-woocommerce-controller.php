<?php
/**
 * Manage WooCommerce functionalities.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Plugins
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.5
 */

namespace WritePoetry\Plugins\WooCommerce;

use WritePoetry\Base\Base_Controller;

/**
 * Class WooCommerce_Controller
 *
 * @package WritePoetry\Plugins\WooCommerce
 */
class WooCommerce_Controller extends Base_Controller {

	/**
	 * Initialize the class.
	 */
	public function __construct() {
		parent::__construct();

		add_filter( 'woocommerce_locate_template', array( $this, 'addon_plugin_template' ), 1, 3 );
	}

	/**
	 * Disable quantity selector for product and product variation.
	 *
	 * @param int      $max_qty The maximum quantity.
	 * @param int|null $min_qty The minimum quantity.
	 */
	public function change_quantity_input( $max_qty, $min_qty = null ) {

		add_filter(
			'woocommerce_quantity_input_args',
			function ( $args ) use ( $max_qty, $min_qty ) {
				$args['max_value'] = $max_qty;

				if ( $min_qty ) {
					$args['min_value'] = $min_qty;
				}
				return $args;
			},
			10,
			2
		);

		add_filter(
			'woocommerce_available_variation',
			function ( $data ) use ( $max_qty, $min_qty ) {
				$data['max_qty'] = $max_qty;

				if ( $min_qty ) {
					$data['min_qty'] = $min_qty;
				}

				return $data;
			},
			10,
			3
		);
	}

	/**
	 * Add custom template path for WooCommerce.
	 *
	 * @param string $template The template path.
	 * @param string $template_name The template name.
	 * @param string $template_path The template path.
	 *
	 * @see https://wisdmlabs.com/blog/override-woocommerce-templates-plugin/.
	 *
	 * @return string The modified template path.
	 */
	public function addon_plugin_template( $template, $template_name, $template_path ) {
		global $woocommerce;
		$_template = $template;

		if ( ! $template_path ) {
			$template_path = $woocommerce->template_url;
		}

		$plugin_path = untrailingslashit( $this->plugin_path ) . '/woocommerce/';

		// Apply filter to exclude specific template.
		$excluded_templates = apply_filters( "{$this->prefix}_exclude_woocommerce_template", array() );

		foreach ( $excluded_templates as $excluded_template ) {
			if ( $template_name === $excluded_template ) {
				return $template;
			}
		}

		// Look within passed path within the theme - this is priority.
		$template = locate_template(
			array(
				$template_path . $template_name,
				$template_name,
			)
		);

		if ( ! $template && file_exists( $plugin_path . $template_name ) ) {
			$template = $plugin_path . $template_name;
		}

		if ( ! $template ) {
			$template = $_template;
		}

		return $template;
	}
}
