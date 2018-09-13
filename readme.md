# Hybrid\\Breadcrumbs

Hybrid Breadcrumbs is a drop-in package that theme authors can use to add breadcrumbs to their WordPress themes.

The package is a developer-friendly project that aims to take out all the work of handling breadcrumbs. It is one of the most advanced and robust breadcrumb systems available that can handle nearly any setup to show the most accurate breadcrumbs for each page.

This project was [originally launched in 2009](http://justintadlock.com/archives/2009/04/05/breadcrumb-trail-wordpress-plugin) as the Breadcrumb Trail plugin. Hybrid Breadcrumbs is a reimagining of that original script as a better drop-in package for theme authors to use.

## Requirements

* WordPress 4.9+.
* PHP 5.6+ (preferably 7+).
* [Composer](https://getcomposer.org/) for managing PHP dependencies.

## Documentation

The following docs are written with theme authors in mind because that'll be the most common use case.  If including in a plugin, it shouldn't be much different.

### Installation

First, you'll need to open your command line tool and change directories to your theme folder.

```bash
cd path/to/wp-content/themes/<your-theme-name>
```

Then, use Composer to install the package.

```bash
composer require justintadlock/hybrid-breadcrumbs
```

Assuming you're not already including the Composer autoload file for your theme and are shipping this as part of your theme package, you'll want something like the following bit of code in your theme's `functions.php` to autoload this package (and any others).

The Composer autoload file will automatically load up Hybrid Breadcrumbs for you and make its code available for you to use.

```php
if ( file_exists( get_parent_theme_file_path( 'vendor/autoload.php' ) ) ) {
	require_once( get_parent_theme_file_path( 'vendor/autoload.php' ) );
}
```

### Translations

Because this script has a few internationalized text strings within it, you'll want to overwrite the textdomain or use something like this [one theme with two textdomains trick](https://gist.github.com/justintadlock/7a605c29ae26c80878d0) (the textdomain in this project is `'hybrid-core'`).

If you're creating a theme using the [Hybrid Core framework](https://github.com/justintadlock/hybrid-core), you don't have to worry about this. Hybrid Core will appropriately handle translations for you.

### Usage

Most developers will want to utilize the `Hybrid\Breadrumbs\Trail` class.  It is a static wrapper class that essentially acts as _syntactic sugar_ for use in theme templates.

Typically, a call like the following would go into your theme's `header.php` template but can be used anywhere you want to show the breadcrumb trail.

```php
Hybrid\Breadcrumbs\Trail::display();
```

_Note that the plugin's namespace is `Hybrid\Breadcrumbs`.  If you're working within another namespace, you'll want to add a `use` statement after your own namespace call or call `\Hybrid\Breadcrumbs\display()` directly.  I'll assume you know what you're doing if you're working with namespaces.  Otherwise, stick to the above._

### Static class

The `Hybrid\Breadcrumbs\Trail` class has the following methods:

```php
// Returns a new instance of the Hybrid\Breadcrumbs\Breadcrumbs class.
Trail::breadcrumbs( array $args = [] );

// Makes a breadcrumb trail and returns an instance of the Hybrid\Breadcrumbs\Breadcrumbs.
Trail::make( array $args = [] );

// Returns an array of Hybrid\Breadcrumbs\Crumb\* objects.
Trail::all( array $args = [] );

// Displays the HTML output of the breadcrumb trail if it exists.
Trail::display( array $args = [] );

// Returns the HTML output of the breadcrumb trail or an empty string.
Trail::render( array $args = [] );
```

### Breadcrumbs class

If you don't care for static classes and need to work directly with the object, that's fine too.  You can create and use a the `Breadcrumbs` object like so:

```php
// Create a new Breadcrumbs object.
$trail = new \Hybrid\Breadcrumbs\Breadcrumbs( array $args = [] );

// Makes the breadcrumb trail and returns an instance of the object.
$trail->make();

// Returns an array of Hybrid\Breadcrumbs\Crumb\* objects.
$trail->all();

// Displays the HTML output of the breadcrumb trail if it exists.
$trail->display();

// Returns the HTML output of the breadcrumb trail or an empty string.
$trail->render();
```

### Parameters

The `Breadcrumbs` class and the `Trail` class methods all accept a single parameter, which an array of optional arguments for setting up the breadcrumb trail.  The following is a list of all the available options (see below for defaults).

* `labels` - An array of labels.
* `post_taxonomy` - An array of taxonomies to show for single posts based on post type.
* `show_on_front` - Whether to show the breadcrumb trail on the site front page.
* `show_trail_end` - Whether to display the final breadcrumb.
* `network` - Whether to include the main site at the beginning of the trail on multisite.
* `before` - HTML to display before.
* `after` - HTML to display after.
* `container_tag` - HTML tag to use for the container.
* `title_tag` - HTML tag to use for the title.
* `list_tag` - HTML tag to use for the list.
* `item_tag` - HTML tag to use for each breadcrumb.
* `container_class` - Class to use for the container.
* `title_class` - Class to use for the title.
* `list_class` - Class to use for the list.
* `item_class` - Class to use for each breadcrumb.

#### Default Parameters

```php
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
```

#### Default Labels

Labels are used for various breadcrumbs where WordPress doesn't provide a title/labels.

```php
$defaults = [
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
```

#### Default Post Taxonomies

By default, no post taxonomies are registered.  However, if a site's post permalink structure is set to only `%postname%`, the following will be the default.

```php
$defaults = [
	'post' => 'category'
];
```

## Copyright and License

This project is licensed under the [GNU GPL](http://www.gnu.org/licenses/old-licenses/gpl-2.0.html), version 2 or later.

2018 &copy; [Justin Tadlock](http://justintadlock.com).
