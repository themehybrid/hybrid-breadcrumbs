<?php
/**
 * Paged singular crumb class.
 *
 * Creates the paged singular crumb when `<!--nextpage-->` is used for a post.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Crumb;

/**
 * Paged singular crumb sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class PagedSingular extends Base {

	/**
	 * Returns a label for the crumb.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function label() {

		return sprintf(
			$this->breadcrumbs->label( 'paged' ),
			number_format_i18n( absint( get_query_var( 'page' ) ) )
		);
	}
}
