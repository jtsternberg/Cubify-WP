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


class Cubify_Wp {

	const VERSION = '0.1.0';

	/**
	 * Sets up our plugin
	 * @since  0.1.0
	 */
	public function __construct() {
	}

	public function hooks() {

		register_activation_hook( __FILE__, array( $this, '_activate' ) );
		register_deactivation_hook( __FILE__, array( $this, '_deactivate' ) );
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}

	/**
	 * Activate the plugin
	 */
	function _activate() {
		// Make sure any rewrite functionality has been loaded
		flush_rewrite_rules();
	}

	/**
	 * Deactivate the plugin
	 * Uninstall routines should be in uninstall.php
	 */
	function _deactivate() {

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
	 * Hooks for the Admin
	 * @since  0.1.0
	 * @return null
	 */
	public function admin_init() {
	}

}

// init our class
$Cubify_Wp = new Cubify_Wp();
$Cubify_Wp->hooks();

