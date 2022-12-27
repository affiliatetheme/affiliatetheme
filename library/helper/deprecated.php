<?php
/**
 * Depcrecated functions
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    product
 */

/**
 * @return string
 * @deprecated 2.0
 */
function get_wrapper_id()
{
	_deprecated_function( 'get_wrapper_id', '2.0', 'at_get_wrapper_id' );

	return at_get_wrapper_id();
}

/**
 * @return string
 * @deprecated 2.0
 */
function get_section_layout( $section )
{
	_deprecated_function( 'get_section_layout', '2.0', 'at_get_section_layout' );

	return at_get_section_layout( $section );
}

/**
 * @return string
 * @deprecated 2.0
 */
function get_section_layout_class( $section )
{
	_deprecated_function( 'get_section_layout_class', '2.0', 'at_get_section_layout_class' );

	return at_get_section_layout_class( $section );
}

/**
 * @return array
 * @deprecated 2.0
 */
function get_search_post_types()
{
	_deprecated_function( 'get_search_post_types', '2.0', 'at_get_search_post_types' );

	return at_get_search_post_types();
}