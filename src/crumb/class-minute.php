<?php

namespace Hybrid\Breadcrumbs\Crumb;

class Minute extends Crumb {

	protected $post = null;

	public function label() {

		return sprintf(
			$this->manager->label( 'archive_minute' ),
			get_the_time(
				esc_html_x( 'i', 'minute archives time format', 'hybrid-core' ),
				$this->post
			)
		);
	}
}
