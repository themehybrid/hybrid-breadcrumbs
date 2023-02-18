<?php
/**
 * Day query class.
 *
 * Called to build breadcrumbs on day archive pages.
 *
 * @package   HybridBreadcrumbs
 * @link      https://github.com/themehybrid/hybrid-breadcrumbs
 *
 * @author    Theme Hybrid
 * @copyright Copyright (c) 2008 - 2023, Theme Hybrid
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
		$this->breadcrumbs->build( 'Network' );

		// Add site home crumb.
		$this->breadcrumbs->crumb( 'Home' );

		// Build rewrite front crumbs.
		$this->breadcrumbs->build( 'RewriteFront' );

		// Add year, month, and day crumbs.
		$this->breadcrumbs->crumb( 'Year' );
		$this->breadcrumbs->crumb( 'Month' );
		$this->breadcrumbs->crumb( 'Day' );

		// Build paged crumbs.
		$this->breadcrumbs->build( 'Paged' );
	}
}
