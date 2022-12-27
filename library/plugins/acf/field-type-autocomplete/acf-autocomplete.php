<?php

class acf_field_autocomplete extends acf_field {
	
	function __construct() {
		
		$this->name = 'autocomplete';
		
		$this->label = __('Autocomplete', 'acf-autocomplete');
		
		$this->category = 'basic';
	
		$this->defaults = array(
			'font_size'	=> 14,
		);
		
		$this->l10n = array(
			'error'	=> __('Error! Please enter a higher value', 'acf-autocomplete'),
		);
		
		parent::__construct();
    	
		add_action( 'wp_ajax_autocomplete_ajax', array( $this, 'autocomplete_ajax_callback' ) );
    	
	}
	
	public function autocomplete_ajax_callback() {
		
		global $wpdb;
		
		$results = array();
		
        //$results = array( 'post' => $_POST, 'get' => $_GET );
        
        $results = $wpdb->get_col( $wpdb->prepare( "
         SELECT DISTINCT postmeta2.meta_value FROM $wpdb->postmeta as postmeta1, $wpdb->postmeta as postmeta2 WHERE postmeta1.meta_value = '%s' AND postmeta1.meta_key = CONCAT( '_', postmeta2.meta_key ) AND postmeta2.meta_value LIKE %s",
         $_REQUEST['field_key'],
         '%' . $_REQUEST['request'] . '%'
         ) );
		 
		//echo $wpdb->last_query;
                
		echo json_encode($results);

		wp_die(); 
		
	}
	
	function render_field_settings( $field ) {
	
		acf_render_field_setting( $field, array(
			'label'			=> __('Font Size','acf-autocomplete'),
			'instructions'	=> __('Customise the input font size','acf-autocomplete'),
			'type'			=> 'number',
			'name'			=> 'font_size',
			'prepend'		=> 'px',
		));

	}
	
	function render_field( $field ) {
		
		?>
		<input type="text" name="<?php echo esc_attr($field['name']) ?>" value="<?php echo esc_attr($field['value']) ?>" style="font-size:<?php echo $field['font_size'] ?>px;" />
		<?php
	}
	
	function input_admin_enqueue_scripts() {
		
		$dir = plugin_dir_url( __FILE__ );
		
		wp_register_script( 'acf-input-autocomplete', get_template_directory_uri() . "/library/plugins/acf/field-type-autocomplete/js/input.js", array( "jquery-ui-autocomplete" ) );
		wp_enqueue_script('acf-input-autocomplete');
		
	}
	
}

new acf_field_autocomplete();

?>
