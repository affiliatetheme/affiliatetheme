<?php



/*
* Get Taxonomies
*
* Gets taxonomies without the built in ones, but grabs categories and tags
*
* @return array Array of taxonomies
* @author Daniel Pataki
* @since 3.0.0
*
*/
function acfats_get_taxonomies() {
	$taxonomies = get_taxonomies( array( '_builtin' => false, 'public' => true ), 'objects' );
	$taxonomies['category'] = get_taxonomy('category');
	$taxonomies['post_tag'] = get_taxonomy('post_tag');
	return $taxonomies;
}

/*
* Get Taxonomies Array
*
* Gets a slug->label array of taxonomies
*
* @return array Array of taxonomies
* @author Daniel Pataki
* @since 3.0.0
*
*/
function acfats_taxonomies_array() {
	$taxonomies = acfats_get_taxonomies();
	$choices = array( 'all' => __( 'All Taxonomies', 'acf-advanced-taxonomy-selector' ) );
	foreach ( $taxonomies as $slug => $taxonomy ) {
		$choices[$slug] = $taxonomy->label;
	}
	return $choices;
}

/*
* Get Post Types Array
*
* Gets a slug->name array of post types
*
* @return array Array of post types
* @author Daniel Pataki
* @since 3.0.0
*
*/
function acfats_post_types_array() {
    $post_types = get_post_types( array( 'public' => true ) );
	$choices = array();
	foreach ( $post_types as $slug => $post_type ) {
		$choices[$slug] = $post_type;
	}
	return $choices;
}


/*
* Get Taxonomies From Selection
*
* Gets only those taxonomies which have been selected
*
* @param array $field The current field options
* @return array Array of selected taxonomies
* @author Daniel Pataki
* @since 3.0.0
*
*/
function acfats_get_taxonomies_from_selection( $field ) {

	if( !empty( $field['post_type'] ) ) {
		$type_taxonomies = get_object_taxonomies( $field['post_type'] );
		$all_taxonomies = get_taxonomies( array(), 'object');
		$taxonomies = array();

		if( !empty( $type_taxonomies ) ) {
			foreach( $type_taxonomies as $slug ) {
				$taxonomies[$slug] = $all_taxonomies[$slug];
			}
		}

		return $taxonomies;
	}

	if( empty( $field['taxonomies'] ) || in_array( 'all', $field['taxonomies'] ) !== false ) {
		$taxonomies = acfats_get_taxonomies();
	}
	else {
		$taxonomies = array();
		foreach( $field['taxonomies'] as $taxonomy_slug ) {
			$taxonomy = get_taxonomy( $taxonomy_slug );
			$taxonomies[$taxonomy->name] = $taxonomy;
		}
	}
	return $taxonomies;
}
