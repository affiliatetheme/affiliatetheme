<?php get_header(); ?>

<div id="main" class="<?= at_get_section_layout_class( 'content' ); ?>">
	<div class="container">
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
</div>

<?php get_footer(); ?>
