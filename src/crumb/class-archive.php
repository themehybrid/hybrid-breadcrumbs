<?php

namespace Hybrid\Breadcrumbs\Crumb;

class Archive extends Crumb {

	public function label() {

		return $this->manager->label( 'archives' );
	}
}
