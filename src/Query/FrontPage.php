<?php
/**
 * Front page query class.
 *
 * Called to build breadcrumbs on the front page.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Query;

use Hybrid\Breadcrumbs\Util\Helpers;

/**
 * Front page query sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class FrontPage extends Base {

	/**
	 * Builds the breadcrumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function make() {

		if ( $this->breadcrumbs->option( 'show_on_front' ) || Helpers::isPagedView() ) {

			// Build network crumbs.
			$this->breadcrumbs->build( 'Network' );

			// Add site home crumb.
			$this->breadcrumbs->crumb( 'Home' );

			// Build paged crumbs.
			$this->breadcrumbs->build( 'Paged' );
		}
	}
}
