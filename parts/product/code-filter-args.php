<?php

global $args, $layout;

$layout  = isset( $_GET['layout'] ) ? sanitize_text_field( $_GET['layout'] ) : ( isset($layout) ? $layout : '' );
$orderby = isset( $_GET['orderby'] ) ? sanitize_text_field( $_GET['orderby'] ) : '';

if ( $orderby ) {
	switch ( $orderby ) {
		case 'z-a':
			$orderby = 'title';
			$order   = 'desc';
			break;

		case 'date':
			$orderby = 'date';
			$order   = 'desc';
			break;

		case 'price-asc':
			$orderby          = 'meta_value_num';
			$order            = 'asc';
			$args['meta_key'] = 'product_shops_0_price';
			break;

		case 'price-desc':
			$orderby          = 'meta_value_num';
			$order            = 'desc';
			$args['meta_key'] = 'product_shops_0_price';
			break;

		case 'rating':
			$orderby          = 'meta_value_num';
			$order            = 'desc';
			$args['meta_key'] = 'product_rating';
			break;

		default:
			$orderby = 'title';
			$order   = 'asc';
			break;
	}

	$args['orderby'] = $orderby;
	$args['order']   = $order;
}