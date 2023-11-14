<?php
/**
 * Mmanage general settings.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Api
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.4
 */

namespace WritePoetry\Api;


class PluginConfig {
    private static $instance;
	public $plugin_path;
	public $plugin_url;
	public $build_path;
	public $build_url;
	public $plugin_name;
	public $plugin_main_file;
	public $prefix;
	public $github_username;
	public $github_repo;
	public $authorize;


    public function __construct() {
		$this->plugin_path =  wp_normalize_path( plugin_dir_path( dirname( __FILE__, 2 ) ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->build_path = $this->plugin_path . 'build';
		$this->build_url = $this->plugin_url . 'build';
		$this->plugin_name = plugin_basename( dirname( __FILE__, 3 ) . '/write-poetry.php' );
		$this->plugin_main_file = wp_normalize_path( $this->plugin_path .'write-poetry.php' );
		$this->prefix = preg_replace( "/[^A-Za-z0-9 ]/", '', plugin_basename( $this->plugin_path ) );
		$this->github_username = 'giacomo-secchi';
		$this->github_repo =  'write-poetry';
		$this->authorize = 'abcdefghijk1234567890';
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
