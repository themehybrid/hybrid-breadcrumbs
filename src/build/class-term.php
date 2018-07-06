<?php

namespace Hybrid\Breadcrumbs\Build;

class Term extends Build {

	protected $term;

	public function make() {

		$taxonomy       = get_taxonomy( $this->term->taxonomy );
		$done_post_type = false;

		// Will either be `false` or an array.
		$rewrite = $taxonomy->rewrite;

		// Build rewrite front crumbs if taxonomy uses it.
		if ( $rewrite && $rewrite['with_front'] ) {
			$this->builder->build( 'RewriteFront' );
		}

		// Build crumbs based on the rewrite slug.
		if ( $rewrite && $rewrite['slug'] ) {

			$path = trim( $rewrite['slug'], '/' );

			// Build path crumbs.
			$this->builder->build( 'Path', [ 'path' => $path ] );

			// We need to split the string to search for post type
			// slugs that may be a part of the taxonomy slug.
			$matches = explode( '/', $path );

			// If matches are found for the path.
			if ( $matches ) {

				// Reverse the array of matches to search for
				// post types in the proper order.
				$matches = array_reverse( $matches );

				// Loop through each of the path matches.
				foreach ( $matches as $slug ) {

					// Get post types that match the rewrite slug.
					$types = $this->manager->getPostTypesBySlug( $slug );

					if ( $types ) {

						$this->builder->build( 'PostType', [
							'post_type' => $types[0]
						] );

						$done_post_type = true;
						break;
					}
				}
			}
		}

		// If there's a single post type for the taxonomy, use it.
		if ( ! $done_post_type && 1 === count( $taxonomy->object_type ) ) {

			$this->builder->build( 'PostType', [
				'post_type' => $taxonomy->object_type[0]
			] );
		}

		// If the taxonomy is hierarchical, list the parent terms.
		if ( is_taxonomy_hierarchical( $taxonomy->name ) && $this->term->parent ) {

			$this->builder->build( 'TermAncestors', [ 'term' => $this->term ] );
		}
	}
}
