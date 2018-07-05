<?php

namespace Hybrid\Breadcrumbs\Crumb;

class Home extends Crumb {

	public function label() {

		$network = is_multisite() && $this->manager->option( 'network' ) && ! is_main_site();

		return $network ? get_bloginfo( 'name' ) : $this->manager->label( 'home' );
	}

	public function url() {

		return user_trailingslashit( home_url() );
	}
}
