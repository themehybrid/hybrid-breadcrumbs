<?php
/**
 * Network build class.
 *
 * This class builds out breadcrumbs to point to the main site in multisite.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Build;

/**
 * Network build sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class Network extends Base {

	/**
	 * Builds the breadcrumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function make() {

		if ( is_multisite() && $this->breadcrumbs->option( 'network' ) && ! is_main_site() ) {

			$this->breadcrumbs->crumb( 'Network' );
		}
	}
}
