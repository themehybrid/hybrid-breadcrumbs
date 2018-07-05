<?php

namespace Hybrid\Breadcrumbs\Build;

class PostAncestors extends Build {

	protected $post;

	public function make() {

		$post_id = $this->post->post_parent;

		$parents = [];

		while ( $post_id ) {

			// Get the post by ID.
			$post = get_post( $post_id );

			// If we hit a page that's set as the front page, bail.
			if ( 'page' == $post->post_type && 'page' == get_option( 'show_on_front' ) && $post_id == get_option( 'page_on_front' ) ) {
				break;
			}

			// Add the formatted post item to the array of parents.
			$parents[] = $post;

			// If there's no longer a post parent, break out of the loop.
			if ( 0 >= $post->post_parent ) {
				break;
			}

			// Change the post ID to the parent post to continue looping.
			$post_id = $post->post_parent;
		}

		// Get the post hierarchy based off the final parent post.
		$this->builder->build( 'PostHierarchy', [ 'post' => $post ] );

		// Display terms for specific post type taxonomy if requested.
		if ( $this->manager->postTaxonomy( $post->post_type ) ) {

			$this->builder->build( 'PostTerms', [
				'post'     => $post,
				'taxonomy' => $this->manager->postTaxonomy( $post->post_type )
			] );
		}

		if ( $parents ) {

			array_map( function( $parent ) {

				$this->builder->crumb( 'Post', [ 'post' => $parent ] );

			}, array_reverse( $parents ) );
		}
	}
}
