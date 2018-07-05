<?php

namespace Hybrid\Breadcrumbs\Query;

class Hour extends Query {

	public function make() {

		// Build network crumbs.
		$this->builder->build( 'Network' );

		// Add site home crumb.
		$this->builder->crumb( 'Home' );

		// Build rewrite front crumbs.
		$this->builder->build( 'RewriteFront' );

		// Add hour crumb.
		$this->builder->crumb( 'Hour' );

		// Build paged crumbs.
		$this->builder->build( 'Paged' );
	}
}
