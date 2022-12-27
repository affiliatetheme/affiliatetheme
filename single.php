<?php

get_header();

/*
 * VARS
 */
$sidebar      = at_get_sidebar( 'blog', 'single' );
$sidebar_size = at_get_sidebar_size( 'blog', 'single' );
?>

<div id="main" class="<?php echo at_get_section_layout_class( 'content' ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-<?php if ( $sidebar == 'none' ) : echo '12'; else: echo $sidebar_size['content']; endif; ?>">
				<div id="content">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article <?php post_class(); ?> role="article">
							<h1><?php the_title(); ?></h1>

							<?php
							if ( '1' == get_field( 'blog_single_show_meta', 'option' ) && at_get_blog_meta_pos( 'top' ) )
								get_template_part( 'parts/stuff/code', 'postmeta' );

							if ( at_get_social( 'blog' ) && ( 'top' == at_get_social_pos( 'blog' ) || 'both' == at_get_social_pos( 'blog' ) ) )
								get_template_part( 'parts/stuff/code', 'social' );

							if ( apply_filters( 'at_show_single_post_thumbnail', false ) && has_post_thumbnail() ) {
								$args = array(
									'class'        => 'img-responsive post-thumbnail',
									'sidebar'      => ( isset( $sidebar ) ? $sidebar : '' ),
									'sidebar_size' => ( isset( $sidebar_size['sidebar'] ) ? $sidebar_size['sidebar'] : '' )
								);

								echo at_post_thumbnail( $post->ID, 'at_large', $args );
							}

							the_content();
							?>
							<div class="clearfix"></div>
						</article>

						<?php
						if ( '1' == get_field( 'blog_single_show_meta', 'option' ) && at_get_blog_meta_pos( 'bottom' ) )
							get_template_part( 'parts/stuff/code', 'postmeta' );

						if ( at_get_social( 'blog' ) && ( 'bottom' == at_get_social_pos( 'blog' ) || 'both' == at_get_social_pos( 'blog' ) ) )
							get_template_part( 'parts/stuff/code', 'social' );

						if ( '1' == get_field( 'blog_single_show_authorbox', 'option' ) )
							get_template_part( 'parts/stuff/code', 'author' );

						if ( '1' == get_field( 'blog_single_show_related', 'option' ) )
							get_template_part( 'parts/stuff/code', 'related' );

						if ( '1' == get_field( 'blog_single_show_postnav', 'option' ) )
							get_template_part( 'parts/stuff/code', 'postnav' );

						get_template_part( 'parts/stuff/code', 'comments' );
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

<?php get_footer(); ?>
