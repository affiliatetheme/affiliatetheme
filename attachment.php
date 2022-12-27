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
						<article <?php post_class(); ?>>
							<?php if ( apply_filters( 'at_attachment_page_title', true ) ) { ?>
								<h1><?php the_title(); ?></h1>
							<?php } ?>

							<?php $attachment_link = wp_get_attachment_link( $post->ID, array( 450, 800 ) ); ?>
							<p><?php echo $attachment_link; ?></p>

							<?php the_content(); ?>
						</article>
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
