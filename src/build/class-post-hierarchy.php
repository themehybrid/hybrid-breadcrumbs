<?php

namespace Hybrid\Breadcrumbs\Build;

class PostHierarchy extends Build {

	protected $post;

	public function make() {

		// Get the post type.
		$type = get_post_type_object( get_post_type( $this->post->ID ) );

		// If this is the 'post' post type, get the rewrite front items and map the rewrite tags.
		if ( 'post' === $type->name ) {

			// Add $wp_rewrite->front to the trail.
			$this->builder->build( 'RewriteFront' );

			// Map the rewrite tags.
			$this->builder->build( 'MapRewriteTags', [
				'post' => $this->post,
				'path' => get_option( 'permalink_structure' )
			] );

		// If the post type has rewrite rules.
		} elseif ( false !== $type->rewrite ) {

			// Build the rewrite front crumbs.
			if ( $type->rewrite['with_front'] ) {
				$this->builder->build( 'RewriteFront' );
			}

			// If there's a path, check for parents.
			if ( ! empty( $type->rewrite['slug'] ) ) {

				$this->builder->build( 'Path', [
					'path' => $type->rewrite['slug']
				] );
			}
		}

		// If there's an archive page, add it to the trail.
		if ( $type->has_archive ) {

			$this->builder->build( 'PostType', [ 'post_type' => $type->name ] );
		}

		// Map the rewrite tags if there's a `%` in the slug.
		if ( 'post' !== $type->name && ! empty( $type->rewrite['slug'] ) && false !== strpos( $type->rewrite['slug'], '%' ) ) {

			$this->builder->build( 'MapRewriteTags', [
				'post' => $this->post,
				'path' => $type->rewrite['slug']
			] );
		}
	}
}
