<?php
/**
 * Helpers class.
 *
 * A static class with helper functions for performing some actions needed in
 * the library.
 *
 * @package   HybridBreadcrumbs
 * @link      https://github.com/themehybrid/hybrid-breadcrumbs
 *
 * @author    Theme Hybrid
 * @copyright Copyright (c) 2008 - 2023, Theme Hybrid
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Util;

/**
 * Helpers class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Helpers {

    /**
     * Helper function for determining whether we're viewing a paginated page.
     *
     * @since  1.0.0
     * @return bool
     *
     * @access public
     */
    public static function isPagedView() {

        return is_paged() || 1 < get_query_var( 'page' ) || 1 < get_query_var( 'cpage' );
    }

    /**
     * Gets post types by slug. This is needed because the `get_post_types()`
     * function doesn't exactly match the `has_archive` argument when it's
     * set as a string instead of a boolean.
     *
     * @since  1.0.0
     * @param  string $slug
     * @return array
     *
     * @access public
     */
    public static function getPostTypesBySlug( $slug ) {

        $return = [];

        $post_types = get_post_types( [], 'objects' );

        foreach ( $post_types as $type ) {

            if ( $slug === $type->has_archive || ( true === $type->has_archive && $slug === $type->rewrite['slug'] ) ) {

                $return[] = $type;
            }
        }

        return $return;
    }

}
