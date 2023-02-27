<?php
/**
 * Network build class.
 *
 * This class builds out breadcrumbs to point to the main site in multisite.
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
 * Network build sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Network extends Base {

    /**
     * Builds the breadcrumbs.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function make() {

        if ( is_multisite() && $this->breadcrumbs->option( 'network' ) && ! is_main_site() ) {

            $this->breadcrumbs->crumb( 'Network' );
        }
    }

}
