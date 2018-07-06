<?php
/**
 * Minute query class.
 *
 * Called to build breadcrumbs on minute archive pages.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Query;

/**
 * Minute query sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class Minute extends Query {

	/**
	 * Builds the breadcrumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function make() {

		// Build network crumbs.
		$this->builder->build( 'Network' );

		// Add site home crumb.
		$this->builder->crumb( 'Home' );

		// Build rewrite front crumbs.
		$this->builder->build( 'RewriteFront' );

		// Add minute crumb.
		$this->builder->crumb( 'Minute' );

		// Build paged crumbs.
		$this->builder->build( 'Paged' );
	}
}
