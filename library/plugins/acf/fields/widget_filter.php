<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_5555f16e6add6',
        'title' => __('Widget: Filter', 'affiliatetheme-backend'),
        'fields' => array (
            array (
                'key' => 'field_5555f17338177',
                'label' => __('Verfügbare Felder', 'affiliatetheme-backend'),
                'name' => 'customfields',
                'type' => 'field_selector',
                'instructions' => __('<strong>Achtung:</strong> Es werden nur Felder des Typs: Nummer, Ja/Nein oder Auswahlfeld angezeigt.', 'affiliatetheme-backend'),
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'group_filtering' => 'exclude',
                'groups' => array(),
                'type_filtering' => 'include',
                'types' => array('number', 'true_false', 'select'),
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'widget',
                    'operator' => '==',
                    'value' => 'filter_widget',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'modified' => 1432025970,
    ));

endif;
