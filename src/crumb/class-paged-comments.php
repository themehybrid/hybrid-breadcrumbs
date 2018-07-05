<?php

namespace Hybrid\Breadcrumbs\Crumb;

class PagedComments extends Crumb {

	public function label() {

		return sprintf(
			$this->manager->label( 'paged_comments' ),
			number_format_i18n( absint( get_query_var( 'cpage' ) ) )
		);
	}
}
