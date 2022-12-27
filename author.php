<?php

get_header();

/*
 * VARS
 */
$sidebar      = at_get_sidebar( 'blog', 'author' );
$sidebar_size = at_get_sidebar_size( 'blog', 'author' );
$layout       = at_get_post_layout( 'author' );
?>

<div id="main" class="<?php echo at_get_section_layout_class( 'content' ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-<?php if ( $sidebar == 'none' ) : echo '12'; else: echo $sidebar_size['content']; endif; ?>">
				<div id="content">
					<?php
					if ( apply_filters( 'at_author_page_title', true ) ) {
						?>
						<h1><?php printf( __( 'Alle Beiträge von <span>%s</span>', 'affiliatetheme' ), get_the_author() ); ?></h1>
						<?php
					}

					echo str_replace( 'avatar-80', 'avatar-80 alignleft', get_avatar( get_the_author_meta( 'user_email' ), $size = '80' ) );

					if ( get_the_author_meta( 'description' ) && ! is_paged() ) { ?>
						<div class="author-description">
							<p class="author-bio">
								<?php the_author_meta( 'description' ); ?>
							</p>
						</div>
					<?php } ?>

					<ul class="list-inline list-author-meta post-meta">
						<?php if ( get_the_author_meta( 'url' ) ) { ?>
							<li class="author-meta-url">
								<i class="fas fa-globe"></i>
								<a href="<?php echo get_the_author_meta( 'url' ); ?>" target="_blank" rel="nofollow"><?php _e( 'Webseite', 'affiliatetheme' ); ?></a></li>
						<?php } ?>

						<?php if ( get_the_author_meta( 'facebook' ) ) { ?>
							<li class="author-meta-facebook">
								<i class="fab fa-facebook"></i>
								<a href="<?php echo get_the_author_meta( 'facebook' ); ?>" target="_blank" rel="nofollow">Facebook</a>
							</li>
						<?php } ?>

						<?php if ( get_the_author_meta( 'twitter' ) ) { ?>
							<li class="author-meta-twitter">
								<i class="fab fa-twitter"></i>
								<a href="https://twitter.com/<?php echo get_the_author_meta( 'twitter' ); ?>" target="_blank" rel="nofollow">Twitter</a>
							</li>
						<?php } ?>
					</ul>

					<div class="clearfix"></div>

					<hr>

					<?php
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
