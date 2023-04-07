<?php
/**
 * Plugin Name: My Custom Functions
 * Plugin URI: https://github.com/giacomo-secchi/functionality-plugin
 * Description: This is an awesome custom plugin with functionality that I'd like to keep when switching things.
 * Author: Giacomo Secchi
 * Author URI: https://giacomosecchi.com
 * Version: 0.0.2
 */

/* Place custom code below this line. */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Include our updater file
include_once( plugin_dir_path( __FILE__ ) . 'update.php');

$updater = new Smashing_Updater( __FILE__ ); // instantiate our class
$updater->set_username( 'giacomo-secchi' ); // set username
$updater->set_repository( 'functionality-plugin' ); // set repo


// if ( ! class_exists( 'MCF_Plugin' ) ) {
// 	class MCF_Plugin {
// 		protected $plugin_slug;
// 		protected $version;
// 		protected $cache_key;
// 		protected $cache_allowed;
// 		protected $file;
// 		protected $plugin;
// 		protected $basename;
// 		protected $active;

// 		public function __construct() {

// 			$this->plugin_slug = plugin_basename( __DIR__ );
// 			$this->version = '1.0';
// 			$this->cache_key = 'mcf_custom_upd';
// 			$this->cache_allowed = false;
// 			add_action( 'admin_init', array( $this, 'set_plugin_properties' ) );


// 			add_filter( 'plugins_api', array( $this, 'get_plugin_informations' ), 20, 3 );
// 			add_filter( 'site_transient_update_plugins', array( $this, 'push_update' ) );
// 			add_action( 'upgrader_process_complete', array( $this, 'purge' ), 10, 2 );

// 		}

// 		public function set_plugin_properties() {
// 			$this->plugin   = get_plugin_data( $this->file );
// 			$this->basename = plugin_basename( $this->file );
// 			$this->active   = is_plugin_active( $this->basename );
// 		}

// 		public function request () {

// 			$remote = get_transient( $this->cache_key );

// 			if ( false === $remote || ! $this->cache_allowed ) {

// 				$remote = wp_remote_get(
// 					'http://test.local/wp-content/uploads/updater/info.json',
// 					array(
// 						'timeout' => 10,
// 						'headers' => array(
// 							'Accept' => 'application/json'
// 						)
// 					)
// 				);

// 				if (
// 					is_wp_error( $remote )
// 					|| 200 !== wp_remote_retrieve_response_code( $remote )
// 					|| empty( wp_remote_retrieve_body( $remote ) )
// 				) {
// 					return false;
// 				}

// 				set_transient( $this->cache_key, $remote, DAY_IN_SECONDS );

// 			}

// 			$remote = json_decode( wp_remote_retrieve_body( $remote ) );

// 			return $remote;

// 		}


// 		function get_plugin_informations( $res, $action, $args ) {


// 			// do nothing if you're not getting plugin information right now
// 			if( 'plugin_information' !== $action ) {
// 				return $res;
// 			}

// 			// do nothing if it is not our plugin
// 			if( $this->plugin_slug !== $args->slug ) {
// 				return $res;
// 			}


// 			// get updates
// 			$remote = $this->request();

// 			if( ! $remote ) {
// 				return $res;
// 			}

// 			$res = new stdClass();

// 			$res->name = $remote->name;
// 			$res->slug = $remote->slug;
// 			$res->version = $remote->version;
// 			$res->tested = $remote->tested;
// 			$res->requires = $remote->requires;
// 			$res->author = $remote->author;
// 			$res->author_profile = $remote->author_profile;
// 			$res->download_link = $remote->download_url;
// 			$res->trunk = $remote->download_url;
// 			$res->requires_php = $remote->requires_php;
// 			$res->last_updated = $remote->last_updated;

// 			$res->sections = array(
// 				'description' => $remote->sections->description,
// 				'installation' => $remote->sections->installation,
// 				'changelog' => $remote->sections->changelog
// 			);

// 			if( ! empty( $remote->banners ) ) {
// 				$res->banners = array(
// 					'low' => $remote->banners->low,
// 					'high' => $remote->banners->high
// 				);
// 			}

// 			return $res;

// 		}

// 		public function push_update( $transient ) {

// 			if ( empty($transient->checked ) ) {
// 				return $transient;
// 			}

// 			$remote = $this->request();

// 			if(
// 				$remote
// 				&& version_compare( $this->version, $remote->version, '<' )
// 				&& version_compare( $remote->requires, get_bloginfo( 'version' ), '<=' )
// 				&& version_compare( $remote->requires_php, PHP_VERSION, '<' )
// 			) {
// 				$res = new stdClass();

// 				$res->slug = $this->plugin_slug;
// 				$res->plugin = plugin_basename( __FILE__ ); // misha-update-plugin/misha-update-plugin.php
// 				$res->new_version = $remote->version;
// 				$res->tested = $remote->tested;
// 				$res->package = $remote->download_url;

// 				$transient->response[ $res->plugin ] = $res;

// 	    }

// 			return $transient;

// 		}

// 		public function purge( $upgrader, $options ){

// 			if (
// 				$this->cache_allowed
// 				&& 'update' === $options['action']
// 				&& 'plugin' === $options[ 'type' ]
// 			) {
// 				// just clean the cache when new plugin version is installed
// 				delete_transient( $this->cache_key );
// 			}

// 		}
// 	}
// }











/**
 * Begins execution of the plugin.
 *
 * Emergency filter if you want to force the deactivation of the plugin via hook,
 * since the plugin rest in the `mu-plugin` folder it is enabled by default and this is the only way to disable it
 *
 * add_filter( 'mcf_plugin_disable', '__return_true' );
 * @return void
 */
// function run_mcf_plugin() {
// 	// Instantiate our class
// 	new MCF_Plugin();
// }


// if ( ! apply_filters( 'mcf_plugin_disable', false ) ) {
// 	run_mcf_plugin();
// }

// if ( ! class_exists( 'MCF_Plugin' ) ) {
//     class MCF_Plugin {
// 		/**
// 		 * Instance of the class
// 		 *
// 		 * @since 1.0.0
// 		 * @var Instance of CTF class
// 		 */
// 		private static $instance;



// 		/**
// 		 * This is our constructor
// 		 *
// 		 * @return void
// 		 */
// 		private function __construct() {}

// 		/**
// 		 * If an instance exists, this returns it.  If not, it creates one and
// 		 * retuns it.
// 		 *
// 		 * @return MCF_Plugin
// 		 */

// 		public static function getInstance() {
// 			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof MCF_Plugin ) ) {
// 				self::$instance = new MCF_Plugin;
// 			}
//  			self::$instance->includes();
// 			self::$instance->init = new MCF_Init();


// 			return self::$instance;
// 		}


// 		public static function is_development_environment() {
// 			return in_array( wp_get_environment_type(), array( 'development', 'local' ), true );
// 		}


// 		/**
// 		 * Load the required files
// 		 *
// 		 * @since  1.0.0
// 		 * @access private
// 		 * @return void
// 		 */
// 		private function includes() {
// 			$includes_path = plugin_dir_path( __FILE__ ) . 'includes/';
// 			require_once $includes_path . 'class-mcf-register-post-types.php';
// 			// require_once $includes_path . 'class-mcf-register-taxonomies.php';
// 			// require_once $includes_path . 'class-mcf-remove-admin-bar.php';
// 			// require_once $includes_path . 'class-mcf-clean-up-head.php';
// 			// require_once $includes_path . 'class-mcf-close-comments.php';
// 			// require_once $includes_path . 'class-mcf-custom-feed-link.php';
// 			// require_once $includes_path . 'class-mcf-insert-figure.php';
// 			// require_once $includes_path . 'class-mcf-rcp-auto-renew.php';
// 			// require_once $includes_path . 'class-mcf-long-url-spam.php';
// 			// require_once $includes_path . 'class-mcf-remove-jetpack-bar.php';
// 			// require_once $includes_path . 'class-mcf-add-mime-types.php';
// 			// require_once $includes_path . 'class-mcf-remove-markdown-support.php';
// 			// require_once $includes_path . 'class-mcf-add-email-feed.php';
// 			// require_once $includes_path . 'class-mcf-increase-postmeta-form-limit.php';
// 			// require_once $includes_path . 'class-mcf-limit-users-delete.php';
// 			require_once $includes_path . 'class-mcf-remove-unwanted-features.php';
// 			require_once $includes_path . 'class-mcf-dev-tools.php';
// 			require_once $includes_path . 'class-mcf-metafield.php';
// 			require_once $includes_path . 'class-mcf-customize-login-page.php';
// 			// require_once $includes_path . 'class-mcf-remove-post-author-url.php';
// 			// require_once $includes_path . 'class-mcf-custom-pagi.php';
// 			// require_once $includes_path . 'class-mcf-allowed-tags.php';


// 			// require_once $includes_path . 'template-functions.php';
// 			// require_once $includes_path . 'misha-update-checker.php';
// 			require_once $includes_path . 'class-mcf-init.php';

// 			foreach ( glob($includes_path . "custom/*.php") as $file ) {
// 				require_once $file;
// 			}

// 		}


//     }

//     //MCF_Plugin::remove_query_string_from_static_files();

// }


