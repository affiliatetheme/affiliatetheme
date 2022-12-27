<?php
/**
 * ACF 5 Field Class
 *
 * This file holds the class required for our field to work with ACF 5
 *
 * @author Daniel Pataki
 * @since 4.0.0
 *
 */

/**
 * ACF 5 Role Selector Class
 *
 * The Field selector class enables users to select other fields from
 * the ones created with ACF. This is the class that is used for ACF 4.
 *
 * @author Daniel Pataki
 * @since 4.0.0
 *
 */

class acf_field_field_selector extends acf_field {


	/**
	 * Field Constructor
	 *
	 * Sets basic properties and runs the parent constructor
	 *
	 * @author Daniel Pataki
	 * @since 3.0.0
	 *
	 */
	function __construct() {

		$this->name = 'field_selector';
		$this->label = __('Field Selector', 'acf-field-selector-field');
		$this->category = __("Choice",'acf');
		$this->defaults = array(
			'style' => '',
			'group_filtering' => 'include',
			'groups' => '',
			'type_filtering'  => 'include',
			'types'  => ''
		);

    	parent::__construct();

        add_filter( 'acffsf/item_filters', 'acffsf_group_filter', 10, 2 );
		add_filter( 'acffsf/item_filters', 'acffsf_type_filter', 10, 2 );


	}


	/**
	 * Field Options
	 *
	 * Creates the options for the field, they are shown when the user
	 * creates a field in the back-end. Currently there are Two fields.
	 *
	 * The Group Filtering settings allow you to filter the fields shown to
	 * the user based on their group. You can include or exclude groups
	 * separated by commas.
	 *
	 * The Type Filtering settings allow you to filter the fields shown to
	 * the user based on their type. You can include or exclude types
	 * separated by commas.
	 *
	 * @param array $field The details of this field
	 * @author Daniel Pataki
	 * @since 4.0.0
	 *
	 */
	function render_field_settings( $field ) {

		$field = array_merge($this->defaults, $field);
		if( !empty( $field['types'] ) ) {
			$field['types'] = implode(',', $field['types']);
		}
		else {
			$field['types'] = '';
		}

		if( !empty( $field['groups'] ) ) {
			$field['groups'] = implode(',', $field['groups']);
		}
		else {
			$field['groups'] = '';
		}

		acf_render_field_setting( $field, array(
			'label'			=> __('Style','acf-field-selector-field'),
			'instructions'	=> __('','acf-field-selector-field'),
			'type'			=> 'radio',
			'name'			=> 'style',
			'layout'	=>	'horizontal',
			'choices'	=>	array(
				'dual_view' => __('Dual view', 'acf-field-selector-field'),
				'select' => __('Select', 'acf-field-selector-field'),
			),
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Group Filtering','acf-field-selector-field'),
			'instructions'	=> __('Set how the given groups are used','acf-field-selector-field'),
			'type'			=> 'radio',
			'name'			=> 'group_filtering',
			'layout'	=>	'horizontal',
			'choices'	=>	array(
				'include' => __('Include', 'acf-field-selector-field'),
				'exclude' => __('Exclude', 'acf-field-selector-field'),
			),
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Groups','acf-field-selector-field'),
			'instructions'	=> __('Set the ID of groups to include or exclude','acf-field-selector-field'),
			'type'			=> 'text',
			'name'			=> 'groups',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Type Filtering','acf-field-selector-field'),
			'instructions'	=> __('Set how the given types are used','acf-field-selector-field'),
			'type'			=> 'radio',
			'name'			=> 'type_filtering',
			'layout'	=>	'horizontal',
			'choices'	=>	array(
				'include' => __('Include', 'acf-field-selector-field'),
				'exclude' => __('Exclude', 'acf-field-selector-field'),
			),
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Types','acf-field-selector-field'),
			'instructions'	=> __('Set the types to include or exclude','acf-field-selector-field'),
			'type'			=> 'text',
			'name'			=> 'types',
		));


	}



	/**
	 * Field Display
	 *
	 * This function takes care of displaying our field to the users, taking
	 * the field options into account.
	 *
	 * @param array $field The details of this field
	 * @author Daniel Pataki
	 * @since 4.0.0
	 *
	 */
	function render_field( $field ) {
		if($field['style'] == 'select') {
			$selected = esc_attr($field['value']);
			$selectable = $this->get_items( $field, $this->get_selectable_item_fields( $field, true ), true, true );
			
			$select_group = array();
			
			foreach($selectable as $k => $v) {
				$select_group[$v['group']['post_title']][] = $v;
			}
			?>
			<select id="field-value" name="<?php echo esc_attr($field['name']) ?>" >
				<?php 
				foreach($select_group as $k => $v) {
					?>
					<optgroup label="<?php echo $k; ?>">
						<?php 
						foreach($v as $item) {
							switch($item['type']) {
								case 'number':
									$type = __('Nummernfeld', 'affiliatetheme-backend');
									break;
									
								case 'select':
									$type = __('Auswahlfeld', 'affiliatetheme-backend');
									break;
									
								case 'true_false':
									$type = __('Ja/Nein', 'affiliatetheme-backend');
									break;
									
								default:
									$type = $item['type'];
									break;
							}
							
							echo '<option value="' . $item['key'] . '"' . ($item['key'] == $selected ? ' selected' : '') . '>' . $item['label'] . ' (' . $type . ')</option>';
						}
						?>
					</optgroup>
					<?php
				}
				?>
			</select>
			<?php
		} else {
			?>
			<div class='multiselector'>
				<div class='selectable-container field-container'>
					<div class='title'><?php _e( 'Verfügbare Felder', 'affiliatetheme-backend' ) ?></div>
					<div class='search'><input type='text' id="field-search" placeholder='<?php _e( 'Suche', 'affiliatetheme-backend') ?> '></div>
					<div class='selectable field'>
						<?php
						$selectable = $this->get_items( $field, $this->get_selectable_item_fields( $field ) );
						acffsf_show_items( $selectable );
						?>
					</div>
				</div>
				<div class='selected-container field-container'>
					<div class='title'><?php _e( 'Gewählte Felder', 'affiliatetheme-backend' ) ?></div>
					<div class='message'><?php _e( 'Drag & Drop Sortierung', 'affiliatetheme-backend' ) ?></div>
					<div class='selected field'>
						<?php
							$selected = $this->get_items( $field, $this->get_selected_item_fields( $field ), false );
							acffsf_show_items( $selected );
						?>
					</div>
				</div>
				<input type='hidden' id='field-value' name='<?php echo esc_attr($field['name']) ?>' value="<?php echo esc_attr($field['value']) ?>">
			</div>
			<?php
		}
	}


	/**
	 * Enqueue Assets
	 *
	 * This function enqueues the scripts and styles needed to display the
	 * field
	 *
	 * @author Daniel Pataki
	 * @since 4.0.0
	 *
	 */
	function input_admin_enqueue_scripts() {

		$dir = get_template_directory_uri() . '/library/plugins/acf/field-type-selector/';

		// register ACF scripts
		wp_enqueue_script( 'acf-input-field_selector', $dir . 'js/input.js', array('acf-input'), '1' );
		wp_enqueue_style( 'acf-input-field_selector', $dir . 'css/input.css', array('acf-input'), '1' );

		wp_enqueue_script( 'jquery-ui-sortable' );

	}





	/**
	 * Pre-Save Value Modification
	 *
	 * This filter is applied to the $value before it is updated in the db
	 *
	 * @param mixed $value The value which will be saved in the database
	 * @param int $post_id The $post_id of which the value will be saved
	 * @param array $field The field array holding all the field options
	 * @return mixed The new value
	 * @author Daniel Pataki
	 * @since 4.0.0
	 *
	 */
	function update_field( $field ) {

		if( !empty( $field['types'] ) ) {
			$field['types'] = array_map( 'trim', explode( ',', $field['types'] ) );
		}
		else {
			$field['types'] = array();
		}

		if( !empty( $field['groups'] ) ) {
			$field['groups'] = array_map( 'trim', explode( ',', $field['groups'] ) );
		}
		else {
			$field['groups'] = array();
		}

		return $field;

	}

	/**
	 * Format Value
	 *
	 * This filter is applied to the $value after it is loaded from the db and
	 * before it is passed back to the API functions such as the_field
	 *
	 * @param mixed $value The value which was loaded from the database
	 * @param int $post_id The $post_id from which the value was loaded
	 * @param array $field The field array holding all the field options
	 * @return mixed The new value
	 * @author Daniel Pataki
	 * @since 4.0.0
	 *
	 */
	function format_value( $value, $post_id, $field ) {		
		if( !empty( $value ) && is_array( $value )) {
			$value = json_decode( $value, true );
		}

		return $value;
	}

	/**
	 * Get Items
	 *
	 * Retrieves items to show for the dual pane viewer
	 *
	 * @param array $field The data of the current field
	 * @param array $items Items to show
	 * @param bool $sort Wether to sort or not
	 * @return array Final list of items to show
 	 * @author Daniel Pataki
	 * @since 4.0.0
	 *
	 */
	function get_items( $field = [], $items, $sort = true) {
		$final_items = array();		
		$groups = acf_get_field_groups();

		// php 8 fix
        if ( ! is_array( $field ) ) {
            $field = [];
        }
		
		if( !empty( $items ) ) {
			foreach( $items as $item ) {
				$group_key = '';
				
				$item_value = get_field_object( $item->post_name );
				
				foreach($groups as $group) {
					if($group['ID'] == $item->post_parent) {
						$group_key = $group['key']; 
						break;
					}
				
				}
				
				$item_value['group'] = array(
					'ID' => $item->post_parent,
					'group_key' => $group_key,
					'post_title' => get_the_title( $item->post_parent )
				);

				if(isset($item_value['key']))
					$final_items[$item_value['key']] = $item_value;
			}

			if( $sort == true ) {
				usort($final_items, 'acffsf_sort_items_by_label' );
			}

		}

		$final_items = apply_filters( 'acffsf/item_filters', $final_items, $field, $final_items );

		return $final_items;
	}



	/**
	 * Get Selectable Items
	 *
	 * Retrieves a list of selectable fields
	 *
	 * @param array $field The data of the current field
	 * @return array Final list of items
 	 * @author Daniel Pataki
	 * @since 4.0.0
	 *
	 */
	function get_selectable_item_fields( $field, $all = false ) {
		global $wpdb;

		$field_keys = array();
		$field_keys_query = 9999;

		

		if($all) {
			$fields = $wpdb->get_results( "SELECT post_name, post_parent FROM $wpdb->posts WHERE post_parent IN (SELECT ID FROM $wpdb->posts WHERE post_type = 'acf-field-group' )" );
		} else {
			if( !empty( $field['value'] ) ) {
				$field_keys = json_decode( $field['value'], true );
				$field_keys_query = "'" . implode( "', '", $field_keys ) . "'";
			}
			$fields = $wpdb->get_results( "SELECT post_name, post_parent FROM $wpdb->posts WHERE post_parent IN (SELECT ID FROM $wpdb->posts WHERE post_type = 'acf-field-group' ) AND post_name NOT IN ( $field_keys_query ) " );
		}

		return $fields;

	}


	/**
	 * Get Selected items
	 *
	 * Gets the items the user has selected
	 *
	 * @param array $field The data of the current field
	 * @return array Final list of items
 	 * @author Daniel Pataki
	 * @since 4.0.0
	 *
	 */
	function get_selected_item_fields( $field ) {
		global $wpdb;

		$field_keys = array();
		$field_keys_query = 9999;

		if( !empty( $field['value'] ) ) {
			$field_keys = json_decode( $field['value'], true );
			$field_keys_query = "'" . implode( "', '", $field_keys ) . "'";
		}

		$fields = $wpdb->get_results( "SELECT post_name, post_parent FROM $wpdb->posts WHERE post_parent IN (SELECT ID FROM $wpdb->posts WHERE post_type = 'acf-field-group' ) AND post_name IN ( $field_keys_query ) " );

		$sortable_fields = array();
		foreach( $fields as $field ) {
			$sortable_fields[$field->post_name] = $field;
		}

		$fields = array();
		foreach( $field_keys as $key ) {
			if(isset($sortable_fields[$key])) {
				$fields[] = $sortable_fields[$key];
			}
		}

		return $fields;

	}


}

new acf_field_field_selector();

?>
