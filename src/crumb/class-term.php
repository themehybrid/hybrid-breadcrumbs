<?php
/**
 * Term crumb class.
 *
 * Creates the term crumb.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Crumb;

/**
 * Term crumb sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class Term extends Base {

	/**
	 * Term object.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    \WP_Term
	 */
	protected $term;

	/**
	 * Returns a label for the crumb.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
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
	 * @access public
	 * @return string
	 */
	public function url() {

		return get_term_link( $this->term, $this->term->taxonomy );
	}
}
