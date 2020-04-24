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
 * wc4bpForceVisibility
 *
 * WC4BP Force Visibility to specific xprofile fields.
 *
 * @since 0.0.1
 */
class wc4bpForceVisibility {
	public function __construct() {
		add_filter( 'wc4bp_xprofile_visibility', array( $this, 'force_visibility' ), 10, 2 );
	}

	public function force_visibility( $visibility_level, $field_id ) {
		$target_fields_ids = array( 523, 524, 525, 526 );

		if ( in_array( $field_id, $target_fields_ids ) ) {
			return 'adminsonly'; // The possible options are public => Everyone, adminsonly => Only me, loggedin => All Members
		}

		return $visibility_level;
	}
}
