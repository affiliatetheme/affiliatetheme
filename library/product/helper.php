<?php
/**
 * Hilfsfunktionen
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    product
 */

add_image_size( 'product_gallery', 360 );
add_image_size( 'product_grid', 262 );
add_image_size( 'product_list', 162 );
add_image_size( 'product_table', 100 );
add_image_size( 'product_tiny', 50, 50, true );

if ( ! function_exists( 'at_product_page_title' ) ) {
	/**
	 * at_product_page_title function.
	 *
	 * @param boolean $echo (default: true)
	 *
	 * @return string
	 */
	function at_product_page_title( $echo = true )
	{
		if ( is_post_type_archive( 'product' ) ) {
			$page_title = __( 'Produkte', 'affiliatetheme' );

		} else {
			$page_title = get_the_title();

		}

		$page_title = apply_filters( 'at_product_page_title', $page_title );

		if ( $echo ) {
			echo $page_title;
		} else {
			return $page_title;
		}

	}
}

if ( ! function_exists( 'get_product_link' ) ) {
	/**
	 * get_product_link function.
	 *
	 * @param int $post_id
	 * @param int $shop_id (default: 0)
	 * @param boolean $clean (default: false)
	 *
	 * @return string
	 */
	function get_product_link( $post_id, $shop_id = 0, $clean = false )
	{
		$product_shop  = get_field( 'product_shops', $post_id );
		$product_link  = ( isset( $product_shop[ $shop_id ]['link'] ) ? $product_shop[ $shop_id ]['link'] : '' );
		$product_cloak = get_field( 'product_cloak', 'option' );

		if ( ! $product_link ) {
			return;
		}

		// cloaker
		if ( $product_cloak && false == $clean ) {
			$product_cloak_slug = get_field( 'product_cloak_slug', 'option' );
			$product_link       = home_url( '/' . $product_cloak_slug . '/' . $post_id . '/' . $shop_id );
		}

		/**
		 * @deprecated $product_url
		 */
		return apply_filters( 'at_get_product_link', $product_link, $post_id, $shop_id, $clean, $product_shop, $product_url = null, $product_cloak );
	}
}

if ( ! function_exists( 'get_product_button_text' ) ) {
	/**
	 * get_product_button_text function.
	 *
	 * @param int $post_id
	 * @param int $shop_id (default: 0)
	 * @param string $pos
	 * @param boolean $short (default: false)
	 *
	 * @return string
	 */
	function get_product_button_text( $post_id, $shop_id = 0, $pos = '', $short = false )
	{
		$product_shops_obj = get_field( 'product_shops', $post_id );
		$product_portal    = ( isset( $product_shops_obj[ $shop_id ]['portal'] ) ? $product_shops_obj[ $shop_id ]['portal'] : '' );
		$product_shop      = ( isset( $product_shops_obj[ $shop_id ]['shop'] ) ? $product_shops_obj[ $shop_id ]['shop'] : '' );

		if ( has_filter( 'at_product_button_text' ) ) {
			$value = apply_filters( 'at_product_button_text', '', $product_portal, $product_shop, $pos, $short );

			if ( $value ) {
				return $value;
			}
		}

		if ( 'detail' == $pos ) {
			$detail_button = ( get_field( 'product_button_detail', 'option' ) ? get_field( 'product_button_detail', 'option' ) : __( 'Weitere Details', 'affiliatetheme' ) );

			if ( true === $short ) {
				$detail_button = ( get_field( 'product_button_detail_short', 'option' ) ? get_field( 'product_button_detail_short', 'option' ) : __( 'Details', 'affiliatetheme' ) );
			}

			return $detail_button;
		}

		// buy button
		$buy_button       = ( get_field( 'product_button_buy', 'option' ) ? get_field( 'product_button_buy', 'option' ) : __( 'Jetzt kaufen', 'affiliatetheme' ) );
		$buy_button_short = ( get_field( 'product_button_buy_short', 'option' ) ? get_field( 'product_button_buy_short', 'option' ) : __( 'Kaufen', 'affiliatetheme' ) );

		if ( $short == true ) {
			if ( has_filter( 'at_product_api_button_short_text' ) ) {
				$buy_button_short = apply_filters( 'at_product_api_button_short_text', $buy_button_short, $product_portal, $product_shop, $pos, $short, $post_id );
			}

			if ( is_object( $product_shop ) ) {
				$buy_button_short = str_replace( '%s', get_the_title( $product_shop->ID ), $buy_button_short );
			}

			return $buy_button_short;
		}

		/**
		 * @deprecated at_get_amazon_product_button_text
		 * @deprecated at_get_affilinet_product_button_text
		 * @deprecated at_get_zanox_product_button_text
		 */
		if ( $output_amazon = apply_filters( 'at_get_amazon_product_button_text', '', $product_portal, $product_shop, $short ) ) {
			$buy_button = $output_amazon;
		}
		if ( $output_affilinet = apply_filters( 'at_get_affilinet_product_button_text', '', $product_portal, $product_shop, $short ) ) {
			$buy_button = $output_affilinet;
		}
		if ( $output_zanox = apply_filters( 'at_get_zanox_product_button_text', '', $product_portal, $product_shop, $short ) ) {
			$buy_button = $output_zanox;
		}

		if ( has_filter( 'at_product_api_button_text' ) ) {
			$buy_button = apply_filters( 'at_product_api_button_text', $buy_button, $product_portal, $product_shop, $pos, $short, $post_id );
		}

		if ( is_object( $product_shop ) ) {
			$buy_button = str_replace( '%s', get_the_title( $product_shop->ID ), $buy_button );
		}

		return $buy_button;
	}
}

if ( ! function_exists( 'get_product_button' ) ) {
	/**
	 * get_product_button function.
	 *
	 * @param int $post_id
	 * @param int $shop_id
	 * @param string $pos
	 * @param string $class
	 * @param boolean $short (default: false)
	 *
	 * @return string
	 */
	function get_product_button( $post_id, $shop_id, $pos, $class = '', $short = false, $force = true, $hide_var = 0 )
	{
		$product_fakeshop        = at_is_fake_product( $post_id );
		$hide_detail_var         = ( $hide_var ? $hide_var : get_field( 'product_button_detail_hide', 'option' ) );
		$hide_buy_var            = ( $hide_var ? $hide_var : get_field( 'product_button_buy_hide', 'option' ) );
		$product_external_target = ( get_field( 'product_external_target', 'option' ) ? get_field( 'product_external_target', 'option' ) : '_blank' );
		$attr                    = '';

		if ( $force == true ) {
			$hide_detail_var = '0';
			$hide_buy_var    = '0';
		}

		if ( 'detail' == $pos ) {
			$url = get_permalink( $post_id );

			if ( '1' == $hide_detail_var || '1' == $product_fakeshop ) {
				return false;
			}

		} else {
			$rel  = apply_filters( 'at_product_link_params_sponsored_tag', true ) ? 'sponsored' : 'nofollow';
			$url  = get_product_link( $post_id, $shop_id );
			$attr = ' rel="' . $rel . '" target="' . $product_external_target . '"';

			if ( '1' == $hide_buy_var || '' == $url ) {
				return false;
			}
		}

		$text = '<a href="' . $url . '" title="' . get_the_title( $post_id ) . '" class="btn btn-' . $pos . ' ' . $class . '"' . $attr . '>' . get_product_button_text( $post_id, $shop_id, $pos, $short ) . '</a>';

		return apply_filters( 'at_product_button', $text, $post_id, $pos );
	}
}

if ( ! function_exists( 'get_product_last_update' ) ) {
	/**
	 * get_product_last_update function.
	 *
	 * @param int $post_id
	 *
	 * @return string
	 */
	function get_product_last_update( $post_id )
	{
		if ( ! $post_id ) {
			return;
		}

		$last_update = get_post_meta( $post_id, 'last_product_price_check', true );

		if ( ! $last_update ) {
			return;
		}

		if ( get_option( 'date_format' ) && get_option( 'time_format' ) ) {
			$format = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
		} else {
			$format = 'd.m.Y H:i:s';
		}

		$format = apply_filters( 'at_product_last_update_date_time_format', $format, $post_id );

		$value = date_i18n( $format, $last_update );

		return apply_filters( 'at_product_last_update', $value, $post_id );
	}
}

if ( ! function_exists( 'get_product_last_update_hint' ) ) {
	/**
	 * get_product_last_update_hint function.
	 *
	 * @param int $post_id
	 * @param int $shop_id (default: 0)
	 *
	 * @return string
	 */
	function get_product_last_update_hint( $post_id, $shop_id = 0, $force = false )
	{
		if ( ! $post_id ) {
			return;
		}

		$output = '';

		$pos = ( get_field( 'product_price_last_update_pos', 'option' ) ? get_field( 'product_price_last_update_pos', 'option' ) : 'single' );

		if ( $pos == 'hide' ) {
			return false;
		}

		if ( get_product_last_update( $post_id ) ) {
			$text = ( get_field( 'product_price_last_update', 'option' ) ? get_field( 'product_price_last_update', 'option' ) : __( 'Zuletzt aktualisiert am: ', 'affiliatetheme' ) . ' %s' );

			if ( ( is_singular( 'product' ) && ( $pos == 'single' || $pos == 'both' ) ) || ! is_singular( 'product' ) && ( $pos == 'loop' || $pos == 'both' ) ) {
				$output = '<small class="price-hint text-block">';
				$output .= sprintf( $text, get_product_last_update( $post_id ) );
				$output .= '</small>';
			}
		} else {
			if ( $pos == 'loop' || $pos == 'both' ) {
				$output = '<p>&nbsp;</p>';
			}
		}

		return apply_filters( 'at_product_last_update_hint', $output, $post_id, $shop_id );
	}
}

if ( ! function_exists( 'get_product_rating' ) ) {
	/**
	 * get_product_rating function.
	 *
	 * @param int $post_id , boolean $force
	 *
	 * @return string
	 */
	function get_product_rating( $post_id, $force = false )
	{
		global $product_rating_hide;

		if ( get_field( 'product_rating_hide', 'options' ) ) {
			$product_rating_hide = '1';
		}

		if ( '1' == $product_rating_hide && $force == false ) {
			return;
		}

		$product_rating     = get_field( 'product_rating', $post_id );
		$product_rating_cnt = get_field( 'product_rating_cnt', $post_id );
		$output             = '';
		$full               = '<i class="fas fa-star"></i>';
		$half               = '<i class="fas fa-star-half-alt"></i>';
		$empty              = '<i class="far fa-star"></i>';
		$max                = 5;

		if ( $product_rating < 0 || $product_rating == -0 ) {
			$product_rating = 0;
		}

		if ( $product_rating ) {
			$rating_arr = explode( '.', $product_rating );
			if ( $rating_arr ) {
				if ( isset( $rating_arr[1] ) && $rating_arr[1] > 0 ) {
					$rating_arr[1] = '1';
				} else {
					$rating_arr[1] = '0';
				}

				/*
				 * FULL
				 */
				$output .= str_repeat( $full, $rating_arr[0] );

				/*
				 * HALF
				 */

				if ( isset( $rating_arr[1] ) && '0' != $rating_arr[1] ) {
					$output .= $half;
				}

				/*
				 * EMTPY
				 */
				if ( ( $max - $rating_arr[0] ) >= '1' ) {
					$output .= str_repeat( $empty, $max - ( $rating_arr[0] + $rating_arr[1] ) );
				}
			}
		} else {
			$output .= str_repeat( $empty, 5 );
		}

		if ( $product_rating_cnt ) {
			$output = '<span title="' . sprintf( __( '%s / %s bei %s Stimmen', 'affiliatetheme' ), $product_rating, $max, $product_rating_cnt ) . '">' . $output . '</span>';
		}

		return apply_filters( 'at_product_rating', $output, $product_rating, $post_id );
	}
}

if ( ! function_exists( 'get_product_review_summary' ) ) {
	/**
	 * get_product_review_summary function.
	 *
	 * @param int $post_id
	 *
	 * @return string
	 */
	function get_product_review_summary( $post_id )
	{
		$product_review_ratings = get_field( 'product_review_ratings', $post_id );
		$output                 = array();

		if ( $product_review_ratings ) {
			$product_review_style          = get_field( 'product_review_style', $post_id );
			$product_review_rating_summary = get_field( 'product_review_rating_summary', $post_id );
			$summary                       = at_product_review_calculate_summary( $post_id );

			$output['style']   = $product_review_style;
			$output['summary'] = $product_review_rating_summary;
			$output['value']   = $summary;

			if ( $product_review_style == 'number' ) {
				$product_review_max_value = get_field( 'product_review_max_value', $post_id );
				$output['max_value']      = $product_review_max_value;
			}
		}

		return $output;
	}
}

if ( ! function_exists( 'get_product_review_summary_html' ) ) {
	/**
	 * get_product_review_summary_html function.
	 *
	 * @param int $post_id
	 *
	 * @return string
	 */
	function get_product_review_summary_html( $post_id )
	{
		$value  = get_product_review_summary( $post_id );
		$output = '';

		if ( $value ) {
			$output = '<div class="product-reviews product-reviews-' . $value['style'] . '">';
			if ( 'procentual' == $value['style'] ) {
				$output .= '
                    <div class="rating-summary">
                        <p class="rating-summary-value">' . round( $value['value'], 2 ) . '<sub>%</sub></p>
                        ' . ( $value['summary'] ? '<p class="rating-summary-text">"' . $value['summary'] . '"</p>' : '' ) . '
                    </div>
                    ';
			} elseif ( 'number' == $value['style'] ) {
				$output .= '
                    <div class="rating-summary">
                        <p class="rating-summary-value">' . $value['value'] . '<sub>/' . $value['max_value'] . '</sub></p>
                        ' . ( $value['summary'] ? '<p class="rating-summary-text">"' . $value['summary'] . '"</p>' : '' ) . '
                    </div>
                    ';
			}
			$output .= '</div>';
		}

		return $output;
	}
}

if ( ! function_exists( 'get_product_rating_cnt' ) ) {
	/**
	 * get_product_rating_cnt function.
	 *
	 * @param int $post_id
	 *
	 * @return string
	 */
	function get_product_rating_cnt( $post_id )
	{
		$product_rating     = get_field( 'product_rating', $post_id );
		$product_rating_cnt = get_field( 'product_rating_cnt', $post_id );
		$output             = '';
		$max                = 5;

		if ( $product_rating < 0 || $product_rating == -0 ) {
			$product_rating = 0;
		}

		if ( $product_rating && $product_rating_cnt ) {
			if ( $product_rating_cnt == 1 ) {
				$output = sprintf( __( '%s / %s bei %s Stimme', 'affiliatetheme' ), $product_rating, $max, $product_rating_cnt );
			} else {
				$output = sprintf( __( '%s / %s bei %s Stimmen', 'affiliatetheme' ), $product_rating, $max, $product_rating_cnt );
			}
		}

		return apply_filters( 'at_product_rating_cnt', $output, $product_rating, $product_rating_cnt, $post_id );
	}
}

if ( ! function_exists( 'at_get_currency' ) ) {
	/**
	 * at_get_currency function.
	 *
	 * @param string $currency
	 *
	 * @return array
	 */
	function at_get_currency()
	{
		$items = array(
			'euro' => __( 'Euro (&euro;)', 'affiliatetheme-backend' ),
			'usd'  => __( 'US-Dollar (&#36;)', 'affiliatetheme-backend' ),
			'cad'  => __( 'Kanadischer Dollar (C&#36;)', 'affiliatetheme-backend' ),
			'gbp'  => __( 'Britisches Pfund (&pound;)', 'affiliatetheme-backend' ),
			'inr'  => __( 'Indischer Rupie (&#8377;)', 'affiliatetheme-backend' ),
			'jpy'  => __( 'Japanischer Yen (&#165;)', 'affiliatetheme-backend' ),
			'mxn'  => __( 'Mexikanischer Peso (Mex&#36;)', 'affiliatetheme-backend' ),
			'cny'  => __( 'Chinesischer Renminbi (CN&#165;)', 'affiliatetheme-backend' ),
			'brl'  => __( 'Brasilianischer Real (R&#36;)', 'affiliatetheme-backend' ),
			'chf'  => __( 'Schweizer Franken (CHF)', 'affiliatetheme-backend' ),
			'rub'  => __( 'Russischer Rubel (&#8381;)', 'affiliatetheme-backend' ),
			'pln'  => __( 'Polnischer Zloty (z&#322;)', 'affiliatetheme-backend' ),
			'aud'  => __( 'Australischer Dollar (&#36;A)', 'affiliatetheme-backend' ),
			'hkd'  => __( 'Hongkong-Dollar (HK&#36;)', 'affiliatetheme-backend' ),
			'kpw'  => __( 'Nordkoreanischer Won (&#8361;)', 'affiliatetheme-backend' ),
			'myr'  => __( 'Ringgit (RM)', 'affiliatetheme-backend' ),
			'php'  => __( 'Philippinischer Peso (&#8369;)', 'affiliatetheme-backend' ),
			'sgd'  => __( 'Singapur-Dollar (S&#36;)', 'affiliatetheme-backend' ),
			'sek'  => __( 'Schwedische Krone (kr)', 'affiliatetheme-backend' ),
			'nok'  => __( 'Norwegische Krone (nkr)', 'affiliatetheme-backend' ),
			'dkk'  => __( 'Dänische Krone (dkr)', 'affiliatetheme-backend' ),
			'czk'  => __( 'Tschechische Krone (K&#269;)', 'affiliatetheme-backend' ),
			'try'  => __( 'Türkische Lira (TL)', 'affiliatetheme-backend' ),
			'bam'  => __( 'Konvertible Mark (KM)', 'affiliatetheme-backend' ),
			'rsd'  => __( 'Serbischer Dinar (Din.)', 'affiliatetheme-backend' ),
			'uah'  => __( 'Hrywnja (&#8372;)', 'affiliatetheme-backend' ),
			'huf'  => __( 'Ungarische Forint (Ft)', 'affiliatetheme-backend' ),
			'krw'  => __( 'Südkoreanischer Won (&#8361;)', 'affiliatetheme-backend' ),
			'twd'  => __( 'Neuer Taiwan-Dollar (NT&#36;)', 'affiliatetheme-backend' ),
		);

		return apply_filters( 'at_get_currency', $items );
	}
}

if ( ! function_exists( 'at_get_currency_sym' ) ) {
	/**
	 * at_get_currency_sym function.
	 *
	 * @param string $currency
	 *
	 * @return string
	 */
	function at_get_currency_sym( $currency )
	{
		switch ( $currency ) {
			case 'euro' :
				$output = '&euro;';
				break;

			case 'eur' :
				$output = '&euro;';
				break;

			case 'usd' :
				$output = '&#36;';
				break;

			case 'cad' :
				$output = 'C&#36;';
				break;

			case 'gbp' :
				$output = '&pound;';
				break;

			case 'inr' :
				$output = '&#8377;';
				break;

			case 'jpy' :
				$output = '&#165;';
				break;

			case 'mxn' :
				$output = 'Mex&#36;';
				break;

			case 'cny' :
				$output = 'CN&#165;';
				break;

			case 'brl' :
				$output = 'R&#36;';
				break;

			case 'chf' :
				$output = 'CHF';
				break;

			case 'rub' :
				$output = '&#8381;';
				break;

			case 'pln' :
				$output = 'z&#322;';
				break;

			case 'aud' :
				$output = '&#36;A';
				break;

			case 'hkd' :
				$output = 'HK&#36;';
				break;

			case 'kpw' :
				$output = '&#8361;';
				break;

			case 'myr' :
				$output = 'RM';
				break;

			case 'php' :
				$output = '&#8369;';
				break;

			case 'sgd' :
				$output = 'S&#36;';
				break;

			case 'sek' :
				$output = 'kr';
				break;

			case 'nok' :
				$output = 'nkr';
				break;

			case 'dkk' :
				$output = 'dkr';
				break;

			case 'czk' :
				$output = 'K&#269;';
				break;

			case 'try' :
				$output = 'TL';
				break;

			case 'bam' :
				$output = 'KM';
				break;

			case 'rsd' :
				$output = 'Din.';
				break;

			case 'uah' :
				$output = '&#8372;';
				break;

			case 'huf' :
				$output = 'Ft';
				break;

			case 'krw' :
				$output = '&#8361;';
				break;

			case 'twd' :
				$output = 'NT&#36;';
				break;

			default:
				$output = '&euro;';
				break;
		}

		return apply_filters( 'at_get_currency_sym', $output, $currency );
	}
}

if ( ! function_exists( 'at_get_default_currency' ) ) {
	/**
	 * at_get_default_currency function.
	 *
	 * @param boolean $sym
	 *
	 * @return  string
	 */
	function at_get_default_currency( $sym = false )
	{
		$product_default_currency = get_field( 'product_default_currency', 'option' );

		$current_currency = 'euro';

		if ( $product_default_currency ) {
			$current_currency = $product_default_currency;
		}

		if ( $sym ) {
			$current_currency = at_get_currency_sym( $current_currency );
		}

		return $current_currency;
	}
}

if ( ! function_exists( 'at_product_currency_structure' ) ) {
	/**
	 * at_product_currency_structure function.
	 *
	 * @param float $price
	 * @param string $currency
	 *
	 * @return  string
	 */
	function at_product_currency_structure( $price, $currency )
	{
		$currency_pos = get_field( 'product_currency_pos', 'option' );

		switch ( $currency_pos ) {
			case 'right_w':
				$output = $price . ' ' . $currency;
				break;

			case 'right':
				$output = $price . $currency;
				break;

			case 'left_w':
				$output = $currency . ' ' . $price;
				break;

			case 'left':
				$output = $currency . $price;
				break;

			default:
				$output = $price . ' ' . $currency;
				break;
		}

		return apply_filters( 'at_product_currency_structure', $output, $price, $currency );
	}
}

if ( ! function_exists( 'at_number_format' ) ) {
	/**
	 * at_number_format function.
	 *
	 * @param float $price
	 *
	 * @return float
	 */
	function at_number_format( $price )
	{
		$format = get_field( 'product_price_format', 'option' );

        $price = floatval($price);
		switch ( $format ) {
			case 'de':
				$output = number_format( $price, 2, ',', '.' );
				break;

			case 'us':
				$output = number_format( $price, 2, '.', ',' );
				break;

			case 'ch':
				$output = number_format( $price, 2, '.', '\'' );
				break;

			default:
				$output = number_format( $price, 2, ',', '.' );
				break;
		}

		return apply_filters( 'at_number_format', $output, $price );
	}
}

if ( ! function_exists( 'get_product_price' ) ) {
	/**
	 * get_product_price function.
	 *
	 * @param int $post_id
	 * @param int $shop_id (default: 0)
	 * @param boolean $with_currency_sym (default: false)
	 * @param boolean $with_hint (default: false)
	 * @param boolean $overview (default: false)
	 *
	 * @return string
	 */
	function get_product_price( $post_id, $shop_id = 0, $with_currency_sym = false, $with_hint = false, $overview = false )
	{
		if ( '1' == get_field( 'product_price_hide', 'option' ) ) {
			return false;
		}

		if ( '1' == get_field( 'product_price_hide', $post_id ) ) {
			return false;
		}

		$product_shops = get_field( 'product_shops', $post_id );

		if ( ! is_array( $product_shops ) ) {
			$product_shops = array();
		}

		$price     = ( isset( $product_shops[ $shop_id ]['price'] ) ? $product_shops[ $shop_id ]['price'] : '' );
		$old_price = ( isset( $product_shops[ $shop_id ]['price_old'] ) ? $product_shops[ $shop_id ]['price_old'] : '' );

		// floatval
		$price_clean     = floatval( $price );
		$old_price_clean = floatval( $old_price );

		$currency = ( isset( $product_shops[ $shop_id ]['currency'] ) ? $product_shops[ $shop_id ]['currency'] : '' );
		$output   = '';

		if ( count( $product_shops ) > 1 && true == $overview ) {
			$output .= '<small>' . __( 'ab', 'affiliatetheme' ) . '</small> ';
		}

		// filter to manipulate price
		$price     = apply_filters( 'at_product_price_val', $price, $post_id );
		$old_price = apply_filters( 'at_product_old_price_val', $old_price, $post_id );

		if ( $price ) {
			$price = at_number_format( $price );

			if ( $with_currency_sym ) {
				$output .= at_product_currency_structure( $price, at_get_currency_sym( $currency ) );
			} else {
				$output .= $price;
			}
		}

		if ( '1' == get_field( 'product_misc_old_price_show', 'option' ) ) {
			if ( floatval( $old_price ) ) {
				$old_price = at_number_format( $old_price );

				if ( floatval( $old_price_clean ) > floatval( $price_clean ) ) {
					$output .= ' <del>';

					if ( $with_currency_sym ) {
						$output .= at_product_currency_structure( $old_price, at_get_currency_sym( $currency ) );
					} else {
						$output .= $old_price;
					}

					$output .= '</del>';
				}
			}
		}

		return apply_filters( 'at_product_price', $output, $post_id, $shop_id, $with_currency_sym, $with_hint, $overview );
	}
}

if ( ! function_exists( 'get_product_price_hint' ) ) {
	/**
	 * get_product_price_hint function.
	 *
	 * @param int $post_id
	 * @param int $shop_id (default: 0)
	 *
	 * @return string
	 */
	function get_product_price_hint( $post_id, $shop_id = 0 )
	{
		$product_shop = get_field( 'product_shops', $post_id );

		$product_price_hint         = ( isset( $product_shop[ $shop_id ]['price_hint'] ) ? $product_shop[ $shop_id ]['price_hint'] : '' );
		$product_price_hint_disable = ( isset( $product_shop[ $shop_id ]['price_hint_disable'] ) ? $product_shop[ $shop_id ]['price_hint_disable'] : '' );
		$global_product_price_hint  = get_field( 'product_price_global_hint', 'option' );
		$text                       = '';

		if ( '1' == $product_price_hint_disable ) {
			return false;
		}

		$output = '<small class="price-hint">';

		if ( ! empty( $global_product_price_hint ) ) {
			$text = $global_product_price_hint;
		}

		if ( ! empty( $product_price_hint ) ) {
			$text = $product_price_hint;
		}

		$output .= $text;

		if ( $last_update_hint = get_product_last_update_hint( $post_id, $shop_id ) ) {
			$output .= '<span class="last-update-hint">' . $last_update_hint . '</span>';
		}

		$output .= '</small>';

		return $output;
	}
}

if ( ! function_exists( 'show_price_compare' ) ) {
	/**
	 * show_price_compare function.
	 *
	 * @param int $post_id
	 * @param string $pos (default: bottom)
	 *
	 * @return string
	 */
	function show_price_compare( $post_id, $pos = 'bottom' )
	{
		$product_shops = get_field( 'product_shops', $post_id );
		$global_show   = get_field( 'product_price_compare_global_show', 'option' );
		$global_hide   = get_field( 'product_price_compare_global_hide', 'option' );
		$single_show   = get_field( 'product_price_compare_show', $post_id );
		$single_hide   = get_field( 'product_price_compare_hide', $post_id );

		if ( ! is_array( $product_shops ) ) {
			return;
		}

		if ( count( $product_shops ) <= 1 ) {
			return;
		}

		if ( '1' == $global_hide ) {
			return;
		}

		if ( '1' == $single_hide ) {
			return;
		}

		if ( '' == $single_show ) {
			if ( 'both' == $global_show ) {
				return true;
			}

			if ( $pos == $global_show ) {
				return true;
			}
		}

		if ( 'both' === $single_show ) {
			return true;
		}

		if ( $pos === $single_show ) {
			return true;
		}

		return;
	}
}

if ( ! function_exists( 'get_product_highlight_text' ) ) {
	/**
	 * get_product_highlight_text function.
	 *
	 * @param int $post_id
	 *
	 * @return string
	 */
	function get_product_highlight_text( $post_id )
	{
		$product_highlight      = get_field( 'product_highlight', $post_id );
		$product_highlight_text = get_field( 'product_highlight_text', $post_id );

		if ( '1' == $product_highlight ) {
			return apply_filters( 'at_product_highlight_text', $product_highlight_text, $post_id );
		}

		return;
	}
}

if ( ! function_exists( 'at_is_fake_product' ) ) {
	/**
	 * at_is_fake_product function.
	 *
	 * @param int $post_id
	 *
	 * @return string
	 */
	function at_is_fake_product( $post_id )
	{
		$product_fakeshop = ( get_field( 'product_fakeshop', 'option' ) ? get_field( 'product_fakeshop', 'option' ) : '0' );

		if ( '1' == $product_fakeshop ) {
			return '1';
		}

		if ( $post_id ) {
			$single_fake = ( get_field( 'product_fake', $post_id ) ? get_field( 'product_fake', $post_id ) : '0' );

			if ( '1' == $single_fake ) {
				return '1';
			}
		}

		return '0';
	}
}

if ( ! function_exists( 'get_product_link_params' ) ) {
	/**
	 * get_product_link_params function.
	 *
	 * @param int $post_id
	 * @param int $product_fakeshop
	 *
	 * @return string
	 */
	function get_product_link_params( $post_id, $product_fakeshop )
	{
		$output                  = '';
		$product_external_target = ( get_field( 'product_external_target', 'option' ) ? get_field( 'product_external_target', 'option' ) : '_blank' );

		if ( '1' == $product_fakeshop ) {
			$rel    = apply_filters( 'at_product_link_params_sponsored_tag', true ) ? 'sponsored' : 'nofollow';
			$output = 'target="' . $product_external_target . '" rel="' . $rel . '"';
		}

		return apply_filters( 'at_product_link_params', $output, $post_id, $product_fakeshop );
	}
}

if ( ! function_exists( 'get_product_grid_tax' ) ) {
	/**
	 * get_product_grid_tax function.
	 *
	 * @param int $post_id
	 *
	 * @return string
	 */
	function get_product_grid_tax( $post_id )
	{
		$product_grid_tax      = get_field( 'product_grid_tax', 'option' );
		$product_grid_tax_item = get_field( 'product_grid_tax_item', 'option' );

		if ( '1' != $product_grid_tax ) {
			return;
		}

		if ( ! is_array( $product_grid_tax_item ) || '' == $product_grid_tax_item ) {
			return;
		}

		$output = get_the_term_list( $post_id, $product_grid_tax_item[0], '<span class="product-tax">', ', ', '</span>' );

		if ( ! is_wp_error( $output ) ) {
			return $output;
		}

		return;
	}
}

if ( ! function_exists( 'get_current_product_tax' ) ) {
	/**
	 * get_current_product_tax function.
	 *
	 * @param string $current
	 *
	 * @return string
	 */
	function get_current_product_tax( $current = '' )
	{
		if ( '' == $current ) {
			$current = get_query_var( 'taxonomy' );
		}

		$taxonomies = get_field( 'product_tax', 'option' );

		if ( ! is_array( $taxonomies ) ) {
			return;
		}

		return searchInMultiArr( 'slug', $current, $taxonomies );
	}
}

if ( ! function_exists( 'get_product_taxonomies' ) ) {
	/**
	 * get_product_taxonomies function.
	 *
	 * @param string $post_id
	 * @param boolean $frontend (default: false)
	 *
	 * @return string
	 */
	function get_product_taxonomies( $post_id, $frontend = 'false' )
	{
		$taxonomies = $taxonomy_names = get_object_taxonomies( 'product', 'object' );
		$output     = array();

		if ( $taxonomies ) {
			foreach ( $taxonomies as $tax ) {
				if ( 'true' == $frontend ) {
					$tax_obj = get_current_product_tax( $tax->name );
					if ( '1' != $tax_obj['frontend'] ) {
						continue;
					}
				}

				$output[ $tax->name ] = $tax->labels->name;
			}

			return $output;
		}
	}
}

if ( ! function_exists( 'get_products_multiselect_tax_form' ) ) {
	/**
	 * get_products_multiselect_tax_form function.
	 *
	 * @param boolean $add_new
	 * @param array $current
	 * @param array $properties
	 *
	 * @return string
	 */
	function get_products_multiselect_tax_form( $add_new = true, $current = array(), $properties = array() )
	{
		$taxonomy_names = get_object_taxonomies( 'product' );
		$output         = '<div class="row 2">';
		foreach ( $taxonomy_names as $tax ) {
			if ( ! is_wp_error( $terms = get_terms( $tax, 'hide_empty=0' ) ) ) {
				$taxonomy = get_taxonomy( $tax );

				/** render dropdown */
				$dropdownArgs = array(
					'taxonomy'     => $tax,
					'orderby'      => 'name',
					'show_count'   => 0,
					'hierarchical' => 1,
					'echo'         => 0,
					'value_field'  => 'slug',
					'hide_empty'   => false,
					'name'         => 'tax[' . $tax . '][]',
				);
				$dropdown     = wp_dropdown_categories( $dropdownArgs );
				$dropdown     = str_replace( '<select ', '<select multiple fieldname="' . $taxonomy->rewrite['slug'] . '"', $dropdown );

				$output .= '
                <div class="form-group col-xs-6">
                    <label>' . $taxonomy->labels->name . '</label>';

				$output .= $dropdown;

				if ( $add_new == true ) {
					$output .= '
                        <input type="text" name="tax[' . $tax . '][]" class="form-control" placeholder="Neuen Term in \'' . $taxonomy->labels->name . '\' anlegen." style="margin-left:4px;margin-top:10px;"/>
                    ';

					$output = apply_filters( 'at_mutltiselect_tax_form_product_dropdown', $output, $properties, $tax );
				}

				$output .= '</div>';
			}
		}
		$output .= '</div>';

		return $output;
	}
}

if ( ! function_exists( 'at_get_acf_field_groups' ) ) {
	/**
	 * at_get_acf_field_groups function.
	 *
	 * @param array $args ;
	 *
	 * @return array
	 */
	function at_get_acf_field_groups( $args = false, $post__in = array() )
	{
		// vars
		$field_groups = array();

		// cache
		$found       = false;
		$clear_cache = apply_filters( 'at_acf_field_groups_clear_cache', true );

		if ( $clear_cache ) {
			wp_cache_delete( 'get_field_groups', 'acf' );
		}

		$cache = wp_cache_get( 'get_field_groups', 'acf', $clear_cache, $found );

		if ( $found ) {
			return acf_filter_field_groups( $cache, $args );
		}

		// load from DB
		$post_args = array(
			'post_type'              => 'acf-field-group',
			'posts_per_page'         => -1,
			'orderby'                => 'menu_order title',
			'order'                  => 'asc',
			'suppress_filters'       => false, // allow WPML to modify the query
			'post_status'            => array( 'publish' ),
			'update_post_meta_cache' => false,
			'post__in'               => $post__in
		);

		$posts = get_posts( $post_args );

		// loop through and load field groups
		if ( $posts ) {
			foreach ( $posts as $post ) {
				// add to return array
				$field_groups[] = acf_get_field_group( $post );

			}
		}

		// set cache
		wp_cache_set( 'get_field_groups', $field_groups, 'acf', 3600 ); // save for 1 hour

		// return
		return $field_groups;
	}
}

if ( ! function_exists( 'at_product_render_table_fields' ) ) {
	/**
	 * at_product_render_table_fields function.
	 *
	 * @param array $products
	 * @param boolean $remove_empty_fields
	 * @param boolean force_field_groups
	 *
	 * @return array
	 */
	function at_product_render_table_fields( $products, $remove_empty_fields = false, $force_field_groups = array() )
	{
		$product_misc_table_empty_field = ( get_field( 'product_misc_table_empty_field', 'option' ) ? get_field( 'product_misc_table_empty_field', 'option' ) : '-' );
		$p_fields                       = array();

		foreach ( $products as $product ) {
			$product_fields = new AT_Product_Fields( $products[0]->ID, 'table', $force_field_groups );

			$fields = $product_fields->get();

			foreach ( $fields as $k => $v ) {
				$key                       = $v['key'];
				$p_fields[ $key ]['field'] = $v;

				$product_field = new AT_Product_Field( $v, $product->ID );

				if ( $product_field ) {
					$field = $product_field->render();

					if ( ! $product_field->is_empty() ) {
						$p_fields[ $key ]['values'][ $product->ID ] = $field['value'];
					} else {
						$p_fields[ $key ]['values'][ $product->ID ] = $product_misc_table_empty_field;
					}
				}
			}
		}

		if ( $remove_empty_fields ) {
			foreach ( $p_fields as $field_key => $field ) {
				if ( at_product_identify_empty_table_fields( $field['values'], $product_misc_table_empty_field ) ) {
					unset( $p_fields[ $field_key ] );
				}
			}
		}

		return $p_fields;
	}
}

if ( ! function_exists( 'at_product_identify_empty_table_fields' ) ) {
	/**
	 * at_product_identify_empty_table_fields function.
	 *
	 * @param array $values
	 * @param string $product_misc_table_empty_field
	 *
	 * @return array
	 */
	function at_product_identify_empty_table_fields( $values = array(), $product_misc_table_empty_field = '' )
	{
		foreach ( $values as $k => $v ) {
			if ( $v !== $product_misc_table_empty_field ) {
				return false;
			}
		}

		return true;
	}
}

if ( ! function_exists( 'sortByMenuOrder' ) ) {
	/**
	 * sortByMenuOrder function.
	 *
	 * @param int $a
	 * @param int $b
	 *
	 * @return int
	 */
	function sortByMenuOrder( $a, $b )
	{
		return $a['menu_order'] - $b['menu_order'];
	}
}

if ( ! function_exists( 'sortByPriceSQL' ) ) {
	/**
	 * sortByPriceSQL function.
	 *
	 * @param int $a
	 * @param int $b
	 *
	 * @return int
	 */
	function sortByPriceSQL( $a, $b )
	{
		return $a['price'] - $b['price'];
	}
}

if ( ! function_exists( 'sortByPrice' ) ) {
	/**
	 * sortByPrice function.
	 *
	 * @param int $a
	 * @param int $b
	 *
	 * @return int
	 */
	function sortByPrice( $a, $b )
	{
		if ( $a['field_553b8257246b5'] == $b['field_553b8257246b5'] ) {
			return 0;
		}

		return $a['field_553b8257246b5'] < $b['field_553b8257246b5'] ? -1 : 1;
	}
}

if ( ! function_exists( 'searchInMultiArr' ) ) {
	/**
	 * searchInMultiArr function.
	 *
	 * @param string $field
	 * @param string $needle
	 * @param array $array
	 *
	 * @return int
	 */
	function searchInMultiArr( $field, $needle, $array )
	{
		foreach ( $array as $key => $val ) {
			if ( $val[ $field ] === $needle ) {
				return $val;
			}
		}

		return null;
	}
}

if ( ! function_exists( 'getRepeaterRowID' ) ) {
	/**
	 * getRepeaterRowID function.
	 *
	 * @param array $array
	 * @param string $field
	 * @param string $string
	 * @param boolean $deeper
	 *
	 * @return int
	 */
	function getRepeaterRowID( $array, $field, $search, $deeper = false )
	{
		if ( is_array( $array ) ) {
			foreach ( $array as $index => $sub ) {
				foreach ( $sub as $key => $val ) {
					if ( $key == $field && $val == $search ) {
						return $index;
					}

					if ( true == $deeper && is_array( $val ) ) {
						foreach ( $val as $shop => $item ) {
							if ( $shop == $field & $item == $search ) {
								return $index;
							}
						}
					}
				}
			}
		} else {
			return 0;
		}
	}
}

if ( ! function_exists( 'removeElementWithValue' ) ) {
	/**
	 * removeElementWithValue function.
	 *
	 * @param array $array
	 * @param string $key
	 * @param string $value
	 *
	 * @return array
	 */
	function removeElementWithValue( $array, $key, $value )
	{
		foreach ( $array as $subKey => $subArray ) {
			if ( $subArray[ $key ] == $value ) {
				unset( $array[ $subKey ] );
			}
		}

		return $array;
	}
}

if ( ! function_exists( 'get_product_review_rating' ) ) {
	/**
	 * get_product_review_rating function.
	 *
	 * @param float $rating
	 * @param int $max
	 * @param string $empty
	 * @param string $half
	 * @param string $full
	 *
	 * @return string
	 */
	function get_product_review_rating( float $rating, int $max, string $empty, string $half, string $full )
	{
		$output = '';

		$rating_form = number_format( $rating, 1, '.', '' );
		$rating_arr  = explode( '.', $rating_form );

		if ( $rating_arr ) {
			if ( isset( $rating_arr[1] ) && $rating_arr[1] > 0 ) {
				$rating_arr[1] = '1';
			} else {
				$rating_arr[1] = '0';
			}

			/*
			 * FULL
			 */
			$output .= str_repeat( $full, $rating_arr[0] );

			/*
			 * HALF
			 */

			if ( isset( $rating_arr[1] ) && '0' != $rating_arr[1] ) {
				$output .= $half;
			}

			/*
			 * EMTPY
			 */
			if ( ( $max - $rating_arr[0] ) >= '1' ) {
				$output .= str_repeat( $empty, $max - ( $rating_arr[0] + $rating_arr[1] ) );
			}
		}

		return $output;
	}
}

if ( ! function_exists( 'at_attach_external_image' ) ) {
	/**
	 * at_attach_external_image function.
	 *
	 * @param string $url
	 * @param int $post_id
	 * @param string $thumb
	 * @param string $filename
	 * @param array $postdata
	 *
	 * @return boolean
	 */
	function at_attach_external_image( $url = null, $post_id = null, $thumb = null, $filename = null, $post_data = array() )
	{
		if ( ! $url || ! $post_id ) {
			return new WP_Error( 'missing', "Need a valid URL and post ID..." );
		}
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		// Download file to temp location, returns full server path to temp file, ex; /home/user/public_html/mysite/wp-content/26192277_640.tmp
		$tmp = download_url( $url );

		// If error storing temporarily, unlink
		if ( is_wp_error( $tmp ) ) {
			@unlink( $file_array['tmp_name'] );   // clean up
			$file_array['tmp_name'] = '';

			return $tmp; // output wp_error
		}

		// get extension
		$url_type['ext'] = at_get_file_extension( $url );

		// override filename if given, reconstruct server path
		if ( ! empty( $filename ) ) {
			$filename = sanitize_file_name( $filename );
			$tmppath  = pathinfo( $tmp );                                                        // extract path parts
			$new      = $tmppath['dirname'] . "/" . $filename . "." . $tmppath['extension'];          // build new path
			rename( $tmp, $new );                                                                 // renames temp file on server
			$tmp = $new;                                                                        // push new filename (in path) to be used in file array later
		}

		// assemble file data (should be built like $_FILES since wp_handle_sideload() will be using)
		$file_array['tmp_name'] = $tmp;                                                         // full server path to temp file

		if ( ! empty( $filename ) ) {
			$file_array['name'] = $filename . "." . $url_type['ext'];                           // user given filename for title, add original URL extension
		} else {
			$file_array['name'] = $url;
		}

		// set additional wp_posts columns
		if ( empty( $post_data['post_title'] ) ) {
			$post_data['post_title'] = basename( $url_filename, "." . $url_type['ext'] );         // just use the original filename (no extension)
		}

		// make sure gets tied to parent
		if ( empty( $post_data['post_parent'] ) ) {
			$post_data['post_parent'] = $post_id;
		}

		// do the validation and storage stuff
		$att_id = media_handle_sideload( $file_array, $post_id, null, $post_data );             // $post_data can override the items saved to wp_posts table, like post_mime_type, guid, post_parent, post_title, post_content, post_status

		// If error storing permanently, unlink
		if ( is_wp_error( $att_id ) ) {
			@unlink( $file_array['tmp_name'] );   // clean up

			return $att_id; // output wp_error
		}

		// set as post thumbnail if desired
		if ( $thumb ) {
			set_post_thumbnail( $post_id, $att_id );
		}

		return $att_id;
	}
}

if ( ! function_exists( 'at_get_file_extension' ) ) {
	/**
	 * A simple function to get the file extension
	 *
	 * @param $url
	 *
	 * @return string|null
	 */
	function at_get_file_extension( $url )
	{
		$typeExtension = null;

		$typeInt = exif_imagetype( $url );

		switch ( $typeInt ) {
			case IMG_GIF:
				$typeExtension = 'gif';
				break;
			case IMG_PNG:
				$typeExtension = 'png';
				break;
			case IMG_WBMP:
				$typeExtension = 'wbmp';
				break;
			case IMG_XPM:
				$typeExtension = 'xpm';
				break;
			default:
				$typeExtension = 'jpg';
		}

		return $typeExtension;
	}
}

if ( ! function_exists( 'at_get_product_rating_list' ) ) {
	/**
	 * at_get_product_rating_list function.
	 *
	 * @param int $rating
	 *
	 * @return string
	 */
	function at_get_product_rating_list( $rating = 0 )
	{
		$output = '<select name="rating" id="rating" class="form-control">';

		for ( $i = 0; $i < 5.5; $i += 0.5 ) {
			if ( $rating == $i ) {
				$output .= '<option value="' . $i . '" selected>' . $i . ' ' . __( 'Sterne', 'affiliatetheme' ) . '</option>';
			} else {
				$output .= '<option value="' . $i . '">' . $i . ' ' . __( 'Sterne', 'affiliatetheme' ) . '</option>';
			}
		}

		$output .= '</select>';

		return $output;
	}
}

if ( ! function_exists( 'at_write_api_log' ) ) {
	/**
	 * at_write_api_log function.
	 *
	 * @param string $type
	 * @param int $post_id
	 * @param string $msg
	 *
	 * @return null
	 */
	function at_write_api_log( $type, $post_id, $msg )
	{
		if ( ! $type ) {
			return;
		}

		if ( ! $post_id ) {
			return;
		}

		$log   = ( is_array( get_option( 'at_' . $type . '_api_log' ) ) ? get_option( 'at_' . $type . '_api_log' ) : array() );
		$log[] = array( 'time' => time(), 'post_id' => $post_id, 'msg' => $msg );

		// limit log to 200 items
		$log = array_reverse( $log );
		$log = array_slice( $log, 0, 200 );
		$log = array_reverse( $log );

		update_option( 'at_' . $type . '_api_log', $log );
	}
}

if ( ! function_exists( 'at_redirect_fake_product_notice' ) ) {
	/**
	 * at_redirect_fake_product_notice function.
	 *
	 * @return string
	 */
	function at_redirect_fake_product_notice()
	{
		$url    = ( get_field( 'product_fake_redirect' ) ? get_field( 'product_fake_redirect' ) : '-' );
		$output = '
            <div class="alert alert-warning">
                ' . sprintf( __( '<strong>Hinweis:</strong> Dies ist ein Fake Produkt. Nicht eingeloggte Besucher werden auf folgende URL weitergeleitet: <mark>%s</mark>', 'affiliatetheme' ), $url ) . '
            </div>
        ';

		echo $output;
	}
}

if ( ! function_exists( 'at_get_product_id_by_metakey' ) ) {
	/**
	 * at_get_product_id_by_metakey function.
	 *
	 * @param string $key
	 * @param string $val
	 * @param string $compare
	 *
	 * @return string
	 */
	function at_get_product_id_by_metakey( $key, $val, $compare = 'LIKE' )
	{
		global $wpdb;

		if ( $post_id = $wpdb->get_var( "SELECT p.ID AS post_id FROM $wpdb->postmeta pm LEFT JOIN $wpdb->posts p ON p.ID = pm.post_id WHERE pm.meta_key $compare '$key' AND pm.meta_value = '$val' AND p.post_type = 'product' LIMIT 0,1" ) ) {
			return $post_id;
		}

		return false;
	}
}

if ( ! function_exists( 'at_get_product_id_by_ean' ) ) {
	/**
	 * at_get_product_id_by_ean function.
	 *
	 * @param string $ean
	 *
	 * @return boolean
	 */
	function at_get_product_id_by_ean( $ean )
	{
		global $wpdb;

		if ( ! is_numeric( $ean ) ) {
			return false;
		}

		if ( strlen( $ean ) < 8 ) {
			return false;
		}

		if ( $post_id = $wpdb->get_var( "SELECT p.ID AS post_id FROM $wpdb->postmeta pm LEFT JOIN $wpdb->posts p ON p.ID = pm.post_id WHERE pm.meta_key = 'product_ean' AND pm.meta_value = '$ean' AND p.post_type = 'product' LIMIT 0,1" ) ) {
			return $post_id;
		}

		return false;
	}
}

if ( ! function_exists( 'at_get_shop_id' ) ) {
	/**
	 * at_get_shop_id function.
	 *
	 * @param int $unique_id
	 * @param string $name
	 * @param boolean $create
	 *
	 * @return int
	 */
	function at_get_shop_id( $unique_id, $name = '', $create = false, $logo = '' )
	{
		global $wpdb;

		if ( ! $unique_id ) {
			return;
		}

		if ( $shop_id = $wpdb->get_var( "SELECT p.ID AS post_id FROM $wpdb->postmeta pm LEFT JOIN $wpdb->posts p ON p.ID = pm.post_id WHERE pm.meta_key = 'unique_identifier' AND pm.meta_value = '" . $unique_id . "' AND p.post_type = 'shop' LIMIT 0,1" ) ) {
			if ( $logo ) {
				if ( ! has_post_thumbnail( $shop_id ) ) {
					$att_id = at_attach_external_image( $logo, $shop_id, true );
				}
			}

			return $shop_id;
		} else {
			if ( true == $create && "" != $name ) {
				$args    = array(
					'post_status' => 'publish',
					'post_type'   => 'shop',
					'post_title'  => $name
				);
				$shop_id = wp_insert_post( $args );

				if ( $shop_id ) {
					add_post_meta( $shop_id, 'unique_identifier', $unique_id );
				}

				if ( $logo ) {
					$att_id = at_attach_external_image( $logo, $shop_id, true );
				}

				return $shop_id;
			}
		}
	}
}

if ( ! function_exists( 'at_get_existing_products' ) ) {
	/**
	 * at_get_existing_products function.
	 *
	 * @return string
	 */
	function at_get_existing_products( $hint = false, $select2 = true )
	{
		global $post, $wpdb;
		$count = $wpdb->get_var( "SELECT Count(ID) FROM $wpdb->posts WHERE post_type = 'product' AND post_status = 'publish'" );
		if ( $count > 100 ) {
			return;
		}

		$args = array(
			'numberposts' => -1,
			'post_type'   => 'product',
			'post_status' => 'any',
			'orderby'     => 'name',
			'order'       => 'ASC',
			'fields'      => 'ids'
		);

		$output = '
        <div class="row">
            <div class="form-group col-xs-12">
                <select name="ex_page_id" id="ex_page_id">
                    <option value="">- ' . __( "Bitte wählen", "affiliatetheme-backend" ) . ' -</option>';

		$posts = get_posts( $args );
		foreach ( $posts as $post ) {
			setup_postdata( $post );
			$output .= '<option value="' . $post . '">' . get_the_title( $post ) . '</option>';
		}
		$output .= '</select>';

		if ( $hint ) {
			$output .= '<p>' . __( 'Mit der Auswahl eines Produktes, wird dieses Produkt einem bestehenden Produkt angehängt, somit kannst du einen Preisvergleich der Anbieter erstellen.', 'affiliatetheme-backend' ) . '</p>';
		}

		$output .= '</div></div>';

		if ( $select2 ) {
			$output .= '<script type="text/javascript">jQuery("select#ex_page_id").select2({width: "100%"});</script>';
		}

		return $output;
	}
}

add_action( 'init', 'at_add_productdata_tab' );
function at_add_productdata_tab()
{
	$show = get_field( 'product_single_show_productdata', 'option' );
	if ( $show != '1' ) {
		return;
	}

	$pos = ( get_field( 'product_single_productdata_pos', 'option' ) ? get_field( 'product_single_productdata_pos', 'option' ) : 'last' );

	add_action( 'at_product_tabs_nav_' . $pos, 'at_add_productdata_tabs_nav', 10, 1 );
	add_action( 'at_product_tabs_content_' . $pos, 'at_add_productdata_tabs_content', 10, 1 );
	add_action( 'at_product_sections_' . $pos, 'at_add_productdata_sections_content', 10, 1 );
}

if ( ! function_exists( 'at_add_productdata_tabs_nav' ) ) {
	/**
	 * at_add_productdata_tabs_nav
	 *
	 * Add Productdata Tab
	 */
	function at_add_productdata_tabs_nav()
	{
		global $post;

		$product_fields = new AT_Product_Fields( $post->ID, 'productdata' );
		$fields         = $product_fields->get();

		if ( $fields ) {
			$title = get_field( 'product_single_productdata_headline', 'option' );
			echo '<li><a href="#tab-productdata" aria-controls="tab-productdata" role="tab" data-toggle="tab">' . $title . '</a></li>';
		}
	}
}

if ( ! function_exists( 'at_add_productdata_tabs_content' ) ) {
	/**
	 * at_add_productdata_tabs_content
	 *
	 * Add Productdata Tab
	 */
	function at_add_productdata_tabs_content()
	{
		ob_start();
		get_template_part( 'parts/product/code', 'tabs-productdata' );
		$tab = ob_get_contents();
		ob_end_clean();

		if ( $tab ) {
			echo '<div role="tabpanel" class="tab-pane" id="tab-productdata">' . $tab . '</div>';
		}
	}
}

if ( ! function_exists( 'at_add_productdata_sections_content' ) ) {
	/**
	 * at_add_productdata_sections_content
	 *
	 * Add Productdata Tab
	 */
	function at_add_productdata_sections_content()
	{
		ob_start();
		get_template_part( 'parts/product/code', 'tabs-productdata' );
		$tab = ob_get_contents();
		ob_end_clean();

		$title = get_field( 'product_single_productdata_headline', 'option' );

		if ( $tab ) {
			echo '<div class="section section-productdata"><p class="h2 section-title">' . $title . ' ' . $tab . '</div>';
		}
	}
}