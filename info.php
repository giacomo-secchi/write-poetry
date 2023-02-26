<?php
$update = array(
	'name' => 'Misha Update Checker',
	'slug' => 'misha-update-checker',

);

header( 'Content-Type: application/json' );
echo json_encode( $update );
