<?php

$i            = $args['i'];
$sidebar      = at_get_sidebar( 'page', 'builder', get_the_ID() );
$sidebar_size = at_get_sidebar_size( 'page', 'builder', get_the_ID() );
$rows         = get_sub_field( 'rows' );

$attributes = array(
	'id'    => array( get_sub_field( 'id' ) ),
	'class' => array( 'section', 'textarea', 'textarea-row-' . get_sub_field( 'rows' ), 'item-' . $i ),
	'style' => array(),
);

if ( get_sub_field( 'class' ) ) {
	$attributes['class'][] = get_sub_field( 'class' );
}

if ( get_sub_field( 'padding' ) == '1' ) {
	$attributes['class'][] = 'no-padding';
}

if ( get_sub_field( 'id' ) ) {
	$attributes['class'][] = 'id-' . get_sub_field( 'id' );
}

if ( get_sub_field( 'bgcolor' ) ) {
	$attributes['style'][] = 'background-color: ' . get_sub_field( 'bgcolor' ) . ';';
}
?>

<div <?= at_attribute_array_html( $attributes ) ?>>
	<?php
	if ( $sidebar == 'none' ) {
		echo '<div class="container">';
	}

	if ( $rows == 1 ) {
		echo get_sub_field( 'editor_1' );
	} elseif ( $rows == 2 ) {
		?>
		<div class="row">
			<div class="col-sm-6">
				<?= get_sub_field( 'editor_1' ) ?>
			</div>

			<div class="col-sm-6">
				<?= get_sub_field( 'editor_2' ) ?>
			</div>
		</div>
		<?php
	} elseif ( $rows == 3 ) {
		?>
		<div class="row">
			<div class="col-sm-4">
				<?= get_sub_field( 'editor_1' ) ?>
			</div>

			<div class="col-sm-4">
				<?= get_sub_field( 'editor_2' ) ?>
			</div>

			<div class="col-sm-4">
				<?= get_sub_field( 'editor_3' ) ?>
			</div>
		</div>
		<?php
	} elseif ( $rows == 4 ) {
		?>
		<div class="row">
			<div class="col-sm-3">
				<?= get_sub_field( 'editor_1' ) ?>
			</div>

			<div class="col-sm-3">
				<?= get_sub_field( 'editor_2' ) ?>
			</div>

			<div class="col-sm-3">
				<?= get_sub_field( 'editor_3' ) ?>
			</div>

			<div class="col-sm-3">
				<?= get_sub_field( 'editor_4' ) ?>
			</div>
		</div>
		<?php
	}

	if ( $sidebar == 'none' ) {
		echo '</div>';
	}
	?>
</div>