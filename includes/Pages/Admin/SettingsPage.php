<?php
/**
 * Options Settings subpage.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry/Pages
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.4
 */

namespace WritePoetry\Pages\Admin;

use WritePoetry\Pages\AdminController;


/**
 *
 */
class SettingsPage extends AdminController {

	private $page_slug;

	private $option_group;

	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	public function __construct() {

		parent::__construct();
		$this->page_slug    = "{$this->prefix}-settings";
		$this->option_group = "{$this->prefix}-settings-group";
	}

	public function getPageSlug() {
		return $this->page_slug;
	}

	public function getOptionGroup() {
		return $this->option_group;
	}

	/**
	 * Invoke hooks.
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'admin_menu', array( $this, 'adminMenu' ) );
		add_action( 'admin_init', array( $this, 'pageInit' ) );
	}


	public function adminMenu() {
		$page_title = __( 'Write Poetry', 'write-poetry' );
		$menu_title = __( 'Write Poetry', 'write-poetry' );
		$capability = 'manage_options';
		$menu_slug  = $this->page_slug;
		$callback   = array( $this, 'createAdminPage' );
		$position   = 24;

		// This page will be under "Settings"
		add_options_page( $page_title, $menu_title, $capability, $menu_slug, $callback, $position );
	}

	/**
	 * Options page callback
	 */
	public function createAdminPage() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Unauthorized user' );
		}

		// Set class property
		echo \WritePoetry\Pages\Admin\Views\HtmlContent::getForm();
	}


	/**
	 * Register and add settings
	 */
	public function pageInit() {
		$page         = $this->page_slug;
		$option_group = $this->option_group;

		$sections = array(
			array(
				'id'          => 'setting_section_custom_login',
				'title'       => __( 'Customize login page', 'write-poetry' ),
				'description' => sprintf(
					__( 'Replace the default WordPress logo, link and link text on the login screen page with your site logo or site icon if no logo is configured. <a href="%s">Add the site icon</a>.', 'write-poetry' ),
					self_admin_url( '/customize.php?autofocus[section]=title_tagline' ),
					__( 'Customizer' )
				),
			),
			array(
				'id'          => 'setting_section_maintenance_mode',
				'title'       => __( 'Enhanced maintenance mode', 'write-poetry' ),
				'description' => __( 'Put your website under maintenance', 'write-poetry' ),
			),
			// Add more sections as needed
		);

		foreach ( $sections as $section ) {

			$id       = $section['id'];
			$title    = $section['title'];
			$callback = function () use ( $section ) {
				$callback_name = $section['callback'] ?? 'section_callback';
				call_user_func( array( $this, $callback_name ), $section );
			};

			add_settings_section( $id, $title, $callback, $page );
		}

		$fields = array(
			array(
				'id'       => "{$this->prefix}_maintenance_mode",
				'title'    => __( 'Enable Maintenance', 'write-poetry' ),
				'callback' => 'checkboxInputTemplate',
				'section'  => 'setting_section_maintenance_mode',
			),
			array(
				'id'       => "{$this->prefix}_custom_login",
				'title'    => __( 'Enable custom login page', 'write-poetry' ),
				'callback' => 'checkboxInputTemplate',
				'section'  => 'setting_section_custom_login',
			),
			// Add more sections as needed
		);

		foreach ( $fields as $field ) {

			$option_name = $field['id'];
			$title       = $field['title'];
			$section     = $field['section'];
			$callback    = function () use ( $field ) {
				call_user_func( array( $this, $field['callback'] ), $field );
			};

			// Create Setting
			add_settings_field( $option_name, $title, $callback, $page, $section );

			$args = array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize' ),
				'default'           => 1,
			);

			register_setting(
				$option_group,
				$option_name,
				function () use ( $args ) {
					call_user_func( array( $this, 'sanitize' ), $args );
				}
			);
		}
	}

	/**
	 * Section callback function.
	 *
	 * @param array $args  The settings array, defining title, id, callback.
	 */
	function section_callback( $args ) {
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php _e( $args['description'] ); ?></p>
		<?php
	}



	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input ) {

		$new_input = array();
		if ( isset( $input['id_number'] ) ) {

		}
			$new_input['id_number'] = absint( $input['id_number'] );

		if ( isset( $input['title'] ) ) {
			$new_input['title'] = sanitize_text_field( $input['title'] );
		}

		return $new_input;
	}




	/**
	 * Get the settings option array and print one of its values
	 */
	public function checkboxInputTemplate( $args ) {
		$disable_checkbox_field = $this->hasFiltersForOption( $args['id'] );
		$checked                = get_option( $args['id'] );
		$current                = 1;
		$disable_current        = true;
		?>
		<input type="checkbox" id="<?php echo esc_attr( $args['id'] ); ?>" name="<?php echo esc_attr( $args['id'] ); ?>" value="1"<?php checked( $checked, $current ); ?>  <?php disabled( $disable_checkbox_field, $disable_current ); ?>/>
		<?php
	}
}

