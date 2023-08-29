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


final class Init
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services() {
		return [
			Base\Development\Utils::class,
			Base\Utils::class,
			Base\AddMimeTypes::class,
			FSE\Theme\Assets::class,
			Pages\Admin::class,
			Pages\Admin\LoginScreen::class,
			Pages\Admin\SettingsLink::class,
			// Plugins\Gtm4wp::class
		];
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
