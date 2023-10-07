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
	public $plugin_name;
	public $prefix;


    public function __construct() {

		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin_name = plugin_basename( dirname( __FILE__, 3 ) . '/write-poetry.php' );
		$this->prefix = preg_replace( "/[^A-Za-z0-9 ]/", '', plugin_basename( $this->plugin_path ) );

    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}