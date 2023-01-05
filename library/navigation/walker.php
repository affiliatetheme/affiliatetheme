<?php
/**
 * Walker für Navigationen
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    navigation
 */

class at_navigation_walker extends Walker_Nav_Menu
{
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
	{
		global $wp_query;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		if ( $args->has_children ) {
			if ( $depth == 0 ) {
				$class_names = "dropdown ";
			} elseif ( $depth > 0 && $depth < 3 ) {
				$class_names = "dropdown dropdown-submenu ";
			}
		}

		$classes = empty( $item->classes ) ? array() : (array)$item->classes;

		$class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		if ( apply_filters( 'the_title', $item->title, $item->ID ) != "divider" ) {
			$output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
		}

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

		if ( $args->has_children && $depth < 3 ) {
			//$attributes .= ' class="dropdown-toggle" ' . (('1' != get_field('design_nav_hover', 'option') || wp_is_mobile()) ? 'data-toggle="dropdown"' : '');
			$attributes .= ' class="dropdown-toggle" ' . ( '1' != get_field( 'design_nav_hover', 'option' ) && ! wp_is_mobile() ? 'data-toggle="dropdown"' : '' );
		}


		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= $args->link_after;

		if ( $args->has_children && $depth < 3 ) {
			$item_output .= ' <b class="caret"></b></a><a href="#" class="extra-toggle dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-plus"></span></a>';
		} else {
			$item_output .= '</a>';
		}
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function start_lvl( &$output, $depth = 0, $args = array(), $id = 0 )
	{
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}

	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output )
	{
		$id_field = $this->db_fields['id'];
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
		}

		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

/**
 * Prevent bugs with old child themes
 *
 * @deprecated 2.0
 */
class description_walker extends at_navigation_walker
{
}