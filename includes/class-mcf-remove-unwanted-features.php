<?php
/**
 * Remove unwanted assets
 *
 * @package     MCF
 * @subpackage  MCF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class MCF_Remove_Unwated_Features {

	/**
	 * Initialize the class
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'stop_heartbeat' ), 1 );

		$this->turn_off_stuff();

	}

	/**
     * Disable Heartbeat
     *
     * @since  1.0.0
     * @access public
	 * @link https://it.siteground.com/tutorial/wordpress/limitare-heartbeat/
     * @return void
     */
	function stop_heartbeat() {
		wp_deregister_script('heartbeat');
	}



	/**
     * Disable features
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
	function turn_off_stuff() {
		$hook_names = array(
			'big_image_size_threshold'	// https://make.wordpress.org/core/2019/10/09/introducing-handling-of-big-images-in-wordpress-5-3/
		);


		foreach ( apply_filters( 'mcf_disable_features', $hook_names ) as $hook_name ) {
			if ( empty( $hook_name ) ) {
				return;
			}


			add_filter( $hook_name, '__return_false' );
		}
	}
}
