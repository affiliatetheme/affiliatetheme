<?php

get_header();
global $grid_col;

$sidebar      = at_get_sidebar( 'shop', 'single' );
$sidebar_size = at_get_sidebar_size( 'shop', 'single' );
$loopLayout   = ( get_field( 'shop_single_layout', 'option' ) ? get_field( 'shop_single_layout', 'option' ) : 'list' );
( get_field( 'orderby', 'option' ) ? $args['orderby'] = get_field( 'orderby', 'option' ) : '' );
( get_field( 'orderby', 'option' ) ? $args['order'] = get_field( 'order', 'option' ) : '' );
$grid_col       = ( 'none' == $sidebar ? '3' : '4' );
$posts_per_page = ( get_field( 'shop_single_posts_per_page', 'option' ) ? get_field( 'shop_single_posts_per_page', 'option' ) : '10' );
$paged          = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
?>

<div id="main" class="<?php echo at_get_section_layout_class( 'content' ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-<?php if ( $sidebar == 'none' ) : echo '12'; else: echo $sidebar_size['content']; endif; ?>">
				<div id="content">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article <?php post_class(); ?>>
							<h1><?php the_title(); ?></h1>
							<?php
							if ( at_get_social( 'blog' ) && ( 'top' == at_get_social_pos( 'blog' ) || 'both' == at_get_social_pos( 'blog' ) ) )
								get_template_part( 'parts/stuff/code', 'social' );

							if ( ! is_paged() ) {
								if ( get_shop_logo() )
									echo get_shop_logo();

								the_content();
							}
							?>

							<div class="clearfix"></div>
						</article>

						<?php
						if ( at_get_social( 'products' ) && ( 'bottom' == at_get_social_pos( 'products' ) || 'both' == at_get_social_pos( 'products' ) ) )
							get_template_part( 'parts/stuff/code', 'social' );

					endwhile; endif;

					/*
					 * Produkte des Shops
					 */
					$product_ids = at_get_shop_products();

					if ( $product_ids ) {
						$args = array(
							'post_type'      => 'product',
							'post__in'       => $product_ids,
							'posts_per_page' => $posts_per_page,
							'paged'          => $paged
						);

						get_template_part( 'parts/product/code', 'filter-args' );

						global $products;

						$products = new WP_Query( $args );
						if ( $products->have_posts() ) {
							if ( '1' == get_field( 'shop_single_userfilter', 'option' ) )
								get_template_part( 'parts/product/code', 'filter' );

							if ( 'grid' == $loopLayout ) {
								echo '<div class="row">';
							}

							while ( $products->have_posts() ) : $products->the_post();
								get_template_part( 'parts/product/loop', $loopLayout );
							endwhile;

							if ( 'grid' == $loopLayout ) {
								echo '</div>';
							}

							echo atio_pagination( 2 );

							wp_reset_postdata();
							wp_reset_query();
						}
					}
					?>
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

<?php get_footer(); ?>
