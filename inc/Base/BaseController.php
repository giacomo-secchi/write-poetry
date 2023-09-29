<?php
/**
 * Base class.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 */

namespace WritePoetry\Base;
use \WritePoetry\Api\PluginConfig;


/**
*
*/
class BaseController {


	private $config;


	public function __construct() {
		$this->config = new PluginConfig();
	}

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

