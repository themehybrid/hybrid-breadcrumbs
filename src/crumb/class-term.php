<?php

namespace Hybrid\Breadcrumbs\Crumb;

class Term extends Crumb {

	protected $term = null;

	public function label() {

		// @todo - Check if term archive matches $term and use:
		// single_term_title( '', false )

		return $this->term->name;
	}

	public function url() {

		return get_term_link( $this->term, $this->term->taxonomy );
	}
}
