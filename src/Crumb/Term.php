<?php
/**
 * Term crumb class.
 *
 * Creates the term crumb.
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
 * Term crumb sub-class.
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
     * Returns a label for the crumb.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public function label() {

        $tax     = $this->term->taxonomy;
        $term_id = $this->term->term_id;

        if ( is_tax( $tax, $term_id ) || is_category( $term_id ) || is_tag( $term_id ) ) {

            return single_term_title( '', false );
        }

        return $this->term->name;
    }

    /**
     * Returns a URL for the crumb.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public function url() {

        return get_term_link( $this->term, $this->term->taxonomy );
    }

}
