<?php

if( ! class_exists('acf_field_code_area') ) :

class acf_field_code_area extends acf_field {

	function __construct() {

		// vars
		$this->name = 'code_area';
		$this->label = __('Code Area', 'acf');
		$this->defaults = array(
			'new_lines'		=> '',
			'maxlength'	=> '',
			'placeholder'	=> '',
			'readonly'		=> 0,
			'disabled'		=> 0,
			'rows'			=> ''
		);

		$this->settings = array(
			'path' => get_template_directory() . '/library/plugins/acf/field-type-code',
			'dir' => get_template_directory_uri() . '/library/plugins/acf/field-type-code/',
			'version' => '1.0.0'
		);

		// do not delete!
    	parent::__construct();
	}

	function input_admin_enqueue_scripts()
	{

		// register acf scripts
		wp_register_script( 'acf-input-code_area-code_mirror_js', $this->settings['dir'] . 'js/codemirror.js', array('acf-input'), $this->settings['version'] );
		wp_register_script( 'acf-input-code_area-code_mirror_mode_js', $this->settings['dir'] . 'js/mode/javascript.js', array('acf-input'), $this->settings['version'] );
		wp_register_script( 'acf-input-code_area-code_mirror_mode_css', $this->settings['dir'] . 'js/mode/css.js', array('acf-input'), $this->settings['version'] );
		wp_register_style( 'acf-input-code_area-code_mirror_css', $this->settings['dir'] . 'css/codemirror.css', array('acf-input'), $this->settings['version'] );
		wp_register_script( 'acf-input-code_area-code_mirror_mode_html', $this->settings['dir'] . 'js/mode/htmlmixed.js', array('acf-input'), $this->settings['version'] );
		wp_register_script( 'acf-input-code_area-code_mirror_mode_xml', $this->settings['dir'] . 'js/mode/xml.js', array('acf-input'), $this->settings['version'] );
		wp_register_script( 'acf-input-code_area-code_mirror_mode_php', $this->settings['dir'] . 'js/mode/php.js', array('acf-input'), $this->settings['version'] );
		wp_register_script( 'acf-input-code_area-code_mirror_mode_clike', $this->settings['dir'] . 'js/mode/clike.js', array('acf-input'), $this->settings['version'] );

		// scripts
		wp_enqueue_script(array(
			'acf-input-code_area-code_mirror_js',
			'acf-input-code_area-code_mirror_mode_js',
			'acf-input-code_area-code_mirror_mode_css',
			'acf-input-code_area-code_mirror_mode_html',
			'acf-input-code_area-code_mirror_mode_xml',
			'acf-input-code_area-code_mirror_mode_php',
			'acf-input-code_area-code_mirror_mode_clike',
		));

		// styles
		wp_enqueue_style(array(
			'acf-input-code_area-code_mirror_css',
		));		

	}

	function render_field( $field ) {

		// vars
		$o = array( 'id', 'class', 'name', 'rows' );
		$e = '';

		// maxlength
		if( $field['maxlength'] !== '' ) { $o[] = 'maxlength'; }

		// rows
		if( empty($field['rows']) ) { $field['rows'] = 8; }

		// populate atts
		$atts = array();
		foreach( $o as $k ) {
			$atts[ $k ] = $field[ $k ];
		}

		$e .= '<textarea ' . acf_esc_attr( $atts ) . ' >';
		$e .= $field["value"];
		$e .= '</textarea>';
		$e .= '<link rel="stylesheet" href="'.$this->settings['dir'].'css/theme/'.$field["code_theme"].'.css" />';
		$e .= '<script>';
		$e .= 'jQuery(document).ready(function($){';
		$e .= 'var editor_'.str_replace('-', '_', $field['id']).' = CodeMirror.fromTextArea(document.getElementById(\''.$field['id'].'\'), {';
		$e .= 'lineNumbers: true,';
		$e .= "tabmode: 'indent',";
		$e .= 'mode: \''.$field["code_language"].'\',';
		$e .= 'theme: \''.$field["code_theme"].'\'';
		$e .= ' });';
		$e .= ' });';
		$e .= '</script>';

		// return
		echo $e;

	}

	function render_field_settings( $field ) {

		// ACF4 migration
		if( empty($field['ID']) ) {

			$field['new_lines'] = 'wpautop';

		}

		// default_value
		acf_render_field_setting( $field, array(
			'label'			=> __('Default Value','acf'),
			'instructions'	=> __('Appears when creating a new post','acf'),
			'type'			=> 'textarea',
			'name'			=> 'default_value',
		));

		// maxlength
		acf_render_field_setting( $field, array(
			'label'			=> __('Character Limit','acf'),
			'instructions'	=> __('Leave blank for no limit','acf'),
			'type'			=> 'number',
			'name'			=> 'maxlength',
		));

		// rows
		acf_render_field_setting( $field, array(
			'label'			=> __('Rows','acf'),
			'instructions'	=> __('Sets the textarea height','acf'),
			'type'			=> 'number',
			'name'			=> 'rows',
			'placeholder'	=> 8
		));

		// language
		acf_render_field_setting( $field, array(
			'label'			=> __('Language','acf'),
			'instructions'	=> __('Controls how new lines are rendered','acf'),
			'type'			=> 'radio',
			'name'			=> 'code_language',
			'choices'	=> array(
				'css'	=>	__("CSS",'acf'),
				'javascript'	=>	__("Javascript",'acf'),
				'htmlmixed'	=>	__("HTML",'acf'),
				'php'	=>	__("PHP",'acf'),
			)
		));

		// theme
		acf_render_field_setting( $field, array(
			'label'			=> __('Themes','acf'),
			'instructions'	=> __("Set a theme for the editor (<a href=\"http://codemirror.net/demo/theme.html\" target=\"_blank\">Preview Here</a>) ",'acf'),
			'type'	=>	'select',
			'name'			=> 'code_theme',
			'choices' => array(
						'default'	=>	__("Default",'acf'),
						'ambiance'	=>	__("Ambiance",'acf'),
						'blackboard'	=>	__("Blackboard",'acf'),
						'cobalt'	=>	__("Cobalt",'acf'),
						'eclipse'	=>	__("Eclipse",'acf'),
						'elegant'	=>	__("Elegant",'acf'),
						'erlang-dark'	=>	__("Erlang Dark",'acf'),
						'lesser-dark'	=>	__("Lesser Dark",'acf'),
						'midnight'	=>	__("Midnight",'acf'),
						'monokai'	=>	__("Monokai",'acf'),
						'neat'	=>	__("Neat",'acf'),
						'night'	=>	__("Night",'acf'),
						'rubyblue'	=>	__("Rubyblue",'acf'),
						'solarized'	=>	__("Solarized",'acf'),
						'twilight'	=>	__("Twilight",'acf'),
						'vibrant-ink'	=>	__("Vibrant Ink",'acf'),
						'xq-dark'	=>	__("XQ Dark",'acf'),
						'xq-light'	=>	__("XQ Light",'acf'),
					)
		));

	}

	function format_value( $value, $post_id, $field ) {

		switch($field["code_language"]){
			case 'css':
				return '<style>'.$value.'</style>';
				break;
			case 'javascript':
				return $value;
				break;
			case 'htmlmixed':
				return nl2br($value);
				break;
			case 'php':
				return eval($value);
				break;
			default:
				return $value;
		}

		return $value;

	}

}

new acf_field_code_area();

endif;

?>