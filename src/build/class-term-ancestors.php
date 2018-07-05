<?php

namespace Hybrid\Breadcrumbs\Build;

class TermAncestors extends Build {

	protected $term;

	public function make() {

		$term_id  = $this->term->parent;
		$taxonomy = $this->term->taxonomy;

		// Set up some default arrays.
		$parents = [];

		// While there is a parent ID, add the parent term link to the $parents array.
		while ( $term_id ) {

			// Get the parent term.
			$term = get_term( $term_id, $taxonomy );

			// Add the term link to the array of parent terms.
			$parents[] = $term;

			// Set the parent term's parent as the parent ID.
			$term_id = $term->parent;
		}

		// If we have parent terms, reverse the array to put them in the
		// proper order for the trail.
		if ( $parents ) {

			array_map( function( $parent ) {

				$this->builder->crumb( 'Term', [ 'term' => $parent ] );

			}, array_reverse( $parents ) );
		}
	}
}
