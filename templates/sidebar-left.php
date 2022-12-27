<?php

/*
 * TEMPLATE NAME: Sidebar (Links)
 *
 */
__( 'Sidebar (Links)', 'affiliatetheme' );

get_header();
$sidebar_size = at_get_sidebar_size( 'page', 'allg', $post->ID );
?>

<div id="main" class="<?= at_get_section_layout_class( 'content' ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-<?= $sidebar_size['content']; ?> col-sm-push-<?= $sidebar_size['sidebar']; ?> ">
				<div id="content">
					<?php
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						if ( at_get_social( 'page' ) && ( 'top' == at_get_social_pos( 'page' ) || 'both' == at_get_social_pos( 'page' ) ) ) {
							get_template_part( 'parts/stuff/code', 'social' );
						}

						the_content();

						wp_link_pages( 'before=<div class="page-nav">Seite:&after=</div>&link_before=<span>&link_after=</span>' );

						if ( at_get_social( 'page' ) && ( 'bottom' == at_get_social_pos( 'page' ) || 'both' == at_get_social_pos( 'page' ) ) ) {
							get_template_part( 'parts/stuff/code', 'social' );
						}

						get_template_part( 'parts/stuff/code', 'comments' );
					endwhile; endif;
					?>
				</div>
			</div>

			<div class="col-sm-<?= $sidebar_size['sidebar']; ?>  col-sm-pull-<?= $sidebar_size['content']; ?>">
				<div id="sidebar">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
