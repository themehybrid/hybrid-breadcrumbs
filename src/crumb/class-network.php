<?php

namespace Hybrid\Breadcrumbs\Crumb;

class Network extends Crumb {

	public function label() {

		return $this->manager->label( 'home' );
	}

	public function url() {

		return network_home_url();
	}
}
