<?php

namespace Hybrid\Breadcrumbs\Query;

class Error extends Query {

	public function make() {

		// Build network crumbs.
		$this->builder->build( 'Network' );

		// Add site home crumb.
		$this->builder->crumb( 'Home' );

		// Add 404 crumb.
		$this->builder->crumb( 'Error' );
	}
}
