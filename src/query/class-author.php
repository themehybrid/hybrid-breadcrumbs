<?php
/**
 * Author query class.
 *
 * Called to build breadcrumbs on author archive pages.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Query;

use WP_User;

/**
 * Author query sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class Author extends Query {

	/**
	 * Builds the breadcrumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function make() {
		global $wp_rewrite;

		// Build network crumbs.
		$this->builder->build( 'Network' );

		// Add site home crumb.
		$this->builder->crumb( 'Home' );

		// Build rewrite front crumbs.
		$this->builder->build( 'RewriteFront' );

		// If $author_base exists, check for parent pages.
		if ( ! empty( $wp_rewrite->author_base ) ) {

			$this->builder->build( 'Path', [
				'page' => $wp_rewrite->author_base
			] );
		}

		// Add author crumb.
		$this->builder->crumb( 'Author', [
			'user' => new WP_User( get_query_var( 'author' ) )
		] );
	}
}
