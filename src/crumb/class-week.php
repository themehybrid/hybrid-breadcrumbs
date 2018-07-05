<?php

namespace Hybrid\Breadcrumbs\Crumb;

class Week extends Crumb {

	public function label() {

		return sprintf(
			$this->manager->label( 'archive_week' ),
			get_the_time(
				esc_html_x( 'W', 'weekly archives date format', 'hybrid-core' )
			)
		);
	}

	public function url() {

		return add_query_arg( [
			'm' => get_the_time( 'Y' ),
			'w' => get_the_time( 'W' )
		], user_trailingslashit( home_url() ) );
	}
}
