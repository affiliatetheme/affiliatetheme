<?php

/*
Plugin Name: Advanced Custom Fields: Advanced Taxonomy Selector
Plugin URI: https://github.com/danielpataki/ACF-Advanced-Taxonomy-Selector
Description: A field for Advanced Custom Fields which allows you to create a field where users can select terms or taxonommies flexibly.
Version: 3.0.0
Author: Daniel Pataki
Author URI: http://danielpataki.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Include Common Functions
include( 'functions.php' );


add_action('plugins_loaded', 'acfatf_load_textdomain');
/**
 * Load Text Domain
 *
 * Loads the textdomain for translations
 *
 * @author Daniel Pataki
 * @since 3.0.0
 *
 */
function acfatf_load_textdomain() {
	$dir = get_template_directory_uri() . '/library/plugins/acf/field-type-taxonomies';
	load_plugin_textdomain( 'acf-advanced-taxonomy-selector', false, $dir . '/lang/' );
}


add_action('acf/include_field_types', 'include_field_types_advanced_taxonomy_selector');
/**
 * ACF 5 Field
 *
 * Loads the field for ACF 5
 *
 * @author Daniel Pataki
 * @since 3.0.0
 *
 */
function include_field_types_advanced_taxonomy_selector( $version ) {
	include_once('acf-advanced_taxonomy_selector-v5.php');
}


add_action('acf/register_fields', 'register_fields_advanced_taxonomy_selector');
/**
 * ACF 4 Field
 *
 * Loads the field for ACF 4
 *
 * @author Daniel Pataki
 * @since 3.0.0
 *
 */
function register_fields_advanced_taxonomy_selector() {
	include_once('acf-advanced_taxonomy_selector-v4.php');
}


?>
