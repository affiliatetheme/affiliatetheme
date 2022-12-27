<?php
/**
 * WP Filter
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    product
 */

/**
 * at_product_glance_counter
 * Snippet URL: http://www.wpcustoms.net/snippets/count-custom-post-type-items-dashboard/
 *
 */
add_filter( 'dashboard_glance_items', 'at_product_glance_counter', 10, 1 );
function at_product_glance_counter( $items = array() )
{
	$post_types = array( 'product' );

	foreach ( $post_types as $type ) {
		if ( ! post_type_exists( $type ) ) continue;
		$num_posts = wp_count_posts( $type );
		if ( $num_posts ) {
			$published = intval( $num_posts->publish );
			$post_type = get_post_type_object( $type );
			$text      = _n( '%s ' . $post_type->labels->singular_name, '%s ' . $post_type->labels->name, $published, 'affiliatetheme-backend' );
			$text      = sprintf( $text, number_format_i18n( $published ) );
			if ( current_user_can( $post_type->cap->edit_posts ) ) {
				$output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $text . '</a>';
				echo '<li class="post-count ' . $post_type->name . '-count">' . $output . '</li>';
			} else {
				$output = '<span>' . $text . '</span>';
				echo '<li class="post-count ' . $post_type->name . '-count">' . $output . '</li>';
			}
		}
	}

	return $items;
}

if ( ! function_exists( 'at_product_remove_comments_rss' ) ) {
	/**
	 * at_product_remove_comments_rss function.
	 *
	 */
	add_filter( 'post_comments_feed_link', 'at_product_remove_comments_rss' );
	function at_product_remove_comments_rss( $for_comments )
	{
		if ( get_post_type() == 'product' ) {
			return;
		}

		return $for_comments;
	}
}