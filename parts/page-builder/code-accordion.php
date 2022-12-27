<?php

$i            = $args['i'];
$sidebar      = at_get_sidebar( 'page', 'builder', $post->ID );
$sidebar_size = at_get_sidebar_size( 'page', 'builder', $post->ID );
$markup       = get_sub_field( 'markup' );
$text_top     = get_sub_field( 'text_top' );
$text_bottom  = get_sub_field( 'text_bottom' );
$items        = get_sub_field( 'items' );
$accordion_id = rand( 0, 1337 );

$attributes = array(
	'id'    => '',
	'class' => array( 'section', 'accordions', 'item-' . $i ),
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

if ( $items ) {
	?>
	<div <?= at_attribute_array_html( $attributes ) ?>>
		<?php
		if ( $sidebar == 'none' ) {
			echo '<div class="container">';
		}

		if ( $text_top ) {
			echo $text_top;
		}

		$accordions = '[accordiongroup id="' . $accordion_id . '" markup="' . $markup . '"]';
		foreach ( $items as $item ) {
			$accordions .= '[accordion group="' . $accordion_id . '" title="' . $item['title'] . '" active="' . ( $item['active'] ? 'true' : '' ) . '"]' . $item['content'] . '[/accordion]';
		}
		$accordions .= '[/accordiongroup]';

		// merge to output
		echo do_shortcode( $accordions );

		if ( $text_bottom ) {
			echo $text_bottom;
		}

		if ( $sidebar == 'none' ) {
			echo '</div>';
		}
		?>
	</div>
	<?php
}