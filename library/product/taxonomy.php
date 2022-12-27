<?php
/**
 * Taxonomy
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    product
 */

add_action( 'init', function () {
	$taxonomy = get_field( 'product_tax', 'option' );

	if ( is_array( $taxonomy ) ) {
		foreach ( $taxonomy as $tax ) {
			$name             = $tax['name'];
			$slug             = sanitize_title( $tax['slug'] );
			$permalink        = sanitize_title( $tax['permalink'] );
			$hierarchical     = ( $tax['hierarchie'] ? true : false );
			$hierarchical_url = ( $tax['hierarchie_url'] ? true : false );
			register_taxonomy(
				$slug,
				'product',
				array(
					'label'        => __( $name, 'affiliatetheme' ),
					'rewrite'      => array( 'slug' => ( $permalink ?: $slug ), 'with_front' => true, 'hierarchical' => $hierarchical_url ),
					'hierarchical' => $hierarchical,
					'query_var'    => true,
					'sort'         => true,
					'public'       => true,
				)
			);
		}

		flush_rewrite_rules();
	}
}, 0 );

add_filter( 'manage_edit-product_columns', 'product_add_taxonomies', 999 );
function product_add_taxonomies( $columns )
{
	$taxonomy = get_field( 'product_tax', 'option' );

	if ( is_array( $taxonomy ) ) {
		foreach ( $taxonomy as $tax ) {
			if ( $tax['backend'] == '1' )
				$columns[ 'taxonomy-' . $tax['slug'] ] = $tax['name'];
		}
	}

	return $columns;
}
