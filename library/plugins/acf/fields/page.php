<?php
if( function_exists('acf_add_local_field_group') ):
    acf_add_local_field_group(array (
        'key' => 'group_55c9e81610cca',
        'title' => __('Sidebar', 'affiliatetheme-backend'),
        'fields' => array (
            array (
                'key' => 'field_55c9e81add881',
                'label' => __('Verhältnis (Inhalt / Sidebar)', 'affiliatetheme-backend'),
                'name' => 'page_allg_sidebar_size',
                'type' => 'select',
                'instructions' => __('Bestimme hier die Aufteilung von Inhalt und Sidebar.', 'affiliatetheme-backend'),
                'required' => 0,
                'conditional_logic' => 0,
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
                    '' => '',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'ajax' => 0,
                'placeholder' => '',
                'disabled' => 0,
                'readonly' => 0,
            ),
            array (
                'key' => 'field_55c9e876dd882',
                'label' => __('Vorschau', 'affiliatetheme-backend'),
                'name' => '',
                'type' => 'message',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                    array (
                        array (
                            'field' => 'field_55c9e81add881',
                            'operator' => '==',
                            'value' => '8_4',
                        ),
                    ),
                ),
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '<img src="' . get_template_directory_uri() . '/library/helper/images/xcore-content-8-4.jpg" class="img-responsive"/>',
                'esc_html' => 0,
            ),
            array (
                'key' => 'field_55c9e889dd883',
                'label' => __('Vorschau', 'affiliatetheme-backend'),
                'name' => '',
                'type' => 'message',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                    array (
                        array (
                            'field' => 'field_55c9e81add881',
                            'operator' => '==',
                            'value' => '9_3',
                        ),
                    ),
                ),
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '<img src="' . get_template_directory_uri() . '/library/helper/images/xcore-content-9-3.jpg" class="img-responsive"/>',
                'esc_html' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'templates/sidebar-left.php',
                ),
            ),
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'templates/sidebar-right.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'side',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
    ));

endif;