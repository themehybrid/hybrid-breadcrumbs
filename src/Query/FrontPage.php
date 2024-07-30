<?php
/**
 * Front page query class.
 *
 * Called to build breadcrumbs on the front page.
 *
 * @package   HybridBreadcrumbs
 * @link      https://github.com/themehybrid/hybrid-breadcrumbs
 *
 * @author    Theme Hybrid
 * @copyright Copyright (c) 2008 - 2023, Theme Hybrid
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Query;

use Hybrid\Breadcrumbs\Util\Helpers;

/**
 * Front page query sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class FrontPage extends Base {

    /**
     * Builds the breadcrumbs.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function make() {

        if ( $this->breadcrumbs->option( 'show_on_front' ) || Helpers::isPagedView() ) {

            // Build network crumbs.
            $this->breadcrumbs->build( 'Network' );

            // Add site home crumb.
            $this->breadcrumbs->crumb( 'Home' );

            // Build paged crumbs.
            $this->breadcrumbs->build( 'Paged' );
        }
    }

}
