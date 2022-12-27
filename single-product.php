<?php

get_header();

/*
 * VARS
 */
global $product_shops;
$sidebar       = at_get_sidebar( 'product', 'single' );
$sidebar_size  = at_get_sidebar_size( 'product', 'single' );
$product_shops = get_field( 'product_shops' );
?>

<div id="main" class="<?php echo at_get_section_layout_class( 'content' ); ?>">
	<div class="container">
		<div class="row" id="product-details">
			<div class="col-sm-8 col-sm-push-4">
				<?php get_template_part( 'parts/product/code', 'title' ); ?>

				<?php if ( $product_shops ) { ?>
					<div class="row">
						<div class="col-md-6 col-md-push-6">
							<?php
							if ( show_price_compare( get_the_ID(), 'top' ) ) {
								get_template_part( 'parts/product/code', 'compare-box' );
							} else {
								get_template_part( 'parts/product/code', 'buybox' );
							}
							?>
						</div>

						<div class="col-md-6 col-md-pull-6">
							<?php get_template_part( 'parts/product/code', 'details' ); ?>
						</div>
					</div>
				<?php } else { ?>
					<?php get_template_part( 'parts/product/code', 'details' ); ?>
				<?php } ?>

				<?php get_template_part( 'parts/product/code', 'description' ); ?>
			</div>

			<div class="col-sm-4 col-sm-pull-8">
				<?php get_template_part( 'parts/product/code', 'gallery' ); ?>
			</div>
		</div>

		<hr>

		<?php get_template_part( 'parts/product/code', 'reviews' ); ?>

		<div class="row" id="product-infos">
			<div class="col-sm-<?php if ( $sidebar == 'none' ) : echo '12'; else: echo $sidebar_size['content']; endif; ?>">
				<div id="content">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article <?php post_class(); ?>>
							<?php
							if ( at_get_social( 'product' ) && ( 'top' == at_get_social_pos( 'product' ) || 'both' == at_get_social_pos( 'product' ) ) )
								get_template_part( 'parts/stuff/code', 'social' );
							?>

							<?php get_template_part( 'parts/product/code', 'tabs' ); ?>
						</article>

						<?php
						if ( show_price_compare( $post->ID, 'bottom' ) ) {
							get_template_part( 'parts/product/code', 'compare' );
						}

						if ( at_show_price_trend( $post->ID, 'bottom' ) ) {
							get_template_part( 'parts/product/code', 'price_trend' );
						}

						if ( at_get_social( 'product' ) && ( 'bottom' == at_get_social_pos( 'product' ) || 'both' == at_get_social_pos( 'product' ) ) ) {
							get_template_part( 'parts/stuff/code', 'social' );
						}

						get_template_part( 'parts/product/code', 'buybox-big' );
						?>
					<?php endwhile; endif; ?>
				</div>
			</div>

			<?php if ( 'left' == $sidebar || 'right' == $sidebar ) { ?>
				<div class="col-sm-<?php echo $sidebar_size['sidebar']; ?>">
					<div id="sidebar">
						<?php get_sidebar(); ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<?php
if ( at_show_price_trend( $post->ID, 'modal' ) ) {
	get_template_part( 'parts/product/code', 'price_trend-modal' );
}

get_footer();
?>
