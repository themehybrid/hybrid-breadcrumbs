<?php
/**
 * Class autoloader.
 *
 * This file holds the class autoloader for the project so that we can load
 * classes on an as-needed basis.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs;

# Register our autoloader with PHP.
spl_autoload_register( function( $class ) {

	$namespace = __NAMESPACE__ . '\\';

	// Bail if the class is not in our namespace.
	if ( 0 !== strpos( $class, $namespace ) ) {
		return;
	}

	// Remove the namespace.
	$class = str_replace( $namespace, '', $class );

	// Build the filename.
	$file = __DIR__ . DIRECTORY_SEPARATOR . str_replace( '\\', DIRECTORY_SEPARATOR, $class ) . '.php';

	// If the file exists for the class name, load it.
	if ( file_exists( $file ) ) {
		include( $file );
	}

} );
