<?php
/**
 * Plugin Name: Cubify WP
 * Plugin URI:  http://webdevstudios.com
 * Description: Cubify your content
 * Version:     0.1.0
 * Author:      WebDevStudios
 * Author URI:  http://webdevstudios.com
 * Donate link: http://webdevstudios.com
 * License:     GPLv2+
 * Text Domain: cubify_wp
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2014 WebDevStudios (email : justin@webdevstudios.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Built using grunt-wp-plugin
 * Copyright (c) 2013 10up, LLC
 * https://github.com/10up/grunt-wp-plugin
 */

// Useful global constants
define( 'CUBIFY_WP_URL', plugin_dir_url( __FILE__ ) );
define( 'CUBIFY_WP_PATH', dirname( __FILE__ ) . '/' );


class Cubify_WP {

	const VERSION = '0.1.0';

	/**
	 * Sets up our plugin
	 * @since  0.1.0
	 */
	public function __construct() {
	}

	/**
	 * Hold our hooks initiations
	 * @since  0.1.0
	 */
	public function hooks() {
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_js' ) );
		add_shortcode( 'cubify', array( $this, 'shortcode' ) );
	}

	/**
	 * Init hooks
	 * @since  0.1.0
	 * @return null
	 */
	public function init() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'cubify_wp' );
		load_textdomain( 'cubify_wp', WP_LANG_DIR . '/cubify_wp/cubify_wp-' . $locale . '.mo' );
		load_plugin_textdomain( 'cubify_wp', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	}

	/**
	 * Register JS handlers
	 * @since  0.1.0
	 */
	public function register_js() {
		// Use minified?
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '.min' : '';

		wp_register_script( 'threejs', THREEJS_URL . 'assets/js/vendor/three.min.js', array( 'threejs' ), ThreeJS::VERSION );
		wp_register_script( 'cubify', THREEJS_URL . "assets/js/cubify-wp$min.js", array( 'threejs', 'jquery' ), ThreeJS::VERSION );
	}

	/**
	 * Shortcode handler for cubify
	 * @since  0.1.0
	 * @param  array  $atts Shortcode attributes
	 * @return string       Shortcode markup
	 */
	public function shortcode( $atts = array() ) {
		wp_enqueue_script( 'cubify' );

		// Parse the attributes passed in (if any)
		$atts = shortcode_atts( array(
			'img'     => '',
			'color'   => 'ffffff',
			'speed'   => 1,
			'size'    => '100%',
			'class'   => 'alignleft',
			'texture' => '',
		), $atts, 'cubify' );

		// class will not be a data attribute, so separate it out.
		$class = $atts['class'];
		unset( $atts['class'] );

		// loop through the attributes and create them as data attributes
		$data_attributes = '';
		foreach ( $args as $key => $value ) {
			$data_attributes .= sprintf( ' data-%1$s="%2$s"', sanitize_title( $key ), esc_attr( $value ) );
		}

		// build our container and send it back
		return sprintf( '<div class="cubify-wp %1$s" %2$s></div>', sanitize_html_class( $class ), $data_attributes );

	}

}

// init our class
$Cubify_WP = new Cubify_WP();
// And our hooks
$Cubify_WP->hooks();
