<?php
/**
 * Kirki Customizer
 *
 * @author		Christian Lang
 * @version		1.0
 * @category	kirki
 */

add_action( 'customize_register', 'at_customizer_sections' );
function at_customizer_sections( $wp_customize ) {
    /**
     * Add panels
     */
    $wp_customize->add_panel( 'general', array(
        'priority'    => 10,
        'title'       => __( 'Allgemein', 'affiliatetheme-backend' ),
    ) );

    $wp_customize->add_panel( 'typography', array(
        'priority'    => 20,
        'title'       => __( 'Typography', 'affiliatetheme-backend' ),
    ) );

    $wp_customize->add_panel( 'navigation', array(
        'priority'    => 50,
        'title'       => __( 'Navigation', 'affiliatetheme-backend' ),
    ) );

    $wp_customize->add_panel( 'sidebar', array(
        'priority'    => 60,
        'title'       => __( 'Sidebar', 'affiliatetheme-backend' ),
    ) );

    $wp_customize->add_panel( 'footer', array(
        'priority'    => 70,
        'title'       => __( 'Footer', 'affiliatetheme-backend' ),
    ) );

    /**
     * Add sections
     */
    $wp_customize->add_section( 'general_bg', array(
        'title'       => __( 'Hintergrund', 'affiliatetheme-backend' ),
        'panel'       => 'general',
        'priority'    => 11,
    ) );

    $wp_customize->add_section( 'general_boxed', array(
        'title'       => __( 'Boxed Layout', 'affiliatetheme-backend' ),
        'panel'       => 'general',
        'priority'    => 12,
    ) );

    $wp_customize->add_section( 'typography_headline', array(
        'title'       => __( 'Überschriften', 'affiliatetheme-backend' ),
        'panel'       => 'typography',
        'priority'    => 21,
    ) );

    $wp_customize->add_section( 'typography_text', array(
        'title'       => __( 'Text', 'affiliatetheme-backend' ),
        'panel'       => 'typography',
        'priority'    => 22,
    ) );

    $wp_customize->add_section( 'typography_links', array(
        'title'       => __( 'Links', 'affiliatetheme-backend' ),
        'panel'       => 'typography',
        'priority'    => 23,
    ) );

    $wp_customize->add_section( 'typography_selection', array(
        'title'       => __( 'Selection', 'affiliatetheme-backend' ),
        'panel'       => 'typography',
        'priority'    => 24,
    ) );

    $wp_customize->add_section( 'typography_button_at', array(
        'title'       => __( 'Allgemeiner Button', 'affiliatetheme-backend' ),
        'panel'       => 'typography',
        'priority'    => 25,
    ) );

    $wp_customize->add_section( 'typography_button_detail', array(
        'title'       => __( 'Details Button', 'affiliatetheme-backend' ),
        'panel'       => 'typography',
        'priority'    => 25,
    ) );

    $wp_customize->add_section( 'typography_button_buy', array(
        'title'       => __( 'Kaufen Button', 'affiliatetheme-backend' ),
        'panel'       => 'typography',
        'priority'    => 25,
    ) );

    $wp_customize->add_section( 'typography_button_link', array(
        'title'       => __( 'Link Button', 'affiliatetheme-backend' ),
        'panel'       => 'typography',
        'priority'    => 25,
    ) );

    $wp_customize->add_section( 'topbar', array(
        'title'       => __( 'Topbar', 'affiliatetheme-backend' ),
        'priority'    => 30,
    ) );

    $wp_customize->add_section( 'header', array(
        'title'       => __( 'Header', 'affiliatetheme-backend' ),
        'priority'    => 40,
    ) );

    $wp_customize->add_section( 'navigation_bar', array(
        'title'       => __( 'Leiste', 'affiliatetheme-backend' ),
        'panel'       => 'navigation',
        'priority'    => 51,
    ) );

    $wp_customize->add_section( 'navigation_dropdown', array(
        'title'       => __( 'Dropdown', 'affiliatetheme-backend' ),
        'panel'       => 'navigation',
        'priority'    => 52,
    ) );

    $wp_customize->add_section( 'sidebar_general', array(
        'title'       => __( 'Allgemein', 'affiliatetheme-backend' ),
        'panel'       => 'sidebar',
        'priority'    => 61,
    ) );

    $wp_customize->add_section( 'sidebar_block', array(
        'title'       => __( 'Block', 'affiliatetheme-backend' ),
        'panel'       => 'sidebar',
        'priority'    => 62,
    ) );

    $wp_customize->add_section( 'sidebar_inline', array(
        'title'       => __( 'Inline', 'affiliatetheme-backend' ),
        'panel'       => 'sidebar',
        'priority'    => 63,
    ) );

    $wp_customize->add_section( 'footer_general', array(
        'title'       => __( 'Allgemein', 'affiliatetheme-backend' ),
        'panel'       => 'footer',
        'priority'    => 71,
    ) );

    $wp_customize->add_section( 'footer_w_general', array(
        'title'       => __( 'Widgets: Allgemein', 'affiliatetheme-backend' ),
        'panel'       => 'footer',
        'priority'    => 72,
    ) );

    $wp_customize->add_section( 'footer_w_block', array(
        'title'       => __( 'Widgets: Block', 'affiliatetheme-backend' ),
        'panel'       => 'footer',
        'priority'    => 73,
    ) );

    $wp_customize->add_section( 'footer_w_inline', array(
        'title'       => __( 'Widgets: Inline', 'affiliatetheme-backend' ),
        'panel'       => 'footer',
        'priority'    => 74,
    ) );

    $wp_customize->add_section( 'breadcrumbs', array(
        'title'       => __( 'Breadcrumbs', 'affiliatetheme-backend' ),
        'priority'    => 80,
    ) );

    $wp_customize->add_section( 'product', array(
        'title'       => __( 'Produkte', 'affiliatetheme-backend' ),
        'priority'    => 90,
    ) );

    $wp_customize->add_section( 'table', array(
        'title'       => __( 'Tabellen', 'affiliatetheme-backend' ),
        'priority'    => 95,
    ) );

    $wp_customize->add_section( 'stuff', array(
        'title'       => __( 'Sonstiges', 'affiliatetheme-backend' ),
        'priority'    => 100,
    ) );
}

add_filter( 'kirki/fields', 'at_customizer_fields' );
function at_customizer_fields( $fields ) {
    /*
     * Allgemein
     */
    $fields[] = array(
        'type'        => 'background',
        'settings'     => 'bo_bi',
        'label'       => __( 'Hintergrund', 'affiliatetheme-backend' ),
        'section'     => 'general_bg',
        'default'     => array(
            'background-color'    => '#f0f0f0',
            'background-image'    => '',
            'background-repeat'   => 'no-repeat',
            'background-size'     => 'cover',
            'background-attach'   => 'fixed',
            'background-position' => 'left-top',
        ),
        'output' => array(
            array(
                'element' => 'body',
            ),
        ),
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'wr_bc',
        'label'       => __( 'Hintergrundfarbe', 'affiliatetheme-backend' ),
        'section'     => 'general_boxed',
        'default'     => 'rgba(255,255,255,1)',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '#wrapper, #wrapper-fluid #main',
                'function' => 'css',
                'property' => 'background-color',
            ),
        )
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'wr_sc',
        'label'       => __( 'Schattenfarbe', 'affiliatetheme-backend' ),
        'section'     => 'general_boxed',
        'default'     => 'rgba(221,221,221,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'slider',
        'settings'     => 'wr_ss',
        'label'       => __( 'Schattenstärke', 'affiliatetheme-backend' ),
        'section'     => 'general_boxed',
        'default'     => 10,
        'priority'    => 10,
        'choices'     => array(
            'min'  => 1,
            'max'  => 100,
            'step' => 1
        ),
    );

    /*
     * Typography - Headlines
     */
    $fields[] = array(
        'type'        => 'typography',
        'settings'     => 'ty_fh',
        'label'       => __( 'Überschrift ', 'affiliatetheme-backend' ),
        'description' => '',
        'help'        => '',
        'section'     => 'typography_headline',
		'choices' => [
			'fonts' => [
				'google' => [ 'popularity', 30 ],
			],
		],
        'default'     => array(
            'font-family'    => 'Hind',
            'variant'        => 'regular',
            'color'          => '#101820',
            'text-transform' => 'none',
        ),
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6',
                'function' => 'css',
            ),
        ),
        'output'      => array(
            array(
                'element' => 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6',
            )
        )
    );

    /*$fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_hc',
        'label'       => __( 'Schriftfarbe', 'affiliatetheme-backend' ),
        'section'     => 'typography_headline',
        'default'     => '#101820',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6',
                'function' => 'css',
                'property' => 'color',
            ),
        )
    );*/

    /*
     * Typography - Text
     */
    $fields[] = array(
        'type'        => 'typography',
        'settings'     => 'ty_ft',
        'label'       => __( 'Text ', 'affiliatetheme-backend' ),
        'description' => '',
        'help'        => '',
        'section'     => 'typography_text',
		'choices' => [
			'fonts' => [
				'google' => [ 'popularity', 30 ],
			],
		],
        'default'     => array(
            'font-family'    => 'Open Sans',
            'variant'        => 'regular',
            'color'          => '#6f7479',
            'text-transform' => 'none',
        ),
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => 'body, .product-grid-hover .caption-hover .caption-hover-txt',
                'function' => 'css',
            ),
        ),
        'output'      => array(
            array(
                'element' => 'body, .product-grid-hover .caption-hover .caption-hover-txt',
            )
        )
    );

    /*
     * Typography - Links
     */
    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_lc',
        'label'       => __( 'Linkfarbe', 'affiliatetheme-backend' ),
        'section'     => 'typography_links',
        'default'     => '#c01313',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => 'a',
                'function' => 'css',
                'property' => 'color',
            ),
        )
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_lc_h',
        'label'       => __( 'Linkfarbe (Hover/Focus)', 'affiliatetheme-backend' ),
        'section'     => 'typography_links',
        'default'     => '#c62a2a',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => 'a:hover, a:focus',
                'function' => 'css',
                'property' => 'color',
            ),
        ),
    );

    /*
     * Typography - Selection
     */
    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_sb',
        'label'       => __( 'Hintergrundfarbe', 'affiliatetheme-backend' ),
        'section'     => 'typography_selection',
        'default'     => '#c01313',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '::selection',
                'function' => 'css',
                'property' => 'background',
            ),
            array(
                'element'  => '::-moz-selection',
                'function' => 'css',
                'property' => 'background',
            ),
        ),
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_sc',
        'label'       => __( 'Schriftfarbe', 'affiliatetheme-backend' ),
        'section'     => 'typography_selection',
        'default'     => '#ffffff',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '::selection',
                'function' => 'css',
                'property' => 'color',
            ),
            array(
                'element'  => '::-moz-selection',
                'function' => 'css',
                'property' => 'color',
            ),
        ),
    );

    /*
     * Typography - Buttons
     */
    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_bb',
        'label'       => __( 'Hintergrundfarbe', 'affiliatetheme-backend' ),
        'section'     => 'typography_button_at',
        'default'     => '#c01313',
        'priority'    => 10,

    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_bc',
        'label'       => __( 'Schriftfarbe', 'affiliatetheme-backend' ),
        'section'     => 'typography_button_at',
        'default'     => '#ffffff',
        'priority'    => 10,
        'transport' => 'postMessage',
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_bb_h',
        'label'       => __( 'Hintergrundfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'typography_button_at',
        'default'     => '#c62a2a',
        'priority'    => 10,
        'transport' => 'postMessage',
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_bc_h',
        'label'       => __( 'Schriftfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'typography_button_at',
        'default'     => '#ffffff',
        'priority'    => 10,
        'transport' => 'postMessage',
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_bdb',
        'label'       => __( 'Hintergrundfarbe', 'affiliatetheme-backend' ),
        'section'     => 'typography_button_detail',
        'default'     => '#9fa2a5',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '.btn-details',
                'function' => 'css',
                'property' => 'background-color',
            ),
            array(
                'element'  => '.btn-detail',
                'function' => 'css',
                'property' => 'border-color',
            ),
        ),
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_bdc',
        'label'       => __( 'Schriftfarbe', 'affiliatetheme-backend' ),
        'section'     => 'typography_button_detail',
        'default'     => '#ffffff',
        'priority'    => 10,
        'transport' => 'postMessage',
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '.btn-detail',
                'function' => 'css',
                'property' => 'color',
            )
        ),
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_bdb_h',
        'label'       => __( 'Hintergrundfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'typography_button_detail',
        'default'     => '#a8abae',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '.btn-detail:hover, .btn-detail:focus, .btn-detail:active',
                'function' => 'css',
                'property' => 'background-color',
            ),
            array(
                'element'  => '.btn-detail:hover, .btn-detail:focus, .btn-detail:active',
                'function' => 'css',
                'property' => 'border-color',
            ),
        ),
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_bdc_h',
        'label'       => __( 'Schriftfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'typography_button_detail',
        'default'     => '#ffffff',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '.btn-detail:hover, .btn-detail:focus, .btn-detail:active',
                'function' => 'css',
                'property' => 'color',
            )
        ),
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_bbb',
        'label'       => __( 'Hintergrundfarbe', 'affiliatetheme-backend' ),
        'section'     => 'typography_button_buy',
        'default'     => '#f3961d',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '.btn-buy',
                'function' => 'css',
                'property' => 'background-color',
            ),
            array(
                'element'  => '.btn-buy',
                'function' => 'css',
                'property' => 'border-color',
            ),
        ),
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_bbc',
        'label'       => __( 'Schriftfarbe', 'affiliatetheme-backend' ),
        'section'     => 'typography_button_buy',
        'default'     => '#ffffff',
        'priority'    => 10,
        'transport' => 'postMessage',
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '.btn-buy',
                'function' => 'css',
                'property' => 'color',
            )
        ),
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_bbb_h',
        'label'       => __( 'Hintergrundfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'typography_button_buy',
        'default'     => '#f4a033',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '.btn-buy:hover, .btn-buy:focus, .btn-buy:active',
                'function' => 'css',
                'property' => 'background-color',
            ),
            array(
                'element'  => '.btn-buy:hover, .btn-buy:focus, .btn-buy:active',
                'function' => 'css',
                'property' => 'border-color',
            ),
        ),
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_bbc_h',
        'label'       => __( 'Schriftfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'typography_button_buy',
        'default'     => '#ffffff',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '.btn-buy:hover, .btn-buy:focus, .btn-buy:active',
                'function' => 'css',
                'property' => 'color',
            )
        ),
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_blc',
        'label'       => __( 'Schriftfarbe', 'affiliatetheme-backend' ),
        'section'     => 'typography_button_link',
        'default'     => '#9fa2a5',
        'priority'    => 10,
        'transport' => 'postMessage',
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '.btn-link',
                'function' => 'css',
                'property' => 'color',
            )
        ),
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'ty_blc_h',
        'label'       => __( 'Schriftfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'typography_button_link',
        'default'     => '#6f7479',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '.btn-link:hover, .btn-link:focus, .btn-link:active',
                'function' => 'css',
                'property' => 'color',
            )
        ),
    );

    /*
     * Topbar
     */
    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'to_bc',
        'label'       => __( 'Hintergrundfarbe', 'affiliatetheme-backend' ),
        'section'     => 'topbar',
        'default'     => 'rgba(245,245,245,1)',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '#topbar',
                'function' => 'css',
                'property' => 'background-color',
            )
        ),
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'to_tc',
        'label'       => __( 'Schriftfarbe', 'affiliatetheme-backend' ),
        'section'     => 'topbar',
        'default'     => '#9fa2a5',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '#topbar',
                'function' => 'css',
                'property' => 'color',
            )
        ),
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'to_lc',
        'label'       => __( 'Linkfarbe', 'affiliatetheme-backend' ),
        'section'     => 'topbar',
        'default'     => '#9fa2a5',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '#topbar a',
                'function' => 'css',
                'property' => 'color',
            )
        ),
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'to_lc_h',
        'label'       => __( 'Linkfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'topbar',
        'default'     => '#c01313',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '#topbar a:hover, #topbar a:focus',
                'function' => 'css',
                'property' => 'color',
            )
        ),
    );

    /*
     * Header
     */
    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'he_bc_t',
        'label'       => __( 'Hintergrundfarbe (Top)', 'affiliatetheme-backend' ),
        'section'     => 'header',
        'default'     => 'rgba(255,255,255,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'he_bc_b',
        'label'       => __( 'Hintergrundfarbe (Bottom)', 'affiliatetheme-backend' ),
        'section'     => 'header',
        'default'     => 'rgba(255,255,255,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'he_tc',
        'label'       => __( 'Schriftfarbe', 'affiliatetheme-backend' ),
        'section'     => 'header',
        'default'     => '#9fa2a5',
        'priority'    => 10,
        'transport'   => 'postMessage',
        'js_vars'     => array(
            array(
                'element'  => '#header',
                'function' => 'css',
                'property' => 'color',
            )
        ),
    );

    $fields[] = array(
        'type'        => 'typography',
        'settings'     => 'he_fl',
        'label'       => __( 'Schriftart (Blogname)', 'affiliatetheme-backend' ),
        'description' => '',
        'help'        => '',
        'section'     => 'header',
		'choices' => [
			'fonts' => [
				'google' => [ 'popularity', 30 ],
			],
		],
        'default'     => array(
            'font-family'    => 'Hind',
            'variant'        => 'regular',
            'text-transform' => 'none',
        ),
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'element'  => '#header .brand',
                'function' => 'css',
            ),
        ),
        'output'      => array(
            array(
                'element' => '#header .brand',
            )
        )
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'he_lc',
        'label'       => __( 'Schriftfarbe (Blogname)', 'affiliatetheme-backend' ),
        'section'     => 'header',
        'default'     => '#c01313',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'     => array(
            array(
                'element'  => '#header .brand',
                'function' => 'css',
                'property' => 'color',
            )
        ),
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'he_lc_h',
        'label'       => __( 'Blogname (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'header',
        'default'     => '#101820',
        'priority'    => 10,
        'transport' => 'postMessage',
        'js_vars'     => array(
            array(
                'element'  => '#header .brand:hover, #header .brand:focus',
                'function' => 'css',
                'property' => 'color',
            )
        ),
    );

    /*
     * Navigation
     */
    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'na_bc_t',
        'label'       => __( 'Hintergrundfarbe (Oben)', 'affiliatetheme-backend' ),
        'section'     => 'navigation_bar',
        'default'     => 'rgba(198,42,42,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'na_bc_b',
        'label'       => __( 'Hintergrundfarbe (Unten)', 'affiliatetheme-backend' ),
        'section'     => 'navigation_bar',
        'default'     => 'rgba(172,17,17,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'na_lc',
        'label'       => __( 'Linkfarbe', 'affiliatetheme-backend' ),
        'section'     => 'navigation_bar',
        'default'     => '#ffffff',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'na_ls',
        'label'       => __( 'Linkfarbe (Textschatten)', 'affiliatetheme-backend' ),
        'help'        => 'Wenn du keinen Textschatten möchtest, stell diesen Wert bitte auf 0% Transparenz.',
        'section'     => 'navigation_bar',
        'default'     => 'rgba(0, 0, 0, 0.25)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'na_lc_h',
        'label'       => __( 'Linkfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'navigation_bar',
        'default'     => '#ffffff',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'na_la',
        'label'       => __( 'Linkfarbe (aktiv)', 'affiliatetheme-backend' ),
        'section'     => 'navigation_bar',
        'default'     => '#efc4c4',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'na_lb',
        'label'       => __( 'Linkfarbe (Brand)', 'affiliatetheme-backend' ),
        'section'     => 'navigation_bar',
        'default'     => '#efc4c4',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'na_lb_h_t',
        'label'       => __( 'Hintergrundfarbe (Hover/Oben)', 'affiliatetheme-backend' ),
        'section'     => 'navigation_bar',
        'default'     => 'rgba(63,70,76,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'na_lb_h_b',
        'label'       => __( 'Hintergrundfarbe (Hover/Unten)', 'affiliatetheme-backend' ),
        'section'     => 'navigation_bar',
        'default'     => 'rgba(16,24,32,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'na_bc_l',
        'label'       => __( 'Rahmenfarbe (Links)', 'affiliatetheme-backend' ),
        'section'     => 'navigation_bar',
        'default'     => 'rgba(255,255,255,0.1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'na_bc_r',
        'label'       => __( 'Rahmenfarbe (Rechts)', 'affiliatetheme-backend' ),
        'section'     => 'navigation_bar',
        'default'     => 'rgba(0,0,0,0.1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'na_d_bc',
        'label'       => __( 'Hintergrundfarbe', 'affiliatetheme-backend' ),
        'section'     => 'navigation_dropdown',
        'default'     => 'rgba(16,24,32,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'na_d_lb_h',
        'label'       => __( 'Hintergrundfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'navigation_dropdown',
        'default'     => 'rgba(192,19,19,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'na_d_lc',
        'label'       => __( 'Linkfarbe', 'affiliatetheme-backend' ),
        'section'     => 'navigation_dropdown',
        'default'     => '#ffffff',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'na_d_lc_h',
        'label'       => __( 'Linkfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'navigation_dropdown',
        'default'     => '#ffffff',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'na_d_la',
        'label'       => __( 'Linkfarbe (aktiv)', 'affiliatetheme-backend' ),
        'section'     => 'navigation_dropdown',
        'default'     => '#9fa2a5',
        'priority'    => 10,
    );

    /*
     * Sidebar
     */
    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'sb_bc',
        'label'       => __( 'Hintergrundfarbe', 'affiliatetheme-backend' ),
        'section'     => 'sidebar_general',
        'default'     => 'rgba(250,250,250,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'sb_bb',
        'label'       => __( 'Rahmenfarbe', 'affiliatetheme-backend' ),
        'section'     => 'sidebar_general',
        'default'     => '#eee',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'sb_tc',
        'label'       => __( 'Schriftfarbe', 'affiliatetheme-backend' ),
        'section'     => 'sidebar_general',
        'default'     => '#6f7479',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'sb_tl',
        'label'       => __( 'Text (hell)', 'affiliatetheme-backend' ),
        'section'     => 'sidebar_general',
        'default'     => '#9fa2a5',
        'help'        => __('Wird u.A. für den Counter im Kategorie/Taxonomie Widget verwendet.', 'affiliatetheme-backend' ),
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'custom',
        'settings'     => 'sb_hb_t_hint',
        'label'       => __( 'Überschrift', 'affiliatetheme-backend' ),
        'section'     => 'sidebar_general',
        'default'     => '',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'sb_hc',
        'label'       => __( 'Schriftfarbe', 'affiliatetheme-backend' ),
        'section'     => 'sidebar_general',
        'default'     => '#ffffff',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'sb_hb_t',
        'label'       => __( 'Hintergrundfarbe (Oben)', 'affiliatetheme-backend' ),
        'section'     => 'sidebar_general',
        'default'     => 'rgba(63,70,76,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'sb_hb_b',
        'label'       => __( 'Hintergrundfarbe (Unten)', 'affiliatetheme-backend' ),
        'section'     => 'sidebar_general',
        'default'     => 'rgba(16,24,32,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'sb_lc',
        'label'       => __( 'Linkfarbe', 'affiliatetheme-backend' ),
        'section'     => 'sidebar_block',
        'default'     => '#101820',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'sb_lc_h',
        'label'       => __( 'Linkfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'sidebar_block',
        'default'     => '#c01313',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'sb_lb_h',
        'label'       => __( 'Hintergrundfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'sidebar_block',
        'default'     => 'rgba(255,255,255,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'sb_ilc',
        'label'       => __( 'Linkfarbe', 'affiliatetheme-backend' ),
        'section'     => 'sidebar_inline',
        'default'     => '#101820',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'sb_ilc_h',
        'label'       => __( 'Linkfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'sidebar_inline',
        'default'     => '#c01313',
        'priority'    => 10,
    );

    /*
     * Breadcrumbs
     */
    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'bc_bc',
        'label'       => __( 'Hintergrundfarbe', 'affiliatetheme-backend' ),
        'section'     => 'breadcrumbs',
        'default'     => 'rgba(16,24,32,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'bc_tc',
        'label'       => __( 'Textfarbe', 'affiliatetheme-backend' ),
        'section'     => 'breadcrumbs',
        'default'     => '#6f7479',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'bc_lc',
        'label'       => __( 'Linkfarbe', 'affiliatetheme-backend' ),
        'section'     => 'breadcrumbs',
        'default'     => '#9fa2a5',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'bc_lc_h',
        'label'       => __( 'Linkfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'breadcrumbs',
        'default'     => '#ffffff',
        'priority'    => 10,
    );

    /*
     * Footer
     */
    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'ft_bc',
        'label'       => __( 'Hintergrundfarbe (oben)', 'affiliatetheme-backend' ),
        'section'     => 'footer_general',
        'default'     => 'rgba(255,255,255,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'fb_bc',
        'label'       => __( 'Hintergrundfarbe (unten)', 'affiliatetheme-backend' ),
        'section'     => 'footer_general',
        'default'     => 'rgba(255,255,255,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'fb_tc',
        'label'       => __( 'Textfarbe', 'affiliatetheme-backend' ),
        'section'     => 'footer_general',
        'default'     => '#9fa2a5',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'fb_lc',
        'label'       => __( 'Linkfarbe', 'affiliatetheme-backend' ),
        'section'     => 'footer_general',
        'default'     => '#9fa2a5',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'fb_lc_h',
        'label'       => __( 'Linkfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'footer_general',
        'default'     => '#c01313',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'fw_bc',
        'label'       => __( 'Hintergrundfarbe', 'affiliatetheme-backend' ),
        'section'     => 'footer_w_general',
        'default'     => '#fff',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'fw_bb',
        'label'       => __( 'Rahmenfarbe', 'affiliatetheme-backend' ),
        'section'     => 'footer_w_general',
        'default'     => '#f5f5f5',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'fw_tc',
        'label'       => __( 'Schriftfarbe', 'affiliatetheme-backend' ),
        'section'     => 'footer_w_general',
        'default'     => '#6f7479',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'fw_tl',
        'label'       => __( 'Schriftfarbe (hell)', 'affiliatetheme-backend' ),
        'section'     => 'footer_w_general',
        'default'     => '#9fa2a5',
        'help'        => __('Wird u.A. für den Counter im Kategorie/Taxonomie Widget verwendet.', 'affiliatetheme-backend' ),
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'custom',
        'settings'     => 'fw_hb_t_hint',
        'label'       => __( 'Überschrift', 'affiliatetheme-backend' ),
        'section'     => 'footer_w_general',
        'default'     => '',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'fw_hc',
        'label'       => __( 'Schriftfarbe', 'affiliatetheme-backend' ),
        'section'     => 'footer_w_general',
        'default'     => '#101820',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'fw_hb_t',
        'label'       => __( 'Hintergrundfarbe (Oben)', 'affiliatetheme-backend' ),
        'section'     => 'footer_w_general',
        'default'     => 'rgba(255,255,255,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'fw_hb_b',
        'label'       => __( 'Hintergrundfarbe (Unten)', 'affiliatetheme-backend' ),
        'section'     => 'footer_w_general',
        'default'     => 'rgba(255,255,255,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'checkbox',
        'settings'     => 'fw_hlb',
        'label'       => __( 'Abschließender Rahmen', 'affiliatetheme-backend' ),
        'section'     => 'footer_w_general',
        'help'        => 'Sofern die Headline einen weißen Hintergrund hat, ist es zu empfehlen diesen abschließenden Rahmen zu aktivieren',
        'default'     => '1',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'fw_lc',
        'label'       => __( 'Linkfarbe', 'affiliatetheme-backend' ),
        'section'     => 'footer_w_block',
        'default'     => '#101820',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'fw_lc_h',
        'label'       => __( 'Linkfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'footer_w_block',
        'default'     => '#c01313',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'fw_lb_h',
        'label'       => __( 'Hintergrundfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'footer_w_block',
        'default'     => 'rgba(250,250,250,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'fw_ilc',
        'label'       => __( 'Linkfarbe', 'affiliatetheme-backend' ),
        'section'     => 'footer_w_inline',
        'default'     => '#101820',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'fw_ilc_h',
        'label'       => __( 'Linkfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'footer_w_inline',
        'default'     => '#c01313',
        'priority'    => 10,
    );

    /*
     * Breadcrumbs
     */
    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'bc_bc',
        'label'       => __( 'Hintergrundfarbe', 'affiliatetheme-backend' ),
        'section'     => 'breadcrumbs',
        'default'     => 'rgba(16,24,32,1)',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'bc_tc',
        'label'       => __( 'Textfarbe', 'affiliatetheme-backend' ),
        'section'     => 'breadcrumbs',
        'default'     => '#6f7479',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'bc_lc',
        'label'       => __( 'Linkfarbe', 'affiliatetheme-backend' ),
        'section'     => 'breadcrumbs',
        'default'     => '#9fa2a5',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'bc_lc_h',
        'label'       => __( 'Linkfarbe (Hover)', 'affiliatetheme-backend' ),
        'section'     => 'breadcrumbs',
        'default'     => '#ffffff',
        'priority'    => 10,
    );

    /*
     * Produkte
     */
    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'pr_pr',
        'label'       => __( 'Preis', 'affiliatetheme-backend' ),
        'section'     => 'product',
        'default'     => '#7ab317',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'pr_sp',
        'label'       => __( 'Streichpreis', 'affiliatetheme-backend' ),
        'section'     => 'product',
        'default'     => '#c01313',
        'priority'    => 11,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'pr_stv',
        'label'       => __( 'Sterne (leer)', 'affiliatetheme-backend' ),
        'section'     => 'product',
        'default'     => '#9fa2a5',
        'priority'    => 12,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'pr_stl',
        'label'       => __( 'Sterne (voll)', 'affiliatetheme-backend' ),
        'section'     => 'product',
        'default'     => '#f3961d',
        'priority'    => 13,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'pr_hnt',
        'label'       => __( 'Preis Hinweis', 'affiliatetheme-backend' ),
        'section'     => 'product',
        'default'     => '#9fa2a5',
        'priority'    => 14,
    );

    /*
     * Tabelle
     */
    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'tah_bt',
        'label'       => __( 'Kopfzeile - Hintergrundfarbe (Oben)', 'affiliatetheme-backend' ),
        'section'     => 'table',
        'default'     => '#9fa2a5',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'tah_bb',
        'label'       => __( 'Kopfzeile - Hintergrundfarbe (Unten)', 'affiliatetheme-backend' ),
        'section'     => 'table',
        'default'     => '#6f7479',
        'priority'    => 11,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'tah_tc',
        'label'       => __( 'Kopfzeile - Textfarbe', 'affiliatetheme-backend' ),
        'section'     => 'table',
        'default'     => '#ffffff',
        'priority'    => 12,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'tahi_bt',
        'label'       => __( 'Highlight (Kopfzeile)  - Hintergrundfarbe (Oben)', 'affiliatetheme-backend' ),
        'section'     => 'table',
        'default'     => '#94c245',
        'priority'    => 13,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'tahi_bb',
        'label'       => __( 'Highlight (Kopfzeile) - Hintergrundfarbe (Unten)', 'affiliatetheme-backend' ),
        'section'     => 'table',
        'default'     => '#7ab317',
        'priority'    => 14,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'tahi_tc',
        'label'       => __( 'Highlight (Kopfzeile)  - Textfarbe', 'affiliatetheme-backend' ),
        'section'     => 'table',
        'default'     => '#ffffff',
        'priority'    => 15,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'tahi_td_bc',
        'label'       => __( 'Highlight (Spalte) - Hintergrundfarbe', 'affiliatetheme-backend' ),
        'section'     => 'table',
        'default'     => 'rgba(122,179,23,0.05)',
        'priority'    => 15,
    );

    $fields[] = array(
        'type'        => 'color-alpha',
        'settings'     => 'tahi_td_boc',
        'label'       => __( 'Highlight (Spalte) - Rahmenfarbe', 'affiliatetheme-backend' ),
        'section'     => 'table',
        'default'     => 'rgba(122,179,23,0.1)',
        'priority'    => 15,
    );

    /*
     * Custom
     */
    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'st_c1',
        'label'       => __( 'Custom 1', 'affiliatetheme-backend' ),
        'section'     => 'stuff',
        'description' => __('Dieser Farbwert legt die Farbe für verschiedene Bereiche, wie etwa die Pagination, Tabs, Toggles und den Filter-Slider fest.', 'affiliatetheme-backend'),
        'default'     => '#c01313',
        'priority'    => 10,
    );

    $fields[] = array(
        'type'        => 'color',
        'settings'     => 'st_c2',
        'label'       => __( 'Custom 2', 'affiliatetheme-backend' ),
        'section'     => 'stuff',
        'description' => __('Dieser Farbwert dient vor allem für verlinkte Überschriften, wie etwa Produktname oder Blogtitle (Empfehlung: gleiche Farbe wie Überschriften).', 'affiliatetheme-backend'),
        'default'     => '#101820',
        'priority'    => 11,
    );

    return $fields;
}
?>