<?php

// Load ACF5
load_plugin_textdomain( 'acf-autocomplete', false, dirname( plugin_basename(__FILE__) ) . '/lang/' ); 

function include_field_types_autocomplete( $version ) {
	
	include_once('acf-autocomplete.php');
	
}

add_action('acf/include_field_types', 'include_field_types_autocomplete');	
?>
