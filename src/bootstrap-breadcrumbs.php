<?php

# Bail if we're not in the WP environment.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

# Check if the framework has been bootstrapped. If not, load the bootstrap files
# and get the framework set up.
if ( ! defined( 'HYBRID_BREADCRUMBS_BOOTSTRAPPED' ) ) {

	// Autoload classes.
	require_once( __DIR__ . '/bootstrap-autoload.php'  );

	// Autoload functions.
	require_once( __DIR__ . '/functions-helpers.php' );

	define( 'HYBRID_BREADCRUMBS_BOOTSTRAPPED', true );
}
