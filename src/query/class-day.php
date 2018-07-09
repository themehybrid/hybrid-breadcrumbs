<?php
/**
 * Day query class.
 *
 * Called to build breadcrumbs on day archive pages.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Query;

/**
 * Day query sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class Day extends Base {

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

		// Add year, month, and day crumbs.
		$this->builder->crumb( 'Year' );
		$this->builder->crumb( 'Month' );
		$this->builder->crumb( 'Day' );

		// Build paged crumbs.
		$this->builder->build( 'Paged' );
	}
}
