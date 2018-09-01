<?php
/**
 * Crumb interface.
 *
 * Defines the interface that crumb classes must use.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Contracts;

/**
 * Crumb interface.
 *
 * @since  1.0.0
 * @access public
 */
interface Crumb {

	/**
	 * Returns a type for the crumb.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function type();

	/**
	 * Returns a text label for the crumb.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function label();

	/**
	 * Returns a URL for the crumb.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function url();
}
