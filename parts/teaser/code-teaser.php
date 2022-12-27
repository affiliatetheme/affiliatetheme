<?php

$indicator = $args['indicator'] ?? false;
$arrows    = $args['arrows'] ?? false;
$fade      = $args['fade'] ?? false;
$interval  = $args['interval'] ?? '';
$images    = $args['images'] ?? [];

if ( $images && at_teaser_has_elements( $images ) ) {
	$rand = rand( 100, 900 );
	?>
	<section id="teaser" class="<?php echo at_get_section_layout_class( 'teaser' ); ?>">
		<div id="carousel-teaser-<?php echo $rand; ?>" class="carousel slide <?php if ( '1' == $fade ) echo 'carousel-fade'; ?>" data-ride="carousel" data-interval="<?php echo $interval; ?>">
			<?php if ( "1" != $indicator && count( $images ) > '1' ) { ?>
				<ol class="carousel-indicators">
					<?php for ( $i = 0; $i < count( $images ); $i++ ) { ?>
						<li data-target="#carousel-teaser-<?php echo $rand; ?>" data-slide-to="<?php echo $i; ?>" <?php if ( $i == 0 ) echo 'class="active"'; ?>></li>
					<?php } ?>
				</ol>
			<?php } ?>

			<div class="carousel-inner" role="listbox">
				<?php
				$i = 0;
				foreach ( $images as $image ) {
					$srcset = array();

					$url      = ( isset( $image['url'] ) ? $image['url'] : '' );
					$external = ( isset( $image['external'] ) ? $image['external'] : '' );
					$nofollow = ( isset( $image['nofollow'] ) ? $image['nofollow'] : '' );

					/**
					 * Load Responsive Images
					 */
					$image_smartphone = ( isset( $image['image_smartphone'] ) ? $image['image_smartphone'] : '' );

					if ( $image_smartphone ) {
						$srcset[] = $image_smartphone['url'] . ' 768w';
					}
					?>
					<div class="item<?php if ( $i == 0 ) echo ' active';
					if ( ! $image['image'] ) echo ' item-noimg'; ?>"<?php if ( $image['background'] ) echo ' style="background-color:' . $image['background'] . '"'; ?>>
						<?php
						if ( $url ) {
							echo '<a href="' . $url . '" ' . ( $external == '1' ? 'target="_blank"' : '' ) . ' ' . ( $nofollow == '1' ? 'rel="nofollow"' : '' ) . '>';
						}
						if ( $image['image'] ) { ?>
							<img
									src="<?php echo $image['image']['url']; ?>"
								<?php
								if ( $srcset ) {
									?>
									srcset="<?php echo $image['image']['url'] . ', ' . implode( ', ', $srcset ); ?>"
									<?php
								}
								?>
									width="<?php echo $image['image']['width']; ?>"
									height="<?php echo $image['image']['height']; ?>"
									alt="<?php echo $image['image']['alt']; ?>"
							/>
							<?php
						}
						if ( $image['text'] ) { ?>
							<div class="container">
								<div class="carousel-caption">
									<?php echo $image['text']; ?>
								</div>
							</div>
						<?php }

						if ( $url ) {
							echo '</a>';
						}
						?>
					</div>
					<?php $i++;
				} ?>
			</div>

			<?php if ( "1" != $arrows && count( $images ) > '1' ) { ?>
				<a class="left carousel-control" href="#carousel-teaser-<?php echo $rand; ?>" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel-teaser-<?php echo $rand; ?>" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			<?php } ?>
		</div>
	</section>
<?php }
wp_reset_query(); ?>