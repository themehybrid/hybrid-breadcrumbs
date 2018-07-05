<?php

namespace Hybrid\Breadcrumbs\Crumb;

class Home extends Crumb {

	public function label() {

		$network = $this->manager->isNetworked() && ! is_main_site();

		return $network ? get_bloginfo( 'name' ) : $this->manager->label( 'home' );
	}

	public function url() {

		return user_trailingslashit( home_url() );
	}
}
