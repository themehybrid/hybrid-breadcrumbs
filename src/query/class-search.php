<?php

namespace Hybrid\Breadcrumbs\Query;

class Search extends Query {

	public function make() {

		// Build network crumbs.
		$this->builder->build( 'Network' );

		// Add site home crumb.
		$this->builder->crumb( 'Home' );

		// Build rewrite front crumbs.
		$this->builder->build( 'RewriteFront' );

		// Add search crumb.
		$this->builder->crumb( 'Search' );

		// Build paged crumbs.
		$this->builder->build( 'Paged' );
	}
}
