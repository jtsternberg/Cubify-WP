<?php
/**
 * Plugin Name: Cubify WP
 * Plugin URI:  http://webdevstudios.com
 * Description: Cubify your content by using a shortcode: [cubify img=/wp-content/plugins/cubify-wp/images/wat.png percentage=50 class=alignright speed=2]
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

// Useful global constants
define( 'CUBIFY_WP_URL', plugin_dir_url( __FILE__ ) );
define( 'CUBIFY_WP_PATH', dirname( __FILE__ ) . '/' );


class Cubify_WP {

	/**
	 * Plugin Version
	 */
	const VERSION = '0.1.0';

	/**
	 * Cubify shortcode defaults
	 * @var array
	 */
	public $shortcode_defaults = array(
		'img'        => '',
		'color'      => '#ffffff',
		'speed'      => 1,
		'class'      => 'alignleft',
		'percentage' => '100',
	);

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

		wp_register_script( 'threejs', CUBIFY_WP_URL . 'assets/js/vendor/three.min.js', array(), Cubify_WP::VERSION );
		wp_register_script( 'cubify', CUBIFY_WP_URL . "assets/js/cubify-wp$min.js", array( 'threejs', 'jquery' ), Cubify_WP::VERSION, true );
	}

	/**
	 * Shortcode handler for cubify
	 * @since  0.1.0
	 * @param  array  $atts Shortcode attributes
	 * @return string       Shortcode markup
	 */
	public function shortcode( $atts = array() ) {
		// Ensure cubify scripts are enqueued
		wp_enqueue_script( 'cubify' );

		// Parse the attributes passed in (if any)
		$atts = shortcode_atts( $this->shortcode_defaults, $atts, 'cubify' );

		// build our container and send it back
		return sprintf( '<p class="cubify-wp %1$s" %2$s></p>', sanitize_html_class( $atts['class'] ), $this->concat_data_attributes( $atts ) );

	}

	/**
	 * Create data attributes from shortcode arguments
	 * @since  0.1.0
	 * @param  array  $atts Shortcode arguments
	 * @return string       String of data attributes
	 */
	public function concat_data_attributes( $atts ) {

		// class will not be a data attribute, so remove it.
		unset( $atts['class'] );

		// loop through the attributes and create them as data attributes
		$cancatenated_attributes = '';
		foreach ( $atts as $key => $value ) {
			$cancatenated_attributes .= sprintf( ' data-%1$s="%2$s"', sanitize_title( $key ), esc_attr( $value ) );
		}
		return $cancatenated_attributes;
	}

}

// init our class
$Cubify_WP = new Cubify_WP();
// And our hooks
$Cubify_WP->hooks();
