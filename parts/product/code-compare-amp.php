<?php

/*
 * VARS
 */
$product_shop            = get_field( 'product_shops' );
$product_external_target = ( get_field( 'product_external_target', 'option' ) ? get_field( 'product_external_target', 'option' ) : '_blank' );

if ( $product_shop ) {
	$i = 0;
	?>
	<hr>
	<div class="product-compare" id="price-compare">
		<p class="h2"><?php _e( 'Preisvergleich', 'affiliatetheme' ); ?></p>

		<table class="table table-bordered table-hover table-product table-striped table-compare">
			<thead>
			<tr>
				<th><?php _e( 'Shop', 'affiliatetheme' ); ?></th>
				<th><?php _e( 'Preis', 'affiliatetheme' ); ?></th>
				<th></th>
			</tr>
			</thead>
			<?php foreach ( $product_shop as $item ) {
				$shop = $item['shop'];
				$rel  = apply_filters( 'at_product_link_params_sponsored_tag', true ) ? 'sponsored' : 'nofollow';
				?>
				<tr>
					<td>
						<a class="shop-link-ext" href="<?= get_product_link( get_the_ID(), $i ); ?>" target="<?= $product_external_target; ?>" rel="<?= $rel ?>">
							<?php
							if ( ! $shop || $shop == '' ) {
								echo ''; // @TODO: Fallback
							} else {
								if ( has_post_thumbnail( $shop->ID ) ) {
									$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $shop->ID ), 'shop_table' );
									?>
									<amp-img src="<?= $thumb[0]; ?>" width="<?= $thumb[1]; ?>" height="<?= $thumb[2]; ?>"></amp-img>
									<?php
								} else {
									echo $shop->post_title;
								}
							}
							?>
						</a>
					</td>
					<td>
						<div class="product-price">
							<p class="price"><?= get_product_price( get_the_ID(), $i, true, true ); ?></p>
							<?php
							do_action( 'at_product_before_price_hint' );
							echo get_product_price_hint( get_the_ID(), $i );
							do_action( 'at_product_after_price_hint' );
							?>
						</div>
					</td>
					<td><?= get_product_button( get_the_ID(), $i, 'buy', 'btn-block' ); ?></td>
				</tr>
				<?php
				$i++;
			} ?>
		</table>
	</div>

<?php } ?>