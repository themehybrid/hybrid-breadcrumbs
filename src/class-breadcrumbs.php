<?php

namespace Hybrid\Breadcrumbs;

class Breadcrumbs {

	protected $builder;

	public $args = [];

	public function __construct( $args = [] ) {

		$defaults = [
			'labels'          => [],
			'post_taxonomy'   => [],
			'show_on_front'   => false,
			'show_title'      => true,
			'network'         => false,
			'before'          => '',
			'after'           => '',
			'container_tag'   => 'nav',
			'title_tag'       => 'h2',
			'list_tag'        => 'ul',
			'item_tag'        => 'li',
			'container_class' => 'breadcrumbs',
			'title_class'     => 'breadcrumbs__title',
			'list_class'      => 'breadcrumbs__items',
			'item_class'      => 'breadcrumbs__item'
		];

		$this->args = wp_parse_args( $args, $defaults );

		$this->args['post_taxonomy'] = wp_parse_args(
			$this->args['post_taxonomy'],
			$this->defaultPostTaxonomies()
		);

		$this->args['labels'] = wp_parse_args(
			$this->args['labels'],
			$this->defaultLabels()
		);

		$this->make();
	}

	protected function defaultLabels() {

		return [
			'browse'              => esc_html__( 'Browse:',                               'hybrid-core' ),
			'aria_label'          => esc_attr_x( 'Breadcrumbs', 'breadcrumbs aria label', 'hybrid-core' ),
			'home'                => esc_html__( 'Home',                                  'hybrid-core' ),
			'error_404'           => esc_html__( '404 Not Found',                         'hybrid-core' ),
			'archives'            => esc_html__( 'Archives',                              'hybrid-core' ),
			// Translators: %s is the search query.
			'search'              => esc_html__( 'Search results for: %s',                'hybrid-core' ),
			// Translators: %s is the page number.
			'paged'               => esc_html__( 'Page %s',                               'hybrid-core' ),
			// Translators: %s is the page number.
			'paged_comments'      => esc_html__( 'Comment Page %s',                       'hybrid-core' ),
			// Translators: Minute archive title. %s is the minute time format.
			'archive_minute'      => esc_html__( 'Minute %s',                             'hybrid-core' ),
			// Translators: Weekly archive title. %s is the week date format.
			'archive_week'        => esc_html__( 'Week %s',                               'hybrid-core' ),

			// "%s" is replaced with the translated date/time format.
			'archive_minute_hour' => '%s',
			'archive_hour'        => '%s',
			'archive_day'         => '%s',
			'archive_month'       => '%s',
			'archive_year'        => '%s',
		];
	}

	protected function defaultPostTaxonomies() {

		$defaults = [];

		// If post permalink is set to `%postname%`, use the `category` taxonomy.
		if ( '%postname%' === trim( get_option( 'permalink_structure' ), '/' ) ) {
			$defaults['post'] = 'category';
		}

		return $defaults;
	}

	public function render() {

		echo $this->fetch();
	}

	public function fetch() {

		$crumbs = $this->builder->all();

		if ( $crumbs ) {

			$html = '<nav class="breadcrumbs">';
			$html .= sprintf( '<h2 class="breadcrumbs__title">%s</h2>', __( 'Browse:', 'hybrid-core' ) );

			$html .= '<ul class="breadcrumbs__trail">';

			foreach ( $crumbs as $crumb ) {

				$url   = $crumb->url();
				$label = $crumb->label();

				if ( $url ) {
					$html .= sprintf(
						'<li class="breadcrumbs__crumb"><a href="%s">%s</a></li>',
						esc_url( $url ),
						$label
					);
				} else {
					$html .= sprintf(
						'<li><span>%s</span></li>',
						$label
					);
				}
			}

			$html .= '</ul></nav>';

			return $html;
		}

		return '';
	}

	protected function make() {

		$this->builder = new Builder( $this );
	}

	public function label( $name ) {

		return isset( $this->args['labels'][ $name ] ) ? $this->args['labels'][ $name ] : '';
	}

	public function postTaxonomy( $name ) {

		return isset( $this->args['post_taxonomy'][ $name ] )
		       ? $this->args['post_taxonomy'][ $name ]
		       : '';
	}


		public function isNetworked() {

			return is_multisite() && $this->args['network'];
		}

		public function showTitle() {

			return $this->args['show_title'];
		}

		public function isPaged() {

			return is_paged() || 1 < get_query_var( 'page' ) || 1 < get_query_var( 'cpage' );
		}

		/**
		 * Gets post types by slug. This is needed because the `get_post_types()`
		 * function doesn't exactly match the `has_archive` argument when it's
		 * set as a string instead of a boolean.
		 *
		 * @since  1.0.0
		 * @access protected
		 * @param  int    $slug  The post type archive slug to search for.
		 * @return void
		 */
		public function getPostTypesBySlug( $slug ) {

			$return = [];

			$post_types = get_post_types( [], 'objects' );

			foreach ( $post_types as $type ) {

				if ( $slug === $type->has_archive || ( true === $type->has_archive && $slug === $type->rewrite['slug'] ) ) {

					$return[] = $type;
				}
			}

			return $return;
		}
}
