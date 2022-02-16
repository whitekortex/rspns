<?php

use ACFComposer\ACFComposer;

// Define Custom Post Type code...

// Register Custom Post Type code...
 
// Hook in ACF code

add_action('after_setup_theme', function () {
	ACFComposer::registerFieldGroup([
		// Define ACF files within here
		// see: https://github.com/flyntwp/acf-field-group-composer
	]);
});