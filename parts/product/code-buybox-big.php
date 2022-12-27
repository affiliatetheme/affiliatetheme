<hr>
<div class="product-buybox product-buybox-big">
	<div class="row">
		<div class="col-sm-6">
			<?php get_template_part( 'parts/product/code', 'price' ); ?>
		</div>

		<div class="col-sm-6 text-right">
			<?php
			echo get_product_button( get_the_ID(), 0, 'buy', 'btn-lg' );
			do_action( 'at_product_buybox_big_after_buy_button' );
			?>
		</div>
	</div>
</div>
