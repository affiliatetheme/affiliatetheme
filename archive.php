<?php

get_header();

/*
 * VARS
 */
$sidebar      = at_get_sidebar( 'blog', 'archive' );
$sidebar_size = at_get_sidebar_size( 'blog', 'archive' );
$layout       = at_get_post_layout( 'archive' );
?>

<div id="main" class="<?= at_get_section_layout_class( 'content' ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-<?php if ( $sidebar == 'none' ) : echo '12'; else: echo $sidebar_size['content']; endif; ?>">
				<div id="content">
					<?php
					if ( apply_filters( 'at_archive_page_title', true ) ) { ?>
						<h1>
							<?php
							if ( is_day() ) :
								printf( __( 'Tagesarchiv: %s', 'affiliatetheme' ), get_the_date() );
							elseif ( is_month() ) :
								printf( __( 'Monatsarchiv: %s', 'affiliatetheme' ), get_the_date( _x( 'F Y', 'monatliches datum format', 'affiliatetheme' ) ) );
							elseif ( is_year() ) :
								printf( __( 'Jahresarchiv: %s', 'affiliatetheme' ), get_the_date( _x( 'Y', 'jaehrliches datum format', 'affiliatetheme' ) ) );
							else :
								_e( 'Archiv', 'affiliatetheme' );
							endif;
							?>
						</h1>

						<hr>
						<?php
					}

					echo( $layout == 'masonry' ? '<div class="row row-masonry">' : '' );

					if ( have_posts() ) : while ( have_posts() ) : the_post();
						get_template_part( 'parts/post/loop', $layout );
					endwhile; endif;

					echo( $layout == 'masonry' ? '</div>' : '' );

					echo atio_pagination( 3 );
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
