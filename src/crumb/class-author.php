<?php

namespace Hybrid\Breadcrumbs\Crumb;

class Author extends Crumb {

	protected $user = null;

	public function label() {

		return get_the_author_meta( 'display_name', $this->user->ID );
	}

	public function url() {

		return get_author_posts_url( $this->user->ID );
	}
}
