<?php
/**
 * Diverse Filter
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    helper
 */

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * just for your security
 * @src http://www.smashingmagazine.com/2010/07/01/10-useful-wordpress-security-tweaks/
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * jpeg quality 100%
 */
add_filter( 'jpeg_quality', 'at_jpeg_quality' );
function at_jpeg_quality()
{
	return 100;
}

/**
 * remove style-tag from gallery-shortcode
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * remove surrounding <p>-tag from images
 */
add_filter( 'the_content', 'at_filter_ptags_on_images' );
function at_filter_ptags_on_images( $content )
{
	return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
}

/**
 * add <span>-tag to wp_list_categories
 */
add_filter( 'wp_list_categories', 'at_categories_count' );
function at_categories_count( $links )
{
	$links = str_replace( '</a> (', '</a><span class="count">(', $links );
	$links = str_replace( ')', ')</span>', $links );

	return $links;
}

/**
 * add <span>-tag to get_archives_link
 */
add_filter( 'get_archives_link', 'at_archive_count' );
function at_archive_count( $links )
{
	$links = str_replace( '</a>&nbsp;(', '</a><span class="count">(', $links );
	$links = str_replace( ')', ')</span>', $links );

	return $links;
}

/**
 * add pdf-filter to wp-media
 */
add_filter( 'post_mime_types', 'modify_post_mime_types' );
function modify_post_mime_types( $post_mime_types )
{
	$post_mime_types['application/pdf'] = array(
		__( 'PDFs', 'affiliatetheme' ),
		__( 'PDFs Verwalten', 'affiliatetheme' ),
		_n_noop( 'PDF <span class="count">(%s)</span>',
			'PDFs <span class="count">(%s)</span>' )
	);

	return $post_mime_types;
}

/**
 * add body classses
 */
add_filter( 'body_class', 'at_frontend_body_class' );
function at_frontend_body_class( $classes )
{
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	if ( $is_lynx ) {
		$classes[] = 'lynx';
	} elseif ( $is_gecko ) {
		$classes[] = 'gecko';
	} elseif ( $is_opera ) {
		$classes[] = 'opera';
	} elseif ( $is_NS4 ) {
		$classes[] = 'ns4';
	} elseif ( $is_safari ) {
		$classes[] = 'safari';
	} elseif ( $is_chrome ) {
		$classes[] = 'chrome';
	} elseif ( $is_IE ) {
		$classes[] = 'ie';
		if ( preg_match( '/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version ) ) {
			$classes[] = 'ie' . $browser_version[1];
		}
	} else {
		$classes[] = 'unknown';
	}
	if ( $is_iphone ) {
		$classes[] = 'iphone';
	}
	if ( stristr( $_SERVER['HTTP_USER_AGENT'], "android" ) ) {
		$classes[] = 'android';
	} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'], "mac" ) ) {
		$classes[] = 'osx';
	} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'], "linux" ) ) {
		$classes[] = 'linux';
	} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'], "windows" ) ) {
		$classes[] = 'windows';
	}

	return $classes;
}

/**
 * add admin body class
 */
add_filter( 'admin_body_class', 'at_admin_body_class' );
function at_admin_body_class( $classes )
{
	$current_user = wp_get_current_user();

	if ( $current_user ) {
		$classes .= $current_user->user_login;
	}

	return $classes;
}

/**
 * add class to images in tinymce editor
 */
add_filter( 'image_send_to_editor', 'at_linked_images_class', 10, 8 );
function at_linked_images_class( $html, $id, $caption, $title, $align, $url, $size, $alt = '' )
{
	$classes = 'lightbox';

	$imgExts = array( "gif", "jpg", "jpeg", "png", "svg" );
	$urlExt  = pathinfo( $url, PATHINFO_EXTENSION );

	if ( in_array( $urlExt, $imgExts ) ) {
		if ( preg_match( '/<a.*? class=".*?">/', $html ) ) {
			$html = preg_replace( '/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html );
		} else {
			$html = preg_replace( '/(<a.*?)>/', '$1 class="' . $classes . '" >', $html );
		}
	}

	return $html;
}

/**
 * remove unused css styles
 */
add_action( 'widgets_init', 'at_remove_recent_comment_style' );
function at_remove_recent_comment_style()
{
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}

/**
 * add post views, if wp-postviews is active
 */
if ( is_plugin_active( 'wp-postviews/wp-postviews.php' ) ) {
	add_filter( 'manage_edit-product_columns', 'at_product_add_views', 999 );
	function at_product_add_views( $columns )
	{
		$columns['views'] = __( 'Aufrufe', 'affiliatetheme-backend' );

		return $columns;
	}
}

/**
 * filter search
 */
add_filter( 'pre_get_posts', 'at_search_filter' );
function at_search_filter( $query )
{
	if ( ! is_admin() && $query->is_main_query() ) {
		if ( $query->is_search ) {
			$post_types = at_get_search_post_types();
			$post_type  = ( isset( $_GET['post_type'] ) ? $_GET['post_type'] : $post_types );

			// fallback if all tab is deactivated
			$search_remove_all = get_field( 'allg_search_remove_all', 'option' );
			if ( $search_remove_all == '1' && ! isset( $_GET['post_type'] ) ) {
				$post_type = $post_types[0];
			}

			$query->set( 'post_type', $post_type );
		}
	}

	return $query;
}

/**
 * remove active class from "blog" if product is active
 */
if ( ! function_exists( 'is_blog' ) ) {
	function is_blog()
	{
		global $post;
		$posttype = get_post_type( $post );

		return ( ( $posttype == 'post' ) && ( is_home() || is_single() || is_archive() || is_category() || is_tag() || is_author() ) ) ? true : false;
	}
}
add_filter( 'nav_menu_css_class', 'at_fix_blog_link_on_cpt', 10, 3 );
function at_fix_blog_link_on_cpt( $classes, $item )
{
	if ( ! is_blog() ) {
		$blog_page_id = intval( get_option( 'page_for_posts' ) );
		if ( $blog_page_id != 0 && $item->object_id == $blog_page_id ) {
			unset( $classes[ array_search( 'current_page_parent', $classes ) ] );
		}
	}

	return $classes;
}

/*
 * Hide Ratings global
 */
add_filter( 'at_table_y_hide_rating', 'at_product_rating_hide_global', 10, 1 );
add_filter( 'at_table_x_hide_rating', 'at_product_rating_hide_global', 10, 1 );
function at_product_rating_hide_global( $status )
{
	if ( get_field( 'product_rating_hide', 'options' ) ) {
		return false;
	}

	return $status;
}

/*
 * Hide Reviews global
 */
add_filter( 'at_table_y_hide_review_summary', 'at_product_review_hide_global', 10, 1 );
add_filter( 'at_table_x_hide_review_summary', 'at_product_review_hide_global', 10, 1 );
function at_product_review_hide_global( $status )
{
	if ( get_field( 'product_reviews_hide', 'options' ) ) {
		return false;
	}

	return $status;
}

/**
 * Make youtube videos GPDR ready
 */
add_filter( 'the_content', 'at_gpdr_youtube_nocookie_domain', 10, 1 );
add_filter( 'acf_the_content', 'at_gpdr_youtube_nocookie_domain', 10, 1 );
function at_gpdr_youtube_nocookie_domain( $html )
{
	$dsgvo_youtube_nocookie = get_field( 'dsgvo_youtube_nocookie', 'options' );

	if ( preg_match( '#https?://(www\.)?youtu#i', $html ) && $dsgvo_youtube_nocookie ) {
		return preg_replace(
			'#src=(["\'])(https?:)?//(www\.)?youtube\.com#i',
			'src=$1$2//$3youtube-nocookie.com',
			$html
		);
	}

	return $html;
}

/**
 * Anonymize ip in every new comment
 */
add_filter( 'pre_comment_user_ip', 'at_gpdr_remove_commentsip' );
function at_gpdr_remove_commentsip( $comment_author_ip )
{
	$dsgvo_comment_privacy = get_field( 'dsgvo_comment_privacy', 'options' );

	if ( ! $dsgvo_comment_privacy ) {
		return $comment_author_ip;
	}

	return wp_privacy_anonymize_ip( $comment_author_ip );
}

/**
 * Add comment privacy hint
 */
add_filter( 'comment_form_default_fields', 'at_gpdr_comment_privacy_hint' );
function at_gpdr_comment_privacy_hint( $fields )
{
	$dsgvo_comment_privacy_hint      = get_field( 'dsgvo_comment_privacy_hint', 'options' );
	$dsgvo_comment_privacy_hint_text = get_field( 'dsgvo_comment_privacy_hint_text', 'options' );

	if ( ! $dsgvo_comment_privacy_hint ) {
		return $fields;
	}

	$fields['user_check'] = '<div class="checkbox"><label><input type="checkbox" name="user_check" value="1" /> ' . $dsgvo_comment_privacy_hint_text . '</label></div>';

	return $fields;
}