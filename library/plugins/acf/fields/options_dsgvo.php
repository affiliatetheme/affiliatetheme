<?php

if ( function_exists( 'acf_add_local_field_group' ) ):
	acf_add_local_field_group( array(
		'key'                   => 'group_5af14e955e06c',
		'title'                 => __( 'Optionen - DSGVO', 'affiliatetheme-backend' ),
		'fields'                => array(
			array(
				'key'               => 'field_5af163c5125b4',
				'label'             => __( 'Proxy für externe Bilder', 'affiliatetheme-backend' ),
				'name'              => 'dsgvo_external_images_proxy',
				'type'              => 'true_false',
				'instructions'      => __( 'Mit dieser Option werden alle extern geladenen Bilder (z.B. Amazon Bilder) über einen lokale Proxy geladen, so wird verhindert das Daten der Besucher an einen Drittanbieter gesendet werden.', 'affiliatetheme-backend' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '25',
					'class' => '',
					'id'    => '',
				),
				'message'           => __( 'aktivieren', 'affiliatetheme-backend' ),
				'default_value'     => 0,
				'ui'                => 0,
				'ui_on_text'        => '',
				'ui_off_text'       => '',
			),
			array(
				'key'               => 'field_5b0bb0890a379',
				'label'             => __( 'YouTube "No-Cookie"', 'affiliatetheme-backend' ),
				'name'              => 'dsgvo_youtube_nocookie',
				'type'              => 'true_false',
				'instructions'      => __( 'Mit dieser Option werden alle YouTube Embedds automatisch über die "No-Cookie" Methode geladen, d.h. ein Video setzt keine Cookies mehr und wird somit mit der DSGVO kompatibel. Weitere Informationen zur No-Cookie Variante findest du bei YouTube selbst.', 'affiliatetheme-backend' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '25',
					'class' => '',
					'id'    => '',
				),
				'message'           => __( 'aktivieren', 'affiliatetheme-backend' ),
				'default_value'     => 0,
				'ui'                => 0,
				'ui_on_text'        => '',
				'ui_off_text'       => '',
			),
			array(
				'key'               => 'field_5b0bb0d60a37a',
				'label'             => __( 'IP-Adressen in Kommentaren anonymisieren', 'affiliatetheme-backend' ),
				'name'              => 'dsgvo_comment_privacy',
				'type'              => 'true_false',
				'instructions'      => __( 'Mit dieser Option werden IP-Adressen in neuen Kommentaren anonymisiert.', 'affiliatetheme-backend' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '25',
					'class' => '',
					'id'    => '',
				),
				'message'           => __( 'aktivieren', 'affiliatetheme-backend' ),
				'default_value'     => 0,
				'ui'                => 0,
				'ui_on_text'        => '',
				'ui_off_text'       => '',
			),
			array(
				'key'               => 'field_5af151de1f791',
				'label'             => __( 'Rechtlich relevante Seiten', 'affiliatetheme-backend' ),
				'name'              => 'dsgvo_privacy_pages',
				'type'              => 'relationship',
				'instructions'      => __( 'Verknüpfe hier rechtlich relevante Seiten wie deine Datenschutzerklärung und dein Impressum. Diese Seiten werden dann z.B. auf der Weiterleitungsseite des Cloakers angezeigt.', 'affiliatetheme-backend' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'post_type'         => array(),
				'taxonomy'          => array(),
				'filters'           => array(
					0 => 'search',
					1 => 'post_type',
					2 => 'taxonomy',
				),
				'elements'          => '',
				'min'               => '',
				'max'               => '',
				'return_format'     => 'id',
			),
			array(
				'key'               => 'field_5b0bb2a4799fc',
				'label'             => __( 'Datenschutz-Hinweis in Kommentaren', 'affiliatetheme-backend' ),
				'name'              => 'dsgvo_comment_privacy_hint',
				'type'              => 'true_false',
				'instructions'      => __( 'Mit dieser Option kannst du einen Datenschutz-Hinweis in deinen Kommentarformular hinterlegen.', 'affiliatetheme-backend' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '25',
					'class' => '',
					'id'    => '',
				),
				'message'           => __( 'aktivieren', 'affiliatetheme-backend' ),
				'default_value'     => 0,
				'ui'                => 0,
				'ui_on_text'        => '',
				'ui_off_text'       => '',
			),
			array(
				'key'               => 'field_5b0bb3b9799fe',
				'label'             => __( 'Text für Checkbox', 'affiliatetheme-backend' ),
				'name'              => 'dsgvo_comment_privacy_hint_text',
				'type'              => 'text',
				'instructions'      => __( 'Hinterlege hier den Text für die Checkbox im Kommentarformular. Du kannst auch HTML nutzen!', 'affiliatetheme-backend' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '37.5',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			),
			array(
				'key'               => 'field_5b0bb7ca107d1',
				'label'             => __( 'Validierungsmeldung', 'affiliatetheme-backend' ),
				'name'              => 'dsgvo_comment_privacy_hint_validate',
				'type'              => 'text',
				'instructions'      => __( 'Dieser Text wird angezeigt, falls jemand einen Kommentar OHNE Checkbox absenden möchte.', 'affiliatetheme-backend' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '37.5',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => __( 'Bitte stimmen Sie der Speicherung und Verarbeitung Ihrer Daten zu', 'affiliatetheme-backend' ),
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			)
		),
		'location'              => array(
			array(
				array(
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'acf-options-dsgvo',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => 1,
		'description'           => '',
		'modified'              => 1525762708,
	) );
endif;