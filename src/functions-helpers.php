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

/**
 * Returns a new breadcrumbs object.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return Breadcrumbs
 */
function breadcrumbs( array $args = [] ) {

	return new Breadcrumbs( $args );
}

/**
 * Renders the breadcrumb trail output.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return void
 */
function render_trail( array $args = [] ) {

	breadcrumbs( $args )->render();
}

/**
 * Returns the breadcrumb trail output.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return string
 */
function fetch_trail( array $args = [] ) {

	return breadcrumbs( $args )->fetch();
}

/**
 * Helper function for determining whether we're viewing a paginated page.
 *
 * @since  1.0.0
 * @access public
 * @return bool
 */
function is_paged_view() {

	return is_paged() || 1 < get_query_var( 'page' ) || 1 < get_query_var( 'cpage' );
}

/**
 * Gets post types by slug. This is needed because the `get_post_types()`
 * function doesn't exactly match the `has_archive` argument when it's set as a
 * string instead of a boolean.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $slug
 * @return array
 */
 function get_post_types_by_slug( $slug ) {

	$return = [];

	$post_types = get_post_types( [], 'objects' );

	foreach ( $post_types as $type ) {

		if ( $slug === $type->has_archive || ( true === $type->has_archive && $slug === $type->rewrite['slug'] ) ) {

			$return[] = $type;
		}
	}

	return $return;
}
