<?php
/**
 * Term build class.
 *
 * Builds breadcrumbs based on the given term object.
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
 * Term build sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Term extends Base {

    /**
     * Term object.
     *
     * @since  1.0.0
     * @var    \WP_Term
     *
     * @access protected
     */
    protected $term;

    /**
     * Builds the breadcrumbs.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function make() {

        $taxonomy       = get_taxonomy( $this->term->taxonomy );
        $done_post_type = false;

        // Will either be `false` or an array.
        $rewrite = $taxonomy->rewrite;

        // Build rewrite front crumbs if taxonomy uses it.
        if ( $rewrite && $rewrite['with_front'] ) {
            $this->breadcrumbs->build( 'RewriteFront' );
        }

        // Build crumbs based on the rewrite slug.
        if ( $rewrite && $rewrite['slug'] ) {

            $path = trim( $rewrite['slug'], '/' );

            // Build path crumbs.
            $this->breadcrumbs->build( 'Path', [ 'path' => $path ] );

            // Check if we've added a post type crumb.
            foreach ( $this->breadcrumbs->all() as $crumb ) {
                if ( $crumb instanceof PostType ) {
                    $done_post_type = true;
                    break;
                }
            }
        }

        // If the taxonomy has a single post type.
        if ( ! $done_post_type && 1 === count( $taxonomy->object_type ) ) {
            $this->breadcrumbs->build( 'PostType', [
                'post_type' => get_post_type_object( $taxonomy->object_type[0] ),
            ] );
        }

        // If the taxonomy is hierarchical, list the parent terms.
        if ( is_taxonomy_hierarchical( $taxonomy->name ) && $this->term->parent ) {

            $this->breadcrumbs->build( 'TermAncestors', [ 'term' => $this->term ] );
        }
    }

}
