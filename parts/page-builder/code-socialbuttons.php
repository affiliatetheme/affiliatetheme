<?php

$i            = $args['i'];
$sidebar      = at_get_sidebar( 'page', 'builder', $post->ID );
$sidebar_size = at_get_sidebar_size( 'page', 'builder', $post->ID );

$attributes = array(
	'id'    => array( get_sub_field( 'id' ) ),
	'class' => array( 'section', 'social-buttons', ' item-' . $i ),
	'style' => array(),
);

if ( get_sub_field( 'class' ) ) {
	$attributes['class'][] = get_sub_field( 'class' );
}

if ( get_sub_field( 'id' ) ) {
	$attributes['class'][] = 'id-' . get_sub_field( 'id' );
}
?>

<div <?= at_attribute_array_html( $attributes ) ?>>
	<?php
	if ( $sidebar == 'none' ) {
		echo '<div class="container">';
	}

	get_template_part( 'parts/stuff/code', 'social' );

	if ( $sidebar == 'none' ) {
		echo '</div>';
	}
	?>
</div>