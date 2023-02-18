<?php
/**
 * Singular query class.
 *
 * Called to build breadcrumbs on singular posts.
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
 * Singular query sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class Singular extends Base {

	/**
	 * Post object.
	 *
	 * @since  1.2.0
	 * @access protected
	 * @var    \WP_Post
	 */
	protected $post;

	/**
	 * Builds the breadcrumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function make() {

		$post = $this->post ?: get_queried_object();

		// Build network crumbs.
		$this->breadcrumbs->build( 'Network' );

		// Add site home crumb.
		$this->breadcrumbs->crumb( 'Home' );

		// Build post crumbs.
		$this->breadcrumbs->build( 'Post', [ 'post' => $post ] );

		// Add post crumb.
		$this->breadcrumbs->crumb( 'Post', [ 'post' => $post ] );

		// Build paged crumbs.
		$this->breadcrumbs->build( 'Paged' );
	}
}
