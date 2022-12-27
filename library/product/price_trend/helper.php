<?php
/**
 * Hilfsfunktionen
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    product
 */


add_action( 'after_switch_theme', 'at_price_trend_database' );
function at_price_trend_database()
{
	global $wpdb;

	/**
	 * Installiere die Tabelle: at_price_trend
	 */
	if ( $wpdb->get_var( "show tables like '" . AT_PRICE_TREND_TABLE . "'" ) != AT_PRICE_TREND_TABLE ) {
		$sql = "CREATE TABLE " . AT_PRICE_TREND_TABLE . " (
	  	id int(11) NOT NULL AUTO_INCREMENT,
	  	post_id int(11) NOT NULL,
	  	shop_id int(11) NOT NULL,
	  	date datetime NOT NULL,
	  	price float(11) NOT NULL,	  	
	  	PRIMARY KEY (id)
		);";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
}

add_action( "wp_ajax_at_price_trend_database_install", "at_price_trend_database_install" );
function at_price_trend_database_install()
{
	at_price_trend_database();

	$response = array();

	$response['status'] = 'ok';

	echo json_encode( $response );

	exit();
}

add_action( 'admin_notices', 'at_price_trend_database_check' );
function at_price_trend_database_check()
{
	global $wpdb;

	if ( $wpdb->get_var( "show tables like '" . AT_PRICE_TREND_TABLE . "'" ) != AT_PRICE_TREND_TABLE ) {
		?>
		<div class="error">
			<p>
				<?php _e( 'Eine oder mehrere Datenbank-Tabellen für den <strong>Preisverlauf</strong> fehlen.
                Bitte aktualisiere deine Datenbank. <a class="button" id="at_price_trend_database_install">Datenbank aktualisieren</a>', 'affiliatetheme-backend' ); ?>
			</p>
		</div>

		<script type="text/javascript">
			jQuery('#at_price_trend_database_install').bind('click', function (e) {
				var target = jQuery(this).closest('.error');
				jQuery(this).append(' <span class="spinner" style="visibility:initial"></span>');

				jQuery.get(ajaxurl + '?&action=at_price_trend_database_install', {}).done(function (data) {
					var response = JSON.parse(data);

					if (response.status == 'ok') {
						jQuery(target).find('.spinner').remove();
						jQuery(target).fadeOut();
					}
				});

				e.preventDefault();
			});
		</script>
		<?php
	}
}

if ( ! function_exists( 'at_price_trend' ) ) {
	/**
	 * at_price_trend function.
	 *
	 * @param int $post_id
	 *
	 * @return boolean
	 */
	function at_price_trend()
	{
		$global_show = get_field( 'product_single_show_price_trend', 'option' );

		if ( $global_show == '1' ) {
			return true;
		}

		return;
	}
}

if ( ! function_exists( 'at_show_price_trend' ) ) {
	/**
	 * at_show_price_trend function.
	 *
	 * @param int $post_id
	 * @param string $pos (default: bottom)
	 *
	 * @return boolean
	 */
	function at_show_price_trend( $post_id, $pos = 'bottom' )
	{
		$global_show = get_field( 'product_single_show_price_trend', 'option' );

		if ( $global_show == '1' ) {
			$global_pos = get_field( 'product_single_price_trend_pos', 'option' );

			if ( $global_pos == $pos ) {
				return true;
			}
		}

		return;
	}
}

add_action( 'added_post_meta', 'at_price_trend_added_price', 10, 3 );
function at_price_trend_added_price( $object_id, $meta_key, $meta_value )
{
	global $wpdb;

	/**
	 * Fires immediately before meta of a specific type is added.
	 *
	 * The dynamic portion of the hook, `$meta_type`, refers to the meta
	 * object type (comment, post, or user).
	 *
	 * @param int $object_id Object ID.
	 * @param string $meta_key Meta key.
	 * @param mixed $meta_value Meta value.
	 *
	 * @since 3.1.0
	 *
	 */

	if ( get_post_type( $object_id ) != 'product' ) {
		return;
	}

	if ( fnmatch( "product_shops_*_price", $meta_key ) ) {
		//error_log('####');
		//error_log('object_id ' . $object_id);
		//error_log('meta_key ' . $meta_key);
		//error_log('meta_value ' . $meta_value);

		$product_shops = get_field( 'product_shops', $object_id );
		$row_id        = 0;

		// current date
		$now   = new DateTime( 'now', new DateTimeZone( 'Europe/Berlin' ) );
		$year  = $now->format( 'Y' );
		$month = $now->format( 'm' );
		$day   = $now->format( 'd' );
		$date  = $now->format( 'Y-m-d H:i:s' );

		if ( preg_match( '/product_shops_([0-9]+)_price/', $meta_key, $matches ) ) {
			$row_id = $matches[1];
		}

		// get shop id
		$shop_id = $product_shops[ $row_id ]['shop'];
		if ( $shop_id ) {
			$shop_id = $shop_id->ID;
		} else {
			$shop_id = 0;
		}

		//error_log('shop_id ' . $shop_id);

		$check = $wpdb->get_row(
			"
            SELECT id
            FROM " . AT_PRICE_TREND_TABLE . "
            WHERE year(date) = '" . $year . "' AND month(date) = '" . $month . "' AND day(date) = '" . $day . "' AND post_id = '" . $object_id . "' AND shop_id = '" . $shop_id . "'
            "
		);

		if ( is_object( $check ) && $check->id ) {
			$wpdb->update(
				AT_PRICE_TREND_TABLE,
				array(
					'date'  => $date,
					'price' => $meta_value,
				),
				array(
					'id' => $check->id
				)
			);
		} else {
			// insert into database
			$wpdb->insert(
				AT_PRICE_TREND_TABLE,
				array(
					'post_id' => $object_id,
					'shop_id' => $shop_id,
					'date'    => $date,
					'price'   => $meta_value,
				)
			);
		}

		//error_log('####');
	}
}

add_action( 'updated_postmeta', 'at_price_trend_updated_price', 10, 4 );
function at_price_trend_updated_price( $meta_id, $object_id, $meta_key, $meta_value )
{
	global $wpdb;

	/**
	 * Fires immediately after updating a post's metadata.
	 *
	 * @param int $meta_id ID of updated metadata entry.
	 * @param int $object_id Object ID.
	 * @param string $meta_key Meta key.
	 * @param mixed $meta_value Meta value.
	 *
	 * @since 2.9.0
	 *
	 */

	if ( fnmatch( "product_shops_*_price", $meta_key ) ) {
		//error_log('####');
		//error_log('meta_id ' . $meta_id);
		//error_log('object_id ' . $object_id);
		//error_log('meta_key ' . $meta_key);
		//error_log('meta_value ' . $meta_value);

		$product_shops = get_field( 'product_shops', $object_id );
		$row_id        = 0;

		// current date
		$now   = new DateTime( 'now', new DateTimeZone( 'Europe/Berlin' ) );
		$year  = $now->format( 'Y' );
		$month = $now->format( 'm' );
		$day   = $now->format( 'd' );
		$date  = $now->format( 'Y-m-d H:i:s' );

		if ( preg_match( '/product_shops_([0-9]+)_price/', $meta_key, $matches ) ) {
			$row_id = $matches[1];
		}

		// get shop id
		$shop_id = $product_shops[ $row_id ]['shop'];
		if ( $shop_id ) {
			$shop_id = $shop_id->ID;
		} else {
			$shop_id = 0;
		}

		//error_log('shop_id ' . $shop_id);

		$check = $wpdb->get_row(
			"
            SELECT id
            FROM " . AT_PRICE_TREND_TABLE . "
            WHERE year(date) = '" . $year . "' AND month(date) = '" . $month . "' AND day(date) = '" . $day . "' AND post_id = '" . $object_id . "' AND shop_id = '" . $shop_id . "'
            "
		);

		if ( is_object( $check ) && $check->id ) {
			$wpdb->update(
				AT_PRICE_TREND_TABLE,
				array(
					'date'  => $date,
					'price' => $meta_value,
				),
				array(
					'id' => $check->id
				)
			);
		} else {
			// insert into database
			$wpdb->insert(
				AT_PRICE_TREND_TABLE,
				array(
					'post_id' => $object_id,
					'shop_id' => $shop_id,
					'date'    => $date,
					'price'   => $meta_value,
				)
			);
		}

		//error_log('####');
	}
}

if ( ! function_exists( 'at_price_trend_chart_data' ) ) {
	/**
	 * at_price_trend_chart_data function.
	 *
	 * @param int $post_id
	 *
	 * @return array
	 */
	function at_price_trend_chart_data( $post_id )
	{
		global $wpdb;

		if ( false === ( $chart = get_transient( 'product_price_trend_' . $post_id ) ) ) {
			$data        = $wpdb->get_results( "SELECT * FROM " . AT_PRICE_TREND_TABLE . " WHERE post_id = '" . $post_id . "' ORDER BY date DESC" );
			$chart       = array( 'options' => array(), 'labels' => array(), 'datasets' => array() );
			$dataset_tmp = array();

			if ( $data ) {
				// labels for last 30 days
				for ( $i = 0; $i < 30; $i++ ) {
					$chart['labels'][] = date( "d.m.Y", strtotime( '-' . $i . ' days' ) );
				}
				$chart['labels'] = array_reverse( $chart['labels'] );

				// prepare data
				foreach ( $data as $item ) {
					$date = new DateTime( $item->date, new DateTimeZone( 'Europe/Berlin' ) );

					// data
					$dataset_tmp[ $item->shop_id ][ $date->format( 'd.m.Y' ) ] = array(
						'date'     => $date->format( 'd.m.Y' ),
						'time'     => $date->format( 'H:i' ),
						'datetime' => $item->date,
						'price'    => $item->price
					);
				}

				$productShops = get_field( 'product_shops', $post_id );

				// set data
				foreach ( $dataset_tmp as $shop => $dataset ) {
					$hide = get_field( 'shop_price_trend_hide', $shop );
					if ( $hide == '1' ) {
						continue;
					}

					if ( $productShops ) {
						$found = false;
						foreach ( $productShops as $item ) {
							if ( $item['shop'] && ( $item['shop']->ID == $shop ) ) {
								$found = true;
							}
						}

						if ( ! $found ) {
							continue;
						}
					}

					$last_prices = array();

					foreach ( $chart['labels'] as $date ) {
						if ( isset( $dataset[ $date ] ) ) {
							$chart['datasets'][ $shop ][] = array(
								'date'     => $dataset[ $date ]['date'],
								'time'     => $dataset[ $date ]['time'],
								'datetime' => $dataset[ $date ]['datetime'],
								'price'    => $dataset[ $date ]['price']
							);

							$last_prices[ $post_id ] = $dataset[ $date ]['price'];
						} else {
							$chart['datasets'][ $shop ][] = array(
								'date'  => $date,
								'price' => ( isset( $last_prices[ $post_id ] ) ? $last_prices[ $post_id ] : 0 )
							);
						}
					}
				}

				$chart['labels'] = array_values( array_unique( $chart['labels'] ) );

				set_transient( 'product_price_trend_' . $post_id, $chart, apply_filters( 'at_product_price_trend_cache', 2 * HOUR_IN_SECONDS ) );
			}
		}

		return apply_filters( 'at_product_price_trend_data', $chart, $post_id );
	}
}

if ( ! function_exists( 'at_price_trend_render_button' ) ) {
	/**
	 * at_price_trend_render_button function.
	 *
	 * @param int $post_id
	 *
	 * @return string
	 */
	function at_price_trend_render_button( $post_id )
	{
		if ( at_show_price_trend( $post_id, 'bottom' ) ) {
			echo '<a href="#price-trend" class="btn btn-sm btn-link smoothscroll" data-offset="100"><i class="fas fa-line-chart"></i> ' . __( 'Preisverlauf', 'affiliatetheme' ) . '</a>';
		}

		if ( at_show_price_trend( $post_id, 'tab' ) ) {
			$hide_tabs = get_field( 'product_single_tabs_remove', 'option' );
			if ( $hide_tabs == '1' ) {
				echo '<a href="#price_trend" class="btn btn-sm btn-link"><i class="fas fa-line-chart"></i> ' . __( 'Preisverlauf', 'affiliatetheme' ) . '</a>';
			} else {
				echo '<a href="#" class="btn btn-sm btn-link open-tab" data-target="tab-price_trend"><i class="fas fa-line-chart"></i> ' . __( 'Preisverlauf', 'affiliatetheme' ) . '</a>';
			}
		}

		if ( at_show_price_trend( $post_id, 'modal' ) ) {
			echo '<a href="#" class="btn btn-sm btn-link" data-toggle="modal" data-target="#priceTrend"><i class="fas fa-line-chart"></i> ' . __( 'Preisverlauf', 'affiliatetheme' ) . '</a>';
		}
	}
}