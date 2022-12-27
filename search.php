<?php

get_header();

/*
 * VARS
 */
$allg_search_remove_all = get_field( 'allg_search_remove_all', 'option' );
$sidebar                = at_get_sidebar( 'allg', 'search' );
$sidebar_size           = at_get_sidebar_size( 'allg', 'search' );
$layout                 = apply_filters( 'at_search_layout', array(
	'post'    => 'small',
	'page'    => 'small',
	'product' => 'list',
	'shop'    => 'small',
	'all'     => 'search_list'
) );
$post_types             = at_get_search_post_types();
$post_type_active       = ( isset( $_GET['post_type'] ) ? sanitize_text_field( $_GET['post_type'] ) : $post_types[0] );

// settings when all is inactive
if ( $allg_search_remove_all == '1' ) {
	$_GET['post_type'] = $post_type_active;
}

$url_query = $_GET;
global $wp_query, $grid_col;

$grid_col = apply_filters( 'at_product_search_grid_col', ( 'none' == $sidebar ? '3' : '4' ) );
?>
<div id="main" class="<?= at_get_section_layout_class( 'content' ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-<?php if ( $sidebar == 'none' ) : echo '12'; else: echo $sidebar_size['content']; endif; ?>">
				<div id="content">
					<h1>
						<?php
						if ( isset( $_GET['post_type'] ) ) {
							printf( __( 'Deine Suche im Bereich <span class="highlight">%s</span> nach <span class="highlight">%s</span> ergab <span class="highlight">%s</span> Treffer', 'affiliatetheme' ), at_post_type_label( $post_type_active ), get_search_query(), $wp_query->found_posts );
						} else {
							printf( __( 'Deine Suche nach <span class="highlight">%s</span> ergab <span class="highlight">%s</span> Treffer', 'affiliatetheme' ), get_search_query(), $wp_query->found_posts );
						}
						?>
					</h1>

					<?php if ( $post_types && count( $post_types ) > 1 ) { ?>
						<p><?php _e( 'Über die Schaltflächen für die einzelnen Bereiche kannst Du die Ergebnisliste verfeinern.', 'affiliatetheme' ); ?></p>
					<?php } ?>

					<hr class="transparent">

					<?php
					if ( $post_types && count( $post_types ) > 1 ) {
						echo '<ul class="nav nav-tabs" role="tablist">';
						unset( $url_query['post_type'] );
						$url = http_build_query( $url_query );

						if ( $allg_search_remove_all != '1' ) {
							echo '<li role="presentation" class="' . ( ! isset( $_GET['post_type'] ) ? 'active' : '' ) . '"><a href="' . home_url() . '?' . $url . '">' . __( 'Alle', 'affiliatetheme' ) . '</a></li>';
						}

						foreach ( $post_types as $post_type ) {
							$url_query['post_type'] = $post_type;
							$url                    = http_build_query( $url_query );

							echo '<li role="presentation" class="' . ( isset( $_GET['post_type'] ) && $post_type_active == $post_type ? 'active' : '' ) . '"><a href="' . home_url() . '?' . $url . '">' . at_post_type_label( $post_type ) . '</a></li>';
						}
						echo '</ul><div class="tab-content" id="search-tabs">';
					}

					if ( have_posts() ) :
						if ( $layout['product'] == 'grid' && $post_type_active == 'product' ) {
							echo '<div class="row">';
						}

						while ( have_posts() ) : the_post();
							$post_type_layout = get_post_type();

							switch ( $post_type_layout ) {
								case 'post':
									get_template_part( 'parts/post/loop', $layout['post'] );
									break;

								case 'page':
									get_template_part( 'parts/page/loop', $layout['page'] );
									break;

								case 'product':
									get_template_part( 'parts/product/loop', $layout['product'] );
									break;

								case 'shop':
									get_template_part( 'parts/shop/loop', $layout['shop'] );
									break;

								default:
									get_template_part( 'parts/post/loop', $layout['post'] );
									break;
							}
						endwhile;

						if ( $layout['product'] == 'grid' && $post_type_active == 'product' ) {
							echo '</div>';
						}

						echo atio_pagination( 3 );
					endif;

					if ( $post_types && count( $post_types ) > 1 ) {
						echo '</div>';
					}
					?>

				</div>
			</div>

			<?php if ( 'left' == $sidebar || 'right' == $sidebar ) { ?>
				<div class="col-sm-<?= $sidebar_size['sidebar']; ?>">
					<div id="sidebar">
						<?php get_sidebar(); ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
