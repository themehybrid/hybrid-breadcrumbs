<?php
/**
 * Minute + Hour crumb class.
 *
 * Creates the minute + hour archive crumb.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Crumb;

/**
 * Minute + Hour crumb sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class MinuteHour extends Base {

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
			$this->breadcrumbs->label( 'archive_minute_hour' ),
			get_the_time(
				esc_html_x( 'g:i a', 'minute and hour archives time format', 'hybrid-core' ),
				$this->post
			)
		);
	}
}
