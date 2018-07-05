<?php

namespace Hybrid\Breadcrumbs\Crumb;

class Post extends Crumb {

	protected $post = null;

	public function label() {

		// @todo - check if the current $post is the same as is_singular()
		// post.  If so, use:
		// single_post_title( '', false )

		return get_the_title( $this->post->ID );
	}

	public function url() {

		return get_permalink( $this->post->ID );
	}
}
