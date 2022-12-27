<?php

global $o_list;
$overview = ( is_singular( 'product' ) && ! $o_list ? false : true );

if ( get_product_price( get_the_ID(), 0, true ) ) { ?>
	<div class="product-price">
		<p class="price"><?= get_product_price( $post->ID, 0, true, false, $overview ); ?></p>
		<?php
		do_action( 'at_product_before_price_hint' );

		echo get_product_price_hint( $post->ID );

		do_action( 'at_product_after_price_hint' );
		?>
	</div>
<?php } else { ?>
	&nbsp;
<?php } ?>