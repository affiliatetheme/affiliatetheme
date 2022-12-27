<?php

/**
 * Affiliate Theme Framework Functions Library - Dont touch this. Use Childthemes!
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    functions
 */

define( 'ATIO_VERSION', '2.0' );
define( 'ENDCORE_LIBRARY', TEMPLATEPATH . '/library' );
define( 'ENDCORE_HELPER', TEMPLATEPATH . '/library/helper' );
define( 'ENDCORE_PLUGINS', TEMPLATEPATH . '/library/plugins' );

/*
 * General
 */
require_once ENDCORE_LIBRARY . '/requirements/_load.php';
require_once ENDCORE_LIBRARY . '/helper/general.php';

// check requirements
if ( xcore_loading_requirements() ) {
	/*
	 * Add-Ons
	 */
	require_once ENDCORE_PLUGINS . '/updater/_load.php';
	require_once ENDCORE_PLUGINS . '/kirki/core/kirki.php';
	require_once ENDCORE_PLUGINS . '/kirki/kirki-functions.php';
	require_once ENDCORE_PLUGINS . '/kirki/kirki-customizer.php';
	require_once ENDCORE_PLUGINS . '/kirki/kirki-css.php';
	require_once ENDCORE_PLUGINS . '/demo-installer/init.php';
	require_once ENDCORE_PLUGINS . '/acf/acf-tooltip/acf-tooltip.php';
	require_once ENDCORE_PLUGINS . '/acf/acf-functions.php';
	require_once ENDCORE_PLUGINS . '/acf/fields/_load.php';
	require_once ENDCORE_PLUGINS . '/acf/export/_load.php';
	require_once ENDCORE_PLUGINS . '/tinymce/_load.php';
	require_once ENDCORE_PLUGINS . '/mobile-detect/Mobile_Detect.php';
	require_once ENDCORE_PLUGINS . '/tax-editor/editor.php';

	/*
	 * Framework functions
	 */
	require_once ENDCORE_LIBRARY . '/helper/_load.php';
	require_once ENDCORE_LIBRARY . '/shop/_load.php';
	require_once ENDCORE_LIBRARY . '/product/_load.php';
	require_once ENDCORE_LIBRARY . '/navigation/_load.php';
	require_once ENDCORE_LIBRARY . '/widgets/_load.php';
	require_once ENDCORE_LIBRARY . '/filter/_load.php';
}