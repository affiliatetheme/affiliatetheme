<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_559279aced3ba',
        'title' => __('Widget: Auswahl von Produkten', 'affiliatetheme-backend'),
        'fields' => array (
            array (
                'key' => 'field_559279b7c9ee7',
                'label' => __('Manuelle zuweisung?', 'affiliatetheme-backend'),
                'name' => 'widget_feed_manual',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => __('Produkte manuell zuweisen', 'affiliatetheme-backend'),
                'default_value' => 0,
            ),
            array (
                'key' => 'field_559279ddc9ee8',
                'label' => __('Produkte', 'affiliatetheme-backend'),
                'name' => 'widget_feed_products',
                'type' => 'relationship',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                    array (
                        array (
                            'field' => 'field_559279b7c9ee7',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
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
                    1 => 'taxonomy',
                ),
                'elements' => '',
                'min' => '',
                'max' => '',
                'return_format' => 'object',
            ),
            array (
                'key' => 'field_559279ddc9ez41ss',
                'label' => __('Produkt IDs', 'affiliatetheme-backend'),
                'name' => 'widget_feed_products_ids',
                'type' => 'text',
                'instructions' => __('Alternativ können hier beliebige Produkt IDs hinterlegt werden. Mehrere IDs bitte kommasepariert angeben. Sofern dieses Feld ausgefüllt wird, wird die Auswahl im oberen Feld überschrieben', 'affiliatetheme-backend'),
                'required' => 0,
                'conditional_logic' => array (
                    array (
                        array (
                            'field' => 'field_559279b7c9ee7',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                )
            ),
            array (
                'key' => 'field_55927d1af8425',
                'label' => __('Taxonomie(n)', 'affiliatetheme-backend'),
                'name' => 'widget_feed_taxonomie',
                'type' => 'advanced_taxonomy_selector',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                    array (
                        array (
                            'field' => 'field_559279b7c9ee7',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'data_type' => 'terms',
                'taxonomies' => array (
                    0 => 'all',
                ),
                'post_type' => array (
                    0 => 'product',
                ),
                'field_type' => 'multiselect',
                'allow_null' => 1,
                'return_value' => 'object',
            ),
            array (
                'key' => 'field_55927d59f8426',
                'label' => __('Anzahl der Produkte', 'affiliatetheme-backend'),
                'name' => 'widget_feed_posts_per_page',
                'type' => 'number',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                    array (
                        array (
                            'field' => 'field_559279b7c9ee7',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 6,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_55927d79f8427',
                'label' => __('Sortierung', 'affiliatetheme-backend'),
                'name' => 'widget_feed_orderby',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                    array (
                        array (
                            'field' => 'field_559279b7c9ee7',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'date' => __('Datum', 'affiliatetheme-backend'),
                    'title' => __('Titel', 'affiliatetheme-backend'),
                    'price' => __('Preis', 'affiliatetheme-backend'),
                    'rating' => __('Bewertung', 'affiliatetheme-backend'),
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
                'key' => 'field_55927dbbf8428',
                'label' => __('Reihenfolge', 'affiliatetheme-backend'),
                'name' => 'widget_feed_order',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                    array (
                        array (
                            'field' => 'field_559279b7c9ee7',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'DESC' => __('Absteigend', 'affiliatetheme-backend'),
                    'ASC' => __('Aufsteigend', 'affiliatetheme-backend'),
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
                'key' => 'field_55927de0f8429',
                'label' => '',
                'name' => 'widget_feed_thumbnail',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => __('Produkbild anzeigen', 'affiliatetheme-backend'),
                'default_value' => 0,
            ),
            array (
                'key' => 'field_55927df9f842a',
                'label' => '',
                'name' => 'widget_feed_rating',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => __('Bewertung anzeigen', 'affiliatetheme-backend'),
                'default_value' => 0,
            ),
            array (
                'key' => 'field_55927e16f842b',
                'label' => '',
                'name' => 'widget_feed_deeplink',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => __('Direkt auf den Shop verlinken', 'affiliatetheme-backend'),
                'default_value' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'widget',
                    'operator' => '==',
                    'value' => 'product_feed',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
    ));

endif;