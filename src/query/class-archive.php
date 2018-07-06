<?php
/**
 * Archive query class.
 *
 * Called to build breadcrumbs on all archive pages.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Query;

/**
 * Archive query sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class Archive extends Query {

	/**
	 * Builds the breadcrumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function make() {

		// Run through the conditionals to determine which type of
		// archive breadcrumbs to build.
		if ( is_post_type_archive() ) {

			$this->builder->query( 'PostTypeArchive' );

		} elseif ( is_category() || is_tag() || is_tax() ) {

			$this->builder->query( 'Tax' );

		} elseif ( is_author() ) {

			$this->builder->query( 'Author' );

		} elseif ( get_query_var( 'minute' ) && get_query_var( 'hour' ) ) {

			$this->builder->query( 'MinuteHour' );

		} elseif ( get_query_var( 'minute' ) ) {

			$this->builder->query( 'Minute' );

		} elseif ( get_query_var( 'hour' ) ) {

			$this->builder->query( 'Hour' );

		} elseif ( is_day() ) {

			$this->builder->query( 'Day' );

		} elseif ( get_query_var( 'week' ) ) {

			$this->builder->query( 'Week' );

		} elseif ( is_month() ) {

			$this->builder->query( 'Month' );

		} elseif ( is_year() ) {

			$this->builder->query( 'Year' );

		} else {
			// Build network crumbs.
			$this->builder->build( 'Network' );

			// Add site home crumb.
			$this->builder->crumb( 'Home' );

			// Build rewrite front crumbs if date/time query.
			if ( is_date() || is_time() ) {
				$this->builder->build( 'RewriteFront' );
			}

			// Add archive crumb.
			$this->builder->crumb( 'Archive' );

			// Build paged crumbs.
			$this->builder->build( 'Paged' );
		}
	}
}
