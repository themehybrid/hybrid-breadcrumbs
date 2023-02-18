# Change Log

You can see the changes made via the [commit log](https://github.com/justintadlock/hybrid-breadcrumbs/commits/master) for the latest release.

## [1.1.0] - 2019-06-10

### Added

- Passes the `$data` array as a second parameter to the following hooks:
	- `hybrid/breadcrumbs/query/{$type}`
	- `hybrid/breadcrumbs/build/{$type}`
	- `hybrid/breadcrumbs/crumb/{$type}`

## [1.0.1] - 2018-10-23

### Fixed

- Better, more consistent handling of the rewrite font item and the posts page where the code ran into conflicts of its own design and may or may not have shown the appropriate breadcrumb.
- Set the initial `$post` variable in `src/Build/PostAncestors.php`.
- Reference the correct `postTaxonomy()` (not `postType()`) method in `src/Build/MapRewriteTags.php`.
-

## [1.0.0] - 2018-09-13

### Added

- Everything's new! This is the first release.
