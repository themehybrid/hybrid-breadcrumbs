<?php

namespace Hybrid\Breadcrumbs\Build;

class PostType extends Build {

	protected $post_type = '';

	public function make() {

		if ( ! post_type_exists( $this->post_type ) ) {
			return;
		}

		if ( 'post' === $this->post_type ) {

			$post_id = get_option( 'page_for_posts' );

			if ( 'posts' !== get_option( 'show_on_front' ) && 0 < $post_id ) {

				// Add post crumb.
				$this->builder->crumb( 'Post', [
					'post' => get_post( $post_id )
				] );
			}

			return;
		}

		// Add post type crumb.
		$this->builder->crumb( 'PostType', [
			'post_type' => get_post_type_object( $this->post_type )
		] );
	}
}
