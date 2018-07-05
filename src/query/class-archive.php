<?php

namespace Hybrid\Breadcrumbs\Query;

class Archive extends Query {

	public function make() {

		// Build network crumbs.
		$this->builder->build( 'Network' );

		// Add site home crumb.
		$this->builder->crumb( 'Home' );

		// Build rewrite front crumbs if date/time query.
		if ( is_date() || is_time() ) {
			$this->builder->build( 'RewriteFront' );
		}

		// Add archive crumb.
		$this->builder->crumb( 'Archive' );

		// Build paged crumbs.
		$this->builder->build( 'Paged' );
	}
}
