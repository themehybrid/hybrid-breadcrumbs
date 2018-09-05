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
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
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
	 * The parsed arguments passed into the class.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    array
	 */
	protected $args = [];

	/**
	 * Array of `Crumb` objects.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    array
	 */
	protected $crumbs = [];

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
			'show_trail_end'  => true,
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
			'title'               => __( 'Browse:',                               'hybrid-core' ),
			'aria_label'          => _x( 'Breadcrumbs', 'breadcrumbs aria label', 'hybrid-core' ),
			'home'                => __( 'Home',                                  'hybrid-core' ),
			'error_404'           => __( '404 Not Found',                         'hybrid-core' ),
			'archives'            => __( 'Archives',                              'hybrid-core' ),
			// Translators: %s is the search query.
			'search'              => __( 'Search results for: %s',                'hybrid-core' ),
			// Translators: %s is the page number.
			'paged'               => __( 'Page %s',                               'hybrid-core' ),
			// Translators: %s is the page number.
			'paged_comments'      => __( 'Comment Page %s',                       'hybrid-core' ),
			// Translators: Minute archive title. %s is the minute time format.
			'archive_minute'      => __( 'Minute %s',                             'hybrid-core' ),
			// Translators: Weekly archive title. %s is the week date format.
			'archive_week'        => __( 'Week %s',                               'hybrid-core' ),

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
	 * Returns an array of `Crumb` objects.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function all() {

		return $this->crumbs;
	}

	/**
	 * Renders the breadcrumbs HTML output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function display() {

		echo $this->render();
	}

	/**
	 * Returns the breadcrumbs HTML output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function render() {

		$html = $list = $title = '';

		// Get an array of all the available breadcrumbs from the builder.
		$crumbs = $this->all();

		if ( $crumbs ) {

			// HTML allowed in labels. Everything else gets stripped out.
			$allowed_html = [
				'abbr'    => [ 'title' => true ],
				'acronym' => [ 'title' => true ],
				'code'    => true,
				'em'      => true,
				'strong'  => true,
				'i'       => true,
				'b'       => true
			];

			$count     = count( $crumbs );
			$i         = 1;
			$show_last = $this->option( 'show_trail_end' );

			// Loop through each of the crumbs and build out a list.
			foreach ( $crumbs as $crumb ) {

				// Break out of the loop if this is the last item
				// and we're not supposed to show the trail end.
				if ( $i === $count && ! $show_last ) {
					break;
				}

				// Filter out any unwanted HTML from the label.
				$label = sprintf(
					'<span itemprop="name">%s</span>',
					wp_kses( $crumb->label(), $allowed_html )
				);

				// Get the crumb URL.
				$url = $crumb->url();

				// Wrap the label with a link if the crumb has
				// one and this isn't the last item.
				if ( $url && $i !== $count  ) {

					$item = sprintf(
						'<a href="%s" itemprop="item">%s</a>',
						esc_url( $url ),
						$label
					);

				} else {

					$item = sprintf(
						'<span itemprop="item">%s</span>',
						$label
					);
				}

				// Get the base class to build modifier classes from.
				$base_class = explode( ' ', $this->option( 'item_class' ) );
				$base_class = array_shift( $base_class );

				$classes = [
					$this->option( 'item_class' ),
					sprintf( "{$base_class}--%s", $crumb->type() )
				];

				// Build the list item.
				$list .= sprintf(
					'<%1$s class="%2$s" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">%3$s</%1$s>',
					tag_escape( $this->option( 'item_tag' ) ),
					esc_attr( join( ' ', $classes ) ),
					$item
				);

				++$i;
			}

			// Build the list HTML.
			$list = sprintf(
				'<%1$s class="%2$s" itemscope itemtype="https://schema.org/BreadcrumbList">%3$s</%1$s>',
				tag_escape( $this->option( 'list_tag' ) ),
				esc_attr( $this->option( 'list_class' ) ),
				$list
			);

			// Build the title HTML only if there's a label for it.
			if ( $this->label( 'title' ) ) {

				$title = sprintf(
					'<%1$s class="%2$s">%3$s</%1$s>',
					tag_escape( $this->option( 'title_tag' ) ),
					esc_attr( $this->option( 'title_class' ) ),
					$this->label( 'title' )
				);
			}

			// Build out the final breadcrumbs trail HTML.
			$html = sprintf(
				'<%1$s class="%2$s" role="navigation" aria-label="%3$s" itemprop="breadcrumb">%4$s%5$s</%1$s>',
				tag_escape( $this->option( 'container_tag' ) ),
				esc_attr( $this->option( 'container_class' ) ),
				esc_attr( $this->label( 'aria_label' ) ),
				$title,
				$list
			);

			$html = $this->option( 'before' ) . $html . $this->option( 'after' );
		}

		return apply_filters( "hybrid/breadcrumbs/trail", $html, $crumbs, $this );
	}

	/**
	 * Runs through a series of conditionals based on the current WordPress
	 * query. Once we figure out which page we're viewing, we create a new
	 * `Query` object and let it build the breadcrumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return Breadcrumbs
	 */
	public function make() {

		// This may not follow any sort of standards-based code
		// formatting rules, but you can damn well read it better!
		    if ( is_front_page() ) { $this->query( 'FrontPage' ); }
		elseif ( is_home()       ) { $this->query( 'Home'      ); }
		elseif ( is_singular()   ) { $this->query( 'Singular'  ); }
		elseif ( is_archive()    ) { $this->query( 'Archive'   ); }
		elseif ( is_search()     ) { $this->query( 'Search'    ); }
		elseif ( is_404()        ) { $this->query( 'Error'     ); }
		elseif ( is_paged()      ) { $this->query( 'Paged'     ); }

		// Return the object for chaining methods.
		return $this;
	}

	/**
	 * Creates a new `Query` object and runs its `make()` method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $type
	 * @param  array   $data
	 * @return void
	 */
	public function query( $type, array $data = [] ) {

		$class = apply_filters(
			"hybrid/breadcrumbs/query/{$type}",
			"\\Hybrid\\Breadcrumbs\\Query\\{$type}"
		);

		$query = new $class( $this, $data );

		$query->make();
	}

	/**
	 * Creates a new `Build` object and runs its `make()` method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $type
	 * @param  array   $data
	 * @return void
	 */
	public function build( $type, array $data = [] ) {

		$class = apply_filters(
			"hybrid/breadcrumbs/build/{$type}",
			"\\Hybrid\\Breadcrumbs\\Build\\{$type}"
		);

		$build = new $class( $this, $data );

		$build->make();
	}

	/**
	 * Creates a new `Crumb` object and adds it to the array of crumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $type
	 * @param  array   $data
	 * @return void
	 */
	public function crumb( $type, array $data = [] ) {

		$class = apply_filters(
			"hybrid/breadcrumbs/crumb/{$type}",
			"\\Hybrid\\Breadcrumbs\\Crumb\\{$type}"
		);

		$this->crumbs[] = new $class( $this, $data );
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
	 * @param  string  $post_type
	 * @return string
	 */
	public function postTaxonomy( $post_type ) {

		$taxes = $this->option( 'post_taxonomy' );

		return isset( $taxes[ $post_type ] ) ? $taxes[ $post_type ] : '';
	}
}
