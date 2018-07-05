<?php

namespace Hybrid\Breadcrumbs\Query;

use WP_User;

class Author extends Query {

	public function make() {
		global $wp_rewrite;

		// Build network crumbs.
		$this->builder->build( 'Network' );

		// Add site home crumb.
		$this->builder->crumb( 'Home' );

		// Build rewrite front crumbs.
		$this->builder->build( 'RewriteFront' );

		// If $author_base exists, check for parent pages.
		if ( ! empty( $wp_rewrite->author_base ) ) {

			$this->builder->build( 'Path', [
				'page' => $wp_rewrite->author_base
			] );
		}

		// Add author crumb.
		$this->builder->crumb( 'Author', [
			'user' => new WP_User( get_query_var( 'author' ) )
		] );
	}
}
