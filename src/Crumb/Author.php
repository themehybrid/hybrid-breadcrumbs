<?php
/**
 * Author crumb class.
 *
 * Creates the author archive crumb.
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
 * Author crumb sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Author extends Base {

    /**
     * User object.
     *
     * @since  1.0.0
     * @var    \WP_User
     *
     * @access protected
     */
    protected $user;

    /**
     * Returns a label for the crumb.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public function label() {

        return get_the_author_meta( 'display_name', $this->user->ID );
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

        return get_author_posts_url( $this->user->ID );
    }

}
