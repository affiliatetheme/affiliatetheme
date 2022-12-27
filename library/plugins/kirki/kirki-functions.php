<?php
/**
 * Kirki Funktionen
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    kirki
 */

add_action( 'customize_register', 'at_clean_customizer', -1 );
function at_clean_customizer( $WP_Customize_Manager )
{
	if ( isset( $WP_Customize_Manager->nav_menus ) && is_object( $WP_Customize_Manager->nav_menus ) ) {
		remove_filter( 'customize_refresh_nonces', array( $WP_Customize_Manager->nav_menus, 'filter_nonces' ) );
		remove_action( 'wp_ajax_load-available-menu-items-customizer', array( $WP_Customize_Manager->nav_menus, 'ajax_load_available_items' ) );
		remove_action( 'wp_ajax_search-available-menu-items-customizer', array( $WP_Customize_Manager->nav_menus, 'ajax_search_available_items' ) );
		remove_action( 'customize_controls_enqueue_scripts', array( $WP_Customize_Manager->nav_menus, 'enqueue_scripts' ) );
		remove_action( 'customize_register', array( $WP_Customize_Manager->nav_menus, 'customize_register' ), 11 );
		remove_filter( 'customize_dynamic_setting_args', array( $WP_Customize_Manager->nav_menus, 'filter_dynamic_setting_args' ), 10, 2 );
		remove_filter( 'customize_dynamic_setting_class', array( $WP_Customize_Manager->nav_menus, 'filter_dynamic_setting_class' ), 10, 3 );
		remove_action( 'customize_controls_print_footer_scripts', array( $WP_Customize_Manager->nav_menus, 'print_templates' ) );
		remove_action( 'customize_controls_print_footer_scripts', array( $WP_Customize_Manager->nav_menus, 'available_items_template' ) );
		remove_action( 'customize_preview_init', array( $WP_Customize_Manager->nav_menus, 'customize_preview_init' ) );
		remove_filter( 'customize_dynamic_partial_args', array( $WP_Customize_Manager->nav_menus, 'customize_dynamic_partial_args' ), 10, 2 );
	}

	if ( isset( $WP_Customize_Manager->widgets ) && is_object( $WP_Customize_Manager->widgets ) ) {
		remove_filter( 'customize_refresh_nonces', array( $WP_Customize_Manager->widgets, 'filter_nonces' ) );
		remove_action( 'wp_ajax_load-available-menu-items-customizer', array( $WP_Customize_Manager->widgets, 'ajax_load_available_items' ) );
		remove_action( 'wp_ajax_search-available-menu-items-customizer', array( $WP_Customize_Manager->widgets, 'ajax_search_available_items' ) );
		remove_action( 'customize_controls_enqueue_scripts', array( $WP_Customize_Manager->widgets, 'enqueue_scripts' ) );
		remove_action( 'customize_register', array( $WP_Customize_Manager->widgets, 'customize_register' ), 11 );
		remove_filter( 'customize_dynamic_setting_args', array( $WP_Customize_Manager->widgets, 'filter_dynamic_setting_args' ), 10, 2 );
		remove_filter( 'customize_dynamic_setting_class', array( $WP_Customize_Manager->widgets, 'filter_dynamic_setting_class' ), 10, 3 );
		remove_action( 'customize_controls_print_footer_scripts', array( $WP_Customize_Manager->widgets, 'print_templates' ) );
		remove_action( 'customize_controls_print_footer_scripts', array( $WP_Customize_Manager->widgets, 'available_items_template' ) );
		remove_action( 'customize_preview_init', array( $WP_Customize_Manager->widgets, 'customize_preview_init' ) );
		remove_filter( 'customize_dynamic_partial_args', array( $WP_Customize_Manager->widgets, 'customize_dynamic_partial_args' ), 10, 2 );
	}
}

/**
 * Fix kirki bug
 */
add_action( 'init', function () {
	$kirki_downloaded_font_files = get_option( 'kirki_downloaded_font_files' );

	if ( ! is_array( $kirki_downloaded_font_files ) ) {
		update_option( 'kirki_downloaded_font_files', array() );
	}
} );