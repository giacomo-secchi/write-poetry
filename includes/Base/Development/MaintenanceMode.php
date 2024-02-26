<?php
/**
 * The Maintenance Mode class.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Base/Development
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 rGiacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.4
 */

namespace WritePoetry\Base\Development;

use WritePoetry\Base\BaseController;
use WritePoetry\Base\Utils;

/**
 * Class MaintenanceMode
 */
class MaintenanceMode extends BaseController {
	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {

		// Keep the default behaviour if standard method is enabled.
		if ( wp_is_maintenance_mode() ) {
			return;
		}

		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			return;
		}

		add_action( 'wp', array( $this, 'check_excluded_pages' ) );
	}


	/**
	 * Exclude pages from maintenance mode.
	 *
	 * @return void
	 */
	public function check_excluded_pages() {
		global $post;

		if ( ! empty( $post->post_name ) ) {
			$current_page = $post->post_name;
		}

		if (
			is_user_logged_in() ||
			is_login() ||
			in_array( $current_page, apply_filters( "{$this->prefix}_maintenance_excluded_pages", array() ), true )
		) {
			return;
		}

		if ( '1' === get_option( "{$this->prefix}_maintenance_mode" ) ) {
			$this->wp_maintenance();
		}
	}

	/**
	 * This function is a copy of the function wp_maintenance() defined in
	 * /wp-includes/load.php. It has been replicated here becuase the core one does not have any hooks
	 *
	 * @see https://github.com/WordPress/WordPress/blob/93eaafe9c10c96f4bb6d1bd37229f77cd160967a/wp-includes/load.php#L372
	 * @return void
	 */
	public function wp_maintenance() {
		// Return if maintenance mode is disabled.
		if ( ! wp_is_maintenance_mode() ) {
			return;
		}

		if ( file_exists( WP_CONTENT_DIR . '/maintenance.php' ) ) {
			require_once WP_CONTENT_DIR . '/maintenance.php';
			die();
		}

		require_once ABSPATH . WPINC . '/functions.php';
		wp_load_translations_early();

		header( 'Retry-After: 600' );

		wp_die(
			esc_html__( 'Briefly unavailable for scheduled maintenance. Check back in a minute.', 'write-poetry' ),
			esc_html__( 'Maintenance', 'write-poetry' ),
			503
		);
	}
}
