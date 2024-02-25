<?php
/**
 * Main Init Class
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/init
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.1
 */

namespace WritePoetry;

use WritePoetry\Api\PluginConfig;
use WritePoetry\Base\BaseController;


/**
 * Main Init class
 */
final class Init {

	/**
	 * Store all the classes inside an array
	 *
	 * @return array Full list of classes
	 */
	public static function get_services() {
		$config = PluginConfig::get_instance();

		$services = array(
			Api\RegisterPostTypes::class,
			Api\RegisterPostTaxonomies::class,
			Base\Development\MaintenanceMode::class,
			Base\Development\Utils::class,
			Base\Utils::class,
			FSE\Blocks::class,
			FSE\Theme\Assets::class,
			Pages\Admin\LoginScreen::class,
			// @phpcs:disable Squiz.Commenting.InlineComment.InvalidEndChar
			// Base\Development\Example::class,
			// Plugins\Jetpack\Portfolio::class,
			// Plugins\Gtm4wp::class
			// @phpcs:enable
		);

		if ( is_admin() ) {
			array_push(
				$services,
				Pages\Admin\SettingsPage::class,
				Pages\Admin\CustomMediaType::class,
				Pages\Admin\SettingsLink::class,
				Pages\Admin\WooCommercePage::class,
				Base\Updater\Updater::class
			);
		}

		if ( BaseController::is_woocommerce_activated() ) {
			array_push(
				$services,
				Plugins\WooCommerce\CartRedirect::class,
				Plugins\WooCommerce\ProductZoom::class,
				Plugins\WooCommerce\ProductAdditionalInfos::class,
				Plugins\WooCommerce\QuantityLayout::class,
				Plugins\WooCommerce\WooCommerceController::class
			);
		}

		return $services;
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the register() method if it exists
	 *
	 * @return void
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 *
	 * @param string $class_name The name of the class to instantiate.
	 * @return object The instantiated object.
	 */
	private static function instantiate( $class_name ) {
		$service = new $class_name();

		return $service;
	}
}
