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
 * wc4bpChangesActivityStream
 *
 * WC4BP Activity Stream related changes.
 *
 * @since 1.0.0
 */
class wc4bpChangesActivityStream {
	public function __construct() {
		/** @see class/wc4bp-activity-stream.php:83 */
		add_filter( 'wc4bp_stream_product_review', array( $this, 'callback_stream_product' ), 10, 5 );
		/** @see class/wc4bp-activity-stream.php:164 */
		add_filter( 'wc4bp_stream_order_complete', array( $this, 'callback_stream_order_complete' ), 10, 5 );
	}

	/**
	 * Override the Activity Stream for Order Complete
	 *
	 * @param string $text_output
	 * @param int $user_id_from_order
	 * @param WC_Order $order
	 * @param WC_ORder_Item[] $order_items
	 * @param string $stream_action
	 *
	 * @return string
	 */
	public function callback_stream_order_complete( $text_output, $user_id_from_order, $order, $order_items, $stream_action ) {
		$user_link = bp_core_get_userlink( $user_id_from_order );

		$names = array();
		/** @var WC_Order_Item_Product $item */
		foreach ( $order_items as $item ) {
			$names[] = '<a href="' . $item->get_product()->get_permalink() . '">' . $item->get_product()->get_name() . '</a>';
		}

		return sprintf(
			'The user: %s bought %s',
			$user_link,
			implode( ', ', $names )
		);
	}

	/**
	 * Override the Activity Stream for Product Review
	 *
	 * @param string $text_output
	 * @param int $user_id
	 * @param WP_Comment $comment_data
	 * @param WC_Product $product
	 * @param string $stream_action
	 *
	 * @return string
	 */
	public function callback_stream_product( $text_output, $user_id, $comment_data, $product, $stream_action ) {
		$user_link = bp_core_get_userlink( $user_id );

		return sprintf(
			'The Product: <a href="%s">%s</a> receive a Review from the user %s',
			get_permalink( $comment_data->comment_post_ID ),
			$product->get_title(),
			$user_link
		);
	}
}