<?php
/**
 * Trail class.
 *
 * A static class to offer easy-to-use methods for creating a breadcrumb trail.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Util;

use Hybrid\Breadcrumbs\Core\Trail as Breadcrumbs;

/**
 * Trail class.
 *
 * @since  1.0.0
 * @access public
 */
class Trail {

	/**
	 * Returns a new breadcrumbs object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $args
	 * @return Breadcrumbs
	 */
	public static function breadcrumbs( array $args = [] ) {

		return ( new Breadcrumbs( $args ) )->make();
	}

	/**
	 * Renders the breadcrumb trail output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $args
	 * @return void
	 */
	public static function display( array $args = [] ) {

		static::breadcrumbs( $args )->display();
	}

	/**
	 * Returns the breadcrumb trail output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $args
	 * @return string
	 */
	public static function fetch( array $args = [] ) {

		return static::breadcrumbs( $args )->fetch();
	}
}
