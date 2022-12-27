<?php

get_header();

/*
 * VARS
 */
global $grid_col, $query_string;
$sidebar      = at_get_sidebar( 'shop', 'archive' );
$sidebar_size = at_get_sidebar_size( 'shop', 'archive' );
$grid_col     = ( 'none' == $sidebar ? '3' : '4' );

parse_str( $query_string, $args );
$args['posts_per_page'] = ( '' != get_field( 'shop_archive_posts_per_page', 'option' ) ? get_field( 'shop_archive_posts_per_page', 'option' ) : '12' );
$args                   = apply_filters( 'at_set_shop_archive_query', $args );
?>

<div id="main" class="<?php echo at_get_section_layout_class( 'content' ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-<?php if ( $sidebar == 'none' ) : echo '12'; else: echo $sidebar_size['content']; endif; ?>">
				<div id="content">
					<?php if ( apply_filters( 'at_shop_page_title', true ) ) { ?>
						<h1><?php at_shop_page_title(); ?></h1>
					<?php }

					query_posts( $args );
					if ( have_posts() ) :
						echo '<div class="shop-list"><div class="row">';
						while ( have_posts() ) : the_post();
							get_template_part( 'parts/shop/loop', 'grid' );
						endwhile;
						echo '</div></div>';

						echo atio_pagination( 3 );
					endif; ?>
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
