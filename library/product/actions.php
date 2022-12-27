<?php
/**
 * WP Actions
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    product
 */

/**
 * at_redirect_fake_product
 *
 */
add_action( 'template_redirect', 'at_redirect_fake_product' );
function at_redirect_fake_product()
{
	global $post;

	if ( ! is_singular( 'product' ) ) {
		return;
	}

	if ( at_is_fake_product( $post->ID ) ) {
		$url = get_field( 'product_fake_redirect', $post->ID );

		if ( $url ) {
			if ( is_user_logged_in() ) {
				add_action( 'at_notices', 'at_redirect_fake_product_notice' );
			} else {
				wp_redirect( $url, 301 );
				exit;
			}
		}
	}
}

/**
 * at_delete_api_log
 *
 */
add_action( 'wp_ajax_at_api_clear_log', 'at_delete_api_log' );
function at_delete_api_log()
{
	$check_hash = ( isset( $_GET['hash'] ) ? $_GET['hash'] : '' );
	$type       = ( isset( $_GET['type'] ) ? $_GET['type'] : '' );

	switch ( $type ) {
		case 'amazon':
			$hash = AWS_CRON_HASH;
			break;

		case 'belboon':
			$hash = BBOON_CRON_HASH;
			break;

		case 'ebay':
			$hash = EBAY_CRON_HASH;
			break;

		case 'adcell':
			$hash = ADCELL_CRON_HASH;
			break;

		case 'cj':
			$hash = CJ_CRON_HASH;
			break;

		case 'rakuten':
			$hash = RAKUTEN_CRON_HASH;
			break;

		case 'tradetracker':
			$hash = TRADETRACKER_CRON_HASH;
			break;

		case 'tradedoubler':
			$hash = TRADEDOUBLER_CRON_HASH;
			break;

		case 'daisycon':
			$hash = DAISYCON_CRON_HASH;
			break;

		case 'financeads':
			$hash = FINANCEADS_CRON_HASH;
			break;

		case 'ccsv':
			$hash = CCSV_CRON_HASH;
			break;

		case 'tracdelight':
			$hash = TRACDELIGHT_CRON_HASH;
			break;

		default:
			$hash = '';
			break;
	}

	if ( $check_hash != $hash || ! isset( $_GET['type'] ) ) {
		die( 'Security check failed.' );
	}

	update_option( 'at_' . $type . '_api_log', array() );

	$status = array( 'status' => 'success' );

	echo json_encode( $status );

	exit();
}

if ( ! function_exists( 'at_taxonomy_pre_get_posts' ) ) {
	/**
	 * Modify the taxonomy query
	 *
	 * @param $query
	 */
	add_action( 'pre_get_posts', 'at_taxonomy_pre_get_posts' );
	function at_taxonomy_pre_get_posts( $query )
	{
		if ( ! is_admin() && $query->is_main_query() ) {
			if ( is_tax() ) {
				$queried_object = get_queried_object();
				$term_id        = $queried_object->term_id;
				$taxonomy       = get_current_product_tax( $queried_object->taxonomy );

				$orderby        = ( isset( $taxonomy['orderby'] ) ? $taxonomy['orderby'] : '' );
				$order          = ( isset( $taxonomy['order'] ) ? $taxonomy['order'] : '' );
				$posts_per_page = ( isset( $taxonomy['posts_per_page'] ) ? $taxonomy['posts_per_page'] : 12 );

				if ( $orderby ) {
					if ( $orderby == 'price' ) {
						$query->set( 'meta_key', 'product_shops_0_price' );
						$query->set( 'orderby', 'meta_value_num' );
					} elseif ( $orderby == 'rating' ) {
						$query->set( 'meta_key', 'product_rating' );
						$query->set( 'orderby', 'meta_value_num' );
					} else {
						$query->set( 'orderby', $orderby );
					}
				}

				if ( $order ) {
					$query->set( 'order', $order );
				}

				if ( $posts_per_page ) {
					$query->set( 'posts_per_page', $posts_per_page );
				}

				// FILTER
				if ( isset( $_GET['orderby'] ) ) {
					if ( $_GET['orderby'] == 'a-z' ) {
						$orderby = 'title';
						$order   = 'asc';
					} elseif ( $_GET['orderby'] == 'z-a' ) {
						$orderby = 'title';
						$order   = 'desc';
					} elseif ( $_GET['orderby'] == 'date' ) {
						$orderby = 'date';
						$order   = 'desc';
					} elseif ( $_GET['orderby'] == 'price-asc' ) {
						$orderby = 'meta_value_num';
						$order   = 'asc';
						$query->set( 'meta_key', 'product_shops_0_price' );
					} elseif ( $_GET['orderby'] == 'price-desc' ) {
						$orderby = 'meta_value_num';
						$order   = 'desc';
						$query->set( 'meta_key', 'product_shops_0_price' );
					} elseif ( $_GET['orderby'] == 'rating' ) {
						$orderby = 'meta_value_num';
						$order   = 'desc';
						$query->set( 'meta_key', 'product_rating' );
					}

					$query->set( 'orderby', $orderby );
					$query->set( 'order', $order );
				}
			}
		}
	}
}