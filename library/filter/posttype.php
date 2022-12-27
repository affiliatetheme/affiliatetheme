<?php
/**
 * Post Type: Filter
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    filter
 */

add_action( 'init', function () {
	$labels = array(
		'name'          => __( 'Filter', 'affiliatetheme-backend' ),
		'singular_name' => __( 'Filter', 'affiliatetheme-backend' ),
		'add_new'       => __( 'Neuen Filter Erstellen', 'affiliatetheme-backend' ),
		'add_new_item'  => __( 'Neuen Filter hinzuf&uuml;gen', 'affiliatetheme-backend' ),
		'edit_item'     => __( 'Filter editieren', 'affiliatetheme-backend' ),
		'new_item'      => __( 'Neuen Filter', 'affiliatetheme-backend' ),
		'all_items'     => __( 'Filter', 'affiliatetheme-backend' ),
		'view_item'     => __( 'Zeige Filter', 'affiliatetheme-backend' ),
		'search_items'  => __( 'Suche Filter', 'affiliatetheme-backend' ),
		'not_found'     => __( 'Kein Filter gefunden', 'affiliatetheme-backend' ),
		'menu_name'     => __( 'Filter', 'affiliatetheme-backend' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'hierarchical'       => false,
		'menu_icon'          => 'dashicons-admin-settings',
		'rewrite'            => array( 'slug' => _x( 'filter', 'Filter Slug', 'affiliatetheme-backend' ), 'with_front' => true ),
		'has_archive'        => false,
		'supports'           => array( 'title', 'woosidebars', 'editor' )
	);

	register_post_type( 'filter', $args );

	flush_rewrite_rules();
} );