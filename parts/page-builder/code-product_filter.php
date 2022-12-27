<?php

$i            = $args['i'];
$sidebar      = at_get_sidebar( 'page', 'builder', $post->ID );
$sidebar_size = at_get_sidebar_size( 'page', 'builder', $post->ID );
$headline     = get_sub_field( 'headline' );
$filter_id    = get_sub_field( 'filter' );

$attributes = array(
	'id'    => array( get_sub_field( 'id' ) ),
	'class' => array( 'section', 'filter', 'item-' . $i ),
	'style' => array(),
);

if ( get_sub_field( 'class' ) ) {
	$attributes['class'][] = get_sub_field( 'class' );
}

if ( get_sub_field( 'id' ) ) {
	$attributes['class'][] = 'id-' . get_sub_field( 'id' );
}

if ( get_sub_field( 'bgcolor' ) ) {
	$attributes['style'][] = 'background-color: ' . get_sub_field( 'bgcolor' ) . ';';
}

if ( get_sub_field( 'bgimage' ) ) {
	$bgimage               = get_sub_field( 'bgimage' );
	$attributes['style'][] = 'background-image: url(' . $bgimage['url'] . ');';
}
?>

<div <?= at_attribute_array_html( $attributes ) ?>>
	<?php
	if ( $sidebar == 'none' ) {
		echo '<div class="container">';
	}

	if ( $filter_id ) {
		echo do_shortcode( '[at_filter id="' . $filter_id . '" /]' );
	}

	if ( $sidebar == 'none' ) {
		echo '</div>';
	}
	?>
</div>