<?php

namespace Hybrid\Breadcrumbs\Query;

class Home extends Query {

	public function make() {

		is_front_page()
			? $this->builder->query( 'FrontPage' )
			: $this->builder->query( 'Singular' );
	}
}
