<?php

get_header();

/*
 * VARS
 */
$sidebar      = at_get_sidebar( 'blog', 'tag' );
$sidebar_size = at_get_sidebar_size( 'blog', 'tag' );
$layout       = at_get_post_layout( 'tag' );
?>

<div id="main" class="<?php echo at_get_section_layout_class( 'content' ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-<?php if ( $sidebar == 'none' ) : echo '12'; else: echo $sidebar_size['content']; endif; ?>">
				<div id="content">
					<?php
					echo apply_filters( 'at_tag_page_title', '<h1>' . single_cat_title( '', false ) . '</h1>' );

					if ( tag_description() && ! is_paged() ) {
						echo tag_description() . '<hr>';
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
