<?php

// namespace \WritePoetry\Pages\Admin\Views;
namespace WritePoetry\Pages\Admin\Views;

class HtmlContent {
    public static function getForm( $value, $nonce ) {

		return '
		<h1>My Awesome Settings Page</h1>
		<form method="POST">
		<label for="awesome_text">' . $value . '</label>
		<input type="text" name="awesome_text" id="awesome_text" value="' . $value . '">' .
		  wp_nonce_field( $nonce ) . '
		<input type="submit" value="Save" class="button button-primary button-large">
		</form>
        ';
    }
}
