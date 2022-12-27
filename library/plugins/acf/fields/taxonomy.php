<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_555af959627b0',
        'title' => __('Einstellungen für diese Taxonomie', 'affiliatetheme-backend'),
        'fields' => array (
            array (
                'key' => 'field_574833b056f80',
                'label' => __('Alternative Überschrift', 'affiliatetheme-backend'),
                'name' => 'taxonomy_headline',
                'type' => 'text',
                'instructions' => __('Sofern angegeben wird die Ausgabe der h1 mit diesem Wert überschrieben.', 'affiliatetheme-backend'),
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                )
            ),
            array (
                'key' => 'field_555af972acc03',
                'label' => __('Bild', 'affiliatetheme-backend'),
                'name' => 'taxonomy_image',
                'type' => 'image',
                'instructions' => __('Hier kannst du ein Bild wie z.B. ein Logo einfügen.', 'affiliatetheme-backend'),
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array (
                'key' => 'field_555af98facc04',
                'label' => __('Erweiterte Beschreibung', 'affiliatetheme-backend'),
                'name' => 'taxonomy_second_description',
                'type' => 'wysiwyg',
                'instructions' => __('Das obere Feld für die Beschreibung zeigt den Text oberhalb der Produkte an. Mit diesem Feld kannst du auch darunter einen Text einfügen. Bedenke das der Text nur auf Seite 1 angezeigt wird.', 'affiliatetheme-backend'),
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
            )
        ),
        'location' => array (
            array (
                array (
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'all',
                ),
                array (
                    'param' => 'taxonomy',
                    'operator' => '!=',
                    'value' => 'category',
                ),
                array (
                    'param' => 'taxonomy',
                    'operator' => '!=',
                    'value' => 'post_tag',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'modified' => 1432025835,
    ));

endif;