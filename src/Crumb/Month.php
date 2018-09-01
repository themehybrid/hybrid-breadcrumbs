<?php
/**
 * Monthy crumb class.
 *
 * Creates the monthly archive crumb.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Crumb;

/**
 * Month crumb sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class Month extends Base {

	/**
	 * Post object.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    \WP_Post
	 */
	protected $post = null;

	/**
	 * Returns a label for the crumb.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function label() {

		return sprintf(
			$this->breadcrumbs->label( 'archive_month' ),
			get_the_time(
				esc_html_x( 'F', 'monthly archives date format', 'hybrid-core' ),
				$this->post
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

		return get_month_link(
			get_the_time( 'Y', $this->post ),
			get_the_time( 'm', $this->post )
		);
	}
}
