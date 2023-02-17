<?php
/**
 * Plugin Name: My Custom Functions
 * Plugin URI: http://yoursite.com
 * Description: This is an awesome custom plugin with functionality that I'd like to keep when switching things.
 * Author: Giacomo Secchi
 * Author URI: https://giacomosecchi.com
 * Version: 0.1.0
 */

/* Place custom code below this line. */

 
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}

$includes_path = plugin_dir_path( __FILE__ ) . 'includes/';


foreach ( glob("includes/*.php") as $file ) {
    include( plugin_dir_path( __FILE__ ) . $file );
}

function mcf_is_development_environment() {
    return in_array( wp_get_environment_type(), array( 'development', 'local' ), true );
}


// Remove query string from static CSS files
function mcf_remove_query_string_from_static_files( $src ) {
     
    if ( ! mcf_is_development_environment() ) {
        return;
    }

    if( strpos( $src, '?ver=' ) ) {
        $src = remove_query_arg( 'ver', $src );
    }

    return $src;
}

add_filter( 'style_loader_src', 'mcf_remove_query_string_from_static_files', 10, 2 );
add_filter( 'script_loader_src', 'mcf_remove_query_string_from_static_files', 10, 2 );

// https://make.wordpress.org/core/2019/10/09/introducing-handling-of-big-images-in-wordpress-5-3/
add_filter( 'big_image_size_threshold', '__return_false' );


/* Place custom code above this line. */
?>
