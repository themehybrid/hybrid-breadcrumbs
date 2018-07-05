<?php

namespace Hybrid\Breadcrumbs\Crumb;

use Hybrid\Breadcrumbs\Breadcrumbs;
use Hybrid\Breadcrumbs\Builder;
use Hybrid\Breadcrumbs\Contracts\Crumb as CrumbContract;

class Crumb implements CrumbContract {

	protected $builder;
	protected $manager;

	public function __construct( Builder $builder, Breadcrumbs $manager, $data = [] ) {

		foreach ( array_keys( get_object_vars( $this ) ) as $key ) {

			if ( isset( $data[ $key ] ) ) {
				$this->$key = $data[ $key ];
			}
		}

		$this->builder = $builder;
		$this->manager = $manager;
	}

	public function label() {
		return '';
	}

	public function url() {
		return '';
	}
}
