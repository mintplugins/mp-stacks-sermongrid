=== MP Stacks + SermonGrid ===
Contributors: johnstonphilip
Donate link: http://mintplugins.com/
Tags: message bar, header
Requires at least: 3.5
Tested up to: 5.3
Stable tag: 1.0.1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add-On Plugin for MP Stacks which shows a grid of Sermons in a Brick.

== Description ==

Extremely simple to set up - allows you to show Sermons on any page, at any time, anywhere on your website. Just put make a brick using “MP Stacks”, put the stack on a page, and set the brick’s Content-Type to be “SermonGrid”.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the 'mp-stacks-sermongrid’ folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Build Bricks under the “Stacks and Bricks” menu.
4. Publish your bricks into a “Stack”.
5. Put Stacks on pages using the shortcode or the “Add Stack” button.

== Frequently Asked Questions ==

See full instructions at http://mintplugins.com/doc/mp-stacks

== Screenshots ==


== Changelog ==

= 1.0.1.3 = June 15, 2019
* Add support for Sermon Manager plugin. You can now use sermons from either Church Content or Sermon Manager with SermonGrid.

= 1.0.1.2 = April 12, 2019
* Podcast UX improvements (copy text js, feed://on iphone)

= 1.0.1.1 = April 12, 2019
* Improve Podcast subscribe experience by providing easy-to-follow routes for iTunes, other podcasting apps, and if you have no podcasting app yet.
* Removed confusing admin pages from ctc

= 1.0.1.0 = February 7, 2019
* Make sermon MP3 show even if link entered isn’t an MP3. This allows for linking to sites like SoundCloud.

= 1.0.0.9 = May 24, 2018
* Fix Read More output on SermonGrid excerpts
* Add filter for podcast feed url to allow for custom podcast URLs

= 1.0.0.8 = September 4, 2017
* Make audio-only sermons display better on iPhone

= 1.0.0.7 = Feburay 27, 2017
* Add podcast disable filter

= 1.0.0.6 = August 18, 2016
* Set has_term to ctc_sermon_tag. Fixes bug introduced with WordPress 4.6

= 1.0.0.5 = August 12, 2016
* Make it so that iframes entered for sermon videos retain all of their settings - like fullscreen attributes.
* Redirect for sermon/feed/ to sermon-ctc/feed

= 1.0.0.4 = June 2, 2016
* Reset rewrite rules upon activation
* Change podcast feed URL from /sermons/ to /ctc-sermons/

= 1.0.0.3 = February 21, 2016
* Added Google Font controls for all Grid Text items.
* Make Sermon Descriptions have proper spacing in sermon lightbox

= 1.0.0.2 = November 10, 2015
* Make Text Below Grid Image open in Lightbox by Default (previously just the featured image did this).
* Do Shortcodes in the Sermon Body in the lightbox popup.

= 1.0.0.1 = November 4, 2015
* Sermons per row are now passed through the mp_stacks_grid_posts_per_row_percentage function.
* Removed Font Awesome to instead use version in MP Stacks.
* Filter ctc-sermons post type to use 'ctc-sermons' as URL rewrite
* Added "Load From Scratch" Isotope Filter behaviour support

= 1.0.0.0 = September 21, 2015
* Original release
