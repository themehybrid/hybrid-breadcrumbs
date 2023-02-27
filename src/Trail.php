<?php
/**
 * Trail class.
 *
 * A static helper class that works as an easy-to-use wrapper for the
 * `Breadcrumbs` class.
 *
 * @package   HybridBreadcrumbs
 * @link      https://github.com/themehybrid/hybrid-breadcrumbs
 *
 * @author    Theme Hybrid
 * @copyright Copyright (c) 2008 - 2023, Theme Hybrid
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs;

/**
 * Trail class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Trail {

    /**
     * Returns a new breadcrumbs object.
     *
     * @since  1.0.0
     * @param  array $args
     * @return \Hybrid\Breadcrumbs\Breadcrumbs
     *
     * @access public
     */
    public static function breadcrumbs( array $args = [] ) {

        return new Breadcrumbs( $args );
    }

    /**
     * Returns a new breadcrumbs object after calling its `make()` method.
     *
     * @since  1.0.0
     * @param  array $args
     * @return \Hybrid\Breadcrumbs\Breadcrumbs
     *
     * @access public
     */
    public static function make( array $args = [] ) {

        return static::breadcrumbs( $args )->make();
    }

    /**
     * Returns an array of `\Hybrid\Breadcrumbs\Contracts\Crumb` objects.
     *
     * @since  1.0.0
     * @param  array $args
     * @return array
     *
     * @access public
     */
    public static function all( array $args = [] ) {

        return static::make( $args )->all();
    }

    /**
     * Renders the breadcrumb trail output.
     *
     * @since  1.0.0
     * @param  array $args
     * @return void
     *
     * @access public
     */
    public static function display( array $args = [] ) {

        static::make( $args )->display();
    }

    /**
     * Returns the breadcrumb trail output.
     *
     * @since  1.0.0
     * @param  array $args
     * @return string
     *
     * @access public
     */
    public static function render( array $args = [] ) {

        return static::make( $args )->render();
    }

}
