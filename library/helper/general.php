<?php
/**
 * General functions before loading other requirements
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    helper
 */

add_filter( 'acf/settings/load_json', function ( $paths ) {
	unset( $paths[0] );
	$uploaddir = wp_upload_dir();
	$path      = $uploaddir['basedir'] . '/acf-json';
	$paths[]   = $path;

	return $paths;
} );