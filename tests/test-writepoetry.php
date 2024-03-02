<?php
/**
 * Class SampleTest
 *
 * @package WritePoetry
 */

/**
 * Sample test case.
 */
class WritePoetryTest extends WP_UnitTestCase {

	/**
	 * A single example test.
	 */
	public function set_up() {
        parent::set_up();

        // Mock that we're in WP Admin context.
		// See https://wordpress.stackexchange.com/questions/207358/unit-testing-in-the-wordpress-backend-is-admin-is-true
        set_current_screen( 'edit-post' );

        $this->write_poetry = WritePoetry\Init::register_services();

    }

	public function tear_down() {
        parent::tear_down();
    }

	public function test_has_settings_interface() {
		$has_settings_interface = ( is_a( $this->write_poetry->settings, 'Starter_Plugin_Settings' ) );

		$this->assertTrue( $has_settings_interface );
	}
}
