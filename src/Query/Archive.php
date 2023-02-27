<?php
/**
 * Archive query class.
 *
 * Called to build breadcrumbs on all archive pages.
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
 * Archive query sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Archive extends Base {

    /**
     * Builds the breadcrumbs.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function make() {

        // Run through the conditionals to determine which type of
        // archive breadcrumbs to build.
        if ( is_post_type_archive() ) {

            $this->breadcrumbs->query( 'PostTypeArchive' );

        } elseif ( is_category() || is_tag() || is_tax() ) {

            $this->breadcrumbs->query( 'Tax' );

        } elseif ( is_author() ) {

            $this->breadcrumbs->query( 'Author' );

        } elseif ( get_query_var( 'minute' ) && get_query_var( 'hour' ) ) {

            $this->breadcrumbs->query( 'MinuteHour' );

        } elseif ( get_query_var( 'minute' ) ) {

            $this->breadcrumbs->query( 'Minute' );

        } elseif ( get_query_var( 'hour' ) ) {

            $this->breadcrumbs->query( 'Hour' );

        } elseif ( is_day() ) {

            $this->breadcrumbs->query( 'Day' );

        } elseif ( get_query_var( 'week' ) ) {

            $this->breadcrumbs->query( 'Week' );

        } elseif ( is_month() ) {

            $this->breadcrumbs->query( 'Month' );

        } elseif ( is_year() ) {

            $this->breadcrumbs->query( 'Year' );

        } else {
            // Build network crumbs.
            $this->breadcrumbs->build( 'Network' );

            // Add site home crumb.
            $this->breadcrumbs->crumb( 'Home' );

            // Build rewrite front crumbs if date/time query.
            if ( is_date() || is_time() ) {
                $this->breadcrumbs->build( 'RewriteFront' );
            }

            // Add archive crumb.
            $this->breadcrumbs->crumb( 'Archive' );

            // Build paged crumbs.
            $this->breadcrumbs->build( 'Paged' );
        }
    }

}
