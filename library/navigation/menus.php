<?php
/**
 * Register nav menu
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    navigation
 */

add_action( 'init', function () {
	if ( at_get_topbar() ) {
		register_nav_menu( 'nav_topbar', __( 'Topbar', 'affiliatetheme-backend' ) );
	}

	register_nav_menu( 'nav_main', __( 'Hauptnavigation', 'affiliatetheme-backend' ) );

	if ( at_header_structure() == '5-2-5' ) {
		register_nav_menu( 'nav_main_second', __( 'Hauptnavigation (2)', 'affiliatetheme-backend' ) );
	}

	register_nav_menu( 'nav_footer', __( 'Footer', 'affiliatetheme-backend' ) );
} );