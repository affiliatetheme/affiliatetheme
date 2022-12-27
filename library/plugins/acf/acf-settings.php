<?php

/**
 * Set ACF Paths
 * @ref: https://www.advancedcustomfields.com/resources/acf-settings/
 */
add_filter( 'acf/settings/path', 'at_acf_settings_path' );
function at_acf_settings_path( $path ) {
	$path = ENDCORE_PLUGINS . '/acf/core/';

	return $path;

}

add_filter( 'acf/settings/dir', 'at_acf_settings_dir' );
function at_acf_settings_dir( $dir ) {
	$dir = get_template_directory_uri() . '/library/plugins/acf/core/';

	return $dir;
}

/**
 * Turn ACF auto-updates off
 * @ref: https://www.advancedcustomfields.com/resources/acf-settings/
 */
add_filter( 'acf/settings/show_updates', 'at_acf_settings_show_updates' );
function at_acf_settings_show_updates( $path ) {
	return false;
}