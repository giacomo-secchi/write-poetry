<?php
/**
 * @package  AlecadddPlugin
 */
namespace WritePoetry\Base;

use \WritePoetry\Base\BaseController;
use \WritePoetry\Api\PluginConfig;

class Activate extends BaseController {

	public static function activate() {
		flush_rewrite_rules();

		$config = PluginConfig::getInstance();

		if ( class_exists( 'WooCommerce' ) ) {

			if ( get_option( "{$config->prefix}_redirect_after_add" ) ) {
				return false;
			}

			update_option( "{$config->prefix}_redirect_after_add", ( get_option( 'woocommerce_cart_redirect_after_add' ) === 'yes' ) ? 'cart' : '' );
		}
	}
}
