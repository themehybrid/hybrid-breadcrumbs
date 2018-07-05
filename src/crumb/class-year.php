<?php

namespace Hybrid\Breadcrumbs\Crumb;

class Year extends Crumb {

	protected $post = null;

	public function label() {

		return sprintf(
			$this->manager->label( 'archive_year' ),
			get_the_time(
				esc_html_x( 'Y', 'yearly archives date format', 'hybrid-core' ),
				$this->post
			)
		);
	}

	public function url() {

		return get_year_link( get_the_time( 'Y', $this->post ) );
	}
}
