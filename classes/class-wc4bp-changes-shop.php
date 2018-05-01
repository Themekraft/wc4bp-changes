<?php
/**
 * @package    WordPress
 * @subpackage WC4BP
 * @author     ThemKraft Team
 * @copyright  2018
 * @link       https://themekraft.com/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * wc4bpChangesShop
 *
 * WC4BP Shop related changes.
 *
 * @since 0.0.1
 */
class wc4bpChangesShop {
	public function __construct() {
		/**
		 *
		 */
		add_filter( 'wc4bp_shop_component_label', array( $this, 'change_shop_label' ) );
		/**
		 *
		 */
		add_filter( 'bp_shop_link_label', array( $this, 'change_shop_label' ) );
		/**
		 *
		 */
		add_filter( 'bp_shop_settings_nav_link_label', array( $this, 'change_shop_label' ) );
		/**
		 *
		 */
		add_filter( 'bp_shop_nav_link_label', array( $this, 'change_shop_label' ) );
		/**
		 * @see wc4bp-premium/class/wc4bp-manager.php:91
		 */
		add_filter( 'wc4bp_shop_slug', array( $this, 'change_shop_slug' ), 1 );
	}
	
	/**
	 * Change the Store label in the different places
	 *
	 * @return string
	 */
	public function change_shop_label() {
		return __( 'Store', 'wc4bp-changes-locale' );
	}
	
	/**
	 * Change the slug for the shop
	 *
	 * @return string
	 */
	public function change_shop_slug() {
		return 'my_store';
	}
}
