<?php
/**
 * Post terms build class.
 *
 * Builds breadcrumbs based on the given taxonomy for the post.
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
 * Post terms build sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class PostTerms extends Base {

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
     * Taxonomy slug.
     *
     * @since  1.0.0
     * @var    string
     *
     * @access protected
     */
    protected $taxonomy;

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
        $post_type = get_post_type( $this->post->ID );

        // Get the post categories.
        $terms = get_the_terms( $this->post->ID, $this->taxonomy );

        // Check that categories were returned.
        if ( $terms && ! is_wp_error( $terms ) ) {

            // Sort the terms by ID and get the first category.
            $terms = wp_list_sort( $terms, 'term_id' );

            $term = get_term( $terms[0], $this->taxonomy );

            // If the category has a parent, add the hierarchy to the trail.
            if ( 0 < $term->parent ) {

                $this->breadcrumbs->build( 'TermAncestors', [
                    'term' => $term,
                ] );
            }

            // Add term crumb.
            $this->breadcrumbs->crumb( 'Term', [ 'term' => $term ] );
        }
    }

}
