<?php

/**
 * enqueue_scripts
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    helper
 */
add_action( 'wp_enqueue_scripts', function () {
	// CSS
	if ( '1' != get_field( 'scripte_fa', 'option' ) ) {
		$fa_handle = defined( 'ELEMENTOR_VERSION' ) ? 'font-awesome-v5' : 'font-awesome';
		wp_enqueue_style( $fa_handle, get_template_directory_uri() . '/_/css/font-awesome.min.css', array(), '5.13.0' );
	}

	wp_enqueue_style( 'boostrap', get_template_directory_uri() . '/_/css/bootstrap.min.css' );
	wp_enqueue_style( 'theme', get_stylesheet_directory_uri() . '/style.css' );

	// Bootstrap
	if ( '1' != get_field( 'scripte_bootstrap_js', 'option' ) ) {
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/_/js/bootstrap.min.js', array( 'jquery' ), '3.4.1', true );
	}

	// Custom Script
	if ( '1' != get_field( 'scripte_bootstrap_js', 'option' ) ) {
		wp_enqueue_script( 'scripts', get_template_directory_uri() . '/_/js/scripts.js', array( 'jquery', 'bootstrap' ), ATIO_VERSION, true );
	} else {
		wp_enqueue_script( 'scripts', get_template_directory_uri() . '/_/js/scripts.js', array( 'jquery' ), ATIO_VERSION, true );
	}

	// Select2
	if ( ! is_archive() && get_page_template( 'templates/compare.php' ) ) {
		wp_enqueue_script( 'at-select2', get_template_directory_uri() . '/_/js/select2.min.js', array( 'jquery', 'bootstrap' ), ATIO_VERSION, true );
	}

	// Comment Script
	wp_enqueue_script( 'comment-reply' );

	// jQuery Validate
	if ( is_singular( 'product' ) && comments_open() ) {
		$product_single_show_user_rating = get_field( 'product_single_show_user_rating', 'option' );
		if ( $product_single_show_user_rating ) {
			wp_enqueue_script( 'jquery-validate', get_template_directory_uri() . '/_/js/jquery.validate.min.js', array( 'jquery' ), '1.15.0', false );
			wp_enqueue_script( 'product', get_template_directory_uri() . '/_/js/product.js', array( 'jquery' ), ATIO_VERSION, true );

			wp_localize_script( 'product', 'product_vars', array(
					'product_error_author'         => __( 'Bitte hinterlasse deinen Namen', 'affiliatetheme' ),
					'product_error_email'          => __( 'Bitte hinterlasse deine E-Mail Adresse.', 'affiliatetheme' ),
					'product_error_comment'        => __( 'Bitte begründe deine Bewertung.', 'affiliatetheme' ),
					'product_error_product_rating' => __( 'Bitte bewerte dieses Produkt.', 'affiliatetheme' ),
				)
			);
		}
	}

	// chartsjs
	if ( ( is_single() && get_post_type() == 'product' ) && at_price_trend() ) {
		wp_enqueue_script( 'chartsjs', get_template_directory_uri() . '/_/js/charts.min.js', array( 'jquery' ), '2.3.0', false );
	}

	// Lightbox
	if ( '1' != get_field( 'scripte_lightbox', 'option' ) ) {
		wp_enqueue_style( 'lightbox', get_template_directory_uri() . '/_/css/lightbox.css' );
		wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/_/js/lightbox.js', array( 'jquery', 'bootstrap' ), ATIO_VERSION, true );

		wp_localize_script( 'lightbox', 'lightbox_vars', array(
				'lightbox_tPrev'    => __( 'Vorheriges Bild (Linke Pfeiltaste)', 'affiliatetheme' ),
				'lightbox_tNext'    => __( 'Nächstes Bild (Rechte Pfeiltase)', 'affiliatetheme' ),
				'lightbox_tCounter' => __( '%curr% von %total%', 'affiliatetheme' ),
			)
		);
	}
} );

/**
 * TinyMCE Styles
 */
add_action( 'admin_init', function () {
	add_editor_style( get_template_directory_uri() . '/_/css/editor.css' );
} );

/**
 * Backend CSS
 */
add_action( 'admin_enqueue_scripts', function () {
	wp_enqueue_style( 'at-backend', get_template_directory_uri() . '/_/css/backend.css', array(), ATIO_VERSION );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/_/css/font-awesome.min.css' );

	// Product data import
	if ( get_post_type() == 'product' ) {
		wp_enqueue_script( 'dataimport', get_template_directory_uri() . '/_/js/dataimport.js', array( 'jquery' ), '1.1', false );
	}
} );

/**
 * Load ajaxurl in frontend
 */
add_action( 'wp_head', function () {
	echo '<script type="text/javascript"> var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '" </script>';
} );