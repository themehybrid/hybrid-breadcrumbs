<?php

namespace Hybrid\Breadcrumbs\Build;

class PostTerms extends Build {

	protected $post;
	protected $taxonomy;

	public function make() {

		// Get the post type.
		$post_type = get_post_type( $this->post->ID );

		// Get the post categories.
		$terms = get_the_terms( $this->post->ID, $this->taxonomy );

		// Check that categories were returned.
		if ( $terms && ! is_wp_error( $terms ) ) {

			// Sort the terms by ID and get the first category.
			$terms = wp_list_sort( $terms, 'term_id' );

			$term = get_term( $terms[0], $this->taxonomy );

			// If the category has a parent, add the hierarchy to the trail.
			if ( 0 < $term->parent ) {

				$this->builder->build( 'TermAncestors', [
					'term' => $term
				] );
			}

			// Add term crumb.
			$this->builder->crumb( 'Term', [ 'term' => $term ] );
		}
	}
}
