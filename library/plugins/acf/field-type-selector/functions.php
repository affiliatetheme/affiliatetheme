<?php
/**
* Post Type Restrictions
*
* Adds the type restrictions the field has to the item list
*
* @param array $items The set of items
* @param array $field The data of the current field
* @return array Final list of items
* @author Daniel Pataki
* @since 4.0.0
*
*/
function acffsf_type_filter( $items, $field ) {

	if( !empty( $items ) ) {
	foreach( $items as $key => $item ) {
		if($item['key'] == 'field_5555b422682d6')
			unset( $items[$key] );	

		if( !empty( $field['types'] ) ) {
				if( $field['type_filtering'] == 'include' && !in_array( $item['type'], $field['types'] ) ) {
				unset( $items[$key] );
			}
			if( $field['type_filtering'] == 'exclude' && in_array( $item['type'], $field['types'] ) ) {
				unset( $items[$key] );
			}
		}
	}
	}

	return $items;
}

/**
* Group Restrictions
*
* Adds the group restrictions the field has to the item list
*
* @param array $items The set of items
* @param array $field The data of the current field
* @return array Final list of items
* @author Daniel Pataki
* @since 4.0.0
*
*/
function acffsf_group_filter( $items, $field = [] ) {
    $field['groups'] = at_get_core_fields();
	
	if( !empty( $items ) ) {
        foreach( $items as $key => $item ) {
            //print_r($item['group']); echo ' / ';
            if( !empty( $field['groups'] ) ) {
                    if($field['group_filtering'] == 'include' && (!in_array( $item['group']['ID'], $field['groups'] ) || !in_array( $item['group']['group_key'], $field['groups'] ))) {
                        unset( $items[$key] );
                }
				
                if( $field['group_filtering'] == 'exclude' && (in_array( $item['group']['ID'], $field['groups'] ) || in_array( $item['group']['group_key'], $field['groups'])) ) {
                    unset( $items[$key] );
                }
            }

            if(empty($item['group']['group_key']))
                unset( $items[$key] );
        }
	}

	return $items;
}


/**
* Item Display
*
* Outputs the HTML to show a single item
*
* @param array $items The set of items
* @author Daniel Pataki
* @since 4.0.0
*
*/
function acffsf_show_items( $items ) {
	echo '<ul>';
	if( !empty( $items ) ) {
		foreach( $items as $item ) {
			$search_term = $item['label']  . ' ' . $item['group']['post_title'];
			echo '<li data-search_term="' . $search_term . '" data-key="' . $item['key'] . '"><strong>' . $item['label'] . '</strong><br>' . $item['group']['post_title'] . '</li>';
		}
	}
	echo '</ul>';
}

/**
* Sorting Function
*
* Sorts our items according to their labels
*
* @param string $a First item to compare
* @param string $b Second item to compare
* @return int The result of the comparison
* @author Daniel Pataki
* @since 4.0.0
*
*/
function acffsf_sort_items_by_label($a, $b) {
	return strcmp( $a["label"], $b["label"] );
}
