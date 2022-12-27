<?php

/*
Plugin Name: Advanced Custom Fields: Field Selector
Plugin URI: https://github.com/danielpataki/ACF-Field-Selector
Description: This field for Advanced Custom Fields will let you create an input field for selecting one or more custom fields.
Version: 4.0.0
Author: Daniel Pataki
Author URI: http://danielpataki.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


// Include Common Functions
include_once('functions.php');


add_action('plugins_loaded', 'acffsf_load_textdomain');
/**
 * Load Text Domain
 *
 * Loads the textdomain for translations
 *
 * @author Daniel Pataki
 * @since 4.0.0
 *
 */
function acffsf_load_textdomain() {
	$dir = get_template_directory_uri() . '/library/plugins/acf/field-type-selector';
	load_plugin_textdomain( 'acf-field-selector-field', false, $dir . '/lang/' );
}


add_action('acf/include_field_types', 'include_field_types_field_selector');
/**
 * ACF 5 Field
 *
 * Loads the field for ACF 5
 *
 * @author Daniel Pataki
 * @since 4.0.0
 *
 */
function include_field_types_field_selector( $version ) {
	include_once('acf-field_selector-v5.php');
}



add_action('acf/register_fields', 'register_fields_field_selector');
/**
 * ACF 4 Field
 *
 * Loads the field for ACF 4
 *
 * @author Daniel Pataki
 * @since 4.0.0
 *
 */
function register_fields_field_selector() {
	include_once('acf-field_selector-v4.php');
}




?>
