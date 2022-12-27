<?php

global $product_items;

if ( is_array( $product_items ) ) {
	$i = 1;
	?>
	<div class="product_top_rated">
		<?php
		foreach ( $product_items as $key => $val ) {
			$product_fakeshop = at_is_fake_product( $key ); ?>
			<div class="top_rated_item row">
				<div class="col-sm-8">
					<p>
						<span class="number"><?php echo $i; ?></span>
						<span class="title"><a href="<?php echo( ( '1' == $product_fakeshop ) ? get_product_link( $key ) : get_permalink( $key ) ); ?>" title="<?php echo get_the_title( $key ); ?>"><?php echo get_the_title( $key ); ?></a></span>
					</p>
				</div>
				<div class="col-sm-4">
					<div class="progress">
						<div class="progress-bar progress-green" role="progressbar" aria-valuenow="<?php echo $val; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $val; ?>%;">
							<?php echo $val; ?>%
						</div>
					</div>
				</div>
			</div>
			<?php
			$i++;
		}
		?>
	</div>
	<?php
}