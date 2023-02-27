<?php
/**
 * Post type archive query class.
 *
 * Called to build breadcrumbs on post type archive pages. Note that the `Home`
 * query class should be used for the posts page.
 *
 * @package   HybridBreadcrumbs
 * @link      https://github.com/themehybrid/hybrid-breadcrumbs
 *
 * @author    Theme Hybrid
 * @copyright Copyright (c) 2008 - 2023, Theme Hybrid
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Query;

use Hybrid\Breadcrumbs\Crumb\PostType;

/**
 * Post type archive query sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class PostTypeArchive extends Base {

    /**
     * Post type object.
     *
     * @since  1.2.0
     * @var    \WP_Post_Type
     *
     * @access protected
     */
    protected $post_type;

    /**
     * User object.
     *
     * @since  1.2.0
     * @var    \WP_User
     *
     * @access protected
     */
    protected $user;

    /**
     * Builds the breadcrumbs.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function make() {

        $type = $this->post_type ?: get_post_type_object( get_query_var( 'post_type' ) );

        $done_post_type = false;

        // Build network crumbs.
        $this->breadcrumbs->build( 'Network' );

        // Add site home crumb.
        $this->breadcrumbs->crumb( 'Home' );

        if ( false !== $type->rewrite ) {

            // Build rewrite front crumbs if post type uses it.
            if ( $type->rewrite['with_front'] ) {
                $this->breadcrumbs->build( 'RewriteFront' );
            }

            // If there's a rewrite slug, check for parents.
            if ( ! empty( $type->rewrite['slug'] ) ) {
                $this->breadcrumbs->build( 'Path', [ 'path' => $type->rewrite['slug'] ] );

                // Check if we've added a post type crumb.
                foreach ( $this->breadcrumbs->all() as $crumb ) {
                    if ( $crumb instanceof PostType ) {
                        $done_post_type = true;
                        break;
                    }
                }
            }
        }

        // Add post type crumb.
        if ( ! $done_post_type ) {
            $this->breadcrumbs->crumb( 'PostType', [ 'post_type' => $type ] );
        }

        // If viewing a search page for the post type archive.
        if ( is_search() ) {

            // Add search crumb.
            $this->breadcrumbs->crumb( 'Search' );
        }

        // If viewing a post type archive by author.
        if ( is_author() ) {

            $user = $this->user ?: new WP_User( get_query_var( 'author' ) );

            // Add author crumb.
            $this->breadcrumbs->crumb( 'Author', [ 'user' => $user ] );
        }

        // Build paged crumbs.
        $this->breadcrumbs->build( 'Paged' );
    }

}
