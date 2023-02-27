<?php
/**
 * Build class.
 *
 * This is the base class, which should be sub-classed, for creating a specific
 * breadcrumb build tools. Build classes are essentially tools/methods for
 * handling specific scenarios. Quite often, they are the workhorses of the
 * project and create many of the crumbs.
 *
 * @package   HybridBreadcrumbs
 * @link      https://github.com/themehybrid/hybrid-breadcrumbs
 *
 * @author    Theme Hybrid
 * @copyright Copyright (c) 2008 - 2023, Theme Hybrid
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Build;

use Hybrid\Breadcrumbs\Contracts\Breadcrumbs;
use Hybrid\Breadcrumbs\Contracts\Build;

/**
 * Base build class.
 *
 * @since  1.0.0
 *
 * @access public
 */
abstract class Base implements Build {

    /**
     * Breadcrumbs object.
     *
     * @since  1.0.0
     * @var \Hybrid\Breadcrumbs\Contracts\Breadcrumbs
     *
     * @access protected
     */
    protected $breadcrumbs;

    /**
     * Creates a new build object. Any data passed in within the `$data`
     * array will be automatically assigned to any existing properties, which
     * can be useful for sub-classes that have custom properties.
     *
     * @since  1.0.0
     * @param \Hybrid\Breadcrumbs\Contracts\Breadcrumbs $breadcrumbs
     * @param  array                                     $data
     * @return void
     *
     * @access public
     */
    public function __construct( Breadcrumbs $breadcrumbs, array $data = [] ) {

        foreach ( array_keys( get_object_vars( $this ) ) as $key ) {

            if ( isset( $data[ $key ] ) ) {
                $this->$key = $data[ $key ];
            }
        }

        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * This should be overwritten in a sub-class. It's where the work happens
     * to build out breadcrumbs.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    abstract public function make();

}
