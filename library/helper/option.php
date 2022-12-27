<?php
/**
 * Theme options
 *
 * @author        Christian Lang
 * @version        1.3
 * @category    helper
 */

/**
 * Optionen - Design - Allgemein
 */
if ( ! function_exists( 'at_get_logo' ) ) {
	/**
	 * at_get_logo function.
	 *
	 * @param boolean $fallback (default: true)
	 * @param boolean $desc (default: true)
	 *
	 * @return string
	 */
	function at_get_logo( $fallback = true, $desc = true )
	{
		$logo        = get_field( 'design_logo', 'option' );
		$logo2x      = get_field( 'design_logo2x', 'option' );
		$name        = ( get_bloginfo( 'name' ) ? '<strong>' . get_bloginfo( 'name' ) . '</strong>' : '' );
		$description = ( get_bloginfo( 'description' ) ? ' <small>' . get_bloginfo( 'description' ) . '</small>' : '' );

		if ( $desc == false ) {
			$description = '';
		}

		if ( ! $logo && true == $fallback ) {
			return apply_filters( 'at_set_navigation_brand', $name . $description );
		}

		if ( is_array( $logo2x ) && wp_is_mobile() ) {
			return '<img src="' . $logo2x['url'] . '" width="' . $logo2x['width'] . '" height="' . $logo2x['height'] . '" alt="' . $logo2x['alt'] . '" class="img-responsive" />';
		}

		if ( is_array( $logo ) ) {
			return '<img src="' . $logo['url'] . '" width="' . $logo['width'] . '" height="' . $logo['height'] . '" alt="' . $logo['alt'] . '" class="img-responsive" />';
		}

		return false;
	}
}

add_action( 'wp_head', 'at_get_favicon' );
function at_get_favicon()
{
	$favicon_ico   = get_field( 'design_favicon', 'option' );
	$favicon_touch = get_field( 'design_favicon_touch', 'option' );

	if ( is_array( $favicon_ico ) ) {
		echo '<link rel="shortcut icon" href="' . $favicon_ico['url'] . '" type="image/x-icon" />';
	}

	if ( is_array( $favicon_touch ) ) {
		echo '<link rel="apple-touch-icon" href="' . $favicon_touch['url'] . '" />';
	}
}

if ( ! function_exists( 'at_get_wrapper_id' ) ) {
	/**
	 * at_get_wrapper_id function.
	 *
	 * @return string
	 */
	function at_get_wrapper_id()
	{
		$setting = get_field( 'design_layout', 'option' );

		switch ( $setting ) {
			case 'fulllwidth':
				$return = 'wrapper-fluid';
				break;

			case 'tiles':
				$return = 'wrapper-tiles';
				break;

			default:
				$return = 'wrapper';
		}

		return apply_filters( 'at_get_wrapper_id', $return, $setting );
	}
}

if ( ! function_exists( 'at_get_section_layout' ) ) {
	/**
	 * at_get_section_layout function.
	 *
	 * @return string
	 */
	function at_get_section_layout( $section )
	{
		$setting = get_field( 'design_' . $section . '_layout', 'option' );
		$return  = 'boxed';

		if ( ! is_array( $setting ) ) {
			$return = $setting;
		}

		return apply_filters( 'at_get_section_layout', $return, $setting );
	}
}

if ( ! function_exists( 'at_get_section_layout_class' ) ) {
	/**
	 * at_get_section_layout_class function.
	 *
	 * @param string $section
	 *
	 * @return string
	 */
	function at_get_section_layout_class( $section )
	{
		$setting    = get_field( 'design_' . $section . '_layout', 'option' );
		$wrapper_id = at_get_wrapper_id();

		if ( 'nav' == $section && ( $wrapper_id != 'wrapper-fluid' || at_get_section_layout( 'header' ) == 'boxed' ) ) {
			return 'wrapped';
		}

		if ( $setting == 'boxed' && $wrapper_id == 'wrapper-fluid' ) {
			return 'wrapped';
		}

		return '';
	}
}

if ( ! function_exists( 'at_get_search_post_types' ) ) {
	/**
	 * at_get_search_post_types function.
	 *
	 * @return array
	 */
	function at_get_search_post_types()
	{
		$post_types         = ( get_field( 'allg_search_post_types', 'option' ) ? get_field( 'allg_search_post_types', 'option' ) : array( 'post' ) );
		$post_types_default = ( get_field( 'allg_search_post_types_default', 'option' ) ? get_field( 'allg_search_post_types_default', 'option' ) : 'post' );

		if ( ! is_array( $post_types ) ) {
			$post_types = explode( ',', $post_types );
		}

		if ( in_array( $post_types_default, $post_types ) ) {
			array_unshift( $post_types, $post_types_default );
			$post_types = array_unique( $post_types );
		}

		return $post_types;
	}
}

/*
* Optionen - Design - Topbar
*/
if ( ! function_exists( 'at_topbar_structure' ) ) {
	/**
	 * at_topbar_structure function.
	 *
	 * @return string
	 */
	function at_topbar_structure()
	{
		$setting = get_field( 'design_topbar_structure', 'option' );
		$return  = 'tl_nr';

		if ( ! is_array( $setting ) ) {
			$return = $setting;
		}

		return $return;
	}
}

if ( ! function_exists( 'at_get_topbar' ) ) {
	/**
	 * at_get_topbar function.
	 *
	 * @return boolean
	 */
	function at_get_topbar()
	{
		$setting = get_field( 'design_topbar_show', 'option' );

		if ( $setting ) {
			return true;
		}

		return false;
	}
}

/*
 * Optionen - Design - Header
 */
if ( ! function_exists( 'at_header_layout' ) ) {
	/**
	 * at_header_layout function.
	 *
	 * @return string
	 */
	function at_header_layout()
	{
		$setting = get_field( 'design_header_layout', 'option' );
		$return  = 'boxed';

		if ( ! is_array( $setting ) && ( "" != $setting ) ) {
			$return = $setting;
		}

		return $return;
	}
}

if ( ! function_exists( 'at_header_structure' ) ) {
	/**
	 * at_header_structure function.
	 *
	 * @return string
	 */
	function at_header_structure()
	{
		$setting = get_field( 'design_header_structure', 'option' );
		$return  = '12';

		if ( ! is_array( $setting ) && ( "" != $setting ) ) {
			$return = $setting;
		}

		return $return;
	}
}

add_filter( 'wp_footer', 'at_header_sticky_nav', 99 );
function at_header_sticky_nav()
{
	$setting = get_field( 'design_nav_sticky', 'option' );
	$layout  = get_field( 'design_header_structure_col_12', 'option' );

	if ( $setting ) {
		echo '
		<script>
			jQuery(document).ready(function() {
				if( jQuery("#navigation").length ) {   
					jQuery("#navigation").affix({
						offset: {
							top: jQuery("#navigation").offset().top,
						}
					});
	
					jQuery("#navigation").on("affix.bs.affix", function () {
					    if( !jQuery( window ).scrollTop() ) return false;
						jQuery("#header").addClass("pb50");
					});
	
					jQuery("#navigation").on("affix-top.bs.affix", function () {
						jQuery("#header").removeClass("pb50");
					});
	
					if ( jQuery("#navigation").hasClass("affix") ) {
						jQuery("#header").addClass("pb50");
					}
				}
			});
			';

		if ( $layout == 'banner' ) {
			echo '
					jQuery("#navigation").data("bs.affix").options.offset = jQuery("#navigation").offset().top + jQuery("#header .brand-banner img").attr("height");
					setTimeout(function(){
						jQuery("#navigation").data("bs.affix").options.offset = jQuery("#navigation").offset().top;
					}, 1000);
				';
		}

		echo '</script>';
	}
}

if ( ! function_exists( 'at_header_nav_searchform' ) ) {
	/**
	 * at_header_nav_searchform function.
	 *
	 * @return boolean
	 */
	function at_header_nav_searchform()
	{
		$desktop = get_field( 'design_nav_searchform', 'option' );
		$mobile  = get_field( 'design_nav_mobile_searchform', 'option' );

		if ( ( '1' == $desktop && '12' == at_header_structure() ) || '1' == $mobile ) {
			return true;
		}

		return false;
	}
}

/*
 * Optionen - Design - Teaser
 */
if ( ! function_exists( 'at_teaser_hide' ) ) {
	/**
	 * at_teaser_hide function.
	 *
	 * @return string
	 */
	function at_teaser_hide()
	{
		$setting = get_field( 'design_teaser_hide', 'option' );

		if ( ! is_array( $setting ) ) {
			return $setting;
		}

		return false;
	}
}

/*
 * Optionen - Blog - Allgemein
 */
if ( ! function_exists( 'at_get_sidebar' ) ) {
	/**
	 * at_get_sidebar function.
	 *
	 * @param string $post_type (default: blog)
	 * @param string $section
	 * @param string $option (default: option)
	 *
	 * @return string
	 */
	function at_get_sidebar( $post_type = 'blog', $section, $option = 'option' )
	{
		$setting = get_field( $post_type . '_' . $section . '_sidebar', $option );
		$return  = 'right';

		if ( ! is_array( $setting ) && ( '' != $setting ) ) {
			$return = $setting;
		}

		return $return;
	}
}

if ( ! function_exists( 'at_get_sidebar_size' ) ) {
	/**
	 * at_get_sidebar_size function.
	 *
	 * @param string $post_type (default: blog)
	 * @param string $section
	 * @param string $option (default: option)
	 *
	 * @return array
	 */
	function at_get_sidebar_size( $post_type = 'blog', $section = '', $option = 'option' )
	{
		$pos     = at_get_sidebar( $post_type, $section, $option );
		$setting = get_field( $post_type . '_' . $section . '_sidebar_size', $option );

		if ( ! is_string( $setting ) ) {
			$setting = '8_4';
		}

		if ( $setting ) {
			$setting = explode( '_', $setting );
		}

		$content = is_array( $setting ) ? $setting[0] : '8';
		$sidebar = is_array( $setting ) ? $setting[1] : '4';

		if ( 'left' == $pos ) {
			$content .= ' col-sm-push-' . ( is_array( $setting ) ? $setting[1] : '4' );
			$sidebar .= ' col-sm-pull-' . ( is_array( $setting ) ? $setting[0] : '8' );
		}

		$output['content'] = $content;
		$output['sidebar'] = $sidebar;

		return $output;
	}
}

if ( ! function_exists( 'at_get_post_layout' ) ) {
	/**
	 * at_get_post_layout function.
	 *
	 * @param string $section
	 *
	 * @return string
	 */
	function at_get_post_layout( $section )
	{
		$setting = get_field( 'blog_' . $section . '_post_layout', 'option' );
		$return  = 'small';

		if ( ! is_array( $setting ) && ( "" != $setting ) ) {
			$return = $setting;
		}

		return $return;
	}
}

if ( ! function_exists( 'at_get_blog_col' ) ) {
	/**
	 * at_get_blog_col function.
	 *
	 * @param string $layout
	 * @param string $sidebar
	 * @param string $sidebar_size
	 *
	 * @return string
	 */
	function at_get_blog_col( $sidebar = '', $sidebar_size = '' )
	{
		$return = '6';

		if ( ! $sidebar || 'none' == $sidebar ) {
			$return = '4';
		} elseif ( $sidebar_size ) {
			$return = '4';
		} elseif ( '3' == $sidebar_size ) {
			$return = '4';
		}

		return $return;
	}
}

add_filter( 'excerpt_length', 'at_excerpt_length', 999 );
function at_excerpt_length( $length )
{
	$setting = get_field( 'blog_excerpt_length', 'option' );
	$return  = 55;

	if ( ! is_array( $setting ) && ( "" != $setting ) ) {
		$return = $setting;
	}

	return $return;
}

if ( ! function_exists( 'at_get_blog_meta_pos' ) ) {
	/**
	 * at_get_blog_meta_pos function.
	 *
	 * @param string $pos (default: top)
	 *
	 * @return boolean
	 */
	function at_get_blog_meta_pos( $pos = 'top' )
	{
		$setting = get_field( 'blog_single_meta_pos', 'option' );

		if ( ! is_array( $setting ) && ( "" != $setting ) ) {
			if ( $setting == $pos || $setting == 'both' ) {
				return true;
			} else {
				return false;
			}
		}

		if ( $setting == '' ) {
			if ( $pos == 'top' ) {
				return true;
			}
		}

		return false;
	}
}

/*
 * Optionen - Design - Footer
 */
if ( ! function_exists( 'at_footer_structure' ) ) {
	/**
	 * at_footer_structure function.
	 *
	 * @return string
	 */
	function at_footer_structure()
	{
		$setting = get_field( 'design_footer_structure', 'option' );
		$return  = 'tl_nr';

		if ( ! is_array( $setting ) && ( "" != $setting ) ) {
			$return = $setting;
		}

		return $return;
	}
}

add_filter( 'body_class', 'at_footer_sticky' );
function at_footer_sticky( $classes )
{
	$setting        = get_field( 'design_footer_sticky', 'option' );
	$footer_widgets = get_field( 'design_footer_widgets', 'option' );

	if ( '1' == $setting && '1' != $footer_widgets ) {
		$classes[] = 'sticky-footer';
	}

	return $classes;
}

/*
 * Optionen - Allgemein - Anpassen
 */
add_action( 'wp_head', 'at_enqueue_custom_css', 99 );
function at_enqueue_custom_css()
{
	$css = get_field( 'custom_css', 'option' );

	if ( $css == '<style></style>' ) {
		return false;
	}

	if ( strpos( $css, '<style>' ) === false ) {
		$css = '<style>' . $css;
	}

	if ( strpos( $css, '</style>' ) === false ) {
		$css .= '</style>';
	}

	if ( $css != "" ) {
		echo $css;
	}
}

add_action( 'wp_head', 'at_enqueue_custom_js_header', 999 );
function at_enqueue_custom_js_header()
{
	$js = get_field( 'custom_js_header', 'option' );

	if ( ! $js ) {
		return;
	}

	if ( preg_match( "/<script\\b[^>]*>/", $js ) == 0 ) {
		echo '<script>';
	}

	echo $js;

	if ( preg_match( "/<\/script\\b[^>]*>/", $js ) == 0 ) {
		echo '</script>';
	}
}

add_action( 'wp_footer', 'at_enqueue_custom_js_footer', 999 );
function at_enqueue_custom_js_footer()
{
	$js = get_field( 'custom_js_footer', 'option' );

	if ( ! $js ) {
		return;
	}

	if ( preg_match( "/<script\\b[^>]*>/", $js ) == 0 ) {
		echo '<script>';
	}

	echo $js;

	if ( preg_match( "/<\/script\\b[^>]*>/", $js ) == 0 ) {
		echo '</script>';
	}
}

/*
 * Optionen - Allgemein - Social Buttons
 */
if ( ! function_exists( 'at_get_social' ) ) {
	/**
	 * at_get_social function.
	 *
	 * @param string $section
	 *
	 * @return string
	 */
	function at_get_social( $section )
	{
		$setting = get_field( 'socialbuttons_' . $section . '_show', 'option' );

		if ( ! is_array( $setting ) && ( "" != $setting ) ) {
			return $setting;
		}

		return false;
	}
}

if ( ! function_exists( 'at_get_social_pos' ) ) {
	/**
	 * at_get_social_pos function.
	 *
	 * @param string $section
	 *
	 * @return string
	 */
	function at_get_social_pos( $section )
	{
		$setting = get_field( 'socialbuttons_' . $section . '_show_pos', 'option' );

		if ( ! is_array( $setting ) && ( "" != $setting ) ) {
			return $setting;
		}

		return false;
	}
}

if ( ! function_exists( 'at_show_product_review' ) ) {
	/**
	 * at_show_product_review function.
	 *
	 * @return string
	 */
	function at_show_product_review()
	{
		$setting = get_field( 'product_reviews_hide', 'option' );

		if ( $setting == '1' ) {
			return false;
		}

		return true;
	}
}