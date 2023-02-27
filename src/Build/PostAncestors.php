<?php
/**
 * Post ancestors build class.
 *
 * Builds breadcrumbs based on whether a post has a parent post. It loops
 * through each post until a parent post is no longer found.
 *
 * @package   HybridBreadcrumbs
 * @link      https://github.com/themehybrid/hybrid-breadcrumbs
 *
 * @author    Theme Hybrid
 * @copyright Copyright (c) 2008 - 2023, Theme Hybrid
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Build;

/**
 * Post ancestors build sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class PostAncestors extends Base {

    /**
     * Post object.
     *
     * @since  1.0.0
     * @var    \WP_Post
     *
     * @access protected
     */
    protected $post;

    /**
     * Builds the breadcrumbs.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function make() {

        $post    = $this->post;
        $post_id = $post->post_parent;
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
        $this->breadcrumbs->build( 'PostHierarchy', [ 'post' => $post ] );

        // Display terms for specific post type taxonomy if requested.
        if ( $this->breadcrumbs->postTaxonomy( $post->post_type ) ) {

            $this->breadcrumbs->build( 'PostTerms', [
                'post'     => $post,
                'taxonomy' => $this->breadcrumbs->postTaxonomy( $post->post_type ),
            ] );
        }

        if ( $parents ) {

            array_map( function( $parent ) {

                $this->breadcrumbs->crumb( 'Post', [ 'post' => $parent ] );

            }, array_reverse( $parents ) );
        }
    }

}
