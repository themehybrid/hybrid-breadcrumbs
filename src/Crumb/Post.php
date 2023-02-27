<?php
/**
 * Post crumb class.
 *
 * Creates the single post crumb.
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
 * Post crumb sub-class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Post extends Base {

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

        $post_id = $this->post->ID;

        if ( is_single( $post_id ) || is_page( $post_id ) || is_attachment( $post_id ) ) {

            return single_post_title( '', false );
        }

        return get_the_title( $this->post->ID );
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

        return get_permalink( $this->post->ID );
    }

}
