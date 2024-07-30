<?php
/**
 * Paged query class.
 *
 * Called to build breadcrumbs on paged pages, assuming a more specific query
 * isn't called first. This is merely a fallback and shouldn't be called under
 * most circumstances.
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
 * Paged query sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Paged extends Base {

    /**
     * Builds the breadcrumbs.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function make() {

        // Build network crumbs.
        $this->breadcrumbs->build( 'Network' );

        // Add site home crumb.
        $this->breadcrumbs->crumb( 'Home' );

        // Build rewrite front crumbs.
        $this->breadcrumbs->build( 'RewriteFront' );

        // Build paged crumbs.
        $this->breadcrumbs->build( 'Paged' );
    }

}
