<?php

namespace Hybrid\Breadcrumbs\Build;

class Path extends Build {

	protected $path = '';

	public function make() {

		// Trim '/' off $this->path in case we just got a simple '/' instead of a real path.
		$path = trim( $this->path, '/' );

		// If there's no path, return.
		if ( ! $path ) {
			return;
		}

		// Get parent post by the path.
		$post = get_page_by_path( $path );

		// If the path is a post, run the parent crumbs and bail early.
		if ( $post ) {

			$this->builder->build( 'PostAncestors', [
				'post' => $post
			] );

			return;
		}

		// Split the $path into an array of strings.
		$matches = explode( '/', $path );

		// If matches are found for the path.
		if ( $matches ) {

			// Reverse the array of matches to search for posts in the proper order.
			$matches = array_reverse( $matches );

			// Loop through each of the path matches.
			foreach ( $matches as $slug ) {

				// Get the parent post by the given path.
				$post = get_page_by_path( $slug );

				// If a parent post is found, set the $post_id and break out of the loop.
				if ( ! empty( $post ) && 0 < $post->ID ) {

					$this->builder->build( 'PostAncestors', [
						'post' => $post
					] );

					break;

				} elseif ( $types = $this->manager->getPostTypesBySlug( $slug ) ) {

					$this->builder->build( 'PostType', [
						'post_type' => $types[0]
					] );

					break;
				}
			}
		}
	}
}
