<?php

/*
 * Template Name: Filter
 */
get_header();

/*
 * VARS
 */
global $grid_col, $layout;
$filter       = new AT_Filter();
$sidebar      = $filter->get_sidebar();
$sidebar_size = $filter->get_sidebar_size();
$layout       = $filter->get_product_layout();
$grid_col     = apply_filters( 'at_product_filter_grid_col', ( 'none' == $sidebar ? '3' : '4' ) );

$filter_query = new AT_Filter_Query( $filter );
$args         = apply_filters( 'at_set_product_filter_query', $filter_query->args() );
?>

<div id="main" class="<?php echo at_get_section_layout_class( 'content' ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-<?php if ( $sidebar == 'none' ) : echo '12'; else: echo $sidebar_size['content']; endif; ?>">
				<div id="content">
					<?php $products = new WP_Query( $args ); ?>

					<h1><?php printf( __( 'Deine Suche ergab <span class="highlight">%s</span> Treffer', 'affiliatetheme' ), $products->found_posts ); ?></h1>

					<?php
					if ( apply_filters( 'at_filter_single_show_content', true ) ) {
						echo '<div class="filter-content">';
						the_content();
						echo '</div>';
					}

					if ( $filter->show_on_results_page() ) echo $filter->build();

					if ( at_get_social( 'page' ) && ( 'top' == at_get_social_pos( 'page' ) || 'both' == at_get_social_pos( 'page' ) ) )
						get_template_part( 'parts/stuff/code', 'social' );

					if ( '1' == get_field( 'filter_user_filter' ) )
						get_template_part( 'parts/product/code', 'filter' );

					if ( $filter->is_ajax() ) {
					?>
					<div id="filter-results-<?php echo $filter->post_id; ?>" class="filter-results" data-form-id="<?php echo $filter->post_id; ?>">
						<?php
						}

						if ( $products->have_posts() ) :
							global $o_list;
							$o_list = true;

							if ( 'grid' == $layout ) echo '<div class="row">';

							while ( $products->have_posts() ) : $products->the_post();
								get_template_part( 'parts/product/loop', $layout );
							endwhile;

							if ( 'grid' == $layout ) echo '</div>';
							echo atio_pagination( 3 );

							wp_reset_query();
						else: ?>
							<p><?php _e( 'Es wurden keine Produkte gefunden.', 'affiliatetheme' ); ?></p>
						<?php endif;

						if ( $filter->is_ajax() ) {
						?>
					</div>
				<?php
				}

				if ( at_get_social( 'page' ) && ( 'bottom' == at_get_social_pos( 'page' ) || 'both' == at_get_social_pos( 'page' ) ) )
					get_template_part( 'parts/stuff/code', 'social' );
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
