<?php
/**
 * Shortcodes
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    product
 */

add_shortcode( 'produkte', 'endcore_products_shortcode' );
add_shortcode( 'products', 'endcore_products_shortcode' );
add_shortcode( 'preisvergleich', 'endcore_price_compare_shortcode' );
add_shortcode( 'price_compare', 'endcore_price_compare_shortcode' );
add_shortcode( 'infobox', 'endcore_infobox_shortcode' );
add_shortcode( 'top_rated', 'endcore_top_rated_shortcode' );
add_shortcode( 'produktvergleich', 'endcore_product_compare_shortcode' );
add_shortcode( 'product_compare', 'endcore_product_compare_shortcode' );
add_shortcode( 'price', 'at_price_shortcode' );

/*
 * Produkte
 */
function endcore_products_shortcode( $atts, $content = null )
{
	extract( shortcode_atts(
		array(
			"limit"           => "12",
			"orderby"         => "date",
			"order"           => "DESC",
			"field"           => "",
			"field_value"     => "",
			"field_value_num" => "",
			"field_compare"   => "=",
			"include"         => "",
			"exclude"         => "",
			"layout"          => "list",
			"detail_button"   => "true",        // Detail Button ausblenden true/false
			"buy_button"      => "true",        // Kaufen Button ausblenden true/false
			"details_fields"  => "true",        // Produkteigenschaften anzeigen true/false
			"details_tax"     => "true",        // Taxonomien anzeigen true/false
			"price_min"       => "",            // Preisfilter: Minimaler Preis
			"price_max"       => "",            // Preisfilter: Maximaler Preis
			"align"           => "left",        // Nur für layout: grid
			"slider"          => "false",        // Nur für layout: grid
			"interval"        => "8000",        // Nur für layout: slider
			"col"             => 3,           // Nur für layout: grid & slider
			"rating"          => "true",        // Nur für layout: table
			"review"          => "false",        // Nur für layout: table
			"highlight"       => "",            // id
			"shop"            => "",
			"reduced"         => "false",
			"fields"          => "",
			"price_compare"   => "false"      // Nur für layout: table
		),
		$atts ) );

	if ( is_admin() && ! wp_doing_ajax() ) {
		return;
	}

	global $grid_col;
	$grid_col = ( $col ? $col : 3 );

	/*
	 * args
	 */
	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => $limit,
		'orderby'        => $orderby,
		'order'          => $order
	);

	// orderby custom field
	if ( 'price' == $orderby ) {
		$args['orderby']  = 'meta_value_num';
		$args['meta_key'] = 'product_shops_0_price';
	}
	if ( 'rating' == $orderby ) {
		$args['orderby']  = 'meta_value_num';
		$args['meta_key'] = 'product_rating';
	}
	if ( 'rating_count' == $orderby ) {
		$args['orderby']  = 'meta_value_num';
		$args['meta_key'] = 'product_rating_cnt';
	}
	if ( 'field' == $orderby ) {
		$args['orderby'] = 'meta_value';
	}

	// custom meta query
	if ( $field ) {
		$field_query = array(
			'key' => $field
		);

		if ( $field_value_num ) {
			$field_query['value'] = $field_value_num;
			$field_query['type']  = 'NUMERIC';
		} elseif ( $field_value ) {
			$field_query['value'] = $field_value;
		}

		if ( $field_compare ) {
			$field_query['compare'] = $field_compare;
		}

		$args['meta_query'][] = $field_query;
	}

	// include
	if ( $include ) {
		if ( $include_arr = explode( ',', $include ) )
			$args['post__in'] = $include_arr;
	}

	// exclude
	if ( $exclude ) {
		if ( $exclude_arr = explode( ',', $exclude ) )
			$args['post__not_in'] = $exclude_arr;
	}

	// price_min / pice_max
	if ( $price_min || $price_max ) {
		$price = array();

		$price[0] = ( $price_min ? $price_min : '0' );
		$price[1] = ( $price_max ? $price_max : '9999999' );

		$args['meta_query'] = array(
			array(
				'key'     => 'product_shops_0_price',
				'value'   => $price,
				'compare' => 'BETWEEN',
				'type'    => 'NUMERIC'
			)
		);
	}

	// sale
	if ( 'true' == $reduced ) {
		$args['meta_query'] = array(
			array(
				'key'     => 'product_shops_0_price_old',
				'value'   => 'mt1.meta_value',
				'compare' => '>',
				'type'    => 'numeric'
			),
			array(
				'key'     => 'product_shops_0_price',
				'compare' => 'EXISTS',
			)
		);

		// set filter when reduced param is set
		$reduced_filter = function ( $sql ) {
			$sql = str_replace( "'mt1.meta_value'", "mt1.meta_value", $sql );

			return $sql;
		};


		add_filter( 'posts_request', $reduced_filter );
	}

	// slider
	if ( 'true' == $slider ) {
		$layout = 'grid'; // überschreibe das aktuelle layout
	}

	// taxonomien
	if ( $atts ) {
		foreach ( $atts as $key => $val ) {
			if ( taxonomy_exists( $key ) ) {
				$args[ $key ] = $val;
			}
		}
	}

	// shop
	if ( $shop != '' ) {
		global $shop_id;
		$shop_id = $shop;
		add_filter( 'posts_where', 'at_product_filter_by_shop' );
		function at_product_filter_by_shop( $where )
		{
			global $shop_id;

			$where = str_replace( "meta_key = 'product_shops_%_shop'", "meta_key LIKE 'product_shops_%_shop' AND meta_value = '" . $shop_id . "'", $where );

			return $where;
		}

		$args['meta_query'][] = array(
			'key' => 'product_shops_%_shop',
		);
	}

	global $product_button_detail_hide;
	$product_button_detail_hide = ( ( 'true' == $detail_button ) ? '0' : '1' );

	global $product_button_buy_hide;
	$product_button_buy_hide = ( ( 'true' == $buy_button ) ? '0' : '1' );

	global $product_details_fields_hide;
	$product_details_fields_hide = ( ( 'true' == $details_fields ) ? '0' : '1' );

	global $product_details_tax_hide;
	$product_details_tax_hide = ( ( 'true' == $details_tax ) ? '0' : '1' );

	global $product_rating_hide;
	$product_rating_hide = ( ( 'true' == $rating ) ? '0' : '1' );

	global $product_review_hide;
	$product_review_hide = ( ( 'true' == $review ) ? '0' : '1' );

	global $product_table_highlight;
	$product_table_highlight = ( $highlight ? explode( ',', $highlight ) : array() );

	global $product_price_compare;
	$product_price_compare = ( $price_compare == 'true' ? true : false );

	// force field groups
	global $product_field_groups;
	if ( $fields ) {
		$product_field_groups = explode( ',', $fields );
	} else {
		$product_field_groups = array();
	}

	// mobile fallback table-x until bootstrap 4 fix
	if ( apply_filters( 'at_mobile_table_fallback', true ) ) {
		if ( at_phone_detect() && ( $layout == 'table-x' || $layout == 'table-y' ) ) {
			$layout = apply_filters( 'at_mobile_table_fallback_layout', 'list' );
		}
	}

	// mobile fallback grid-hover
	if ( wp_is_mobile() && ( $layout == 'grid-hover' ) ) {
		$layout = 'grid';
	}

	$args = apply_filters( 'at_set_product_shortcode_query', $args, $layout );

	$output = apply_filters( 'at_product_shortcode_loop_before', '', $layout );

	if ( $layout == "table-x" ) {
		/*
		 * Layout: table-x
		 */
		global $products;
		$products = new WP_Query( $args );

		if ( $products->have_posts() ) {
			$products = $products->posts;
			ob_start();
			get_template_part( 'parts/product/loop', 'table-x' );
			$output .= ob_get_contents();
			ob_end_clean();
		}
	} elseif ( $layout == "table-y" ) {
		/*
		 * Layout: table-y
		 */
		global $products;
		$products = new WP_Query( $args );

		if ( $products->have_posts() ) {
			$products = $products->posts;
			ob_start();
			get_template_part( 'parts/product/loop', 'table-y' );
			$output .= ob_get_contents();
			ob_end_clean();
		}
	} elseif ( $layout == "list" ) {
		/*
		 * Layout: list
		 */
		$products = new WP_Query( $args );
		if ( $products->have_posts() ) :
			while ( $products->have_posts() ) : $products->the_post();
				ob_start();
				get_template_part( 'parts/product/loop', 'list' );
				$output .= ob_get_contents();
				ob_end_clean();
			endwhile;
		endif;
	} elseif ( $layout == "grid" || $layout == "grid-hover" ) {
		/*
		 * Layout: grid or grid-hover
		 */
		$products_grid = new WP_Query( $args );
		if ( $products_grid->have_posts() ) :
			$i    = 0;
			$rand = rand( 0, 13337 );

			if ( 'true' == $slider ) {
				$output .= '
				<div id="carousel-' . $rand . '" class="carousel slide" data-interval="' . $interval . '" data-ride="carousel">
					<div class="controls pull-right hidden-xs">
	                    <a class="left btn btn-link" href="#carousel-' . $rand . '" data-slide="prev"><i class="fas fa-chevron-left"></i></a>
	                    <a class="right btn btn-link" href="#carousel-' . $rand . '" data-slide="next"><i class="fas fa-chevron-right"></i></a>
	                </div>
	                <div class="clearfix"></div>
					<div class="carousel-inner">
						<div class="item active">
				';
			}

			if ( '1' == $products_grid->found_posts || '1' == $products_grid->query['posts_per_page'] ) {
				$output .= '<div class="product-single-view align' . $align . '">';
				global $product_single_view;
				$product_single_view = '1';
			} else {
				$output .= '<div class="row">';
			}

			while ( $products_grid->have_posts() ) : $products_grid->the_post();
				if ( 'true' == $slider ) {
					if ( $col == 15 ) {
						$c = 5;
					} elseif ( $col == 2 ) {
						$c = 6;
					} elseif ( $col == 3 ) {
						$c = 4;
					} elseif ( $col == 4 ) {
						$c = 3;
					} elseif ( $col == 6 ) {
						$c = 2;
					} elseif ( $col == 12 ) {
						$c = 1;
					}

					if ( $i % $c == 0 && $i != 0 ) {
						$output .= '</div></div><div class="item"><div class="row">';
					}
				}

				ob_start();
				get_template_part( 'parts/product/loop', $layout );
				$output .= ob_get_contents();
				ob_end_clean();
				$i++;
			endwhile;

			$output .= '</div>';

			if ( 'true' == $slider ) {
				$output .= '
						</div>
					</div>
				</div>
				';
			}

		endif;
	} else {
		/*
		 * Layout: Custom
		 */
		$products = new WP_Query( $args );
		if ( $products->have_posts() ) :
			while ( $products->have_posts() ) : $products->the_post();
				ob_start();
				get_template_part( 'parts/product/loop', $layout );
				$output .= ob_get_contents();
				ob_end_clean();
			endwhile;
		endif;
	}

	if ( isset( $products_grid ) ) {
		if ( '1' == $products_grid->found_posts || '1' == $products_grid->query['posts_per_page'] ) {
		} else {
			$output .= '<div class="clearfix"></div>';
		}
	}

	wp_reset_postdata();

	// remove filter when reduced param is set
	if ( 'true' == $reduced ) {
		remove_filter( 'posts_request', spl_object_hash( $reduced_filter ) );
	}

	$output = apply_filters( 'at_product_shortcode_loop_after', $output, $layout );

	// reset globals
	$product_button_detail_hide  = '0';
	$product_button_buy_hide     = '0';
	$product_details_fields_hide = '0';
	$product_details_tax_hide    = '0';
	$product_rating_hide         = '0';
	$product_review_hide         = '0';
	$product_table_highlight     = array();

	return $output;
}

/*
 * Preisvergleich
 */
function endcore_price_compare_shortcode( $atts, $content = null )
{
	extract( shortcode_atts(
			array(
				"id" => "",
			),
			$atts )
	);

	$output = '';

	if ( $id ) {
		$args = array(
			'post_type'      => 'product',
			'post__in'       => array( $id ),
			'posts_per_page' => '1'
		);

		$post = new WP_Query( $args );

		if ( $post->have_posts() ) :
			while ( $post->have_posts() ) : $post->the_post();
				ob_start();
				get_template_part( 'parts/product/code', 'compare' );
				$output .= ob_get_contents();
				ob_end_clean();
			endwhile;

			wp_reset_postdata();
		endif;
	} else {
		global $post;
		ob_start();
		get_template_part( 'parts/product/code', 'compare' );
		$output .= ob_get_contents();
		ob_end_clean();
	}

	return $output;
}

/*
 * Infobox
 */
function endcore_infobox_shortcode( $atts, $content = null )
{
	extract( shortcode_atts(
			array(
				"id" => "",
			),
			$atts )
	);

	$output = '';

	if ( $id ) {
		$args = array(
			'post_type'      => 'product',
			'post__in'       => array( $id ),
			'posts_per_page' => '1'
		);
		query_posts( $args );
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				ob_start();
				get_template_part( 'parts/product/code', 'buybox-big' );
				$output .= ob_get_contents();
				ob_end_clean();
			endwhile;

			wp_reset_query();
		endif;
	} else {
		global $post;
		ob_start();
		get_template_part( 'parts/product/code', 'buybox-big' );
		$output .= ob_get_contents();
		ob_end_clean();
	}

	return $output . '<br>';
}

/*
 * Top Rated
 */
function endcore_top_rated_shortcode( $atts, $content = null )
{
	extract( shortcode_atts(
			array(
				"limit" => "5",
				"type"  => "procentual"
			),
			$atts )
	);

	global $product_items;

	$output        = '';
	$product_items = array();

	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => -1,
		'meta_key'       => 'product_review_ratings'
	);

	// taxonomien
	if ( $atts ) {
		foreach ( $atts as $key => $val ) {
			if ( taxonomy_exists( $key ) ) {
				$args[ $key ] = $val;
			}
		}
	}

	$args = apply_filters( 'at_set_top_rated_query', $args );

	$products = get_posts( $args );

	if ( $products ) {
		//get ratings
		foreach ( $products as $product ) {
			$product_review_ratings = get_field( 'product_review_ratings', $product->ID );

			if ( $product_review_ratings ) {
				$summary = 0;
				foreach ( $product_review_ratings as $rating ) {
					$summary = $summary + floatval( $rating['value'] );
				}
				$summary = $summary / count( $product_review_ratings );

				$product_items[ $product->ID ] = number_format( $summary, 1, '.', ',' );
			}
		}

		if ( $product_items ) {
			//sort ratings
			arsort( $product_items );
			$product_items = array_slice( $product_items, 0, $limit, true );

			ob_start();
			get_template_part( 'parts/product/code', 'top-rated-' . $type );
			$output .= ob_get_contents();
			ob_end_clean();
		}
	}

	return $output;
}

/*
 * Product Compare
 */
function endcore_product_compare_shortcode( $atts, $content = null )
{
	global $product_items, $taxonomies;

	extract( shortcode_atts(
			array(
				"include" => "",
				"exclude" => "",
			),
			$atts )
	);

	$output        = '';
	$product_items = array();

	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => -1
	);

	// include
	if ( $include ) {
		if ( $include_arr = explode( ',', $include ) )
			$args['post__in'] = $include_arr;
	}

	// exclude
	if ( $exclude ) {
		if ( $exclude_arr = explode( ',', $exclude ) )
			$args['post__not_in'] = $exclude_arr;
	}

	// taxonomien
	if ( $atts ) {
		foreach ( $atts as $key => $val ) {
			if ( taxonomy_exists( $key ) ) {
				$taxonomies[ $key ] = $val;
				$args[ $key ]       = $val;
			}
		}
	}

	$args = apply_filters( 'at_set_product_compare_shortcode_query', $args );

	$product_items = get_posts( $args );

	if ( $product_items ) {
		ob_start();
		include( locate_template( 'parts/product/code-product-compare.php' ) );
		$output .= ob_get_contents();
		ob_end_clean();
	}

	return $output;
}

/*
 * Preis
 */
if ( ! function_exists( 'at_price_shortcode' ) ) {
	function at_price_shortcode( $atts, $content = null )
	{
		extract( shortcode_atts(
				array(
					"id"       => "0",
					"post_id"  => "",
					"currency" => "false"
				),
				$atts )
		);

		$output = '<span class="price">';

		$p_price    = get_field( 'product_shops_' . $id . '_price', $post_id );
		$p_currency = get_field( 'product_shops_' . $id . '_currency', $post_id );

		if ( $p_price ) {
			$output .= at_number_format( $p_price );

			if ( $currency == "true" ) {
				$output .= ' ' . at_get_currency_sym( $p_currency );
			}
		}

		$output .= '</span>';

		return $output;
	}
}