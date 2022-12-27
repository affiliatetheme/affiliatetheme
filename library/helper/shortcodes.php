<?php
/**
 * Shortcodes
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    helper
 */

add_shortcode( 'hidden', 'endcore_hidden_shortcode' );
add_shortcode( 'visible', 'endcore_visible_shortcode' );
add_shortcode( 'row', 'endcore_row_shortcode' );
add_shortcode( 'col', 'endcore_column_shortcode' );
add_shortcode( 'media', 'endcore_media_shortcode' );
add_shortcode( 'media_object', 'endcore_media_object_shortcode' );
add_shortcode( 'media_body', 'endcore_media_body_shortcode' );
add_shortcode( 'hr', 'endcore_divider_shortcode' );
add_shortcode( 'clear', 'endcore_clear_shortcode' );
add_shortcode( 'button', 'endcore_button_shortcode' );
add_shortcode( 'alert', 'endcore_alert_shortcode' );
add_shortcode( 'accordiongroup', 'endcore_accordiongroup_shortcode' );
add_shortcode( 'accordion', 'endcore_accordion_shortcode' );
add_shortcode( 'tabs', 'endcore_tabs_shortcode' );
add_shortcode( 'tab', 'endcore_tab_shortcode' );
add_shortcode( 'testimonial', 'endcore_testimonial_shortcode' );
add_shortcode( 'socialbuttons', 'endcore_socialbuttons_shortcode' );
add_shortcode( 'blogposts', 'endcore_blogposts_shortcode' );
add_shortcode( 'taxonomy_images', 'endcore_taxonomy_images_shortcode' );
add_shortcode( 'at_widget', 'endcore_at_widget_shortcode' );

// overwrite gallery shortcode
remove_shortcode( 'gallery' );
add_shortcode( 'gallery', 'endcore_gallery_shortcode' );

// render shortcode
add_filter( 'the_content', 'do_shortcode', 99 );
add_filter( 'the_excerpt', 'do_shortcode', 99 );
add_filter( 'widget_text', 'do_shortcode', 99 );
add_filter( 'term_description', 'do_shortcode', 99 );
add_filter( 'category_description', 'do_shortcode', 99 );
add_filter( 'tag_description', 'do_shortcode', 99 );
add_filter( 'acf_the_content', 'do_shortcode', 99 );

/*
 * Hidden Shortcode
 */
function endcore_hidden_shortcode ( $atts, $content = null )
{
    extract( shortcode_atts( array(
        "screen"    => "",
        "display"   => "block",
        "container" => "span",
    ), $atts ) );

    $screen = explode( ',', $screen );

    $classes = array();

    foreach ( $screen as $value ) {
        $classes[] = 'hidden-' . $value;
    }

    return '<' . $container . ' class="' . implode( ' ', $classes ) . '">' . do_shortcode( $content ) . '</' . $container . '>';
}

/*
 * Visible Shortcode
 */
function endcore_visible_shortcode ( $atts, $content = null )
{
    extract( shortcode_atts( array(
        "screen"    => "",
        "display"   => "block",
        "container" => "span",
    ), $atts ) );

    $screen = explode( ',', $screen );

    $classes = array();

    foreach ( $screen as $value ) {
        $classes[] = 'visible-' . $value . '-' . $display;
    }

    return '<' . $container . ' class="' . implode( ' ', $classes ) . '">' . do_shortcode( $content ) . '</' . $container . '>';
}

/*
 * Row Shortcode
 */
function endcore_row_shortcode ( $atts, $content = null )
{

    return '<div class="row">' . do_shortcode( $content ) . '</div>';
}

/*
 * Grid Shortcode
 */
function endcore_column_shortcode ( $atts, $content = null )
{
    extract( shortcode_atts( array(
        "class" => ''
    ), $atts ) );

    return '<div class="' . $class . '">' . do_shortcode( $content ) . '</div>';
}

/*
 * Divider Shortcode
 */
function endcore_divider_shortcode ( $atts, $content = null )
{
    return '<hr/>';
}

/*
 * Clear Shortcode
 */
function endcore_clear_shortcode ( $atts, $content = null )
{
    return '<div class="clearfix"></div>';
}

/*
 * Button Shortcode
 */
function endcore_button_shortcode ( $atts, $content = null )
{
    extract( shortcode_atts( array(
        "color"         => "btn-primary",
        "size"          => "btn-md",
        "shape"         => "btn-rounded",
        "outline"       => "false",
        "block"         => "false",
        "icon"          => "",
        "icon_position" => "left",
        "target"        => "",
        "rel"           => "false",
        "href"          => "",
        "class"         => ""
    ), $atts ) );

    $attributes      = array(
        'class'  => array( 'btn' ),
        'target' => array(),
        'rel'    => array()
    );
    $attributes_html = '';

    if ( $color ) {
        $attributes['class'][] = $color;
    }

    if ( $size ) {
        $attributes['class'][] = $size;
    }

    if ( $shape ) {
        $attributes['class'][] = $shape;
    }

    if ( $outline == 'true' ) {
        $attributes['class'][] = 'btn-outline';
    }

    if ( $block == 'true' ) {
        $attributes['class'][] = 'btn-block';
    }

    if ( $class ) {
        $attributes['class'][] = $class;
    }

    if ( $target ) {
        $attributes['target'][] = $target;
    }

    if ( $rel ) {
        $attributes['rel'][] = $rel;
    }

    if ( $attributes ) {
        foreach ( $attributes as $k => $v ) {
            $attributes_html .= $k . '="' . implode( ' ', $v ) . '" ';
        }
    }

    $text = do_shortcode( $content );

    if ( $icon ) {
        if ( $icon_position == 'left' ) {
            $text = '<i class="fa ' . $icon . '"></i> ' . $text;
        } else {
            $text .= ' <i class="fa ' . $icon . '"></i>';
        }
    }

    return '<a href="' . $href . '" ' . $attributes_html . '>' . $text . '</a>';
}

/*
 * Alert Shortcode
 */
function endcore_alert_shortcode ( $atts, $content = null )
{
    extract( shortcode_atts( array(
        "style" => "info",
    ), $atts ) );

    return wpautop( '<div class="alert alert-' . $style . '">' . do_shortcode( $content ) . '</div>' );
}

/*
 * Media Shortcode
 */
function endcore_media_shortcode ( $atts, $content = null )
{
    return '<div class="media">' . do_shortcode( $content ) . '</div>';
}

function endcore_media_object_shortcode ( $atts, $content = null )
{
    extract( shortcode_atts( array(
        "style"   => "left",
        "aligned" => "",
    ), $atts ) );

    return '<div class="media-' . $style . ( $aligned ? ' media-' . $aligned : '' ) . '">' . do_shortcode( $content ) . '</div>';
}

function endcore_media_body_shortcode ( $atts, $content = null )
{
    extract( shortcode_atts( array(), $atts ) );


    return '<div class="media-body">' . do_shortcode( $content ) . '</div>';
}

/*
 * Tab Shortcode
 */
function endcore_tabs_shortcode ( $atts, $content = null )
{
    extract( shortcode_atts( array(
        "style" => "tab",
        "id"    => "1",
        "title" => ""
    ), $atts ) );

    $content = preg_replace( '/\[\/tab\](.*?)\[tab\]/im', "[/tab]\n[tab]", $content );

    $tabs       = explode( ",", $title );
    $tab_number = 1;

    $output = '<div role="tabpanel"><ul class="nav nav-tabs Tab' . $id . '" id="Tabs" role="tablist">';
    foreach ( $tabs as $tab ) {
        $output .= '<li role="presentation"><a href="#tab' . $id . $tab_number . '" aria-controls="tab' . $id . $tab_number . '" role="tab" data-toggle="tab">' . trim( $tab ) . '</a></li>';
        $tab_number++;
    }
    $output .= '</ul>';

    $output .= '<div class="tab-content">';
    $output .= do_shortcode( $content );
    $output .= '</div>';
    $output .= '<div class="clearfix"></div>';
    $output .= "<script type='text/javascript'>jQuery(document).ready(function() { jQuery('.Tab" . $id . " a:first').tab('show'); jQuery('.Tab" . $id . " a').click(function (e) { e.preventDefault();  jQuery(this).tab('show'); }) });</script></div>";

    return $output;
}

function endcore_tab_shortcode ( $atts, $content = null )
{
    extract( shortcode_atts( array(
        "id"  => "",
        "tid" => "1"
    ), $atts ) );

    return '<div class="tab-pane" role="tabpanel" id="tab' . $tid . $id . '">' . do_shortcode( $content ) . '</div>';
}

/*
 * Accordion Shortcode
 */
function endcore_accordiongroup_shortcode ( $atts, $content = null )
{
    extract( shortcode_atts( array(
        "id"     => "",
        "markup" => "default"
    ), $atts ) );

    $output = '<div class="panel-group" id="accordion' . $id . '" role="tablist" data-markup="' . $markup . '">' . do_shortcode( $content ) . '</div>';


    if ( $markup == 'faq' ) {
        $accordion_contents = at_shortcode_accordion_content( 'accordion', $content );

        if ( is_array( $accordion_contents ) && ! empty( $accordion_contents ) ) {
            ob_start();

            ?>
            <script type="application/ld+json">
                {
                    "@context": "https://schema.org",
                    "@type": "FAQPage",
                    "mainEntity": [
                        <?php
                $d = 0;
                foreach ( $accordion_contents as $item ) {
                    if ( $d != 0 ) {
                        echo ',';
                    }
                    ?>
                            {
                                "@type": "Question",
                                "name": "<?= $item['title'] ?>",
                                "acceptedAnswer": {
                                    "@type": "Answer",
                                    "text": "<?= htmlspecialchars( $item['content'] ) ?>"
                                }
                            }
                            <?php
                    $d++;
                }
                ?>
                    ]
                }

            </script>
            <?php

            $faq_markup = ob_get_contents();
            ob_end_clean();

            $output .= $faq_markup;
        }
    }

    return $output;
}

function endcore_accordion_shortcode ( $atts, $content = null )
{
    extract( shortcode_atts( array(
        "id"     => "",
        "title"  => "",
        "active" => "",
        "class"  => "",
        "group"  => ""
    ), $atts ) );

    if ( $id ) {
        $group = $id;
    }

    $current = rand( 1, 9999 );

    $content = preg_replace( '/\[\/accordion\](.*?)\[accordion\]/im', "[/accordion]\n[accordion]", $content );

    return '<div class="panel ' . $class . ' panel-default"><div class="panel-heading" role="tab"><a ' . ( $active == "true" ? 'aria-expanded="true"' : 'aria-expanded="false"' ) . ' class="panel-title collapsed" data-toggle="collapse" aria-controls="collapse' . $current . '" data-parent="#accordion' . $group . '" href="#collapse' . $current . '">' . html_entity_decode( $title ) . '</a></div><div class="panel-collapse collapse' . ( $active == "true" ? ' in' : '' ) . '" id="collapse' . $current . '" role="tabpanel" aria-labelledby="collapse' . $current . '"><div class="panel-body">' . do_shortcode( $content ) . '</div></div></div>';
}

/*
 * Social Buttons Shortcode
 */
function endcore_socialbuttons_shortcode ( $atts, $content = null )
{
    if ( is_admin() ) {
        return;
    }

    ob_start();
    get_template_part( 'parts/stuff/code', 'social' );
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

/*
 * Blogposts Shortcode
 */
function endcore_blogposts_shortcode ( $atts, $content = null )
{
    extract( shortcode_atts(
            array(
                'layout'           => 'small',
                'limit'            => '4',
                'category'         => '',
                'category_name'    => '',
                'category__not_in' => '',
                'tag'              => '',
                'orderby'          => 'date',
                'order'            => 'DESC',
                'include'          => '',
                'exclude'          => '',
                'meta_key'         => '',
                'meta_value'       => '',
                'post_type'        => 'post',
                'post_parent'      => '',
                'author'           => '',
                'post_status'      => '',
                'suppress_filters' => true,
                'classes'          => '',
                'offset'           => 0,
                'taxonomy'         => '',
            ), $atts )
    );

    // exclude
    if ( $exclude ) {
        $exclude_arr = explode( ',', $exclude );
    } else {
        $exclude_arr = array();
    }

    // include
    if ( $include ) {
        $include_arr = explode( ',', $include );
    } else {
        $include_arr = array();
    }

    $args = array(
        'posts_per_page'   => $limit,
        'offset'           => $offset,
        'category'         => $category,
        'category_name'    => $category_name,
        'category__not_in' => $category__not_in,
        'tag'              => $tag,
        'orderby'          => $orderby,
        'order'            => $order,
        'post__in'         => $include_arr,
        'post__not_in'     => $exclude_arr,
        'meta_key'         => $meta_key,
        'meta_value'       => $meta_value,
        'post_type'        => $post_type,
        'post_parent'      => $post_parent,
        'author'           => $author,
        'post_status'      => $post_status,
        'suppress_filters' => ( $suppress_filters == 'false' ? false : true ),
        'taxonomy'         => $taxonomy
    );

    if ( is_admin() ) {
        return;
    }

    $output = '<div class="blogposts">';

    if ( $layout == 'grid' ) {
        $output .= '<div class="row">';
    }

    if ( $layout == 'list' ) {
        $output .= '<ul>';
    }

	$blogPosts = new WP_Query( $args );
	if ( $blogPosts->have_posts() ) :
		while ( $blogPosts->have_posts() ) : $blogPosts->the_post();
			ob_start();
			get_template_part( 'parts/post/loop', $layout );
			$output .= ob_get_contents();
			ob_end_clean();
		endwhile;

		wp_reset_query();
	endif;

    if ( $layout == 'list' ) {
        $output .= '</ul>';
    }

    if ( $layout == 'grid' ) {
        $output .= '</div>';
    }

    $output .= '</div>';

    return $output;
}

/*
 * Taxonomy Images Shortcode
 */
function endcore_taxonomy_images_shortcode ( $atts, $content = null )
{
    extract( shortcode_atts(
            array(
                'taxonomy'          => '',
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => 1,
                'exclude'           => '',
                'exclude_tree'      => '',
                'include'           => '',
                'number'            => '',
                'slug'              => '',
                'parent'            => '',
                'hierarchical'      => 1,
                'child_of'          => 0,
                'childless'         => false,
                'name__like'        => '',
                'description__like' => '',
                'offset'            => '',
                'search'            => '',
                'without_images'    => true
            ), $atts )
    );

    if ( ! $taxonomy ) {
        return;
    }

    // exclude
    if ( $exclude ) {
        $exclude_arr = explode( ',', $exclude );
    } else {
        $exclude_arr = array();
    }

    // exclude_tree
    if ( $exclude_tree ) {
        $exclude_tree_arr = explode( ',', $exclude_tree );
    } else {
        $exclude_tree_arr = array();
    }

    // include
    if ( $include ) {
        $include_arr = explode( ',', $include );
    } else {
        $include_arr = array();
    }

    $args = array(
        'orderby'           => $orderby,
        'order'             => $order,
        'hide_empty'        => $hide_empty,
        'exclude'           => $exclude_arr,
        'exclude_tree'      => $exclude_tree_arr,
        'include'           => $include_arr,
        'number'            => $number,
        'slug'              => $slug,
        'parent'            => $parent,
        'hierarchical'      => $hierarchical,
        'child_of'          => $child_of,
        'name__like'        => $name__like,
        'description__like' => $description__like,
        'offset'            => $offset,
        'search'            => $search,
    );

    $output = '';
    $terms  = get_terms( $taxonomy, $args );

    if ( $terms ) {
        $output = '
		<div class="taxonomy-list">
			<div class="row">';
        foreach ( $terms as $term ) {
            $taxonomy_image = get_field( 'taxonomy_image', $taxonomy . '_' . $term->term_id );

            if ( $without_images == 'false' && ! $taxonomy_image ) {
                continue;
            }

            $output .= '
						<div class="col-xs-12 col-sm-6 col-sm-4 col-lg-3">
							<div class="thumbnail product-grid">
								<div class="caption">';
            if ( $taxonomy_image ) {
                $output .= '
											<div class="img-grid-wrapper">
												<a title="' . $term->name . '" href="' . get_term_link( $term, $taxonomy ) . '">
													<img src="' . $taxonomy_image['url'] . '" width="' . $taxonomy_image['width'] . '" height="' . $taxonomy_image['height'] . '" alt="' . $term->name . ' Logo" class="taximage img-responsive">
												</a>
											</div>
										';
            }
            $output .= '
									<a title="' . $term->name . '" href="' . get_term_link( $term, $taxonomy ) . '" class="product-title">' . $term->name . '</a>
								</div>
							</div>
						</div>
					';
        }
        $output .= '
			</div>
		</div>
		';
    }

    return $output;
}

/*
 * Widget Shortcode
 */
function endcore_at_widget_shortcode ( $atts, $content = null )
{
    extract( shortcode_atts(
            array(
                'type'      => '',
                'title'     => '',
                'widget_id' => '38'
            ), $atts )
    );

    $args = array(
        'before_widget' => '<div class="at_widget at_inline_widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    );

    ob_start();
    the_widget( $type, $atts, $args );
    $output = ob_get_clean();

    return $output;
}

/*
 * Bootstrap Gallery Shortcode
 */
function endcore_gallery_shortcode ( $attr )
{
    $post = get_post();

    static $instance = 0;
    $instance++;

    if ( ! empty( $attr['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $attr['orderby'] ) ) {
            $attr['orderby'] = 'post__in';
        }
        $attr['include'] = $attr['ids'];
    }

    // Allow plugins/themes to override the default gallery template.
    $output = apply_filters( 'post_gallery', '', $attr );
    if ( $output != '' ) {
        return $output;
    }

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( ! $attr['orderby'] ) {
            unset( $attr['orderby'] );
        }
    }

    extract( shortcode_atts( array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post ? $post->ID : 0,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => '',
        'link'       => ''
    ), $attr, 'gallery' ) );

    $id = intval( $id );
    if ( 'RAND' == $order ) {
        $orderby = 'none';
    }

    if ( ! empty( $include ) ) {
        $_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( ! empty( $exclude ) ) {
        $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
    } else {
        $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
    }

    if ( empty( $attachments ) ) {
        return '';
    }

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment ) {
            $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
        }

        return $output;
    }

    $itemtag    = tag_escape( $itemtag );
    $captiontag = tag_escape( $captiontag );
    $icontag    = tag_escape( $icontag );
    $valid_tags = wp_kses_allowed_html( 'post' );
    if ( ! isset( $valid_tags[$itemtag] ) ) {
        $itemtag = 'dl';
    }
    if ( ! isset( $valid_tags[$captiontag] ) ) {
        $captiontag = 'dd';
    }
    if ( ! isset( $valid_tags[$icontag] ) ) {
        $icontag = 'dt';
    }

    $columns   = intval( $columns );
    $itemwidth = $columns > 0 ? floor( 100 / $columns ) : 100;
    $float     = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $gallery_style = $gallery_div = '';
    if ( apply_filters( 'use_default_gallery_style', true ) ) {
        $gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				margin-top: 10px;
				text-align: center;
			}
			#{$selector} img {
				border: 2px solid #cfcfcf;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
			/* see gallery_shortcode() in wp-includes/media.php */
		</style>";
    }
    $size_class  = sanitize_html_class( $size );
    $gallery_div = "<div id='$selector' class='row gallery galleryid-{$id} gallery-size-{$size_class}'>";
    $output      = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

    $i               = 1;
    $numberofcolumns = $columns;
    $classes         = twitterbootstrap_galleries_get_grid_classes( $numberofcolumns );

    foreach ( $attachments as $id => $attachment ) {
        if ( ! empty( $link ) && 'file' === $link ) {
            $image_output = wp_get_attachment_link( $id, $size, false, false );
        } elseif ( ! empty( $link ) && 'none' === $link ) {
            $image_output = wp_get_attachment_image( $id, $size, false );
        } else {
            $image_output = wp_get_attachment_link( $id, $size, true, false );
        }
        $image_output = str_replace( "<a", "<a title='" . wptexturize( $attachment->post_excerpt ) . "'", $image_output );

        $image_output = preg_replace( '/height="[0-9]+"/', '', $image_output );
        $image_output = preg_replace( '/width="[0-9]+"/', '', $image_output );
        $image_output = str_replace( 'class="', 'class="img-responsive ', $image_output );
        $image_meta   = wp_get_attachment_metadata( $id );

        $orientation = '';
        if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
            $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
        }

        $output .= "<div class='gallery-item " . $classes . "'>";
        $output .= "
			<div class='gallery-icon {$orientation}'>
				$image_output
			</div>";
        if ( $captiontag && trim( $attachment->post_excerpt ) ) {
            $output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize( $attachment->post_excerpt ) . "
				</{$captiontag}>";
        }
        $output .= "</div>";

        if ( $numberofcolumns == 6 ) {
            if ( 0 == ( $i % 6 ) ) {
                $output .= '<div class="clearfix visible-md visible-lg"></div>';
            }
            if ( 0 == ( $i % 2 ) ) {
                $output .= '<div class="clearfix visible-xs"></div>';
            }
        } elseif ( $numberofcolumns == 4 ) {
            if ( 0 == ( $i % 4 ) ) {
                $output .= '<div class="clearfix visible-md visible-lg"></div>';
            }
        } elseif ( $numberofcolumns == 4 ) {
            if ( 0 == ( $i % 4 ) ) {
                $output .= '<div class="clearfix visible-md visible-lg"></div>';
            }
            if ( 0 == ( $i % 2 ) ) {
                $output .= '<div class="clearfix visible-sm"></div>';
            }
        } elseif ( $numberofcolumns == 3 ) {
            if ( 0 == ( $i % 3 ) ) {
                $output .= '<div class="clearfix visible-md visible-lg"></div>';
            }
        } elseif ( $numberofcolumns == 31 ) {
            if ( 0 == ( $i % 3 ) ) {
                $output .= '<div class="clearfix visible-md visible-lg"></div>';
            }
            if ( 0 == ( $i % 2 ) ) {
                $output .= '<div class="clearfix visible-sm"></div>';
            }
        } elseif ( $numberofcolumns == 2 ) {
            if ( 0 == ( $i % 2 ) ) {
                $output .= '<div class="clearfix invisible-xs"></div>';
            }
        }
        $i++;
    }

    $output .= "
		</div>\n";

    return $output;
}

function twitterbootstrap_galleries_get_grid_classes ( $numberofcolumns )
{
    switch ( $numberofcolumns ) {
        case 9:
            $classes = 'col-xxs-12 col-xs-6 col-sm-3 col-md-2';
            break;
        case 8:
            $classes = 'col-xxs-12 col-xs-6 col-sm-3 col-md-2';
            break;
        case 7:
            $classes = 'col-xxs-12 col-xs-6 col-sm-3 col-md-2';
            break;
        case 6:
            $classes = 'col-xxs-12 col-xs-6 col-sm-4 col-md-2';
            break;
        case 5:
            $classes = 'col-xxs-12 col-xs-6 col-sm-4 col-md-15';
            break;
        case 4:
            $classes = 'col-xxs-12 col-xs-6 col-sm-6 col-md-3';
            break;
        case 3:
            $classes = 'col-xxs-12 col-xs-6 col-sm-4 col-md-4';
            break;
        case 31:
            $classes = 'col-xxs-12 col-xs-6 col-sm-6 col-md-4';
            break;
        case 2:
            $classes = 'col-xxs-12 col-xs-6 col-sm-6 col-md-6';
            break;
        case 1:
            $classes = 'col-xs-12';
            break;
        default:
            $classes = 'col-xxs-12 col-xs-6 col-sm-3';
    }

    return $classes;
}

?>