<?php

namespace Hybrid\Breadcrumbs\Crumb;

class Error extends Crumb {

	public function label() {

		return $this->manager->label( 'error_404' );
	}
}
