<?php

namespace Hybrid\Breadcrumbs\Query;

class Day extends Query {

	public function make() {

		// Build network crumbs.
		$this->builder->build( 'Network' );

		// Add site home crumb.
		$this->builder->crumb( 'Home' );

		// Build rewrite front crumbs.
		$this->builder->build( 'RewriteFront' );

		// Add year, month, and day crumbs.
		$this->builder->crumb( 'Year' );
		$this->builder->crumb( 'Month' );
		$this->builder->crumb( 'Day' );

		// Build paged crumbs.
		$this->builder->build( 'Paged' );
	}
}
