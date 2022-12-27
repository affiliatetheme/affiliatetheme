<?php
/*
 * VARS
 */

global $grid_col, $sidebar, $sidebar_size;
$args = array(
	'class'        => 'img-responsive post-thumbnail',
	'sidebar'      => ( isset( $sidebar ) ? $sidebar : '' ),
	'sidebar_size' => ( isset( $sidebar_size['sidebar'] ) ? $sidebar_size['sidebar'] : '' )
);

$grid_col = at_get_blog_col( $sidebar, substr( $sidebar_size['sidebar'], 0, 1 ) );
?>
<article <?php post_class( 'post-masonry col-sm-' . $grid_col ); ?>>
	<div class="post-inner">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?= at_post_thumbnail( get_the_ID(), 'at_thumbnail', $args ); ?>
		</a>

		<h2>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>

		<p><?php the_excerpt(); ?></p>

		<div class="clearfix"></div>
	</div>
</article>