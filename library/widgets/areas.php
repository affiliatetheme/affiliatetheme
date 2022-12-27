<?php
/**
 * Register sidebars
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    widgets
 */

add_action( 'init', function () {
	register_sidebar( array(
		'name'          => __( 'Allgemeine Sidebar', 'affiliatetheme-backend' ),
		'id'            => 'standard',
		'description'   => __( 'Allgemeine Sidebar, diese ist fuer WooSidebars notwendig.', 'affiliatetheme-backend' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<p class="h1">',
		'after_title'   => '</p>',
	) );

	if ( get_field( 'design_footer_widgets', 'option' ) == '1' ) {
		for ( $i = 1; $i < 5; $i++ ) {
			register_sidebar( array(
				'name'          => __( 'Footer ', 'affiliatetheme-backend' ) . '(' . $i . ')',
				'id'            => 'footer_' . $i,
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<p class="h1">',
				'after_title'   => '</p>',
			) );
		}
	}
} );