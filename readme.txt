=== Cubify WP ===
Contributors:      jtsternberg, camdensegal
Donate link:       http://webdevstudios.com
Tags:
Requires at least: 3.6.0
Tested up to:      3.9.0
Stable tag:        0.1.0
License:           GPLv2 or later
License URI:       http://www.gnu.org/licenses/gpl-2.0.html

Cubify your content

== Description ==

Because you always wanted floating 3D cubes in your WordPress content.

### Shortcode Instructions

1. Use the shortcode in your WordPress content. Something like `[cubify img=/wp-content/plugins/cubify-wp/images/wat.png percentage=50 class=alignright speed=2]`. **Note:** Only images on the same server can be used, so best to use images in your media library.
2. Smile
3. Share

### Shortcode Parameters

* img        - Image URL
* color      - Box color
* speed      - Spin speed
* class      - Default is `alignleft`, but feel free to align with: `aligncenter`, `alignright`, or set your own custom class
* percentage - Width of the cube in relation to content

== Installation ==

= Manual Installation =

1. Upload the entire `/cubify-wp` directory to the `/wp-content/plugins/` directory.
2. Activate Cubify WP through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= How do I insert cubes into my content? =
Use a shortcode. `[cubify img=/wp-content/plugins/cubify-wp/images/wat.png percentage=50 class=alignright speed=2]`

= Shortcode Parameters =

* img        - Image URL
* color      - Box color
* speed      - Spin speed
* class      - Default is `alignleft`, but feel free to align with: `aligncenter`, `alignright`, or set your own custom class
* percentage - Width of the cube in relation to content

= Where should I upload images? =

Cubify-WP only works if the images you upload are on your server. Just use the WordPress media uploader, and then copy/paste the URL into the shortcode.

= What makes these magical cubes so beautiful? =
[Three.js](http://threejs.org/ "A JavaScript 3D Library which makes WebGL simpler") A JavaScript 3D Library which makes WebGL simpler.

= Does this plugin serve any practical purpose? =
Cubify-WP is for fun of course! That's pretty practical, right?

== Screenshots ==

1. Use a shortcode to insert a cube into your content.
2. The cube aligned right with content.

== Changelog ==

= 0.1.0 =
* First release

== Upgrade Notice ==

= 0.1.0 =
First Release
