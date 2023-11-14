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
use \WritePoetry\Api\PluginConfig;


/**
*
*/
class BaseController {


	public $config;



	public function __construct() {
		$this->config = new PluginConfig();
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
            throw new \Exception("Property '$property' does not exist.");
        }
    }

	public function is_woocommerce_activated() {
		add_filter( 'plugins_loaded', function () {

			return class_exists( 'WooCommerce' ) ? true : false;
		} );

	}
}

