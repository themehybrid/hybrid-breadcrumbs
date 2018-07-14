<?php
/**
 * Week crumb class.
 *
 * Creates the weekly archive crumb.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Crumb;

/**
 * Week crumb sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class Week extends Base {

	/**
	 * Returns a label for the crumb.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function label() {

		return sprintf(
			$this->breadcrumbs->label( 'archive_week' ),
			get_the_time(
				esc_html_x( 'W', 'weekly archives date format', 'hybrid-core' )
			)
		);
	}

	/**
	 * Returns a URL for the crumb.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function url() {

		return add_query_arg( [
			'm' => get_the_time( 'Y' ),
			'w' => get_the_time( 'W' )
		], user_trailingslashit( home_url() ) );
	}
}
