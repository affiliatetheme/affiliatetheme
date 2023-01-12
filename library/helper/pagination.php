<?php
/**
 * Pagination
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    helper
 */

function atio_pagination( $range = 3, $show_one_pager = true, $show_page_hint = false )
{
	global $wp_query, $products;

	if ( $products && is_object( $products ) ) {
		if ( $products->query ) {
			$wp_query = $products;
		}
	}

	$num_of_pages = (int)$wp_query->max_num_pages;

	if ( $num_of_pages > 1 ) {
		$current_page         = get_query_var( 'paged' ) === 0 ? 1 : get_query_var( 'paged' );
		$num_of_display_pages = ( $range * 2 ) + 1;

		$output = '<div class="clearfix"></div><ul class="pagination">';

		if ( $show_page_hint ) {
			$output .= '<span>Seite ' . $current_page . ' von ' . $num_of_pages . '</span>';
		}

		if ( $current_page > 2 && $current_page > $range + 1 && $num_of_display_pages < $num_of_pages ) {
			$output .= '<li class="at-pag-newest"><a href="' . get_pagenum_link( 1 ) . '" title="' . __( 'Seite 1 - Neueste Artikel', 'affiliatetheme' ) . '" data-page="1">«</a></li>';
		}
		if ( $show_one_pager && $current_page > 1 ) {
			$output .= '<li class="at-pag-prev"><a href="' . get_pagenum_link( $current_page - 1 ) . '" title="Seite ' . ( $current_page - 1 ) . __( '- Neuere Artikel', 'affiliatetheme' ) . '" data-page="' . ( $current_page - 1 ) . '">‹</a></li>';
		}

		for ( $i = 1; $i <= $num_of_pages; $i++ ) {
			if ( $i < $current_page + $range + 1 && $i > $current_page - $range - 1 ) {
				if ( $current_page === $i ) {
					$output .= '<li class="active at-pag-current"><a data-page="' . ( $i ) . '">' . $i . '</a></li>';
				} else {
					$output .= '<li class="at-pag-link"><a href="' . get_pagenum_link( $i ) . '" title="' . __( 'Seite', 'affiliatetheme' ) . ' ' . $i . '" data-page="' . ( $i ) . '">' . $i . '</a></li>';
				}
			}
		}

		if ( $show_one_pager && $current_page < $num_of_pages ) {
			$output .= '<li class="at-pag-next"><a href="' . get_pagenum_link( $current_page + 1 ) . '" title="Seite ' . ( $current_page + 1 ) . __( '- Ältere Artikel', 'affiliatetheme' ) . '" data-page="' . ( $current_page + 1 ) . '">›</i></a></li>';
		}
		if ( $current_page < $num_of_pages - 1 && $current_page + $range < $num_of_pages && $num_of_display_pages < $num_of_pages ) {
			$output .= '<li  class="at-pag-oldest"><a href="' . get_pagenum_link( $num_of_pages ) . '" title="Seite ' . $num_of_pages . __( '- Älteste Artikel', 'affiliatetheme' ) . '" data-page="' . ( $num_of_pages ) . '">»</a></li>';
		}

		$output .= '</ul>';

		return $output;
	}
}

/**
 * Prevent bugs with old child themes
 *
 * @deprecated 2.0
 */
function pagination( $range = 3, $show_one_pager = true, $show_page_hint = false )
{
    atio_pagination($range,$show_one_pager,$show_page_hint);
}