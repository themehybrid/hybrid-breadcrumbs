<?php

namespace Hybrid\Breadcrumbs\Crumb;

class Day extends Crumb {

	protected $post = null;

	public function label() {

		return sprintf(
			$this->manager->label( 'archive_day' ),
			get_the_time(
				esc_html_x( 'j', 'daily archives date format', 'hybrid-core' ),
				$this->post
			)
		);
	}

	public function url() {

		return get_day_link(
			get_the_time( 'Y', $this->post ),
			get_the_time( 'm', $this->post ),
			get_the_time( 'd', $this->post )
		);
	}
}
