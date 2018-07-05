<?php
/**
 * Breadcrumbs interface.
 *
 * Defines the interface that breadcrumbs classes must use.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Contracts;

/**
 * Breadcrumbs interface.
 *
 * @since  1.0.0
 * @access public
 */
interface Breadcrumbs {

	/**
	 * Renders the breadcrumbs HTML output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function render();

	/**
	 * Returns the breadcrumbs HTML output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function fetch();

	/**
	 * Returns a specific option or `false` if the option doesn't exist.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return mixed
	 */
	public function option( $name );

	/**
	 * Returns a specific label or an empty string if it doesn't exist.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return string
	 */
	public function label( $name );

	/**
	 * Returns a specific post taxonomy or an empty string if one isn't set.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return string
	 */
	public function postTaxonomy( $name );
}
