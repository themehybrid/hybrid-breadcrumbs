<?php
/**
 * Post type archive query class.
 *
 * Called to build breadcrumbs on post type archive pages. Note that the `Home`
 * query class should be used for the posts page.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Query;

/**
 * Post type archive query sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class PostTypeArchive extends Base {

	/**
	 * Builds the breadcrumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function make() {

		// Build network crumbs.
		$this->breadcrumbs->build( 'Network' );

		// Add site home crumb.
		$this->breadcrumbs->crumb( 'Home' );

		// Get the post type object.
		$type = get_post_type_object( get_query_var( 'post_type' ) );

		if ( false !== $type->rewrite ) {

			// Build rewrite front crumbs if post type uses it.
			if ( $type->rewrite['with_front'] ) {
				$this->breadcrumbs->build( 'RewriteFront' );
			}

			// If there's a rewrite slug, check for parents.
			if ( ! empty( $type->rewrite['slug'] ) ) {

				$this->breadcrumbs->build( 'Path', [
					'path' => $type->rewrite['slug']
				] );
			}
		}

		// Add post type crumb.
		$this->breadcrumbs->crumb( 'PostType', [ 'post_type' => $type ] );

		// If viewing a search page for the post type archive.
		if ( is_search() ) {

			// Add search crumb.
			$this->breadcrumbs->crumb( 'Search' );
		}

		// If viewing a post type archive by author.
		if ( is_author() ) {

			// Add author crumb.
			$this->breadcrumbs->crumb( 'Author', [
				'user' => new WP_User( get_query_var( 'author' ) )
			] );
		}

		// Build paged crumbs.
		$this->breadcrumbs->build( 'Paged' );
	}
}
