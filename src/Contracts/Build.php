<?php
/**
 * Build interface.
 *
 * Defines the interface that build classes must use.
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
