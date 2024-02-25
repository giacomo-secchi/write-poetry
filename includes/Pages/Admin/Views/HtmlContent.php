<?php
/**
 * Add HTML content for the settings page.
 *
 * @package           WritePoetry
 * @subpackage        WritePoetry\Pages\Admin\Views
 * @author            Giacomo Secchi <giacomo.secchi@gmail.com>
 * @copyright         2023 Giacomo Secchi
 * @license           GPL-2.0-or-later
 * @since             0.2.1
 */

namespace WritePoetry\Pages\Admin\Views;

use WritePoetry\Api\PluginConfig;
use WritePoetry\Pages\Admin\SettingsPage;

/**
 * Class HtmlContent
 */
class HtmlContent {
	/**
	 * Get the form.
	 *
	 * @return void
	 */
	public static function get_form() {

		$settings_page = new SettingsPage();
		$page          = $settings_page->getPageSlug();
		$option_group  = $settings_page->getOptionGroup();

		?>
		<div class="wrap">
			<h1>
			<?php
			echo esc_html(
				sprintf(
				/* translators: %s: Name of the settings page */
					__( '%s Settings', 'write-poetry' ),
					get_admin_page_title()
				)
			);
			?>
				</h1>

			<?php settings_errors(); ?>

			<form action="<?php echo esc_url( admin_url( 'options.php' ) ); ?>" method="post">
				<?php
					// output security fields for the registered setting "{$config->prefix}-settings-group".
					settings_fields( $option_group );
					// output setting sections and their fields
					// (sections are registered for "{$config->prefix}-settings", each field is registered to a specific section).
					do_settings_sections( $page );
					// output save settings button.
					submit_button( __( 'Save Settings', 'write-poetry' ) );
				?>
			</form>
		</div>
		<?php
	}
}
