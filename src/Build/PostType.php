<?php
/**
 * Post type build class.
 *
 * Builds breadcrumbs for the give post type.
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
 * Post type build sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class PostType extends Base {

    /**
     * Post type slug.
     *
     * @since  1.0.0
     * @var    \WP_Post_Type
     *
     * @access protected
     */
    protected $post_type = '';

    /**
     * Builds the breadcrumbs.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function make() {
        global $wp_rewrite;

        $type = is_string( $this->post_type )
                ? get_post_type_object( $this->post_type )
            : $this->post_type;

        if ( ! $type ) {
            return;
        }

        // If this the post type is `post`, add the posts page and bail.
        if ( 'post' === $type->name ) {

            $show_on_front = get_option( 'show_on_front' );
            $post_id       = get_option( 'page_for_posts' );

            // Add post crumb if we have a posts page.
            if ( 'posts' !== $show_on_front && 0 < $post_id ) {

                $post = get_post( $post_id );

                // If the posts page is the same as the rewrite
                // front path, we should've already handled that
                // scenario at this point.
                if ( trim( $wp_rewrite->front, '/' ) !== $post->post_name ) {

                    $this->breadcrumbs->crumb( 'Post', [
                        'post' => $post,
                    ] );
                }
            }

            return;
        }

        // Add post type crumb.
        $this->breadcrumbs->crumb( 'PostType', [ 'post_type' => $type ] );
    }

}
