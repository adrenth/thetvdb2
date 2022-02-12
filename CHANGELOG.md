# Changelog

# 6.0.0

* Update minimum PHP requirement to PHP 7.4
* Extension classes are now final
* All exceptions now implement one distinguishable interface (TheTvdbException)

# 5.1.3

* Add illuminate/support:^9.0 version constraint for Laravel 9 support

# 5.1.2

* Remove develop dependencies (phpcs and phpunit)

# 5.1.0

* Add support for PHP 8.0

# 5.0.1

* Add illuminate/support:^8.0 version constraint for Laravel 8 support

# 5.0.0

* Use PSR-4 for autoloading (thanks to Oskar Stark)
* Add support for symfony/serializer:^5.1

# 4.0.0

* Add /movies/{id} and /movieupdates?since=... endpoint
* Extend version constraint for illuminate/support package

# 3.0.0

* Extend version constraint for illuminate/support package
* Move sources from ./lib to ./src
* Refactored classes

# 2.1.0

* Add siteRatingCount attribute in Series model
* Add lastUpdated attribute in BasicEpisode model
* Add slug to Series model
* Code improvements

# 2.0.0

* Drop support for PHP 5.6 and PHP 5.5
* Add PHP 7.1+ support
* Minor bugfixes

# 1.0.5
* Make `$toTime` parameter optional in `UpdateExtension::query`.
* HTTP errors will not result in an exception thrown by Guzzle HTTP Client.

# 1.0.4
* API login: Make username and userkey optional

# 1.0.3
* Added firstAired attribute in BasicEpisode.

# 1.0.2
* Add package documentation.

# 1.0.1
* Fixed searching for series resulted in a wrong response object. Fixed by X11.

# 1.0.0
* Initial release.
