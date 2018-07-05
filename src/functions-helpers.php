<?php

namespace Hybrid\Breadcrumbs;

function breadcrumbs( $args = [] ) {

	return new Breadcrumbs( $args );
}

function render_trail( $args = [] ) {

	breadcrumbs( $args )->render();
}

function fetch_trail( $args = [] ) {

	return breadcrumbs( $args )->fetch();
}
