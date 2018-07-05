<?php

namespace Hybrid\Breadcrumbs\Build;

class RewriteFront extends Build {

	public function make() {
		global $wp_rewrite;

		if ( $wp_rewrite->front ) {

			$this->builder->build( 'Path', [
				'path' => $wp_rewrite->front
			] );
		}
	}
}
