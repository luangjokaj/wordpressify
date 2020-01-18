=== A Starting Point ===
Contributors: can2
Requires at least: 5.0
Tested up to: WordPress 5.3.2
Requires PHP: 5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A Starting Point is an "_s" or underscores based theme with some extra features.

== Description ==
A Starting Point is an "_s" or underscores based theme with some extra features. Extra features include additional widget areas for the sidebar and footer and additional styles.

== Frequently Asked Questions ==

= Does this theme use a front-end framework? =

Yes, this theme includes a full copy of the latest version of Bootstrap.

= Does this theme support any plugins? =

Yes, this theme supports the following plugins:

- Advanced Custom Fields
- WooCommerce

== Changelog ==

= 1.7.1 =

* Update bootstrap and its dependecies (popper.js)
* add card and jumbotron styles for group block when used with bootstrap utility classes
* fix issue where editor styles were not loading
* include bootstrap utility styles into editor stylesheet

= 1.6.6 =

* Fixed issue where the Customizer was rendering invalid css to the #page element
* Make the #page element `max-width: none` by default
* Import the _type.scss styles into Bootstrap

= 1.6.5 =

* Hide acf json folder from public

= 1.6.4 =

* remove prefixes from the wp_body_open() function
* update theme URI

= 1.6.3 =

* remove prefixes from the popper and bootstrap wp_enqueue_script() functions
* add correct license URL
* update README.txt with correct license description

= 1.6.2 =

* fixed issue where "recent post" widget links were not breaking correctly
* add new tags to style.css (blog, right-sidebar, custom-header, editor-style)
* prefixed the wp_body_open() function
* updated header.php with new prefixed body open function, a_starting_point_wp_body_open();
* updated screenshot
* updated README.txt

= 1.6.1 =

* fix error caused by unnecessary line breaks in customizer.php
* correctly translate customizer.php but for real this time (hopefully)

= 1.6.0 =

* correctly translate customizer.php
* remove unneccesary sanitize functions
* fix issue where some input elements are still breaking outside of the main content area

= 1.5.0 =

* add some space between posts and widgets
* add max-width to select elements
* use the provided sanatize function for colors
* use jquery the correct way (as dependecy argument)
* update screenshot size dimensions
* fix issue where sub-menus were impossible to use
* update selector for headings color so that custom color works
* change strings in customizor for better translation
* change all occruance of ASP to A Starting Point
* replace asp with text domain
* change ASP Theme to text domain
* change "Theme Name: ASP Theme" correct text domain
* update woocommerce assets with correct text domain
* update reference for jetpack styles with text domain
* change theme customizer file to match text domain
* rename pot file to match text domain
* change custom css class token name to match text domain

= 1.4.0 =
* add editor style support

= 1.3.0 =
* escape theme mod options before output


= 1.2.0 =
* add theme URI

= 1.1.0 =
* don't bundle js
* prefix various functions and output
* fix screenshot
* remove the theme url
* remove footer link
* use core jquery

= 1.0.0 =
* Initial release.


== Resources ==
* _s - http://underscores.me/
* Bootstrap - https://getbootstrap.com/
* Advanced Custom Fields - http://advancedcustomfields.com/

== Credits ==

* Based on Underscores http://underscores.me/, (C) 2012-2016 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* Bootstrap: http://getbootstrap.com, License: MIT License

== Copyright Information ==

A Starting Point, Copyright 2019 Cresencio Cantu

A Starting Point is distributed under the terms of the GNU GPL

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

A Starting Point WordPress Theme is derived from Underscores WordPress Theme, Copyright 2012-2016 Automattic, Inc.
Underscores WordPress Theme is distributed under the terms of the GNU GPL

= Images bundled with the theme =
* screenshot.png - Theme screenshot by Cresencio Cantu
  Images for the screenshot were taken by the Theme Author and are released under CC0 license.

A Starting Point WordPress Theme bundles the following third-party resources:

Bootstrap, 2011-2019 the Bootstrap Authors and Twitter, Inc.
Code released under the MIT License. Docs released under Creative Commons.

Popper.js, Code and documentation copyright 2016 Federico Zivolo
Code released under the MIT license. Docs released under Creative Commons.