<?php
/**
 * Helper functions.
 *
 * Easy-to-use helper functions for use in themes and within the project itself.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs;

use Hybrid\Breadcrumbs\Util\Trail;

/**
 * Returns a new breadcrumbs object.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return Trail
 */
function breadcrumbs( array $args = [] ) {

	return Trail::breadcrumbs( $args );
}

/**
 * Returns a new breadcrumbs object after calling its `make()` method.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return Breadcrumbs
 */
function make( array $args = [] ) {

	return Trail::make( $args );
}

/**
 * Returns an array of `\Hybrid\Breadcrumbs\Contracts\Crumb` objects.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return array
 */
function all( array $args = [] ) {

	return Trail::all( $args );
}

/**
 * Renders the breadcrumb trail output.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return void
 */
function display( array $args = [] ) {

	Trail::display( $args );
}

/**
 * Returns the breadcrumb trail output.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return string
 */
function render( array $args = [] ) {

	return Trail::render( $args );
}
