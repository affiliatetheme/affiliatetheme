<?php
/*
 * VARS
 */

global $grid_col;
$grid_col       = '4';
$posts_per_page = ( get_field( 'product_single_related_numberposts', 'option' ) ? get_field( 'product_single_related_numberposts', 'option' ) : '3' );
$layout         = ( get_field( 'product_single_related_layout', 'option' ) ? get_field( 'product_single_related_layout', 'option' ) : 'list' );
$filter         = ( get_field( 'product_single_related_filter', 'option' ) ? get_field( 'product_single_related_filter', 'option' ) : '' );
$orderby        = ( get_field( 'product_single_related_orderby', 'option' ) ? get_field( 'product_single_related_orderby', 'option' ) : 'date' );
$order          = ( get_field( 'product_single_related_order', 'option' ) ? get_field( 'product_single_related_order', 'option' ) : 'DESC' );
$post_type      = $post->post_type;

if ( ( '' == ( $related = get_field( 'product_related' ) ) ) ) {
	$args = array(
		'post_type'      => $post_type,
		'posts_per_page' => $posts_per_page,
		'post__not_in'   => array( get_the_ID() ),
		'orderby'        => $orderby,
		'order'          => $order,
	);

	if ( $orderby ) {
		if ( $orderby == 'price' ) {
			$args['meta_key'] = 'product_shops_0_price';
			$args['orderby']  = 'meta_value_num';
		} elseif ( $orderby == 'rating' ) {
			$args['meta_key'] = 'product_rating';
			$args['orderby']  = 'meta_value_num';
		} else {
			$args['orderby'] = $orderby;
		}
	}

	if ( 'tax' == $filter ) {
		$taxonomies = get_object_taxonomies( $post );
		if ( $taxonomies ) {
			$args['tax_query'] = array( 'relation' => 'OR' );
			foreach ( $taxonomies as $tax ) {
				$terms               = wp_get_post_terms( $post->ID, $tax, array( 'fields' => 'slugs' ) );
				$args['tax_query'][] = array(
					'taxonomy' => $tax,
					'field'    => 'slug',
					'terms'    => $terms
				);
			}
		}
	}

	$args = apply_filters( 'at_set_product_related_query', $args );

	$related = get_posts( $args );
}

// remove not published products
if ( $related ) {
	foreach ( $related as $k => $v ) {
		if ( $v->post_status != 'publish' ) {
			unset( $related[ $k ] );
		}
	}
}

if ( $related ) {
	global $o_list;
	$o_list = true;
	?>
	<div class="product-related">
		<?php
		if ( 'grid' == $layout ) echo '<div class="row">';
		foreach ( $related as $post ) {
			setup_postdata( $post );
			if ( $post->post_status != 'publish' ) continue;

			get_template_part( 'parts/product/loop', $layout );

		}
		if ( 'grid' == $layout ) echo '</div>';
		?>
	</div>
	<?php
} else {
	echo apply_filters( 'at_related_products_no_results', __( 'Es wurden keine ähnlichen Produkte gefunden.', 'affiliatetheme' ) );
}
wp_reset_query();
?>

