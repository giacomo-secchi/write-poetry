<?php
/**
 * Base configurations.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.5
 */

namespace WritePoetry\Base;

use WritePoetry\Api\PluginConfig;

class Activate {

	public static function activate() {

		$config = PluginConfig::getInstance();

		if ( class_exists( 'WooCommerce' ) ) {

			if ( get_option( "{$config->prefix}_redirect_after_add" ) ) {
				return false;
			}

			update_option( "{$config->prefix}_redirect_after_add", ( get_option( 'woocommerce_cart_redirect_after_add' ) === 'yes' ) ? 'cart' : '' );
		}

		flush_rewrite_rules();
	}
}
