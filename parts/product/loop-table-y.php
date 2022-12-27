<?php

global $products, $product_table_highlight, $product_details_tax_hide, $product_details_fields_hide, $product_review_hide, $product_button_detail_hide, $product_button_buy_hide, $product_field_groups;

// set product highlight
if ( $product_table_highlight ) {
	$custom_product_table_highlight = $product_table_highlight;
} else {
	$custom_product_table_highlight = array();
}

$hide_detail_button = $product_button_detail_hide;
$hide_buy_button    = $product_button_buy_hide;

$product_misc_table_empty_field = ( get_field( 'product_misc_table_empty_field', 'option' ) ? get_field( 'product_misc_table_empty_field', 'option' ) : '-' );
$product_image_link             = get_field( 'product_image_link', 'options' );

if ( $products ) {
	// force field groups
	if ( $product_field_groups ) {
		$force_field_groups = $product_field_groups;
	} else {
		$force_field_groups = array();
	}

	// get product fields
	if ( $product_details_fields_hide != '1' ) {
		$fields = at_product_render_table_fields( $products, true, $force_field_groups );
	}

	$col_width = round( 100 / ( count( $products ) + 1 ) );
	?>

	<div class="table-responsive">
		<table class="table table-hover table-product table-striped table-product-y">
			<colgroup>
				<col style="width:5%">
				<col>
				<col>
				<?php
				$i = 1;
				if ( $fields ) {
					foreach ( $fields as $k => $v ) {
						if ( $i == 2 ) {
							echo '<col>';
						} else {
							echo '<col style="width:' . $col_width . '%;">';
						}

						$i++;
					}
				}

				if ( apply_filters( 'at_table_y_hide_price', true ) ) {
					echo '<col>';
				} ?>
				<col>
			</colgroup>
			<thead>
			<tr class="product-row-header">
				<th></th>
				<th></th>
				<th><?= apply_filters( 'at_table_y_product_name_row_title', __( 'Modell', 'affiliatetheme' ) ); ?></th>
				<?php
				if ( apply_filters( 'at_table_y_hide_review_summary', true ) && $product_review_hide != 1 ) {
					?>
					<th><?= apply_filters( 'at_table_y_product_review_row_title', __( 'Testergebnis', 'affiliatetheme' ) ); ?></th><?php
				}

				if ( $fields ) {
					foreach ( $fields as $k => $v ) {
						echo '<th>' . $v['field']['label'] . '</th>';
					}
				}

				if ( '1' != get_field( 'product_price_hide', 'option' ) && apply_filters( 'at_table_y_hide_price', true ) ) {
					?>
					<th><?= apply_filters( 'at_table_y_product_price_row_title', __( 'Preis', 'affiliatetheme' ) ); ?></th>
					<?php
				}
				?>
				<th></th>
			</thead>

			<tbody>
			<?php
			$c = 1;

			// check price
			$has_price = false;
			foreach ( $products as $product ) {
				if ( get_product_price( $product->ID, 0, true ) ) {
					$has_price = true;
				}
			}

			foreach ( $products as $product ) {
				$product_fakeshop = at_is_fake_product( $product->ID );
				?>
				<tr class="product-<?= $product->ID; ?>">
					<?php
					if ( apply_filters( 'at_table_y_show_number_row', true ) ) { ?>
						<td class="<?= ( in_array( $product->ID, $custom_product_table_highlight ) ? 'table-highlight ' : '' ); ?>table-counter">
							<strong><?= $c; ?></strong>
						</td>
						<?php
					}
					echo '
						<td class="table-thumbnail ' . ( in_array( $product->ID, $custom_product_table_highlight ) ? 'table-highlight ' : '' ) . '">
						    <a title="' . get_the_title( $product->ID ) . '" href="' . ( ( '1' == $product_fakeshop || '1' == $product_image_link ) ? get_product_link( $product->ID ) : get_permalink( $product->ID ) ) . '" ' . get_product_link_params( $product->ID, ( $product_image_link == '1' ? $product_image_link : $product_fakeshop ) ) . '>
						        ' . at_post_thumbnail( $product->ID, 'product_table', array( 'class' => 'img-responsive' ) ) . '
                            </a>
                            ' . ( ( $highlight_text = get_product_highlight_text( $product->ID ) ) ? '<span class="badge-at">' . $highlight_text . '</span>' : '' ) . '
                        </td>
                        ';

					echo '<td class="' . ( in_array( $product->ID, $custom_product_table_highlight ) ? 'table-highlight ' : '' ) . 'product-title">';
					echo '<a href="' . ( ( '1' == $product_fakeshop ) ? get_product_link( $product->ID ) : get_permalink( $product->ID ) ) . '" title="' . get_the_title( $product->ID ) . '" ' . get_product_link_params( $product->ID, $product_fakeshop ) . '> ' . get_the_title( $product->ID ) . '</a>';

					if ( get_product_rating( $product->ID ) && apply_filters( 'at_table_y_hide_rating', true ) ) { ?>
						<div class="product-rating">
							<?php
							echo get_product_rating( $product->ID );
							?>
						</div>
					<?php }

					echo '</td>';

					if ( apply_filters( 'at_table_y_hide_review_summary', true ) && $product_review_hide != 1 ) {
						echo '<td class="' . ( in_array( $product->ID, $custom_product_table_highlight ) ? 'table-highlight ' : '' ) . 'product-review-summary product-' . $product->ID . '">';
						if ( get_product_review_summary_html( $product->ID ) ) {
							echo get_product_review_summary_html( $product->ID );
						} else {
							echo apply_filters( 'at_table_y_product_review_fallback', '-' );
						}
						echo '</td>';
					}

					if ( $fields ) {
						foreach ( $fields as $k => $v ) {
							echo '<td class="' . ( in_array( $product->ID, $custom_product_table_highlight ) ? 'table-highlight ' : '' ) . 'product product-' . $product->ID . '">' . $v['values'][ $product->ID ] . '</td>';
						}
					}

					if ( $has_price && apply_filters( 'at_table_y_hide_price', true ) ) {
						echo '<td class="' . ( in_array( $product->ID, $custom_product_table_highlight ) ? 'table-highlight ' : '' ) . 'product-price">';
						if ( get_product_price( $product->ID, 0, true ) ) {
							echo '<p class="price">' . get_product_price( $product->ID, 0, true, false, true ) . '</p>';
							if ( apply_filters( 'at_table_show_price_hint', true ) ) {
								do_action( 'at_product_before_price_hint' );
								echo get_product_price_hint( $product->ID );
								do_action( 'at_product_after_price_hint' );
							}
						}
						echo '</td>';
					}

					if ( get_product_button( $product->ID, 0, 'detail', 'btn-block', true ) || get_product_button( $product->ID, 0, 'buy', 'btn-block', true ) ) {
						echo '<td class="' . ( in_array( $product->ID, $custom_product_table_highlight ) ? 'table-highlight ' : '' ) . '">';
						do_action( 'at_product_table_y_before_buttons' );
						echo get_product_button( $product->ID, 0, 'detail', 'btn-block', true, false, $hide_detail_button );
						echo get_product_button( $product->ID, 0, 'buy', 'btn-block', true, false, $hide_buy_button );
						do_action( 'at_product_table_y_after_buttons' );
						echo '</td>';
					}
					?>
				</tr>

				<?php $c++;
			} ?>
			</tbody>
		</table>
	</div>
	<?php wp_reset_query();
} ?>