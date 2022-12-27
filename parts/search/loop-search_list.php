<?php

$args             = array(
	'class' => 'img-responsive product-img',
);
$product_fakeshop = get_field( 'product_fakeshop', 'option' );
$permalink        = get_permalink( get_the_ID() );

if ( get_post_type( $post->ID ) == 'product' && '1' == $product_fakeshop ) {
	$permalink = get_product_link( get_the_ID() );
}
?>
<div class="thumbnail product-list">
	<div class="caption">
		<a title="<?php the_title(); ?>" href="<?= $permalink; ?>" class="product-title" <?= get_product_link_params( get_the_ID(), $product_fakeshop ); ?>>
			<?php the_title(); ?>
		</a>

		<hr class="hidden-xs">

		<p class="post-meta">
			<span class="post-meta-author">
				<?= __( 'Gefunden in', 'affiliatetheme' ) . ' <strong>' . at_post_type_label( get_post_type( get_the_ID() ) ) . '</strong>'; ?>
			</span>
		</p>

		<div class="row">
			<div class="col-md-3 col-sm-6">
				<div class="img-list-wrapper">
					<a title="<?php the_title(); ?>" href="<?= $permalink; ?>" class="product-title" <?= get_product_link_params( get_the_ID(), $product_fakeshop ); ?>>
						<?= at_post_thumbnail( get_the_ID(), 'at_thumbnail', $args ); ?>
					</a>
				</div>
			</div>

			<?php the_excerpt() ?>
		</div>
	</div>
</div>