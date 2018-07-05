<?php

namespace Hybrid\Breadcrumbs\Crumb;

class Search extends Crumb {

	public function label() {

		return sprintf( $this->manager->label( 'search' ), get_search_query() );
	}

	public function url() {

		return get_search_link();
	}
}
