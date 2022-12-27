<?php

$i         = $args['i'];
$indicator = get_sub_field( 'indicator' );
$arrows    = get_sub_field( 'arrows' );
$fade      = get_sub_field( 'fade' );
$interval  = get_sub_field( 'interval' );
$images    = get_sub_field( 'bilder' );

$attributes = array(
	'id'    => array( get_sub_field( 'id' ) ),
	'class' => array( 'section', 'slideshow', 'item-' . $i ),
	'style' => array(),
);

if ( get_sub_field( 'class' ) ) {
	$attributes['class'][] = get_sub_field( 'class' );
}

if ( get_sub_field( 'id' ) ) {
	$attributes['class'][] = 'id-' . get_sub_field( 'id' );
}

if ( $images ) {
	?>
	<div <?= at_attribute_array_html( $attributes ) ?>>
		<?php
		get_template_part( 'parts/teaser/code', 'teaser', [ 'indicator' => $indicator, 'arrows' => $arrows, 'fade' => $fade, 'interval' => $interval, 'images' => $images ] );
		?>
	</div>
	<?php
}