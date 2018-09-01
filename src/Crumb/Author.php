<?php
/**
 * Author crumb class.
 *
 * Creates the author archive crumb.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Crumb;

/**
 * Author crumb sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class Author extends Base {

	/**
	 * User object.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    \WP_User
	 */
	protected $user;

	/**
	 * Returns a label for the crumb.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function label() {

		return get_the_author_meta( 'display_name', $this->user->ID );
	}

	/**
	 * Returns a URL for the crumb.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function url() {

		return get_author_posts_url( $this->user->ID );
	}
}
