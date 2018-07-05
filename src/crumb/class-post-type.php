<?php

namespace Hybrid\Breadcrumbs\Crumb;

class PostType extends Crumb {

	protected $post_type;

	public function label() {

		if ( is_post_type_archive() ) {

			$label = post_type_archive_title( '', false );

		} else {

			$labels = $this->post_type->labels;

			// Core filter hook.
			$label = apply_filters(
				'post_type_archive_title',
				! empty( $labels->archive_title ) ? $labels->archive_title : $labels->name,
				$this->post_type->name
			);
		}

		return $label;
	}

	public function url() {

		return get_post_type_archive_link( $this->post_type->name );
	}
}
