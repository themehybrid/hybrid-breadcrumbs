<?php
/**
 * Home crumb class.
 *
 * Creates the home crumb.
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
 * Home crumb sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class Home extends Base {

	/**
	 * Returns a label for the crumb.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function label() {

		$network = $this->breadcrumbs->option( 'network' ) && ! is_main_site();

		return $network ? get_bloginfo( 'name' ) : $this->breadcrumbs->label( 'home' );
	}

	/**
	 * Returns a URL for the crumb.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function url() {

		return user_trailingslashit( home_url() );
	}
}
