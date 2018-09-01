<?php
/**
 * Error crumb class.
 *
 * Creates the error 404 crumb.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Crumb;

/**
 * Error 404 crumb sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class Error extends Base {

	/**
	 * Returns a label for the crumb.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function label() {

		return $this->breadcrumbs->label( 'error_404' );
	}
}
