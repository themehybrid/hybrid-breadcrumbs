<?php
/**
 * Breadcrumbs interface.
 *
 * Defines the interface that breadcrumbs classes must use.
 *
 * @package   HybridBreadcrumbs
 * @link      https://github.com/themehybrid/hybrid-breadcrumbs
 *
 * @author    Theme Hybrid
 * @copyright Copyright (c) 2008 - 2023, Theme Hybrid
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Contracts;

/**
 * Breadcrumbs interface.
 *
 * @since  1.0.0
 *
 * @access public
 */
interface Breadcrumbs {

    /**
     * Builds a new breadcrumbs object and returns it.
     *
     * @since  1.0.0
     * @return \Hybrid\Breadcrumbs\Contracts\Breadcrumbs
     *
     * @access public
     */
    public function make();

    /**
     * Renders the breadcrumbs HTML output.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function display();

    /**
     * Returns the breadcrumbs HTML output.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public function render();

    /**
     * Returns the breadcrumbs in an array.
     *
     * @since  1.0.0
     * @return array
     *
     * @access public
     */
    public function all();

    /**
     * Creates a new `\Hybrid\Breadcrumbs\Contracts\Query` object and runs
     * its `make()` method.
     *
     * @since  1.0.0
     * @param  string $type
     * @param  array  $data
     * @return void
     *
     * @access public
     */
    public function query( $type, array $data = [] );

    /**
     * Creates a new `\Hybrid\Breadcrumbs\Contracts\Build` object and runs
     * its `make()` method.
     *
     * @since  1.0.0
     * @param  string $type
     * @param  array  $data
     * @return void
     *
     * @access public
     */
    public function build( $type, array $data = [] );

    /**
     * Creates a new `\Hybrid\Breadcrumbs\Contracts\Crumb` object and adds
     * it to the array of crumbs.
     *
     * @since  1.0.0
     * @param  string $type
     * @param  array  $data
     * @return void
     *
     * @access public
     */
    public function crumb( $type, array $data = [] );

    /**
     * Returns a specific option or `false` if the option doesn't exist.
     *
     * @since  1.0.0
     * @param  string $name
     * @return mixed
     *
     * @access public
     */
    public function option( $name );

    /**
     * Returns a specific label or an empty string if it doesn't exist.
     *
     * @since  1.0.0
     * @param  string $name
     * @return string
     *
     * @access public
     */
    public function label( $name );

    /**
     * Returns a specific post taxonomy or an empty string if one isn't set.
     *
     * @since  1.0.0
     * @param  string $post_type
     * @return string
     *
     * @access public
     */
    public function postTaxonomy( $post_type );

}
