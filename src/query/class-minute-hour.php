<?php

namespace Hybrid\Breadcrumbs\Query;

class MinuteHour extends Query {

	public function make() {

		// Build network crumbs.
		$this->builder->build( 'Network' );

		// Add site home crumb.
		$this->builder->crumb( 'Home' );

		// Build rewrite front crumbs.
		$this->builder->build( 'RewriteFront' );

		// Add minute-hour crumb.
		$this->builder->crumb( 'MinuteHour' );

		// Build paged crumbs.
		$this->builder->build( 'Paged' );
	}
}
