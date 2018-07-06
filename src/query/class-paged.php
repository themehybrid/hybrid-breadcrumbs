<?php
/**
 * Paged query class.
 *
 * Called to build breadcrumbs on paged pages, assuming a more specific query
 * isn't called first. This is merely a fallback and shouldn't be called under
 * most circumstances.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Query;

/**
 * Paged query sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class Paged extends Query {

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

		// Build paged crumbs.
		$this->builder->build( 'Paged' );
	}
}