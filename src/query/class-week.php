<?php

namespace Hybrid\Breadcrumbs\Query;

class WeekArchive extends Query {

	public function make() {

		// Build network crumbs.
		$this->builder->build( 'Network' );

		// Add site home crumb.
		$this->builder->crumb( 'Home' );

		// Build rewrite front crumbs.
		$this->builder->build( 'RewriteFront' );

		// Add the year and week crumbs.
		$this->builder->crumb( 'Year' );
		$this->builder->crumb( 'Week' );

		// Build paged crumbs.
		$this->builder->build( 'Paged' );
	}
}
