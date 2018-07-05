<?php

namespace Hybrid\Breadcrumbs\Build;

use WP_User;

class MapRewriteTags extends Build {

	protected $post;
	protected $path = '';

	public function make() {

		// Trim '/' from both sides of `$this->path`.
		$path = trim( $this->path, '/' );

		// Split the $path into an array of strings.
		$matches = explode( '/', $path );

		// Bail if no matches are found.
		if ( ! $matches ) {
			return;
		}

		// Loop through each of the matches, adding each to the $trail array.
		foreach ( $matches as $tag ) {

			// If using the %year% tag, add a link to the yearly archive.
			if ( '%year%' == $tag ) {

				$this->builder->crumb( 'Year', [ 'post' => $this->post ] );

			// If using the %monthnum% tag, add a link to the monthly archive.
			} elseif ( '%monthnum%' == $tag ) {

				$this->builder->crumb( 'Month', [ 'post' => $this->post ] );

			// If using the %day% tag, add a link to the daily archive.
			} elseif ( '%day%' == $tag ) {

				$this->builder->crumb( 'Day', [ 'post' => $this->post ] );

			// If using the %author% tag, add a link to the post author archive.
			} elseif ( '%author%' == $tag ) {

				$this->builder->crumb( 'Author', [
					'user' => new WP_User( $this->post->post_author )
				] );

			// If using the %category% tag, add a link to the first
			// category archive to match permalinks.
			} elseif ( taxonomy_exists( trim( $tag, '%' ) ) ) {

				// Force override terms in this post type.
				$this->manager->args->post_taxonomy[ $this->post->post_type ] = false;

				// Build post terms crumbs.
				$this->builder->build( 'PostTerms', [
					'post'     => $this->post,
					'taxonomy' => trim( $tag, '%' )
				] );
			}
		}
	}
}
