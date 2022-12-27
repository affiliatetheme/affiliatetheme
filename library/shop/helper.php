<?php
/**
 * Hilfsfunktionen
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    shop
 */

add_image_size( 'shop_table', 150, 0, true );

if ( ! function_exists( 'at_shop_page_title' ) ) {
	/**
	 * at_product_page_title function.
	 *
	 * @param boolean $echo
	 *
	 * @return string
	 */
	function at_shop_page_title( $echo = true )
	{
		if ( is_post_type_archive( 'shop' ) ) {
			$page_title = __( 'Shops', 'affiliatetheme' );

		} else {
			$page_title = get_the_title();

		}

		$page_title = apply_filters( 'at_shop_page_title', $page_title );

		if ( $echo )
			echo $page_title;
		else
			return $page_title;

	}
}

if ( ! function_exists( 'get_shop_logo' ) ) {
	/**
	 * get_shop_logo function.
	 *
	 * @param int $post_id
	 * @param boolean $force (default: false)
	 *
	 * @return string
	 */
	function get_shop_logo( $post_id = '', $force = false )
	{
		global $post;
		$shops_logo       = get_field( 'shop_single_logo', 'option' );
		$shops_logo_align = get_field( 'shop_single_logo_align', 'option' );

		if ( $post )
			$post_id = $post->ID;

		if ( '1' != $shops_logo && false == $force )
			return;

		if ( $logo = get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'img-responsive ' . $shops_logo_align ) ) )
			return $logo;

		return;
	}
}

if ( ! function_exists( 'at_get_shop_products' ) ) {
	/**
	 * at_get_shop_products function.
	 *
	 * @return array
	 */
	function at_get_shop_products()
	{
		global $wpdb, $post;

		$query = "SELECT " . $wpdb->prefix . "posts.ID FROM " . $wpdb->prefix . "posts  INNER JOIN " . $wpdb->prefix . "postmeta ON ( " . $wpdb->prefix . "posts.ID = " . $wpdb->prefix . "postmeta.post_id ) WHERE 1=1  AND (" . $wpdb->prefix . "postmeta.meta_key LIKE 'product_shops_%_shop' AND " . $wpdb->prefix . "postmeta.meta_value LIKE '" . $post->ID . "') AND " . $wpdb->prefix . "posts.post_type = 'product' AND (" . $wpdb->prefix . "posts.post_status = 'publish' OR " . $wpdb->prefix . "posts.post_status = 'acf-disabled' OR " . $wpdb->prefix . "posts.post_status = 'private') GROUP BY " . $wpdb->prefix . "posts.ID ORDER BY " . $wpdb->prefix . "posts.post_date DESC LIMIT 0,999999";

		$results = $wpdb->get_results( $query );

		if ( $results ) {
			$ids = array();

			foreach ( $results as $item ) {
				$ids[] = $item->ID;
			}

			return $ids;
		}

		return;
	}
}

if ( ! function_exists( 'at_shop_pagination_fix' ) ) {
	/**
	 * at_shop_pagination_fix function.
	 *
	 * @return
	 */
	add_action( 'template_redirect', 'at_shop_pagination_fix', 0 );
	function at_shop_pagination_fix()
	{
		if ( is_singular( 'shop' ) ) {
			remove_action( 'template_redirect', 'redirect_canonical' );
		}
	}
}