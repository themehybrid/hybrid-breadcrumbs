<?php
/**
 * Post type build class.
 *
 * Builds breadcrumbs for the give post type.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Build;

/**
 * Post type build sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class PostType extends Base {

	/**
	 * Post type slug.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $post_type = '';

	/**
	 * Builds the breadcrumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function make() {
		global $wp_rewrite;

		if ( ! post_type_exists( $this->post_type ) ) {
			return;
		}

		// If this the post type is `post`, add the posts page and bail.
		if ( 'post' === $this->post_type ) {

			$show_on_front = get_option( 'show_on_front'  );
			$post_id       = get_option( 'page_for_posts' );

			// Add post crumb if we have a posts page.
			if ( 'posts' !== $show_on_front && 0 < $post_id ) {

				$post = get_post( $post_id );

				// If the posts page is the same as the rewrite
				// front path, we should've already handled that
				// scenario at this point.
				if ( trim( $wp_rewrite->front, '/' ) !== $post->post_name ) {

					$this->breadcrumbs->crumb( 'Post', [
						'post' => $post
					] );
				}
			}

			return;
		}

		// Add post type crumb.
		$this->breadcrumbs->crumb( 'PostType', [
			'post_type' => get_post_type_object( $this->post_type )
		] );
	}
}
