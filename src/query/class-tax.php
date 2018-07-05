<?php

namespace Hybrid\Breadcrumbs\Query;

class Tax extends Query {

	public function make() {
		global $wp_rewrite;

		// Build network crumbs.
		$this->builder->build( 'Network' );

		// Add site home crumb.
		$this->builder->crumb( 'Home' );

		// Get some taxonomy and term variables.
		$term           = get_queried_object();
		$taxonomy       = get_taxonomy( $term->taxonomy );
		$done_post_type = false;

		// If there are rewrite rules for the taxonomy.
		if ( false !== $taxonomy->rewrite ) {

			// Build rewrite front crumbs if taxonomy uses it.
			if ( $taxonomy->rewrite['with_front'] && $wp_rewrite->front ) {
				$this->builder->build( 'RewriteFront' );
			}

			// Build path crumbs.
			$this->builder->build( 'Path', [ 'path' => $taxonomy->rewrite['slug'] ] );

			// Add post type archive if its 'has_archive' matches the taxonomy rewrite 'slug'.
			if ( $taxonomy->rewrite['slug'] ) {

				$slug = trim( $taxonomy->rewrite['slug'], '/' );

				// Deals with the situation if the slug has a '/' between multiple
				// strings. For example, "movies/genres" where "movies" is the post
				// type archive.
				$matches = explode( '/', $slug );

				// If matches are found for the path.
				if ( $matches ) {

					// Reverse the array of matches to search for posts in the proper order.
					$matches = array_reverse( $matches );

					// Loop through each of the path matches.
					foreach ( $matches as $slug ) {

						// Get public post types that match the rewrite slug.
						$post_types = $this->manager->getPostTypesBySlug( $slug );

						if ( $post_types ) {

							$this->builder->build( 'PostType', [
								'post_type' => $post_types[0]
							] );

							$done_post_type = true;

							// Break out of the loop.
							break;
						}
					}
				}
			}
		}

		// If there's a single post type for the taxonomy, use it.
		if ( false === $done_post_type && 1 === count( $taxonomy->object_type ) ) {

			$this->builder->build( 'PostType', [
				'post_type' => $taxonomy->object_type[0]
			] );
		}

		// If the taxonomy is hierarchical, list its parent terms.
		if ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) {

			$this->builder->build( 'TermAncestors', [ 'term' => $term ] );
		}

		// Add term crumb.
		$this->builder->crumb( 'Term', [ 'term' => $term ] );

		// Build paged crumbs.
		$this->builder->build( 'Paged' );
	}
}
