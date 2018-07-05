<?php

namespace Hybrid\Breadcrumbs\Query;

class PostTypeArchive extends Query {

	public function make() {

		// Build network crumbs.
		$this->builder->build( 'Network' );

		// Add site home crumb.
		$this->builder->crumb( 'Home' );

		// Build rewrite front crumbs.
		$this->builder->build( 'RewriteFront' );

		// Get the post type object.
		$type = get_post_type_object( get_query_var( 'post_type' ) );

		if ( false !== $type->rewrite ) {

			// Build rewrite front crumbs if post type uses it.
			if ( $type->rewrite['with_front'] ) {
				$this->builder->build( 'RewriteFront' );
			}

			// If there's a rewrite slug, check for parents.
			if ( ! empty( $type->rewrite['slug'] ) ) {

				$this->builder->build( 'Path', [
					'path' => $type->rewrite['slug']
				] );
			}
		}

		// Add post type crumb.
		$this->builder->crumb( 'PostType', [ 'post_type' => $type ] );

		// If viewing a search page for the post type archive.
		if ( is_search() ) {

			// Add search crumb.
			$this->builder->crumb( 'Search' );
		}

		// If viewing a post type archive by author.
		if ( is_author() ) {

			// Add author crumb.
			$this->builder->crumb( 'Author', [
				'user' => new WP_User( get_query_var( 'author' ) )
			] );
		}

		// Build paged crumbs.
		$this->builder->build( 'Paged' );
	}
}
