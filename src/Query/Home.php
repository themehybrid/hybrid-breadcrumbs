<?php
/**
 * Home query class.
 *
 * Called to build breadcrumbs on the home (blog posts) page.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Query;

/**
 * Home query sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class Home extends Base {

	/**
	 * Builds the breadcrumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function make() {

		is_front_page()
			? $this->breadcrumbs->query( 'FrontPage' )
			: $this->breadcrumbs->query( 'Singular' );
	}
}
