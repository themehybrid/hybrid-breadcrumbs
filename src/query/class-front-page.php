<?php

namespace Hybrid\Breadcrumbs\Query;

class FrontPage extends Query {

	public function make() {

		// Only show front items if the 'show_on_front' argument is set to 'true'.
		if ( $this->manager->args['show_on_front'] || $this->manager->isPaged() ) {

			// Build network crumbs.
			$this->builder->build( 'Network' );

			// Add site home link.
			$this->builder->crumb( 'Home' );

			// Build paged crumbs.
			$this->builder->build( 'Paged' );
		}
	}
}
