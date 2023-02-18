<?php
/**
 * Error crumb class.
 *
 * Creates the error 404 crumb.
 *
 * @package   HybridBreadcrumbs
 * @link      https://github.com/themehybrid/hybrid-breadcrumbs
 *
 * @author    Theme Hybrid
 * @copyright Copyright (c) 2008 - 2023, Theme Hybrid
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
