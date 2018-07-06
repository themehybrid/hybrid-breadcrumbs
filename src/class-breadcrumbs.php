<?php
/**
 * Breadcrumbs class.
 *
 * This is the primary project class for creating breadcrumbs.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs;

use Hybrid\Breadcrumbs\Contracts\Breadcrumbs as BreadcrumbsContract;

/**
 * Breadcrumbs class.
 *
 * @since  1.0.0
 * @access public
 */
class Breadcrumbs implements BreadcrumbsContract {

	/**
	 * The `Builder` object, which actually builds the array of breadcrumbs.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Builder
	 */
	protected $builder;

	/**
	 * The parsed arguments passed into the class.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array
	 */
	public $args = [];

	/**
	 * Creates a new breadcrumbs object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $args
	 * @return void
	 */
	public function __construct( array $args = [] ) {

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
			'list_class'      => 'breadcrumbs__trail',
			'item_class'      => 'breadcrumbs__crumb'
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

	/**
	 * Returns an array of default labels.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return array
	 */
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

	/**
	 * Returns an array of default post taxonomies.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return array
	 */
	protected function defaultPostTaxonomies() {

		$defaults = [];

		// If post permalink is set to `%postname%`, use the `category` taxonomy.
		if ( '%postname%' === trim( get_option( 'permalink_structure' ), '/' ) ) {
			$defaults['post'] = 'category';
		}

		return $defaults;
	}

	/**
	 * Renders the breadcrumbs HTML output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function render() {

		echo $this->fetch();
	}

	/**
	 * Returns the breadcrumbs HTML output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
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

	/**
	 * Creates a new builder object.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function make() {

		$this->builder = new Builder( $this );
	}

	/**
	 * Returns a specific option or `false` if the option doesn't exist.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return mixed
	 */
	public function option( $name ) {

		return isset( $this->args[ $name ] ) ? $this->args[ $name ] : false;
	}

	/**
	 * Returns a specific label or an empty string if it doesn't exist.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return string
	 */
	public function label( $name ) {

		$labels = $this->option( 'labels' );

		return isset( $labels[ $name ] ) ? $labels[ $name ] : '';
	}

	/**
	 * Returns a specific post taxonomy or an empty string if one isn't set.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return string
	 */
	public function postTaxonomy( $name ) {

		$taxes = $this->option( 'post_taxonomy' );

		return isset( $taxes[ $name ] ) ? $taxes[ $name ] : '';
	}
}
