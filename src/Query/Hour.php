<?php
/**
 * Hour query class.
 *
 * Called to build breadcrumbs on hour archive pages.
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
 * Hour query sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Hour extends Base {

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

        // Add hour crumb.
        $this->breadcrumbs->crumb( 'Hour' );

        // Build paged crumbs.
        $this->breadcrumbs->build( 'Paged' );
    }

}
