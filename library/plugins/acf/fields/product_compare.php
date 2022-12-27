<?php
if( function_exists('acf_add_local_field_group') ):
    acf_add_local_field_group(array (
        'key' => 'group_555b2395904ef',
        'title' => __('Produktvergleich', 'affiliatetheme-backend'),
        'fields' => array (
            array (
                'key' => 'field_555b239da3071',
                'label' => __('Hinweis', 'affiliatetheme-backend'),
                'name' => '',
                'type' => 'message',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => __('Der Produktvergleich kann nur fehlerfrei funktionieren wenn die ausgewählen Produkte die gleichen Eigenschaften besitzen. Du kannst so logischerweise keine Autos mit Druckern vergleichen. Wenn du also mehrere Produkttypen in deinem System hast, so wähle bitte die gewünschten Produkte für diesen Vergleich per Hand aus.', 'affiliatetheme-backend'),
                'esc_html' => 0,
            ),
            array (
                'key' => 'field_555b23e3a3072',
                'label' => __('Produkte', 'affiliatetheme-backend'),
                'name' => 'compare_products',
                'type' => 'relationship',
                'instructions' => __('Verfügbare Produkte für diesen Vergleich. Sofern keine Auswahl getroffen wird, werden alle Produkte verwendet.', 'affiliatetheme-backend'),
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'post_type' => array (
                    0 => 'product',
                ),
                'taxonomy' => array (
                ),
                'filters' => array (
                    0 => 'search',
                    1 => 'post_type',
                    2 => 'taxonomy',
                ),
                'elements' => '',
                'min' => '',
                'max' => '',
                'return_format' => 'object',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'templates/compare.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'modified' => 1432036461,
    ));

endif;