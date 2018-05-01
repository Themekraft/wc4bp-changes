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

class wc4bpChangesManager {
	
	public function __construct() {
		global $wc4bp_loader;
		if ( ! empty( $wc4bp_loader ) ) {
			/** @var WC4BP_Loader $wc4bp_loader */
			$freemius = $wc4bp_loader::getFreemius();
			if ( ! empty( $freemius ) && $freemius->is_plan__premium_only( 'professional' ) ) {
				require 'class-wc4bp-changes-shop.php';
				new wc4bpChangesShop();
			} else {
				add_action( 'admin_notices', array( $this, 'required_wc4bp_pro' ) );
			}
		} else {
			add_action( 'admin_notices', array( $this, 'required_wc4bp_pro' ) );
		}
	}
	
	public function required_wc4bp_pro() {
		require wc4bpChanges::$view . 'required_notice.php';
	}
}
