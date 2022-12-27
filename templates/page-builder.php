<?php

/*
 * Template Name: Page Builder
 */
get_header();

/*
 * VARS
 */
$sidebar      = at_get_sidebar( 'page', 'builder', get_the_ID() );
$sidebar_size = at_get_sidebar_size( 'page', 'builder', get_the_ID() );
?>

	<div id="main" class="<?php echo at_get_section_layout_class( 'content' ); ?>">
		<?php if ( $sidebar != 'none' ) { ?>
		<div class="container">
			<div class="row">
				<div class="col-sm-<?php echo $sidebar_size['content']; ?>">
					<?php } ?>
					<div id="page-builder" class="<?php echo( $sidebar != 'none' ? 'with-sidebar' : '' ); ?>">
						<div id="content">
							<?php
							if ( have_rows( 'page_builder' ) ):
								$i = 0;

								ob_start();
								while ( have_rows( 'page_builder' ) ) : the_row();
									$rowLayout = str_replace( 'page_builder_', '', get_row_layout() );
									get_template_part( 'parts/page-builder/code', $rowLayout, [ 'i' => $i ] );

									$i++;
								endwhile;

								$output = ob_get_contents();
								ob_end_clean();

								remove_filter( 'the_content', 'wpautop' );
								echo apply_filters( 'the_content', $output );
								add_filter( 'the_content', 'wpautop' );
							endif;

							if ( comments_open() ) {
								if ( $sidebar == 'none' ) {
									echo '<div class="container">';
								}

								get_template_part( 'parts/stuff/code', 'comments' );

								if ( $sidebar == 'none' ) {
									echo '</div>';
								}
							}
							?>
						</div>
					</div>

					<?php if ( $sidebar != 'none' ) { ?>
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
	<?php } ?>
	</div>

<?php get_footer(); ?>