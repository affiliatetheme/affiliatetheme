<?php
/*
 * VARS
 */

global $grid_col;
$grid_col = '4';
$layout   = ( get_field( 'product_single_accessories_layout', 'option' ) ? get_field( 'product_single_accessories_layout', 'option' ) : 'list' );

if ( $accessories = get_field( 'product_accessories' ) ) {
	?>
	<div class="product-accessories">
		<?php
		if ( 'grid' == $layout ) echo '<div class="row">';
		foreach ( $accessories as $post ) {
			setup_postdata( $post );
			if ( $post->post_status != 'publish' ) continue;

			get_template_part( 'parts/product/loop', $layout );

		}
		if ( 'grid' == $layout ) echo '</row">';
		?>
	</div>
	<?php
} else {
	echo apply_filters( 'at_product_accessories_no_results', __( 'Es wurde kein Zubehör gefunden.', 'affiliatetheme' ) );
}
wp_reset_query();
?>