<?php
/**
 * Post ancestors build class.
 *
 * Builds breadcrumbs based on whether a post has a parent post. It loops
 * through each post until a parent post is no longer found.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Build;

/**
 * Post ancestors build sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class PostAncestors extends Build {

	/**
	 * Post object.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    \WP_Post
	 */
	protected $post;

	/**
	 * Builds the breadcrumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function make() {

		$post_id = $this->post->post_parent;
		$parents = [];

		while ( $post_id ) {

			$show_on_front = get_option( 'show_on_front' );
			$page_on_front = get_option( 'page_on_front' );

			// If we hit a post that's set as the front page, bail.
			if ( 'posts' !== $show_on_front && $post_id === $page_on_front ) {
				break;
			}

			// Get the parent post.
			$post = get_post( $post_id );

			// Add the formatted post item to the array of parents.
			$parents[] = $post;

			// If there's no longer a post parent, break out of the loop.
			if ( 0 >= $post->post_parent ) {
				break;
			}

			// Change the post ID to the parent post to continue looping.
			$post_id = $post->post_parent;
		}

		// Get the post hierarchy based off the final parent post.
		$this->builder->build( 'PostHierarchy', [ 'post' => $post ] );

		// Display terms for specific post type taxonomy if requested.
		if ( $this->manager->postTaxonomy( $post->post_type ) ) {

			$this->builder->build( 'PostTerms', [
				'post'     => $post,
				'taxonomy' => $this->manager->postTaxonomy( $post->post_type )
			] );
		}

		if ( $parents ) {

			array_map( function( $parent ) {

				$this->builder->crumb( 'Post', [ 'post' => $parent ] );

			}, array_reverse( $parents ) );
		}
	}
}
