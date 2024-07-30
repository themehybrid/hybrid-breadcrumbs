<?php
/**
 * Paged crumb class.
 *
 * Creates the paged crumb.
 *
 * @package   HybridBreadcrumbs
 * @link      https://github.com/themehybrid/hybrid-breadcrumbs
 *
 * @author    Theme Hybrid
 * @copyright Copyright (c) 2008 - 2023, Theme Hybrid
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Crumb;

/**
 * Paged crumb sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Paged extends Base {

    /**
     * Returns a label for the crumb.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public function label() {

        return sprintf(
            $this->breadcrumbs->label( 'paged' ),
            number_format_i18n( absint( get_query_var( 'paged' ) ) )
        );
    }

}
