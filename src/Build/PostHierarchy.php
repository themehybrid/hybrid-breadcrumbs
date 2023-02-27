<?php
/**
 * Post hierarchy build class.
 *
 * Builds breadcrumbs primarily based on the post type rewrite settings of the
 * given post.
 *
 * @package   HybridBreadcrumbs
 * @link      https://github.com/themehybrid/hybrid-breadcrumbs
 *
 * @author    Theme Hybrid
 * @copyright Copyright (c) 2008 - 2023, Theme Hybrid
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Build;

use Hybrid\Breadcrumbs\Crumb\PostType;

/**
 * Post hierarchy build sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class PostHierarchy extends Base {

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

        // Get the post type.
        $type = get_post_type_object( get_post_type( $this->post->ID ) );

        // If this is the 'post' post type, get the rewrite front items,
        // map the rewrite tags, and bail early.
        if ( 'post' === $type->name ) {

            // Add $wp_rewrite->front to the trail.
            $this->breadcrumbs->build( 'RewriteFront' );

            // Map the rewrite tags.
            $this->breadcrumbs->build( 'MapRewriteTags', [
                'post' => $this->post,
                'path' => get_option( 'permalink_structure' ),
            ] );

            return;
        }

        $rewrite        = $type->rewrite;
        $done_post_type = false;

        // If the post type has rewrite rules.
        if ( $rewrite ) {

            // Build the rewrite front crumbs.
            if ( $rewrite['with_front'] ) {

                $this->breadcrumbs->build( 'RewriteFront' );
            }

            // If there's a path, check for parents.
            if ( $rewrite['slug'] ) {
                $this->breadcrumbs->build( 'Path', [ 'path' => $rewrite['slug'] ] );

                // Check if we've added a post type crumb.
                foreach ( $this->breadcrumbs->all() as $crumb ) {
                    if ( $crumb instanceof PostType ) {
                        $done_post_type = true;
                        break;
                    }
                }
            }
        }

        // Fall back to the post type crumb if not getting from path.
        if ( ! $done_post_type && $type->has_archive ) {
            $this->breadcrumbs->build( 'PostType', [ 'post_type' => $type ] );
        }

        // Map the rewrite tags if there's a `%` in the slug.
        if ( $rewrite && false !== strpos( $rewrite['slug'], '%' ) ) {

            $this->breadcrumbs->build( 'MapRewriteTags', [
                'post' => $this->post,
                'path' => $rewrite['slug'],
            ] );
        }
    }

}
