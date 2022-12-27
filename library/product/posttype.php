<?php
/**
 * Post Type: Produkt
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    product
 */

add_action( 'init', function () {
	$slug             = ( get_field( 'product_slug', 'option' ) ? get_field( 'product_slug', 'option' ) : 'produkt' );
	$product_fakeshop = get_field( 'product_fakeshop', 'option' );
	$archive          = ( '1' != get_field( 'product_archive_remove', 'option' ) ? ( get_field( 'product_archive_slug', 'option' ) ? get_field( 'product_archive_slug', 'option' ) : true ) : false );

	$labels = array(
		'name'          => __( 'Produkte', 'affiliatetheme-backend' ),
		'singular_name' => __( 'Produkt', 'affiliatetheme-backend' ),
		'add_new'       => __( 'Neues Produkt Erstellen', 'affiliatetheme-backend' ),
		'add_new_item'  => __( 'Neues Produkt hinzuf&uuml;gen', 'affiliatetheme-backend' ),
		'edit_item'     => __( 'Produkt editieren', 'affiliatetheme-backend' ),
		'new_item'      => __( 'Neues Produkt', 'affiliatetheme-backend' ),
		'all_items'     => __( 'Produkte', 'affiliatetheme-backend' ),
		'view_item'     => __( 'Zeige Produkt', 'affiliatetheme-backend' ),
		'search_items'  => __( 'Suche Produkt', 'affiliatetheme-backend' ),
		'not_found'     => __( 'Kein Produkt gefunden', 'affiliatetheme-backend' ),
		'menu_name'     => __( 'Produkte', 'affiliatetheme-backend' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => ( ( '1' == $product_fakeshop ) ? false : true ),
		'show_ui'            => true,
		'menu_icon'          => 'dashicons-products',
		'rewrite'            => array( 'slug' => $slug, 'with_front' => true ),
		'has_archive'        => $archive,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'trackbacks', 'comments', 'revisions', 'custom-fields', 'woosidebars' )
	);

	register_post_type( 'product', $args );

	flush_rewrite_rules();
} );

if ( '1' == get_field( 'product_slug_remove', 'option' ) ) {
	add_filter( 'post_type_link', 'affiliatetheme_product_remove_slug', 10, 3 );
	add_action( 'pre_get_posts', 'affiliatetheme_parse_product_request' );
}

function affiliatetheme_product_remove_slug( $post_link, $post, $leavename )
{
	$slug = ( get_field( 'product_slug', 'option' ) ? get_field( 'product_slug', 'option' ) : 'produkt' );

	if ( 'product' != $post->post_type || 'publish' != $post->post_status ) {
		return $post_link;
	}

	$post_link = str_replace( '/' . $slug . '/', '/', $post_link );

	return $post_link;
}

function affiliatetheme_parse_product_request( $query )
{
	if ( ! $query->is_main_query() )
		return;

	if ( 2 != count( $query->query ) || ! isset( $query->query['page'] ) )
		return;

	if ( ! empty( $query->query['name'] ) )
		$query->set( 'post_type', array( 'post', 'product', 'page' ) );
}
