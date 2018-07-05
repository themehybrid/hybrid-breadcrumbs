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

	$file       = '';
	$new_pieces = [];

	// Remove the namespace.
	$class = str_replace( $namespace, '', $class );

	// Explode the full class name into an array of items by sub-namespace
	// and class name.
	$pieces = explode( '\\', $class );

	foreach ( $pieces as $piece ) {

		// Split pieces by uppercase letter.  Assume sub-namespaces and
		// classes are in "PascalCase".
		$pascal = preg_split( '/(?=[A-Z])/', $piece,  -1, PREG_SPLIT_NO_EMPTY );

		// Lowercase and hyphenate the word pieces within a string.
		$new_pieces[] = strtolower( join( '-', $pascal ) );
	}

	// Gets the prefix. `class-` for classes and `interface-` for interfaces.
	$prefix = !! array_intersect( [ 'contract', 'contracts', 'interface', 'interface' ], $new_pieces )
	          ? 'interface'
		  : 'class';

	// Pop the last item off the array and re-add it with the `class-` prefix
	// and the `.php` file extension.  This is our class file.
	$new_pieces[] = sprintf( '%s-%s.php', $prefix, array_pop( $new_pieces ) );

	// Join all the pieces together by a forward slash. These are directories.
	$file = join( DIRECTORY_SEPARATOR, $new_pieces );

	// Append the file name to the framework directory.
	$file = trailingslashit( __DIR__ ) . $file;

	// Include the file only if it exists.
	if ( file_exists( $file ) ) {
		include( $file );
	}
} );
