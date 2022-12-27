<?php

global $wp;

$slug     = apply_filters( 'at_external_images_script_slug', 'at-get-img' );
$post_id  = $wp->query_vars[ $slug ];
$image_id = $wp->query_vars['image_id'];
$url      = at_external_images_get_image_url( $post_id, $image_id );

if ( $url ) {
	if ( strpos( $url, ".jpg" ) ) {
		header( "Content-Type: image/jpg" );
	}

	if ( strpos( $url, ".gif" ) ) {
		header( "Content-Type: image/gif" );
	}

	if ( strpos( $url, ".png" ) ) {
		header( "Content-Type: image/png" );
	}
	readfile( $url );
}