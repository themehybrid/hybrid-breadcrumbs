<?php
/**
 * Query class.
 *
 * This is the base class, which should be sub-classed, for building breadcrumbs
 * based on the current query. Each query class is based on the current WP main
 * query. Each class can call another query class, one or more build classes, or
 * one or more crumb classes.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Query;

use Hybrid\Breadcrumbs\Contracts\Breadcrumbs;
use Hybrid\Breadcrumbs\Contracts\Query;

/**
 * Base query class.
 *
 * @since  1.0.0
 * @access public
 */
abstract class Base implements Query {

	/**
	 * Breadcrumbs object.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Breadcrumbs
	 */
	protected $breadcrumbs;

	/**
	 * Creates a new query object. Any data passed in within the `$data`
	 * array will be automatically assigned to any existing properties, which
	 * can be useful for sub-classes that have custom properties.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Breadcrumbs $breadcrumbs
	 * @param  array       $data
	 * @return void
	 */
	public function __construct( Breadcrumbs $breadcrumbs, array $data = [] ) {

		foreach ( array_keys( get_object_vars( $this ) ) as $key ) {

			if ( isset( $data[ $key ] ) ) {
				$this->$key = $data[ $key ];
			}
		}

		$this->breadcrumbs = $breadcrumbs;
	}

	/**
	 * Override this method in sub-classes to build out breadcrumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	abstract public function make();
}
