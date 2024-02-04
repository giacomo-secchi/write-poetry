<?php
/**
 * Example class.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base/Development
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.4
 */

namespace WritePoetry\Base\Development;

use WritePoetry\Base\BaseController;
use WritePoetry\Base\Utils;

/**
 *
 */
class MaintenanceMode extends BaseController {
	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {

		// Keep the default behaviour if standard method is enabled
		if ( wp_is_maintenance_mode() ) {
			return;
		}

		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			return;
		}

		add_action( 'wp', array( $this, 'excluded_pages' ) );
	}



	public function excluded_pages() {
		global $post;

		if ( ! empty( $post->post_name ) ) {
			$current_page = $post->post_name;
		}

		if (
			is_user_logged_in() ||
			is_login() ||
			in_array( $current_page, apply_filters( "{$this->prefix}_maintenance_excluded_pages", array() ) )
		) {
			return;
		}

		if ( '1' == get_option( "{$this->prefix}_maintenance_mode" ) ) {
			$this->wp_maintenance();
		}
	}

	public function wp_maintenance() {
		if ( file_exists( WP_CONTENT_DIR . '/maintenance.php' ) ) {
			require_once WP_CONTENT_DIR . '/maintenance.php';
			die();
		}

		require_once ABSPATH . WPINC . '/functions.php';
		wp_load_translations_early();

		header( 'Retry-After: 600' );

		wp_die(
			__( 'Briefly unavailable for scheduled maintenance. Check back in a minute.' ),
			__( 'Maintenance' ),
			503
		);
	}
}
