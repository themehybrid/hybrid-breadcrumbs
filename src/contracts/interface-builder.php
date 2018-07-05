<?php
/**
 * Builder interface.
 *
 * Defines the interface that builder classes must use.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Contracts;

/**
 * Builder interface.
 *
 * @since  1.0.0
 * @access public
 */
interface Builder {

	/**
	 * Creates a new `Query` object and runs its `make()` method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $type
	 * @param  array   $data
	 * @return void
	 */
	public function query( $type, array $data = [] );

	/**
	 * Creates a new `Build` object and runs its `make()` method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $type
	 * @param  array   $data
	 * @return void
	 */
	public function build( $type, array $data = [] );

	/**
	 * Creates a new `Crumb` object and adds it to the array of crumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $type
	 * @param  array   $data
	 * @return void
	 */
	public function crumb( $type, array $data = [] );

	/**
	 * Returns an array of `Crumb` objects.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function all();
}
