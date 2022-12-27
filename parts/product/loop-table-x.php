<?php

global $products, $product_table_highlight, $product_details_tax_hide, $product_details_fields_hide, $product_rating_hide, $product_review_hide, $product_button_detail_hide, $product_button_buy_hide, $product_field_groups, $product_price_compare;

// set product highlight
if ( $product_table_highlight ) {
	$custom_product_table_highlight = $product_table_highlight;
} else {
	$custom_product_table_highlight = array();
}

// buttons
$hide_detail_button = $product_button_detail_hide;
$hide_buy_button    = $product_button_buy_hide;

// image link
$product_image_link = get_field( 'product_image_link', 'options' );

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
		<table class="table table-striped table-hover table-product table-product-x">
			<colgroup>
				<col>
				<?php foreach ( $products as $product ) {
					echo '<col style="width:' . $col_width . '%;">';
				} ?>
			</colgroup>
			<thead>
			<tr class="product-row-number">
				<th></th>
				<?php
				$i = 1;
				foreach ( $products as $product ) {
					echo '<th class="' . ( in_array( $product->ID, $custom_product_table_highlight ) ? 'table-highlight ' : '' ) . 'table-counter product-' . $product->ID . '">' . $i . '</th>';
					$i++;
				} ?>
			</tr>
			</thead>

			<tbody>
			<tr class="product-row-image">
				<td></td>
				<?php
				foreach ( $products as $product ) {
					$product_fakeshop = ( $product_image_link == '1' ? $product_image_link : at_is_fake_product( $product->ID ) );

					echo '
                        <td class="' . ( in_array( $product->ID, $custom_product_table_highlight ) ? 'table-highlight ' : '' ) . 'table-thumbnail product-' . $product->ID . '">
                            <a title="' . get_the_title( $product->ID ) . '" href="' . ( ( '1' == $product_fakeshop ) ? get_product_link( $product->ID ) : get_permalink( $product->ID ) ) . '" ' . get_product_link_params( $product->ID, ( $product_image_link == '1' ? $product_image_link : $product_fakeshop ) ) . '>
                                ' . at_post_thumbnail( $product->ID, 'product_table', array( 'class' => 'img-responsive' ) ) . '
                            </a>
                            ' . ( ( $highlight_text = get_product_highlight_text( $product->ID ) ) ? '<span class="badge-at">' . $highlight_text . '</span>' : '' ) . '
                        </td>
                        ';
				}
				?>
			</tr>

			<tr class="product-row-title">
				<td><?= apply_filters( 'at_table_x_product_name_row_title', __( 'Modell', 'affiliatetheme' ) ); ?></td>
				<?php
				foreach ( $products as $product ) {
					$product_fakeshop = at_is_fake_product( $product->ID );

					echo '<td class="' . ( in_array( $product->ID, $custom_product_table_highlight ) ? 'table-highlight ' : '' ) . 'product-title product-' . $product->ID . '">';
					echo '<a href="' . ( ( '1' == $product_fakeshop ) ? get_product_link( $product->ID ) : get_permalink( $product->ID ) ) . '" title="' . get_the_title( $product->ID ) . '" ' . get_product_link_params( $product->ID, $product_fakeshop ) . '>' . get_the_title( $product->ID ) . '</a>';
					echo '</td>';
				} ?>
			</tr>

			<?php
			if ( $fields && count( $fields ) > 1 && get_product_price( $product->ID, 0, true ) && apply_filters( 'at_table_x_hide_first_price', true ) ) { ?>
				<tr class="product-row-price-1">
					<td><?= apply_filters( 'at_table_x_product_price_row_title', __( 'Preis', 'affiliatetheme' ) ); ?></td>
					<?php
					foreach ( $products as $product ) {
						echo '<td class="' . ( in_array( $product->ID, $custom_product_table_highlight ) ? 'table-highlight ' : '' ) . 'product-price product-' . $product->ID . '">';
						$price = get_product_price( $product->ID, 0, true, false, true );
						if ( $price ) {
							?>
							<p class="price">
								<?= $price; ?>
							</p>
							<?php
						}

						if ( apply_filters( 'at_table_show_price_hint', true ) ) {
							do_action( 'at_product_before_price_hint' );
							echo get_product_price_hint( $product->ID );
							do_action( 'at_product_after_price_hint' );
						}
						echo '</td>';
					} ?>
				</tr>
			<?php }

			if ( apply_filters( 'at_table_x_hide_review_summary', true ) && $product_review_hide != 1 ) {
				?>
				<tr class="product-row-review-summary">
					<td><?= apply_filters( 'at_table_x_product_review_row_title', __( 'Testergebnis', 'affiliatetheme' ) ); ?></td>
					<?php foreach ( $products as $product ) { ?>
						<td class="product-review-summary <?= ( in_array( $product->ID, $custom_product_table_highlight ) ? 'table-highlight ' : '' ); ?> product-<?= $product->ID; ?>">
							<?php
							if ( get_product_review_summary_html( $product->ID ) ) {
								echo get_product_review_summary_html( $product->ID );
							} else {
								echo apply_filters( 'at_table_x_product_review_fallback', '-' );
							}
							?>
						</td>
					<?php } ?>
				</tr>
				<?php
			}

			if ( apply_filters( 'at_table_x_hide_rating', true ) && $product_rating_hide != 1 ) { ?>
				<tr class="product-row-rating">
					<td><?= apply_filters( 'at_table_x_product_rating_row_title', __( 'Bewertung', 'affiliatetheme' ) ); ?></td>

					<?php foreach ( $products as $product ) { ?>
						<td class="product-rating <?= ( in_array( $product->ID, $custom_product_table_highlight ) ? 'table-highlight ' : '' ); ?> product-<?= $product->ID; ?>">
							<?php
							if ( get_product_rating( $product->ID ) ) {
								echo get_product_rating( $product->ID );
							}
							?>
						</td>
					<?php } ?>
				</tr>
				<?php
			}

			if ( $fields ) {
				foreach ( $fields as $k => $v ) {
					echo '<tr class="product-row-field-' . $v['field']['name'] . '">';
					echo '<td>' . $v['field']['label'] . '</td>';
					foreach ( $products as $product ) {
						if ( isset( $v['values'][ $product->ID ] ) ) {
							echo '<td class="' . ( in_array( $product->ID, $custom_product_table_highlight ) ? 'table-highlight ' : '' ) . 'product product-' . $product->ID . '">' . $v['values'][ $product->ID ] . '</td>';
						}
					}
					echo '</tr>';
				}
			}

			if ( get_product_price( $product->ID, 0, true ) && apply_filters( 'at_table_x_hide_second_price', true ) ) {
				?>
				<tr class="product-row-price-2">
					<td>
						<?php
						if ( $product_price_compare ) {
							echo apply_filters( 'at_table_x_product_price_row_title', __( 'Erhältlich bei', 'affiliatetheme' ) );
						} else {
							echo apply_filters( 'at_table_x_product_price_row_title', __( 'Preis', 'affiliatetheme' ) );
						}
						?>
					</td>
					<?php
					foreach ( $products as $product ) {
						echo '<td class="' . ( in_array( $product->ID, $custom_product_table_highlight ) ? 'table-highlight ' : '' ) . 'product-price product-' . $product->ID . '' . ( $product_price_compare ? ' product-price-compare' : '' ) . '">';
						if ( $product_price_compare ) {
							$product_external_target = ( get_field( 'product_external_target', 'option' ) ? get_field( 'product_external_target', 'option' ) : '_blank' );
							$product_shops           = get_field( 'product_shops', $product->ID );
							if ( $product_shops ) {
								foreach ( $product_shops as $k => $item ) {
									$shop = $item['shop'];
									$rel  = apply_filters( 'at_product_link_params_sponsored_tag', true ) ? 'sponsored' : 'nofollow';
									?>
									<div class="row">
										<div class="col-xs-6">
											<a class="shop-link-ext" href="<?= get_product_link( $product->ID, $k ); ?>" target="<?= $product_external_target; ?>" rel="<?= $rel ?>">
												<?php
												if ( ! $shop || $shop == '' ) {
													echo ''; // @TODO: Fallback
												} else {
													if ( has_post_thumbnail( $shop->ID ) ) {
														echo get_the_post_thumbnail( $shop->ID, 'shop_table', array( 'class' => 'img-responsive' ) );
													} else {
														echo $shop->post_title;
													}
												}
												?>
											</a>
										</div>

										<div class="col-xs-6">
											<div class="product-price">
												<p class="price">
													<?php
													$rel = apply_filters( 'at_product_link_params_sponsored_tag', true ) ? 'sponsored' : 'nofollow';
													?>
													<a class="shop-link-ext" href="<?= get_product_link( $product->ID, $k ); ?>" target="<?= $product_external_target; ?>" rel="<?= $rel ?>">
														<?= get_product_price( $product->ID, $k, true, false ); ?>
													</a>
												</p>
											</div>
										</div>
									</div>
									<?php
								}
							}
							?>

							<?php
						} else {
							$price = get_product_price( $product->ID, 0, true, false, true );
							if ( $price ) {
								?>
								<p class="price">
									<?= $price; ?>
								</p>
								<?php
							}

							if ( apply_filters( 'at_table_show_price_hint', true ) && $price ) {
								do_action( 'at_product_before_price_hint' );
								echo get_product_price_hint( $product->ID );
								do_action( 'at_product_after_price_hint' );
							}
						}
						echo '</td>';
					} ?>
				</tr>
				<?php
			}

			if ( get_product_button( $products[0]->ID, 0, 'detail', 'btn-block', true, false, $hide_detail_button ) || get_product_button( $products[0]->ID, 0, 'buy', 'btn-block', true, false, $hide_buy_button ) ) { ?>
				<tr class="product-row-buttons">
					<td></td>
					<?php
					foreach ( $products as $post ) {
						setup_postdata( $post );

						echo '<td class="' . ( in_array( $post->ID, $custom_product_table_highlight ) ? 'table-highlight ' : '' ) . 'product-' . $post->ID . '">';
						do_action( 'at_product_table_x_before_buttons' );
						echo get_product_button( $post->ID, 0, 'detail', 'btn-block', true, false, $hide_detail_button );
						echo get_product_button( $post->ID, 0, 'buy', 'btn-block', true, false, $hide_buy_button );
						do_action( 'at_product_table_x_after_buttons' );
						echo '</td>';
					} ?>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
	<?php wp_reset_query();
} ?>