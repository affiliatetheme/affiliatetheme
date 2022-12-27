<?php
/*
 * VARS
 */

global $grid_col, $o_list, $product_button_detail_hide, $product_button_buy_hide;
$args               = array(
	'class' => 'img-responsive product-img',
);
$product_fakeshop   = at_is_fake_product( get_the_ID() );
$product_image_link = get_field( 'product_image_link', 'options' );
if ( ! $o_list ) {
	$hide_detail_button = $product_button_detail_hide;
	$hide_buy_button    = $product_button_buy_hide;
} else {
	$hide_detail_button = '';
	$hide_buy_button    = '';
}
?>
<div class="col-xxs-12 col-xs-6 col-md-4 col-lg-<?= ( ( "" != $grid_col ) ? $grid_col : '3' ); ?> eq">
	<div class="thumbnail thumbnail-<?= get_the_ID() ?> product-grid">
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

			do_action( 'at_product_grid_before_buttons' );

			$btn_detail = get_product_button( get_the_ID(), 0, 'detail', 'btn-block', true, false, $hide_detail_button );
			$btn_buy    = get_product_button( get_the_ID(), 0, 'buy', 'btn-block', true, false, $hide_buy_button );

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
			?>
		</div>
	</div>
</div>