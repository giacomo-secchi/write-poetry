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
use \WritePoetry\Api\PluginConfig;



final class Init
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services() {
		$config = PluginConfig::getInstance();

		$services = array(
			Api\RegisterPostTypes::class,
			Api\RegisterPostTaxonomies::class,
			Base\Development\MaintenanceMode::class,
			Base\Development\Utils::class,
			Base\Utils::class,
			FSE\Blocks::class,
			FSE\Theme\Assets::class,
			Pages\Admin\LoginScreen::class,
			// Plugins\Jetpack\Portfolio::class,
			// Plugins\Gtm4wp::class
		);


		if ( is_admin() ) {
			array_push( $services,
				Pages\Admin\SettingsPage::class,
				Pages\Admin\CustomMediaType::class,
				Pages\Admin\SettingsLink::class,
				Pages\Admin\WooCommercePage::class,
				Base\Updater\Updater::class
			);
		}



		// TODO: Restore filter to be sure that all plugins are loaded before check if WooCommerce is enabled
		// add_filter( 'plugins_loaded', function ( ) use ( $services ) {

			if ( class_exists( 'WooCommerce' ) ) {
				array_push( $services,
					Plugins\WooCommerce\CartRedirect::class,
					Plugins\WooCommerce\ProductZoom::class,
					Plugins\WooCommerce\ProductAdditionalInfos::class,
					Plugins\WooCommerce\WooCommerceController::class,
					Plugins\WooCommerce\QuantityLayout::class
				);
			}

		// } );


		return $services;
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the register() method if it exists
	 * @return
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
	 * @param  class $class    class from the services array
	 * @return class instance  new instance of the class
	 */
	private static function instantiate( $class ) {
		$service = new $class();

		return $service;
	}
}
