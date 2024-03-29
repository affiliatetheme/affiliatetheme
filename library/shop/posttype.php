<?php
/**
 * Post Type: Shop
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    shop
 */

add_action( 'init', function() {
	$slug    = '';
	$archive = '';
	$labels  = array(
		'name'          => __( 'Shops', 'affiliatetheme-backend' ),
		'singular_name' => __( 'Shops', 'affiliatetheme-backend' ),
		'add_new'       => __( 'Neuen Shop Erstellen', 'affiliatetheme-backend' ),
		'add_new_item'  => __( 'Neuen Shop hinzuf&uuml;gen', 'affiliatetheme-backend' ),
		'edit_item'     => __( 'Shop editieren', 'affiliatetheme-backend' ),
		'new_item'      => __( 'Neuen Shop', 'affiliatetheme-backend' ),
		'all_items'     => __( 'Shops', 'affiliatetheme-backend' ),
		'view_item'     => __( 'Zeige Shop', 'affiliatetheme-backend' ),
		'search_items'  => __( 'Suche Shop', 'affiliatetheme-backend' ),
		'not_found'     => __( 'Kein Shop gefunden', 'affiliatetheme-backend' ),
		'menu_name'     => __( 'Shops', 'affiliatetheme-backend' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'menu_icon'          => 'dashicons-admin-home',
		'rewrite'            => array( 'slug' => $slug, 'with_front' => true ),
		'has_archive'        => $archive,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'trackbacks', 'comments', 'revisions', 'custom-fields', 'woosidebars' )
	);

	register_post_type( 'shop', $args );

	flush_rewrite_rules();
} );

add_filter( 'post_type_link', 'affiliatetheme_shop_remove_slug', 10, 3 );

function affiliatetheme_shop_remove_slug( $post_link, $post, $leavename )
{
	$active = get_field( 'shop_slug_remove', 'option' );

	if ( $active ) {
		$slug = ( get_field( 'shop_slug', 'option' ) ? get_field( 'shop_slug', 'option' ) : 'shop' );

		if ( 'shop' != $post->post_type || 'publish' != $post->post_status ) {
			return $post_link;
		}

		$post_link = str_replace( '/' . $slug . '/', '/', $post_link );
	}


	return $post_link;
}