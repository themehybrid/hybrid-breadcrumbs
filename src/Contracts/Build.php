<?php
/**
 * Build interface.
 *
 * Defines the interface that build classes must use.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Contracts;

/**
 * Build interface.
 *
 * @since  1.0.0
 * @access public
 */
interface Build {

	/**
	 * Builds breadcrumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function make();
}
