<?php

namespace Hybrid\Breadcrumbs\Build;

class Paged extends Build {

	protected $post;

	public function make() {

		// If viewing a paged singular post.
		if ( is_singular() && 1 < get_query_var( 'page' ) ) {

			$this->builder->crumb( 'PagedSingular' );

		// If viewing a singular post with paged comments.
		} elseif ( is_singular() && get_option( 'page_comments' ) && 1 < get_query_var( 'cpage' ) ) {

			$this->builder->crumb( 'PagedComments' );

		// If viewing a paged archive-type page.
		} elseif ( is_paged() ) {

			$this->builder->crumb( 'Paged' );
		}
	}
}
