<?php

namespace Hybrid\Breadcrumbs\Build;

class Post extends Build {

	protected $post;

	public function make() {

		// If the post has a parent, follow the parent trail.
		if ( 0 < $this->post->post_parent ) {

			$this->builder->build( 'PostAncestors', [
				'post' => $this->post
			] );

		// If the post doesn't have a parent, get its hierarchy based off the post type.
		} else {

			$this->builder->build( 'PostHierarchy', [
				'post' => $this->post
			] );
		}

		// Display terms for specific post type taxonomy if requested.
		if ( $this->manager->postTaxonomy( $this->post->post_type ) ) {

			$this->builder->build( 'PostTerms', [
				'post'     => $this->post,
				'taxonomy' => $this->manager->postTaxonomy( $this->post->post_type )
			] );
		}
	}
}
