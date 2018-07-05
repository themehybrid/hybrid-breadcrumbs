<?php

namespace Hybrid\Breadcrumbs\Query;

class Minute extends Query {

	public function make() {

		// Build network crumbs.
		$this->builder->build( 'Network' );

		// Add site home crumb.
		$this->builder->crumb( 'Home' );

		// Build rewrite front crumbs.
		$this->builder->build( 'RewriteFront' );

		// Add minute crumb.
		$this->builder->crumb( 'Minute' );

		// Build paged crumbs.
		$this->builder->build( 'Paged' );
	}
}
