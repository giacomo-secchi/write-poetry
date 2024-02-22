<?php
/**
 * Manage general settings.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Api
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.4
 */

namespace WritePoetry\Api;

/**
 * Manage general settings class.
 */
class PluginConfig {
	/**
	 * Instance of the class
	 *
	 * @var null
	 */
	private static $instance;

	/**
	 * Plugin path
	 *
	 * @var string
	 */
	public $plugin_path;

	/**
	 * Plugin URL
	 *
	 * @var string
	 */
	public $plugin_url;

	/**
	 * Build path
	 *
	 * @var string
	 */
	public $build_path;

	/**
	 * Build URL
	 *
	 * @var string
	 */
	public $build_url;

	/**
	 * Plugin name
	 *
	 * @var string
	 */
	public $plugin_name;

	/**
	 * Plugin main file
	 *
	 * @var string
	 */
	public $plugin_main_file;

	/**
	 * Prefix
	 *
	 * @var string
	 */
	public $prefix;

	/**
	 * GitHub username
	 *
	 * @var string
	 */
	public $github_username;

	/**
	 * GitHub repository
	 *
	 * @var string
	 */
	public $github_repo;

	/**
	 * Authorize
	 *
	 * @var string
	 */
	public $authorize;

	/**
	 * PluginConfig constructor.
	 */
	public function __construct() {
		$this->plugin_path      = wp_normalize_path( plugin_dir_path( dirname( __DIR__, 1 ) ) );
		$this->plugin_url       = plugin_dir_url( dirname( __DIR__, 1 ) );
		$this->build_path       = $this->plugin_path . 'build';
		$this->build_url        = $this->plugin_url . 'build';
		$this->plugin_name      = plugin_basename( dirname( __DIR__, 2 ) . '/write-poetry.php' );
		$this->plugin_main_file = wp_normalize_path( $this->plugin_path . 'write-poetry.php' );
		$this->prefix           = preg_replace( '/[^A-Za-z0-9 ]/', '', plugin_basename( $this->plugin_path ) );
		$this->github_username  = 'giacomo-secchi';
		$this->github_repo      = 'write-poetry';
		$this->authorize        = 'abcdefghijk1234567890';
	}

	/**
	 * Get instance of the class
	 *
	 * @return PluginConfig
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
