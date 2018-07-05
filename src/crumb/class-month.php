<?php

namespace Hybrid\Breadcrumbs\Crumb;

class Month extends Crumb {

	protected $post = null;

	public function label() {

		return sprintf(
			$this->manager->label( 'archive_month' ),
			get_the_time(
				esc_html_x( 'F', 'monthly archives date format', 'hybrid-core' ),
				$this->post
			)
		);
	}

	public function url() {

		return get_month_link(
			get_the_time( 'Y', $this->post ),
			get_the_time( 'm', $this->post )
		);
	}
}
