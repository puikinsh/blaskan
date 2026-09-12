=== Blaskan ===

Contributors: colorlib
Theme URI: https://colorlib.com/wp/themes/blaskan/
Author: Colorlib
Author URI: https://colorlib.com/
Requires at least: 5.2
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 3.1.0
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Source code: https://github.com/puikinsh/blaskan

Blaskan is a responsive and accessible WordPress theme that's built for many kinds of screens.

== Description ==

Blaskan lays posts out in a masonry grid with large featured images, and reads cleanly
from a phone to a wide desktop. The sidebar can sit to the right, to the left, or be
turned off entirely, per site. It ships with eight footer widget areas, a custom header,
a custom logo, an author widget, and support for Jetpack's infinite scroll.

The theme loads no external resources: its typefaces and icons are bundled, so no request
is made to a third party on a visitor's behalf.

== Configuration ==

Blaskan supports:

* Custom header and custom logo
* Custom background
* A main sidebar, positioned right, left, or hidden, under Appearance > Customize > Theme options
* Eight footer widget areas, with the number of columns set in the Customizer
* An optional search box in the header
* Post thumbnails, sticky posts, threaded comments and RTL languages

If you need to modify the code, please use a child theme.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==

= Does this theme support any plugins? =

Blaskan includes support for Infinite Scroll and content options in Jetpack.

= The sidebar does not appear. Why? =

A sidebar with no widgets in it is hidden, and the content runs full width instead. Add a
widget under Appearance > Widgets to bring it back. The Customizer will tell you when the
area is empty.

= How do I load the complete Font Awesome icon set? =

The bundled icon font is subsetted to the glyphs the theme draws. To load the full set
from a child theme or plugin:

`add_filter( 'blaskan_full_fontawesome', '__return_true' );`

== Changelog ==

= 3.1.0 =
* Removed the bundled Bootstrap grid. The theme uses its own layout rules on the same
  breakpoints and widths, so existing markup and child themes are unaffected. This also
  drops a second copy of normalize.css that was loading on top of the theme's own, and
  fixes code and preformatted text rendering at 9.4px instead of 15px, which Bootstrap's
  10px root font size had been causing.
* Replaced Font Awesome 4.7.0 with a self-hosted Font Awesome 7.3.1, subsetted to the 32
  glyphs the theme renders. Icon payload drops from 234 KB to 5.4 KB.
* Self-hosted Droid Serif, Source Sans Pro, Work Sans and Pacifico. The theme no longer
  requests anything from fonts.googleapis.com, so no third-party request is made on a
  visitor's behalf.
* An empty sidebar is now explained in the Customizer rather than silently collapsing,
  which is what made the sidebar layout setting look broken (#197).
* Added the Requires at least, Tested up to and Requires PHP headers, and corrected the
  theme tags to what the theme actually supports.
* Recompressed the screenshot from 727 KB to 132 KB.

= 3.0.2 =
* Fixed footer columns, related posts, widget titles in the footer and search focus.

= 3.0.1 =
* Maintenance release.

= 3.0.0 =
* Rewritten theme.

== Credits ==

* Based on Underscores https://underscores.me/, (C) 2012-2017 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css https://necolas.github.io/normalize.css/, (C) 2012-2016 Nicolas Gallagher and Jonathan Neal, [MIT](https://opensource.org/licenses/MIT)
* Font Awesome 7.3.1 https://fontawesome.com/ — icons [CC BY 4.0](https://creativecommons.org/licenses/by/4.0/), fonts [SIL OFL 1.1](https://scripts.sil.org/OFL), code [MIT](https://opensource.org/licenses/MIT)
* Droid Serif, Source Sans Pro, Work Sans and Pacifico, all [SIL OFL 1.1](https://scripts.sil.org/OFL)
* Masonry https://masonry.desandro.com/, [MIT](https://opensource.org/licenses/MIT) — bundled with WordPress

== Images ==

Header image: https://pixabay.com/en/girl-female-modeling-model-sexy-1502520/
Licensed under CC0 Public Domain, https://creativecommons.org/publicdomain/zero/1.0/deed.en
