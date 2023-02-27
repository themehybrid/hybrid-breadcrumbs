<?php
/**
 * Map rewrite tags build class.
 *
 * This class accepts a permalink structure and attempts to map any rewrite tags
 * like `%tag%` to a breadcrumb. This is used with any post type.  It maps the
 * core WP `%year%`, `%monthnum%`, `%day%`, and `%author` tags. It will also map
 * any taxonomy tags.
 *
 * @package   HybridBreadcrumbs
 * @link      https://github.com/themehybrid/hybrid-breadcrumbs
 *
 * @author    Theme Hybrid
 * @copyright Copyright (c) 2008 - 2023, Theme Hybrid
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Build;

use WP_User;

/**
 * Map rewrite tags build sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class MapRewriteTags extends Base {

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
     * Permalink structure or path with possible `%tag%` names in it.
     *
     * @since  1.0.0
     * @var    string
     *
     * @access protected
     */
    protected $path = '';

    /**
     * Builds the breadcrumbs.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function make() {

        // Trim '/' from both sides of `$this->path`.
        $path = trim( $this->path, '/' );

        // Split the $path into an array of strings.
        $matches = explode( '/', $path );

        // Bail if no matches are found.
        if ( ! $matches ) {
            return;
        }

        // Loop through each of the matches, adding each to the $trail array.
        foreach ( $matches as $tag ) {

            // If using the %year% tag, add a link to the yearly archive.
            if ( '%year%' === $tag ) {

                $this->breadcrumbs->crumb( 'Year', [ 'post' => $this->post ] );

                // If using the %monthnum% tag, add a link to the monthly archive.
            } elseif ( '%monthnum%' === $tag ) {

                $this->breadcrumbs->crumb( 'Month', [ 'post' => $this->post ] );

                // If using the %day% tag, add a link to the daily archive.
            } elseif ( '%day%' === $tag ) {

                $this->breadcrumbs->crumb( 'Day', [ 'post' => $this->post ] );

                // If using the %author% tag, add a link to the post author archive.
            } elseif ( '%author%' === $tag ) {

                $this->breadcrumbs->crumb( 'Author', [
                    'user' => new WP_User( $this->post->post_author ),
                ] );

                // If using the %category% tag, add a link to the first
                // category archive to match permalinks.
            } elseif (
                taxonomy_exists( trim( $tag, '%' ) )
                && $tag !== $this->breadcrumbs->postTaxonomy( $this->post->post_type )
            ) {

                // Build post terms crumbs.
                $this->breadcrumbs->build( 'PostTerms', [
                    'post'     => $this->post,
                    'taxonomy' => trim( $tag, '%' ),
                ] );
            }
        }
    }

}
