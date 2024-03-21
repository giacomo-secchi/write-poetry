<?php
/**
 * Base class.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.5
 */

namespace WritePoetry\Base;

use WritePoetry\Api\Plugin_Config;

/**
 * Base class.
 */
class Base_Controller {

	/**
	 * Configuration object.
	 *
	 * @var object
	 */
	public $config;

	/**
	 * Initialize the class
	 */
	public function __construct() {
		$this->config = new Plugin_Config();
	}

	/**
	 * Magic method that allows accessing configuration properties as if they were class properties.
	 *
	 * @param string $property The name of the property to retrieve from the $config object.
	 *
	 * @return mixed The value of the requested property if it exists in $config.
	 * @throws \Exception If the requested property does not exist in the $config object.
	 */
	public function __get( $property ) {

		if ( property_exists( $this->config, $property ) ) {
			return $this->config->$property;
		} else {
			throw new \Exception( esc_html( "Property '$property' does not exist." ) );
		}
	}

	/**
	 * Check if WooCommerce is activated.
	 *
	 * @return bool
	 */
	public static function is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}
