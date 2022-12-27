<?php

get_header();

/*
 * VARS
 */
global $grid_col, $orderby, $order;
$sidebar                     = at_get_sidebar( 'product', 'archive' );
$sidebar_size                = at_get_sidebar_size( 'product', 'archive' );
$layout                      = ( '' != get_field( 'product_archive_layout', 'option' ) ? get_field( 'product_archive_layout', 'option' ) : 'list' );
$posts_per_page              = ( get_field( 'product_archive_posts_per_page', 'option' ) ? get_field( 'product_archive_posts_per_page', 'option' ) : '12' );
$orderby                     = get_field( 'product_archive_orderby', 'option' );
$order                       = get_field( 'product_archive_order', 'option' );
$grid_col                    = apply_filters( 'at_product_archive_grid_col', ( 'none' == $sidebar ? '3' : '4' ) );
$paged                       = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
$product_archive_text_top    = get_field( 'product_archive_text_top', 'options' );
$product_archive_text_bottom = get_field( 'product_archive_text_bottom', 'options' );

// mobile fallback grid-hover
if ( wp_is_mobile() && ( $layout == 'grid-hover' ) ) {
	$layout = 'grid';
}

/*
 * QUERY
 */
$args              = array();
$args['post_type'] = 'product';
$args['paged']     = $paged;
if ( $posts_per_page ) {
	$args['posts_per_page'] = $posts_per_page;
}

if ( $orderby ) {
	if ( $orderby == 'price' ) {
		$args['meta_key'] = 'product_shops_0_price';
		$args['orderby']  = 'meta_value_num';
	} elseif ( $orderby == 'rating' ) {
		$args['meta_key'] = 'product_rating';
		$args['orderby']  = 'meta_value_num';
	} else {
		$args['orderby'] = $orderby;
	}
}

if ( $order ) {
	$args['order'] = $order;
}

$args = apply_filters( 'at_set_product_archive_query', $args );
?>

<div id="main" class="<?php echo at_get_section_layout_class( 'content' ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-<?php if ( $sidebar == 'none' ) : echo '12'; else: echo $sidebar_size['content']; endif; ?>">
				<div id="content">
					<?php if ( apply_filters( 'at_show_product_page_title', true ) ) { ?>
						<h1><?php at_product_page_title(); ?></h1>
					<?php }

					if ( $product_archive_text_top && ! is_paged() ) {
						echo '<div class="product-archive-text-top">' . $product_archive_text_top . '</div>';
					}

					get_template_part( 'parts/product/code', 'filter-args' );

					query_posts( $args );
					if ( have_posts() ) :
						if ( '1' == get_field( 'product_archive_userfilter', 'option' ) )
							get_template_part( 'parts/product/code', 'filter' );

						if ( 'grid' == $layout || 'grid-hover' == $layout ) echo '<div class="row">';

						while ( have_posts() ) : the_post();
							get_template_part( 'parts/product/loop', $layout );
						endwhile;

						if ( 'grid' == $layout || 'grid-hover' == $layout ) echo '</div>';
						echo atio_pagination( 3 );
					endif;

					if ( $product_archive_text_bottom && ! is_paged() ) {
						echo '<div class="product-archive-text-bottom">' . $product_archive_text_bottom . '</div>';
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
