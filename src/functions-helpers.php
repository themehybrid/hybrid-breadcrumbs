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
 * Renders the breadcrumb trail output.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return void
 */
function render( array $args = [] ) {

	Trail::render( $args );
}

/**
 * Returns the breadcrumb trail output.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return string
 */
function fetch( array $args = [] ) {

	return Trail::fetch( $args );
}
