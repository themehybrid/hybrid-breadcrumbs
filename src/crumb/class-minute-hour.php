<?php

namespace Hybrid\Breadcrumbs\Crumb;

class MinuteHour extends Crumb {

	protected $post = null;

	public function label() {

		return sprintf(
			$this->manager->label( 'archive_minute_hour' ),
			get_the_time(
				esc_html_x( 'g:i a', 'minute and hour archives time format', 'hybrid-core' ),
				$this->post
			)
		);
	}
}
