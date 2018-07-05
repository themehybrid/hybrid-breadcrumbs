<?php

namespace Hybrid\Breadcrumbs\Build;

class Network extends Build {

	public function make() {

		if ( is_multisite() && $this->manager->isNetworked() && ! is_main_site() ) {

			$this->builder->crumb( 'Network' );
		}
	}
}
