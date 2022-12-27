<?php

/**
 * Language Files
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    helper
 */
add_action( 'after_setup_theme', 'at_load_frontend_language_files', 10 );
function at_load_frontend_language_files()
{
	load_theme_textdomain( 'affiliatetheme', get_template_directory() . '/languages/frontend' );
	load_theme_textdomain( 'affiliatetheme-backend', get_template_directory() . '/languages/backend' );
}

function at_locale_is( $lang )
{
	$locale = get_locale();

	if ( strpos( $lang, $locale ) !== false ) {
		return true;
	}

	return false;
}