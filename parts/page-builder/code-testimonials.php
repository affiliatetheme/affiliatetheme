<?php

$i            = $args['i'];
$sidebar      = at_get_sidebar( 'page', 'builder', $post->ID );
$sidebar_size = at_get_sidebar_size( 'page', 'builder', $post->ID );
$text         = get_sub_field( 'text' );
$fields       = get_sub_field( 'testimonials' );

$attributes = array(
	'id'    => array( get_sub_field( 'id' ) ),
	'class' => array( 'section', 'testimonials', 'item-' . $i ),
	'style' => array(),
);

if ( get_sub_field( 'id' ) ) {
	$attributes['class'][] = 'id-' . get_sub_field( 'id' );
}

if ( get_sub_field( 'class' ) ) {
	$attributes['class'][] = get_sub_field( 'class' );
}
?>

<div <?= at_attribute_array_html( $attributes ) ?>>
	<?php
	if ( $sidebar == 'none' ) {
		echo '<div class="container">';
	}

	if ( $text ) {
		echo '<div class="inner">' . $text . '</div>';
	}
	?>
	<div class="row">
		<?php
		foreach ( $fields as $field ) {
			$image = $field['image'];
			?>
			<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12">
				<blockquote>
					<?= $field['text'] ?>
					<footer>
						<?php
						if ( $image ) {
							echo wp_get_attachment_image( $image['ID'], 'full', false, [ 'class' => 'img-responsive' ] );
						}

						if ( $field['name'] ) {
							echo '<strong>' . $field['name'] . '</strong>';
						}

						if ( $field['web'] ) {
							?>
							<cite title="<?= $field['name'] ?>">
								<a href="<?= $field['web'] ?>" target="_blank" rel="nofollow">
									<?= at_clean_url( $field['web'] ) ?>
								</a>
							</cite>
							<?php
						}
						?>
					</footer>
				</blockquote>
			</div>
			<?php
		}
		?>
	</div>
	<?php
	if ( $sidebar == 'none' ) {
		echo '</div>';
	}
	?>
</div>