<?php
class acf_field_code_area_plugin
{	
	function __construct()
	{
		
		add_action('acf/include_field_types', array($this, 'include_field_types'));
	}
	
	function include_field_types( $version ) {
		include_once('acf-code_area-v5.php');
	}
	
}

new acf_field_code_area_plugin();