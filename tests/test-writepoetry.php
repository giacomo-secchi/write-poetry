<?php
/**
 * Class SampleTest
 *
 * @package WritePoetry
 */

namespace WritePoetry\Tests;

use phpmock\phpunit\PHPMock;
/**
 * Get a plugin option from the WordPress database.
 *
 * @param string $name
 *
 * @return mixed
 */
function demo_get_option( $name ) {
	return get_option( 'writepoetry_' . $name );
}

/**
 * Sample test case.
 */
class WritePoetryTest extends \WP_UnitTestCase {

	use PHPMock;


	/**
	 * A single example test.
	 */
	public function set_up() {
		parent::set_up();

		// Mock that we're in WP Admin context.
		// See https://wordpress.stackexchange.com/questions/207358/unit-testing-in-the-wordpress-backend-is-admin-is-true
		set_current_screen( 'edit-post' );

		// $this->write_poetry = WritePoetry\Init::register_services();
	}

	public function tear_down() {
		parent::tear_down();
	}

	// public function test_has_settings_interface() {
	// $has_settings_interface = ( is_a( $this->write_poetry->settings, 'Starter_Plugin_Settings' ) );

	// $this->assertTrue( $has_settings_interface );
	// }

	public function test_demo_get_option() {
		$get_option = $this->getFunctionMock( 'WritePoetry\Tests', 'get_option' );

		$get_option->expects( $this->once() )
					->with( $this->equalTo( 'writepoetry_ciao' ) )
					->willReturn( 'bar' );

		$this->assertEquals( 'bar', demo_get_option( 'ciao' ) );
	}

	public function test_fallback() {
		$this->assertTrue( true );
	}
}
