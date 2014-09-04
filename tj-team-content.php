<?php
/**
 * Plugin Name:  Theme Junkie Team Content
 * Plugin URI:   http://www.theme-junkie.com/
 * Description:  Enable team post type to your WordPress website.
 * Version:      0.1.1
 * Author:       Theme Junkie
 * Author URI:   http://www.theme-junkie.com/
 * Author Email: satrya@theme-junkie.com
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    Theme_Junkie_Team_Content
 * @since      0.1.0
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class Tj_Team_Content {

	/**
	 * PHP5 constructor method.
	 *
	 * @since  0.1.0
	 */
	public function __construct() {

		/* Set constant path to the plugin directory. */
		add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 );

		/* Internationalize the text strings used. */
		add_action( 'plugins_loaded', array( &$this, 'i18n' ), 2 );

		/* Load the admin functions files. */
		add_action( 'plugins_loaded', array( &$this, 'admin' ), 3 );

		/* Load the plugin functions files. */
		add_action( 'plugins_loaded', array( &$this, 'includes' ), 4 );

		/* Loads the admin styles and scripts. */
		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_scripts' ) );

	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since  0.1.0
	 */
	public function constants() {

		/* Set constant path to the plugin directory. */
		define( 'TJTC_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		/* Set the constant path to the plugin directory URI. */
		define( 'TJTC_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		/* Set the constant path to the admin directory. */
		define( 'TJTC_ADMIN', TJTC_DIR . trailingslashit( 'admin' ) );

		/* Set the constant path to the inc directory. */
		define( 'TJTC_INC', TJTC_DIR . trailingslashit( 'inc' ) );

		/* Set the constant path to the assets directory. */
		define( 'TJTC_ASSETS', TJTC_URI . trailingslashit( 'assets' ) );

	}

	/**
	 * Loads the translation files.
	 *
	 * @since  0.1.0
	 */
	public function i18n() {
		load_plugin_textdomain( 'tjtc', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Loads the admin functions.
	 *
	 * @since  0.1.0
	 */
	public function admin() {
		require_once( TJTC_ADMIN . 'admin.php' );
		require_once( TJTC_ADMIN . 'metabox.php' );
	}

	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since  0.1.0
	 */
	public function includes() {
		require_once( TJTC_INC . 'post-type.php' );
		require_once( TJTC_INC . 'functions.php' );
		require_once( TJTC_INC . 'messages.php' );
	}

	/**
	 * Loads the admin styles and scripts.
	 *
	 * @since  0.1.0
	 */
	public function admin_scripts() {

		/* Check if current screen is Portfolio page. */
		if ( 'member' != get_current_screen()->post_type )
			return;

		/* Loads the meta boxes style. */
		wp_enqueue_style( 'tjtc-metaboxes-style', trailingslashit( TJTC_ASSETS ) . 'css/tjtc-admin.css', null, null );

		/* Loads required media files for the media manager. */
		wp_enqueue_media();

		/* Custom image uploader. */
		wp_enqueue_script( 'tjtc-media', trailingslashit( TJTC_ASSETS ) . 'js/media.js', array( 'jquery' ), null, true );

		/* Localize custom JS. */
		wp_localize_script( 'tjtc-media', 'tjtc_media',
			array(
				'title'  => __( 'Upload or Choose Member Image', 'tjtc' ),
				'button' => __( 'Add image', 'tjtc' )
			)
		);
		
	}

}

new Tj_Team_Content;