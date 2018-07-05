<?php

namespace Hybrid\Breadcrumbs\Query;

class Singular extends Query {

	public function make() {

		$post = get_queried_object();

		// Build network crumbs.
		$this->builder->build( 'Network' );

		// Add site home crumb.
		$this->builder->crumb( 'Home' );

		// Build post crumbs.
		$this->builder->build( 'Post', [ 'post' => $post ] );

		// Add post crumb.
		$this->builder->crumb( 'Post', [ 'post' => $post ] );

		// Build paged crumbs.
		$this->builder->build( 'Paged' );
	}
}
