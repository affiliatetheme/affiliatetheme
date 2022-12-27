<?php

global $grid_col;
?>
<div class="col-xs-12 col-sm-6 col-sm-4 col-lg-<?= ( ( "" != $grid_col ) ? $grid_col : '3' ); ?>">
	<div class="thumbnail product-grid">
		<div class="caption">
			<div class="img-grid-wrapper">
				<a title="<?php the_title(); ?>" href="<?= get_permalink(); ?>">
					<?= at_post_thumbnail( get_the_ID(), 'product_grid', array( 'class' => 'img-responsive product-img' ) ); ?>
				</a>
			</div>
			<a title="<?php the_title(); ?>" href="<?= get_permalink(); ?>" class="product-title"><?php the_title(); ?></a>
		</div>
	</div>
</div>