<?php
/**
 * Plugin Name: WC4BP -> Changes
 * Description: Customize your WC4BP installation from code
 * Author: ThemeKraft Team
 * Author URI: https://themekraft.com/products/woocommerce-buddypress-integration/
 * Version: 0.0.1
 * Licence: GPLv3
 * Text Domain: wc4bp-changes-locale
 * Domain Path: /languages
 *
 *****************************************************************************
 * WC requires at least: 3.0.0
 * WC tested up to: 3.3.3
 *****************************************************************************
 *
 * This script is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 ****************************************************************************
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'wc4bpChanges' ) ) {
	
	class wc4bpChanges {
		/**
		 * Instance of this class.
		 *
		 * @var object
		 */
		protected static $instance = null;
		/**
		 * Assets base url
		 *
		 * @var string
		 */
		public static $assets;
		/**
		 * Path to the view folder
		 *
		 * @var string
		 */
		public static $view;
		
		/**
		 * Initialize the plugin.
		 */
		private function __construct() {
			self::$assets = plugin_dir_url( __FILE__ ) . '/assets/';
			self::$view   = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;
			add_action( 'plugins_loaded', array( $this, 'init' ), 1 );
			
		}
		
		/**
		 * Initialize the Manager
		 */
		public function init() {
			require 'classes' . DIRECTORY_SEPARATOR . 'class-wc4bp-changes-manager.php';
			new wc4bpChangesManager();
		}
		
		/**
		 * Return an instance of this class.
		 *
		 * @return object A single instance of this class.
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			
			return self::$instance;
		}
		
		/**
		 * Load the plugin text domain for translation.
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'wc4bp-changes-locale', false, basename( dirname( __FILE__ ) ) . '/languages' );
		}
	}
	
	/**
	 * Load the plugin at this point to ensure the correct execution of the hooks.
	 */
	global $wc4bp_changes_instance;
	$wc4bp_changes_instance = wc4bpChanges::get_instance();
}

