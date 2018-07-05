<?php

namespace Hybrid\Breadcrumbs\Crumb;

class Paged extends Crumb {

	public function label() {

		return sprintf(
			$this->manager->label( 'paged' ),
			number_format_i18n( absint( get_query_var( 'paged' ) ) )
		);
	}
}
