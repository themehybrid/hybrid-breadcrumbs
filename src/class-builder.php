<?php

namespace Hybrid\Breadcrumbs;

use Hybrid\Breadcrumbs\Crumb;
use Hybrid\Breadcrumbs\Build;

class Builder {

	protected $manager;
	protected $crumbs = [];

	public function __construct( Breadcrumbs $manager ) {

		$this->manager = $manager;

		$this->make();
	}

	public function query( $type, $data = [] ) {

		$class = __NAMESPACE__ . "\\Query\\{$type}";

		$query = new $class( $this, $this->manager, $data );

		$query->make();
	}

	public function build( $type, $data = [] ) {

		$class = __NAMESPACE__ . "\\Build\\{$type}";

		$build = new $class( $this, $this->manager, $data );

		$build->make();
	}

	public function crumb( $type, $data = [] ) {

		$class = __NAMESPACE__ . "\\Crumb\\{$type}";

		$this->crumbs[] = new $class( $this, $this->manager, $data );
	}

	public function all() {

		return $this->crumbs;
	}

	protected function make() {

		if ( is_front_page() ) {

			$this->query( 'FrontPage' );

		} elseif ( is_home() ) {

			$this->query( 'Home' );

		} elseif ( is_singular() ) {

			$this->query( 'Singular' );

		} elseif ( is_archive() ) {

			if ( is_post_type_archive() ) {

				$this->query( 'PostTypeArchive' );

			} elseif ( is_category() || is_tag() || is_tax() ) {

				$this->query( 'Tax' );

			} elseif ( is_author() ) {

				$this->query( 'Author' );

			} elseif ( get_query_var( 'minute' ) && get_query_var( 'hour' ) ) {

				$this->query( 'MinuteHour' );

			} elseif ( get_query_var( 'minute' ) ) {

				$this->query( 'Minute' );

			} elseif ( get_query_var( 'hour' ) ) {

				$this->query( 'Hour' );

			} elseif ( is_day() ) {

				$this->query( 'Day' );

			} elseif ( get_query_var( 'week' ) ) {

				$this->query( 'Week' );

			} elseif ( is_month() ) {

				$this->query( 'Month' );

			} elseif ( is_year() ) {

				$this->query( 'Year' );

			} else {

				$this->query( 'Archive' );
			}

		} elseif ( is_search() ) {

			$this->query( 'Search' );

		} elseif ( is_404() ) {

			$this->query( 'Error' );

		} elseif ( is_paged() ) {

			$this->query( 'Paged' );
		}
	}
}
