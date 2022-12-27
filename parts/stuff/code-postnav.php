<?php

/*
 * VARS
 */
$in_same_term = ( ( 'category' == get_field( 'blog_single_postnav_filter', 'option' ) ) ? true : '' );
$prev_post    = get_previous_post( $in_same_term );
$next_post    = get_next_post( $in_same_term );

if ( $prev_post || $next_post ) echo '<hr>';
?>
<div class="post-postnav">
	<nav>
		<ul class="pager">
			<?php if ( $prev_post ) : ?>
				<li class="previous">
					<a rel="prev" href="<?= get_permalink( $prev_post->ID ); ?>" title="<?php _e( 'zum Vorherigen Artikel', 'affiliatetheme' ); ?>">
						<small><?php _e( 'Vorheriger Artikel', 'affiliatetheme' ); ?></small>
						<?= get_the_title( $prev_post->ID ); ?>
					</a>
				</li>
			<?php endif; ?>

			<?php if ( $next_post ) : ?>
				<li class="next">
					<a rel="next" href="<?= get_permalink( $next_post->ID ); ?>" title="<?php _e( 'zum Nächsten Artikel', 'affiliatetheme' ); ?>">
						<small><?php _e( 'Nächster Artikel', 'affiliatetheme' ); ?></small>
						<?= get_the_title( $next_post->ID ); ?>
					</a>
				</li>
			<?php endif; ?>
		</ul>
	</nav>
</div>