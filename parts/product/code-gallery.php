<?php

$gallery            = get_field( 'product_gallery' );
$gallery_external   = get_field( 'product_gallery_external' );
$product_image_link = get_field( 'product_image_link', 'option' );
$product_fakeshop   = at_is_fake_product( get_the_ID() );
$thumbnail          = get_the_post_thumbnail( get_the_ID(), 'product_gallery', array( 'class' => 'img-responsive' ) );
$thumbnail_tiny     = get_the_post_thumbnail( get_the_ID(), 'product_tiny', array( 'class' => 'img-responsive' ) );

// overwrite gallery, if extern
if ( $gallery_external ) {
	$dsgvo_external_images_proxy = get_field( 'dsgvo_external_images_proxy', 'options' );

	$gallery = array();

	foreach ( $gallery_external as $k => $item ) {
		$hide = $item['hide'];

		if ( $hide == '1' ) {
			continue;
		}

		if ( $dsgvo_external_images_proxy ) {
			$url = at_external_images_get_url( get_the_ID(), $k + 1 );
		} else {
			$url = $item['url'];
		}

		$gallery[] = array(
			'sizes' => array(
				'product_gallery'        => $url,
				'product_gallery-height' => '',
				'product_gallery-width'  => '',
				'product_tiny'           => $url,
				'product_tiny-height'    => '',
				'product_tiny-width'     => '',
			),
			'alt'   => $item['alt']
		);
	}
}
?>
<div class="carousel slide article-slide" id="productGallery">
	<div class='carousel-outer'>
		<div class="carousel-inner cont-slider">
			<?php
			$i = 0;
			if ( $thumbnail ) {
				?>
				<div class="item active">
					<div class="img-wrapper">
						<?php
						if ( '1' == $product_image_link ) {
							$rel                     = apply_filters( 'at_product_link_params_sponsored_tag', true ) ? 'sponsored' : 'nofollow';
							$product_external_target = ( get_field( 'product_external_target', 'option' ) ? get_field( 'product_external_target', 'option' ) : '_blank' );
							echo '<a class="img-wrapper-inner" href="' . get_product_link( get_the_ID() ) . '" title="' . get_the_title() . '" target="' . $product_external_target . '" rel="' . $rel . '">';
						} else {
							echo '<div class="img-wrapper-inner">';
						}

						echo $thumbnail;

						if ( '1' == $product_image_link ) {
							echo '</a>';
						} else {
							echo '</div>';
						}
						?>
					</div>
				</div>
				<?php $i++;
			}

			if ( $gallery ) {
				foreach ( $gallery as $item ) { ?>
					<div class="item <?php if ( ! $thumbnail && $i == 0 ) {
						echo 'active';
					} ?>">
						<div class="img-wrapper">
							<?php
							if ( '1' == $product_image_link ) {
								$rel                     = apply_filters( 'at_product_link_params_sponsored_tag', true ) ? 'sponsored' : 'nofollow';
								$product_external_target = ( get_field( 'product_external_target', 'option' ) ? get_field( 'product_external_target', 'option' ) : '_blank' );
								echo '<a class="img-wrapper-inner" href="' . get_product_link( get_the_ID() ) . '" title="' . get_the_title() . '" target="' . $product_external_target . '" rel="' . $rel . '">';
							} else {
								echo '<div class="img-wrapper-inner">';
							}
							?>

							<img src="<?php echo $item['sizes']['product_gallery']; ?>" width="<?php echo $item['sizes']['product_gallery-height']; ?>" height="<?php echo $item['sizes']['product_gallery-height']; ?>" alt="<?php echo $item['alt']; ?>" class="img-responsive"/>

							<?php
							if ( '1' == $product_image_link ) {
								echo '</a>';
							} else {
								echo '</div>';
							}
							?>
						</div>
					</div>
					<?php
					$i++;
				}
			}
			?>
		</div>

		<?php if ( $gallery ) { ?>
			<a class='left carousel-control' href='#productGallery' data-slide='prev'>
				<span class='glyphicon glyphicon-chevron-left'></span>
			</a>
			<a class='right carousel-control' href='#productGallery' data-slide='next'>
				<span class='glyphicon glyphicon-chevron-right'></span>
			</a>
		<?php } ?>
	</div>

	<?php if ( $gallery ) { ?>
		<ol class="carousel-indicators">
			<?php
			$i = 0;
			if ( $thumbnail_tiny ) {
				?>
				<li class="active" data-slide-to="0 " data-target="#productGallery">
					<?= $thumbnail_tiny; ?>
				</li>
				<?php $i++;
			}
			?>

			<?php
			if ( $gallery ) {
				foreach ( $gallery as $item ) { ?>
					<li class="<?= ! $thumbnail_tiny && $i == 0 ? 'active' : '' ?>" data-slide-to="<?php echo $i; ?>" data-target="#productGallery">
						<img src="<?php echo $item['sizes']['product_tiny']; ?>" width="<?php echo $item['sizes']['product_tiny-height']; ?>" height="<?php echo $item['sizes']['product_tiny-height']; ?>" alt="<?php echo $item['alt']; ?>" class="img-responsive"/>
					</li>
					<?php $i++;
				}
			}
			?>
		</ol>
	<?php } ?>
</div>