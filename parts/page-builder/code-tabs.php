<?php

$i            = $args['i'];
$sidebar      = at_get_sidebar( 'page', 'builder', $post->ID );
$sidebar_size = at_get_sidebar_size( 'page', 'builder', $post->ID );
$text_top     = get_sub_field( 'text_top' );
$text_bottom  = get_sub_field( 'text_bottom' );
$items        = get_sub_field( 'items' );
$tab_id       = rand( 0, 1337 );

$attributes = array(
	'id'    => '',
	'class' => array( 'section', 'tabs', 'item-' . $i ),
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

		$titles = array();

		// grab titles
		foreach ( $items as $item ) {
			$titles[] = $item['title'];
		}

		$tabs = '[tabs style="tab" id="' . $tab_id . '" title="' . implode( ',', $titles ) . '"]';
		foreach ( $items as $k => $item ) {
			$tabs .= '[tab id="' . ( $k + 1 ) . '" tid="' . $tab_id . '"]' . $item['content'] . '[/tab]';
		}
		$tabs .= '[/tabs]';

		// merge to output
		echo do_shortcode( $tabs );

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