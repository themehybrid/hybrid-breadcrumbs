<?php
/**
 * Post type crumb class.
 *
 * Creates the post type archive crumb.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Crumb;

/**
 * Post type crumb sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class PostType extends Base {

	/**
	 * Post type object.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    \WP_Post_Type
	 */
	protected $post_type;

	/**
	 * Returns a label for the crumb.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function label() {

		if ( is_post_type_archive( $this->post_type->name ) ) {

			return post_type_archive_title( '', false );
		}

		$labels = $this->post_type->labels;

		return apply_filters(
			'post_type_archive_title', // Core WP filter hook.
			! empty( $labels->archive_title ) ? $labels->archive_title : $labels->name,
			$this->post_type->name
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

		return get_post_type_archive_link( $this->post_type->name );
	}
}
