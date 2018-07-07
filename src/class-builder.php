<?php
/**
 * Builder class.
 *
 * This class builds up the array of breadcrumbs for our final breadcrumb trail
 * and is passed back to the original `Breadcrumbs` object for output.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs;

use Hybrid\Breadcrumbs\Contracts\Breadcrumbs;
use Hybrid\Breadcrumbs\Contracts\Builder as BuilderContract;

/**
 * Breadcrumbs builder class.
 *
 * @since  1.0.0
 * @access public
 */
class Builder implements BuilderContract {

	/**
	 * The `Breadcrumbs` object passed in.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Breadcrumbs
	 */
	protected $manager;

	/**
	 * Array of `Crumb` objects.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    array
	 */
	protected $crumbs = [];

	/**
	 * Creates a new builder object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Breadcrumbs  $manager
	 * @return void
	 */
	public function __construct( Breadcrumbs $manager ) {

		$this->manager = $manager;
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

		$class = __NAMESPACE__ . "\\Query\\{$type}";

		$query = new $class( $this, $this->manager, $data );

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

		$class = __NAMESPACE__ . "\\Build\\{$type}";

		$build = new $class( $this, $this->manager, $data );

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

		$class = __NAMESPACE__ . "\\Crumb\\{$type}";

		$this->crumbs[] = new $class( $this, $this->manager, $data );
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
	 * Runs through a series of conditionals based on the current WordPress
	 * query. Once we figure out which page we're viewing, we create a new
	 * `Query` object and let it build the breadcrumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
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
	}
}
