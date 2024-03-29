<?php
/**
 * Manage configurations for Google Tag Manager for WordPress Plugin.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Plugins
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.3
 */

namespace WritePoetry\Plugins;

/**
 * Class Gtm4wp
 *
 * @package WritePoetry\Plugins
 */
class Gtm4wp {
	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'wp_body_open', array( $this, 'gtm_noscript_container_code' ) );
	}


	/**
	 * Manually coded Container code compatibility mode
	 * this functionality has been disabled,
	 * it seems that the plugin GTM4WP already call gtm4wp_the_gtm_tag function
	 * when 'Container code compatibility mode' is set to manual
	 *
	 * @return void
	 */
	public function gtm_noscript_container_code() {
		if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) {
			gtm4wp_the_gtm_tag(); }
	}
}
