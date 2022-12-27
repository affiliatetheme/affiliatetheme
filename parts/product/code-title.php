<h1 class="product-title"><?php the_title(); ?></h1>

<?php
if ( get_product_rating( get_the_ID() ) ) { ?>
	<div class="product-rating">
		<?php
		echo get_product_rating( get_the_ID() );
		if ( get_product_rating_cnt( get_the_ID() ) ) {
			echo '<small>(' . get_product_rating_cnt( get_the_ID() ) . ')</small>';
		}
		?>
	</div>
	<?php
}
?>