<?php global $product_shops;
$product_shop = ( $product_shops ? $product_shops : get_field( 'product_shops' ) ); ?>
<div class="product-buybox">
	<div class="row">
		<div class="col-xxs-12 col-xs-6 col-md-12">
			<?php get_template_part( 'parts/product/code', 'price' ); ?>
		</div>
		<div class="col-xxs-12 col-xs-6 col-md-12">
			<?php
			echo get_product_button( get_the_ID(), 0, 'buy', 'btn-block btn-lg' );

			do_action( 'at_product_buybox_after_buy_button' );

			if ( show_price_compare( get_the_ID() ) ) {
				echo '<a href="#price-compare" class="btn btn-xs btn-block btn-link smoothscroll" data-offset="100">' . __( 'zum Preisvergleich', 'affiliatetheme' ) . ' (' . count( $product_shops ) . ')</a>';
			}
			?>
		</div>
	</div>
</div>

<?= at_price_trend_render_button( get_the_ID() ) ?>

