<?php
/*
 * VARS
 */

global $grid_col, $product_button_detail_hide, $product_button_buy_hide;;
$args                   = array(
	'class' => 'img-responsive product-img',
);
$product_fakeshop       = at_is_fake_product( get_the_ID() );
$product_highlights     = get_field( 'product_highlights', get_the_ID() );
$product_gallery        = get_field( 'product_gallery', get_the_ID() );
$product_thumbnail      = "";
$product_thumbnail_tiny = "";
$product_image_link     = get_field( 'product_image_link', 'options' );

if ( has_post_thumbnail() ) {
	$product_thumbnail_id   = get_post_thumbnail_id( get_the_ID() );
	$product_thumbnail      = wp_get_attachment_image_src( $product_thumbnail_id, 'product_gallery', true );
	$product_thumbnail_tiny = get_the_post_thumbnail( get_the_ID(), 'product_tiny', array( 'class' => 'img-responsive' ) );

	// external images (thumbnail)
	$product_thumbnail_ext = get_post_meta( get_the_ID(), '_thumbnail_ext_url', true );
	if ( $product_thumbnail_ext ) {
		$product_thumbnail[0] = $product_thumbnail_ext;
	}
}

// eternal images (gallery)
if ( $product_gallery_external = get_field( 'product_gallery_external' ) ) {
	$product_gallery = $product_gallery_external;
}

$hide_detail_button = $product_button_detail_hide;
$hide_buy_button    = $product_button_buy_hide;
$btn_detail         = get_product_button( get_the_ID(), 0, 'detail', 'btn-block', true, false, $hide_detail_button );
$btn_buy            = get_product_button( get_the_ID(), 0, 'buy', 'btn-block', true, false, $hide_buy_button );
?>
<div class="col-xxs-12 col-xs-6 col-md-4 col-lg-<?= ( ( "" != $grid_col ) ? $grid_col : '3' ); ?> eq">
	<div class="thumbnail thumbnail-<?= get_the_ID() ?> product-grid product-grid-hover">
		<div class="caption-hover">
			<?php if ( get_field( 'product_grid_hover_images_overlay', 'option' ) != "1" ) { ?>
				<div class="caption-hover-img">
					<ul class="list-unstyled <?php if ( $product_gallery_external ) {
						echo 'list-external';
					} ?>">
						<?php
						if ( $product_thumbnail_tiny ) { ?>
							<li>
								<a href="#" class="active" data-big="<?= $product_thumbnail[0]; ?>">
									<?= $product_thumbnail_tiny; ?>
								</a>
							</li>
							<?php
						}

						$i = 0;
						if ( $product_gallery ) {
							foreach ( $product_gallery as $item ) {
								if ( $i == 5 ) break;

								if ( isset( $item['sizes'] ) ) {
									?>
									<li>
										<a href="#" class="<?php if ( ! $product_thumbnail_tiny && $i == 0 ) echo 'active'; ?>"
										   data-big="<?= $item['sizes']['product_gallery']; ?>">
											<img src="<?= $item['sizes']['product_tiny']; ?>"
												 width="<?= $item['sizes']['product_tiny-height']; ?>"
												 height="<?= $item['sizes']['product_tiny-height']; ?>"
												 alt="<?= $item['alt']; ?>"
											/>
										</a>
									</li>
									<?php
								} else {
									if ( $item['hide'] == '1' ) {
										continue;
									}
									?>
									<li>
										<a href="#" class="<?php if ( ! $product_thumbnail_tiny && $i == 0 ) echo 'active'; ?>"
										   data-big="<?= $item['url']; ?>">
											<img src="<?= $item['url']; ?>"
												 alt="<?= $item['alt']; ?>"
												 class="img-responsive"
											/>
										</a>
									</li>
									<?php
								}
								$i++;
							}
						}
						?>
					</ul>
				</div>
			<?php } ?>
			<div class="caption-hover-txt">
				<?php if ( $product_highlights && get_field( 'product_grid_hover_text_overlay', 'option' ) != "1" ) { ?>
					<?= $product_highlights; ?>
					<hr class="hidden-xs">
					<?php
				}

				do_action( 'at_product_grid_hover_before_buttons' );

				if ( get_field( 'product_grid_hover_buttons_overlay', 'option' ) != "1" ) {
					if ( '1' == get_field( 'product_button_among', 'option' ) || at_is_fake_product( get_the_ID() ) ) {
						echo $btn_detail . $btn_buy;
					} else {
						if ( ! $btn_buy ) {
							echo $btn_detail;
						} elseif ( ! $btn_detail ) {
							echo $btn_buy;
						} else {
							?>
							<div class="row product-buttons">
								<div class="col-sm-6">
									<?= $btn_detail; ?>
								</div>
								<div class="col-sm-6">
									<?= $btn_buy; ?>
								</div>
							</div>
							<?php
						}
					}
				}

				do_action( 'at_product_grid_hover_after_buttons' );
				?>
			</div>
		</div>

		<div class="caption">
			<?php
			if ( $highlight_text = get_product_highlight_text( get_the_ID() ) )
				echo '<span class="badge-at">' . $highlight_text . '</span>';
			?>
			<div class="img-grid-wrapper">
				<a title="<?php the_title(); ?>" href="<?= ( ( '1' == $product_fakeshop || '1' == $product_image_link ) ? get_product_link( get_the_ID() ) : get_permalink() ); ?>" <?= get_product_link_params( get_the_ID(), ( $product_image_link == '1' ? $product_image_link : $product_fakeshop ) ); ?>>
					<?= at_post_thumbnail( get_the_ID(), 'product_grid', $args ); ?>
				</a>
			</div>

			<?php if ( get_product_grid_tax( get_the_ID() ) ) { ?>
				<div class="row row-product-meta">
					<div class="col-xs-6">
						<?php
						if ( get_product_grid_tax( get_the_ID() ) )
							echo get_product_grid_tax( get_the_ID() );
						?>
					</div>
					<div class="col-xs-6">
						<div class="product-rating text-right"><?= get_product_rating( get_the_ID() ); ?></div>
					</div>
				</div>
			<?php } else { ?>
				<div class="row-product-meta">
					<div class="product-rating"><?= get_product_rating( get_the_ID() ); ?></div>
				</div>
			<?php } ?>

			<a title="<?php the_title(); ?>" href="<?= ( ( '1' == $product_fakeshop ) ? get_product_link( get_the_ID() ) : get_permalink() ); ?>" class="product-title" <?= get_product_link_params( get_the_ID(), $product_fakeshop ); ?>>
				<?php the_title(); ?>
			</a>

			<?php
			get_template_part( 'parts/product/code', 'price' );

			if ( get_field( 'product_grid_hover_buttons', 'option' ) != "1" ) {
				do_action( 'at_product_grid_before_buttons' );

				if ( $btn_detail || $btn_buy ) {
					echo '<hr class="hidden-xs" />';

					if ( '1' == get_field( 'product_button_among', 'option' ) || at_is_fake_product( get_the_ID() ) ) {
						echo $btn_detail . $btn_buy;
					} else {
						if ( ! $btn_buy ) {
							echo $btn_detail;
						} elseif ( ! $btn_detail ) {
							echo $btn_buy;
						} else {
							?>
							<div class="row product-buttons">
								<div class="col-sm-6">
									<?= $btn_detail; ?>
								</div>
								<div class="col-sm-6">
									<?= $btn_buy; ?>
								</div>
							</div>
							<?php
						}
					}
				}

				do_action( 'at_product_grid_after_buttons' );
			}
			?>
		</div>
	</div>
</div>