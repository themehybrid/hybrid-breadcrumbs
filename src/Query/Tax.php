<?php
/**
 * Taxonomy query class.
 *
 * Called to build breadcrumbs on taxonomy (term) archive pages.
 *
 * @package   HybridBreadcrumbs
 * @link      https://github.com/themehybrid/hybrid-breadcrumbs
 *
 * @author    Theme Hybrid
 * @copyright Copyright (c) 2008 - 2023, Theme Hybrid
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Query;

/**
 * Taxonomy query sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Tax extends Base {

    /**
     * Term object.
     *
     * @since  1.2.0
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

        $term = $this->term ?: get_queried_object();

        // Build network crumbs.
        $this->breadcrumbs->build( 'Network' );

        // Add site home crumb.
        $this->breadcrumbs->crumb( 'Home' );

        // Build term crumbs.
        $this->breadcrumbs->build( 'Term', [ 'term' => $term ] );

        // Add term crumb.
        $this->breadcrumbs->crumb( 'Term', [ 'term' => $term ] );

        // Build paged crumbs.
        $this->breadcrumbs->build( 'Paged' );
    }

}
