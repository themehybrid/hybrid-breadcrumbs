<?php
/**
 * Day crumb class.
 *
 * Creates the day archive crumb.
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
 * Day crumb sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Day extends Base {

    /**
     * Post object.
     *
     * @since  1.0.0
     * @var    \WP_Post
     *
     * @access protected
     */
    protected $post = null;

    /**
     * Returns a label for the crumb.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public function label() {

        return sprintf(
            $this->breadcrumbs->label( 'archive_day' ),
            get_the_time(
                esc_html_x( 'j', 'daily archives date format', 'hybrid-core' ),
                $this->post
            )
        );
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

        return get_day_link(
            get_the_time( 'Y', $this->post ),
            get_the_time( 'm', $this->post ),
            get_the_time( 'd', $this->post )
        );
    }

}
