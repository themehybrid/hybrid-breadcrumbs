<?php

namespace Hybrid\Breadcrumbs\Query;

class Year extends Query {

	public function make() {

		// Build network crumbs.
		$this->builder->build( 'Network' );

		// Add site home crumb.
		$this->builder->crumb( 'Home' );

		// Build rewrite front crumbs.
		$this->builder->build( 'RewriteFront' );

		// Add year crumb.
		$this->builder->crumb( 'Year' );

		// Build paged crumbs.
		$this->builder->build( 'Paged' );
	}
}
