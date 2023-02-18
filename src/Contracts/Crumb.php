<?php
/**
 * Crumb interface.
 *
 * Defines the interface that crumb classes must use.
 *
 * @package   HybridBreadcrumbs
 * @link      https://github.com/themehybrid/hybrid-breadcrumbs
 *
 * @author    Theme Hybrid
 * @copyright Copyright (c) 2008 - 2023, Theme Hybrid
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
