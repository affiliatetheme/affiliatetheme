<?php
if( function_exists('acf_add_local_field_group') ):
	acf_add_local_field_group(array (
		'key' => 'group_58b8b2b63c1e2',
		'title' => __('Filter - Design', 'affiliatetheme-backend'),
		'fields' => array (
			array (
				'key' => 'field_58b8b2bc8f276',
				'label' => __('Sidebar', 'affiliatetheme-backend'),
				'name' => 'filter_single_sidebar',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'none' => __('Keine', 'affiliatetheme-backend'),
					'left' => __('Links', 'affiliatetheme-backend'),
					'right' => __('Rechts', 'affiliatetheme-backend'),
				),
				'default_value' => array (
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
			array (
				'key' => 'field_58b8b2f08f277',
				'label' => __('Verhältnis (Inhalt / Sidebar)', 'affiliatetheme-backend'),
				'name' => 'filter_single_sidebar_size',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_58b8b2bc8f276',
							'operator' => '==',
							'value' => 'left',
						),
					),
					array (
						array (
							'field' => 'field_58b8b2bc8f276',
							'operator' => '==',
							'value' => 'right',
						),
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'8_4' => '8/4',
					'9_3' => '9/3',
				),
				'default_value' => array (
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
			array (
				'key' => 'field_58b8b3218f278',
				'label' => __('Produktdarstellung', 'affiliatetheme-backend'),
				'name' => 'filter_product_layout',
				'type' => 'select',
				'instructions' => __('Darstellung der Produkte', 'affiliatetheme-backend'),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'list' => __('Liste', 'affiliatetheme-backend'),
					'grid' => __('Grid', 'affiliatetheme-backend'),
					'grid-hover' => __('Grid mit Hover-Effekt', 'affiliatetheme-backend'),
				),
				'default_value' => array (
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
			array (
				'key' => 'field_58b8b36d8f279',
				'label' => __('Produkte pro Seite', 'affiliatetheme-backend'),
				'name' => 'filter_product_per_page',
				'type' => 'number',
				'instructions' => __('Wieviele Produkte sollen pro Seite angezeigt werden?', 'affiliatetheme-backend'),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 12,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => 1,
			),
			array (
				'key' => 'field_58b8b39c8f27a',
				'label' => __('Sortierung', 'affiliatetheme-backend'),
				'name' => 'filter_product_orderby',
				'type' => 'select',
				'instructions' => __('Wie sollen die Produkte in der Übersicht sortiert werden?', 'affiliatetheme-backend'),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'date' => __('Datum', 'affiliatetheme-backend'),
					'name' => __('Name', 'affiliatetheme-backend'),
					'price' => __('Preis', 'affiliatetheme-backend'),
					'rating' => __('Bewertung', 'affiliatetheme-backend'),
					'comments' => __('Kommentare', 'affiliatetheme-backend'),
					'menu_order' => __('Menü Reihenfolge', 'affiliatetheme-backend'),
					'rand' => __('Zufällig', 'affiliatetheme-backend'),
				),
				'default_value' => array (
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
			array (
				'key' => 'field_58b8b4108f27b',
				'label' => __('Reihenfolge', 'affiliatetheme-backend'),
				'name' => 'filter_product_order',
				'type' => 'select',
				'instructions' => __('Wie sollen die Produkte in der Übersicht sortiert werden?', 'affiliatetheme-backend'),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'desc' => __('Absteigend', 'affiliatetheme-backend'),
					'asc' => __('Aufsteigend', 'affiliatetheme-backend'),
				),
				'default_value' => array (
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
			array (
				'key' => 'field_58b8b42f8f27c',
				'label' => __('Benutzer-Filter', 'affiliatetheme-backend'),
				'name' => 'filter_user_filter',
				'type' => 'true_false',
				'instructions' => __('Soll der User einen Filter angezeigt bekommen in dem er die Darstellung sowie die Sortierung der Produkte manuell anpassen kann?', 'affiliatetheme-backend'),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'filter',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
endif;