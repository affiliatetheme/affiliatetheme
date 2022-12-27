<?php
/**
 * Kirki Frontend CSS
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    kirki
 */

add_action( 'wp_enqueue_scripts', 'at_load_inline_css', 999 );
function at_load_inline_css() {
	wp_add_inline_style( 'theme', at_inline_css() );
}

function at_rgba_rgb( $rgba ) {
	if ( strpos( $rgba, '#' ) !== false ) {
		return $rgba;
	}

	$rgba_arr = explode( ',', $rgba );
	if ( $rgba_arr && count( $rgba_arr ) > 2 ) {
		$rgb = str_replace( 'rgba(', 'rgb(', $rgba_arr[0] ) . ', ' . $rgba_arr[1] . ', ' . $rgba_arr[2] . ')';
	} else {
		$rgb = '';
	}

	return $rgb;
}

function at_rgb_hex( $rgb ) {
	if ( strpos( $rgb, '#' ) !== false || $rgb == '' ) {
		return $rgb;
	}

	$rgb_arr = explode( ',', $rgb );
	$r       = str_replace( 'rgb(', '', $rgb_arr[0] );
	$g       = $rgb_arr[1];
	$b       = str_replace( ')', '', $rgb_arr[2] ); // prevent bug with rgba

	$hex = "#";
	$hex .= str_pad( dechex( $r ), 2, "0", STR_PAD_LEFT );
	$hex .= str_pad( dechex( $g ), 2, "0", STR_PAD_LEFT );
	$hex .= str_pad( dechex( $b ), 2, "0", STR_PAD_LEFT );

	return $hex;
}

function at_hex_rgb( $hex, $rgba = '' ) {
	$hex = str_replace( "#", "", $hex );

	if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}

	$rgb = array( $r, $g, $b );

	$output = implode( ",", $rgb );

	if ( $rgba ) {
		$output .= ',' . $rgba;
	}

	return $output;
}

function at_inline_css() {
	/*
	 * General
	 */
	$wr_bc = Kirki::get_option( 'wr_bc' );
	$wr_sc = Kirki::get_option( 'wr_sc' );
	$wr_ss = Kirki::get_option( 'wr_ss' );

	/*
	 * Typography
	 */
	$ty_lc   = Kirki::get_option( '', 'ty_lc' );
	$ty_lc_h = Kirki::get_option( '', 'ty_lc_h' );
	$ty_hc   = Kirki::get_option( '', 'ty_hc' );
	$ty_sc   = Kirki::get_option( '', 'ty_sc' );
	$ty_sb   = Kirki::get_option( '', 'ty_sb' );

	$ty_bc   = Kirki::get_option( '', 'ty_bc' );
	$ty_bb   = Kirki::get_option( '', 'ty_bb' );
	$ty_bc_h = Kirki::get_option( '', 'ty_bc_h' );
	$ty_bb_h = Kirki::get_option( '', 'ty_bb_h' );

	$ty_bdc   = Kirki::get_option( '', 'ty_bdc' );
	$ty_bdb   = Kirki::get_option( '', 'ty_bdb' );
	$ty_bdc_h = Kirki::get_option( '', 'ty_bdc_h' );
	$ty_bdb_h = Kirki::get_option( '', 'ty_bdb_h' );

	$ty_bbc   = Kirki::get_option( '', 'ty_bbc' );
	$ty_bbb   = Kirki::get_option( '', 'ty_bbb' );
	$ty_bbc_h = Kirki::get_option( '', 'ty_bbc_h' );
	$ty_bbb_h = Kirki::get_option( '', 'ty_bbb_h' );

	$ty_blc   = Kirki::get_option( '', 'ty_blc' );
	$ty_blc_h = Kirki::get_option( '', 'ty_blc_h' );

	/*
	 * Topbar
	 */
	$to_bc   = Kirki::get_option( '', 'to_bc' );
	$to_lc   = Kirki::get_option( '', 'to_lc' );
	$to_lc_h = Kirki::get_option( '', 'to_lc_h' );
	$to_tc   = Kirki::get_option( '', 'to_tc' );

	/*
	 * Header
	 */
	$he_bc_t = Kirki::get_option( '', 'he_bc_t' );
	$he_bc_b = Kirki::get_option( '', 'he_bc_b' );
	$he_tc   = Kirki::get_option( '', 'he_tc' );
	//$he_fl = Kirki::get_option( '', 'he_fl' );
	$he_lc   = Kirki::get_option( '', 'he_lc' );
	$he_lc_h = Kirki::get_option( '', 'he_lc_h' );

	/*
	 * Navigation
	 */
	$na_bc_t   = Kirki::get_option( '', 'na_bc_t' );
	$na_bc_b   = Kirki::get_option( '', 'na_bc_b' );
	$na_lc     = Kirki::get_option( '', 'na_lc' );
	$na_lc_h   = Kirki::get_option( '', 'na_lc_h' );
	$na_ls     = Kirki::get_option( '', 'na_ls' );
	$na_lb     = Kirki::get_option( '', 'na_lb' );
	$na_la     = Kirki::get_option( '', 'na_la' );
	$na_lb_h_t = Kirki::get_option( '', 'na_lb_h_t' );
	$na_lb_h_b = Kirki::get_option( '', 'na_lb_h_b' );
	$na_bc_l   = Kirki::get_option( '', 'na_bc_l' );
	$na_bc_r   = Kirki::get_option( '', 'na_bc_r' );
	$na_d_bc   = Kirki::get_option( '', 'na_d_bc' );
	$na_d_lc   = Kirki::get_option( '', 'na_d_lc' );
	$na_d_la   = Kirki::get_option( '', 'na_d_la' );
	$na_d_lc_h = Kirki::get_option( '', 'na_d_lc_h' );
	$na_d_lb_h = Kirki::get_option( '', 'na_d_lb_h' );

	/*
	 * Sidebar
	 */
	$sb_bc    = Kirki::get_option( '', 'sb_bc' );
	$sb_bb    = Kirki::get_option( '', 'sb_bb' );
	$sb_tc    = Kirki::get_option( '', 'sb_tc' );
	$sb_tl    = Kirki::get_option( '', 'sb_tl' );
	$sb_hc    = Kirki::get_option( '', 'sb_hc' );
	$sb_hb_t  = Kirki::get_option( '', 'sb_hb_t' );
	$sb_hb_b  = Kirki::get_option( '', 'sb_hb_b' );
	$sb_lc    = Kirki::get_option( '', 'sb_lc' );
	$sb_lc_h  = Kirki::get_option( '', 'sb_lc_h' );
	$sb_lb_h  = Kirki::get_option( '', 'sb_lb_h' );
	$sb_ilc   = Kirki::get_option( '', 'sb_ilc' );
	$sb_ilc_h = Kirki::get_option( '', 'sb_ilc_h' );

	/*
	 * Breadcrumbs
	 */
	$bc_bc   = Kirki::get_option( '', 'bc_bc' );
	$bc_lc   = Kirki::get_option( '', 'bc_lc' );
	$bc_lc_h = Kirki::get_option( '', 'bc_lc_h' );
	$bc_tc   = Kirki::get_option( '', 'bc_tc' );

	/*
	 * Footer
	 */
	$ft_bc   = Kirki::get_option( '', 'ft_bc' );
	$fb_bc   = Kirki::get_option( '', 'fb_bc' );
	$fb_lc   = Kirki::get_option( '', 'fb_lc' );
	$fb_lc_h = Kirki::get_option( '', 'fb_lc_h' );
	$fb_tc   = Kirki::get_option( '', 'fb_tc' );

	/*
	 * Footer Widgets
	 */
	$fw_bc    = Kirki::get_option( '', 'fw_bc' );
	$fw_bb    = Kirki::get_option( '', 'fw_bb' );
	$fw_tc    = Kirki::get_option( '', 'fw_tc' );
	$fw_tl    = Kirki::get_option( '', 'fw_tl' );
	$fw_hc    = Kirki::get_option( '', 'fw_hc' );
	$fw_hb_t  = Kirki::get_option( '', 'fw_hb_t' );
	$fw_hlb   = Kirki::get_option( '', 'fw_hlb' );
	$fw_hb_b  = Kirki::get_option( '', 'fw_hb_b' );
	$fw_lc    = Kirki::get_option( '', 'fw_lc' );
	$fw_lc_h  = Kirki::get_option( '', 'fw_lc_h' );
	$fw_lb_h  = Kirki::get_option( '', 'fw_lb_h' );
	$fw_ilc   = Kirki::get_option( '', 'fw_ilc' );
	$fw_ilc_h = Kirki::get_option( '', 'fw_ilc_h' );

	/*
	 * Tabellen
	 */
	$tah_bt      = Kirki::get_option( '', 'tah_bt' );
	$tah_bb      = Kirki::get_option( '', 'tah_bb' );
	$tah_tc      = Kirki::get_option( '', 'tah_tc' );
	$tahi_bt     = Kirki::get_option( '', 'tahi_bt' );
	$tahi_bb     = Kirki::get_option( '', 'tahi_bb' );
	$tahi_tc     = Kirki::get_option( '', 'tahi_tc' );
	$tahi_td_bc  = Kirki::get_option( '', 'tahi_td_bc' );
	$tahi_td_boc = Kirki::get_option( '', 'tahi_td_boc' );

	/*
	 * Produkt
	 */
	$pr_pr  = Kirki::get_option( '', 'pr_pr' );
	$pr_sp  = Kirki::get_option( '', 'pr_sp' );
	$pr_stv = Kirki::get_option( '', 'pr_stv' );
	$pr_stl = Kirki::get_option( '', 'pr_stl' );
	$pr_hnt = Kirki::get_option( '', 'pr_hnt' );

	/*
	 * Stuff
	 */
	$st_c1 = Kirki::get_option( '', 'st_c1' );
	$st_c2 = Kirki::get_option( '', 'st_c2' );

	$output = '
        #wrapper{
            background-color: ' . at_rgba_rgb( $wr_bc ) . ';
            background-color: ' . $wr_bc . ';
            box-shadow: 0 0 ' . $wr_ss . 'px ' . $wr_sc . ';
        }

        #wrapper-fluid #main{
            background-color: ' . at_rgba_rgb( $wr_bc ) . ';
            background-color: ' . $wr_bc . ';
        }

        a {
            color: ' . $ty_lc . ';
        }

        a:hover, a:focus {
            color: ' . $ty_lc_h . ';
        }

        ::selection {
	        background: ' . $ty_sb . ';
	        color: ' . $ty_sc . ';
        }

        ::-moz-selection {
	        background: ' . $ty_sb . ';
	        color: ' . $ty_sc . ';
        }

		
        .btn-at, .btn-primary {
            color: ' . $ty_bc . ';
            background-color: ' . $ty_bb . ';
            border-color: ' . $ty_bb . ';
        }
		
        .btn-detail {
            color: ' . $ty_bdc . ';
            background-color: ' . $ty_bdb . ';
            border-color: ' . $ty_bdb . ';
        }
		
        .btn-buy {
            color: ' . $ty_bbc . ';
            background-color: ' . $ty_bbb . ';
            border-color: ' . $ty_bbb . ';
        }
		
        .btn-link {
            color: ' . $ty_blc . ';
        }
		
		.btn-at.btn-outline, .btn-primary.btn-outline {
			background: none;
			color: ' . $ty_bb . ';
		}
		
		.btn-detail.btn-outline {
			background: none;
            color: ' . $ty_bdb . ';
		}
		
		.btn-buy.btn-outline {
			background: none;
            color: ' . $ty_bbb . ';
		}
		
        .btn-at:hover, .btn-at:focus, .btn-at:active, .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary:active:hover, .btn-primary:active:focus {
            color: ' . $ty_bc_h . ';
            background-color: ' . $ty_bb_h . ';
            border-color: ' . $ty_bb_h . ';
        }
		
        .btn-detail:hover, .btn-detail:focus, .btn-detail:active {
            color: ' . $ty_bdc_h . ';
            background-color: ' . $ty_bdb_h . ';
            border-color: ' . $ty_bdb_h . ';
        }
		
        .btn-buy:hover, .btn-buy:focus, .btn-buy:active {
            color: ' . $ty_bbc_h . ';
            background-color: ' . $ty_bbb_h . ';
            border-color: ' . $ty_bbb_h . ';
        }
		
        .btn-link:hover, .btn-link:focus, .btn-link:active {
            color: ' . $ty_blc_h . ';
        }

        #topbar {
            background-color: ' . at_rgba_rgb( $to_bc ) . ';
            background-color: ' . $to_bc . ';
            color: ' . $to_tc . ';
        }

        #topbar a {
            color: ' . $to_lc . ';
        }

        #topbar a:hover, #topbar a:focus {
            color: ' . $to_lc_h . ';
        }

        #header {
            color: ' . $he_tc . ';
            background-color: ' . at_rgba_rgb( $he_bc_b ) . ';
            background: -moz-linear-gradient(top,  ' . $he_bc_t . ' 0%, ' . $he_bc_b . ' 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . $he_bc_t . '), color-stop(100%,' . $he_bc_b . '));
            background: -webkit-linear-gradient(top,  ' . $he_bc_t . ' 0%,' . $he_bc_b . ' 100%);
            background: -o-linear-gradient(top,  ' . $he_bc_t . ' 0%,' . $he_bc_b . ' 100%);
            background: -ms-linear-gradient(top,  ' . $he_bc_t . ' 0%,' . $he_bc_b . ' 100%);
            background: linear-gradient(to bottom,  ' . $he_bc_t . ' 0%,' . $he_bc_b . ' 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . at_rgb_hex( at_rgba_rgb( $he_bc_t ) ) . '\', endColorstr=\'' . at_rgb_hex( at_rgba_rgb( $he_bc_b ) ) . '\',GradientType=0 );
        }

        #header .brand {
	        color: ' . $he_lc . ';
        }

        #header .brand small {
            color: ' . $he_tc . ';
        }

        #header .brand:hover, #header .brand:focus {
	        color: ' . $he_lc_h . ';
        }

		.cart-mini .fa {
			color: ' . $he_lc . ';
		}
		
		.cart-mini strong {
			color: ' . $he_lc_h . ';
		}

		.cart-mini a:hover strong,
		.cart-mini a:focus strong {
			color:  ' . $he_lc . ';
		}
		
		.cart-mini small {
			color: ' . $he_tc . ';
		}

        #navigation .navbar {
	        background-color: ' . at_rgba_rgb( $na_bc_b ) . ';
            background: -moz-linear-gradient(top, ' . $na_bc_t . ' 0px, ' . $na_bc_b . ' 50px);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0px,' . $na_bc_t . '), color-stop(50px,' . $na_bc_b . '));
            background: -webkit-linear-gradient(top, ' . $na_bc_t . ' 0px,' . $na_bc_b . ' 50px);
            background: -o-linear-gradient(top, ' . $na_bc_t . ' 0px,' . $na_bc_b . ' 50px);
            background: -ms-linear-gradient(top, ' . $na_bc_t . ' 0px,' . $na_bc_b . ' 50px);
            background: linear-gradient(to bottom, ' . $na_bc_t . ' 0px,' . $na_bc_b . ' 50px);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . at_rgb_hex( at_rgba_rgb( $na_bc_t ) ) . '\', endColorstr=\'' . at_rgb_hex( at_rgba_rgb( $na_bc_b ) ) . '\',GradientType=0 );
        }

        #navigation .navbar .navbar-nav > li > a {
            color: ' . $na_lc . ';
        }

        #navigation .navbar .navbar-nav > li > a:hover,
        #navigation .navbar .navbar-nav > li > a:focus,
        #navigation .navbar .navbar-nav > li:hover > a,
        #navigation .navbar .navbar-nav > .open > a,
        #navigation .navbar .navbar-nav > .open > a:hover,
        #navigation .navbar .navbar-nav > .open > a:focus,
        #navigation .navbar .navbar-nav > .current_page_item > a:hover,
        #navigation .navbar .navbar-nav > .current_page_item > a:focus,
        #navigation .navbar .navbar-nav > .current_page_parent > a:hover,
        #navigation .navbar .navbar-nav > .current_page_parent > a:focus {
            color: ' . $na_lc_h . ';
            background-color: ' . at_rgba_rgb( $na_lb_h_b ) . ';
            background: -moz-linear-gradient(top, ' . $na_lb_h_t . ' 0%, ' . $na_lb_h_b . ' 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . $na_lb_h_t . '), color-stop(100%,' . $na_lb_h_b . '));
            background: -webkit-linear-gradient(top, ' . $na_lb_h_t . ' 0%,' . $na_lb_h_b . ' 100%);
            background: -o-linear-gradient(top, ' . $na_lb_h_t . ' 0%,' . $na_lb_h_b . ' 100%);
            background: -ms-linear-gradient(top, ' . $na_lb_h_t . ' 0%,' . $na_lb_h_b . ' 100%);
            background: linear-gradient(to bottom, ' . $na_lb_h_t . ' 0%,' . $na_lb_h_b . ' 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . at_rgb_hex( at_rgba_rgb( $na_lb_h_t ) ) . '\', endColorstr=\'' . at_rgb_hex( at_rgba_rgb( $na_lb_h_b ) ) . '\',GradientType=0 );
        }

        #navigation .navbar .navbar-nav > .current_page_item > a,
        #navigation .navbar .navbar-nav > .current_page_parent > a,
		#navigation .navbar .navbar-nav > .current-menu-item > a,
        #navigation .navbar .navbar-nav > .current-menu-ancestor > a {
            color: ' . $na_la . ';
        }

        #navigation .navbar .navbar-brand {
            color: ' . $na_lb . ';
        }

        #navigation .navbar .navbar-brand:hover, #navigation .navbar .navbar-brand:focus {
            color: ' . $na_lc_h . ';
        }

        #navigation .navbar .navbar-brand, #navigation .navbar .navbar-nav > li > a {
            text-shadow: 0 1px 0 ' . $na_ls . ';
        }
		
        @media (max-width: 767px) {
            #navigation .navbar .navbar-toggle .icon-bar {
                box-shadow: 0 1px 0 ' . $na_ls . ';
            }
        }

        @media (min-width: 768px) {
            #navigation .navbar .navbar-nav {
                border-right: 1px solid ' . at_rgba_rgb( $na_bc_l ) . ';
                border-right: 1px solid ' . $na_bc_l . ';
                border-left: 1px solid ' . at_rgba_rgb( $na_bc_r ) . ';
                border-left: 1px solid ' . $na_bc_r . ';
            }

            #navigation .navbar .navbar-nav > li {
                border-right: 1px solid ' . at_rgba_rgb( $na_bc_r ) . ';
                border-right: 1px solid ' . $na_bc_r . ';
                border-left: 1px solid ' . at_rgba_rgb( $na_bc_l ) . ';
                border-left: 1px solid ' . $na_bc_l . ';
            }

            #navigation .dropdown-submenu > a:after {
                border-left-color: ' . $na_d_la . ';
            }
			
            #navigation .dropdown-submenu:hover > a:after,
            #navigation .dropdown-submenu.open > a:after,
            #navigation .dropdown-submenu > a:hover:after,
            #navigation .dropdown-submenu > a:focus:after {
                border-left-color: ' . $na_d_lc_h . '!important;
            }
        }

        @media (max-width: 767px) {
            #navigation .navbar .navbar-collapse {
                border-color: ' . at_rgba_rgb( $na_bc_r ) . ';
                border-color: ' . $na_bc_r . ';
                box-shadow: inset 0 1px 0 ' . at_rgba_rgb( $na_bc_l ) . ';
                box-shadow: inset 0 1px 0 ' . $na_bc_l . ';
            }

            #navigation .navbar .navbar-form {
                border-color: ' . at_rgba_rgb( $na_bc_r ) . ';
                border-color: ' . $na_bc_r . ';
                box-shadow: inset 0 1px 0 ' . at_rgba_rgb( $na_bc_l ) . ', 0 1px 0 ' . at_rgba_rgb( $na_bc_l ) . ';
                box-shadow: inset 0 1px 0 ' . $na_bc_l . ', 0 1px 0 ' . $na_bc_l . ';
            }
        }

        #navigation .navbar .navbar-toggle .icon-bar {
            background-color: ' . $na_lb . ';
        }
        #navigation .navbar .navbar-toggle:hover .icon-bar, #navigation .navbar .navbar-toggle:focus .icon-bar {
            background-color: ' . $na_lc . ';
        }

        #navigation .dropdown-menu {
            background-color: ' . at_rgba_rgb( $na_d_bc ) . ';
            background-color: ' . $na_d_bc . ';
        }
		
        #navigation .dropdown-menu > li > a {
            color: ' . $na_d_lc . ';
        }
		
        #navigation .dropdown-menu > .current_page_item > a,
        #navigation .dropdown-menu > .current_page_parent > a {
            color: ' . $na_d_la . ';
        }
		
        #navigation .dropdown-menu > .current_page_item > a:after, #navigation .dropdown-menu > .current_page_parent > a:after {
            border-left-color: ' . $na_d_la . ';
        }
		
        #navigation .dropdown-menu > li:hover > a,
        #navigation .dropdown-menu > li.open > a,
        #navigation .dropdown-menu > li > a:hover,
        #navigation .dropdown-menu > li > a:focus {
            background-color: ' . at_rgba_rgb( $na_d_lb_h ) . ';
            background-color: ' . $na_d_lb_h . ';
            color: ' . $na_d_lc_h . ';
        }
		
        .thumbnail[class*="product-"] .product-title {
            color: ' . $st_c2 . ';
        }
		
        .thumbnail[class*="product-"] .product-title:hover,
		.thumbnail[class*="product-"] .product-title:focus {
            color: ' . $st_c1 . ';
            text-decoration: none;
        }
		
        #sidebar .widget {
            background-color: ' . at_rgba_rgb( $sb_bc ) . ';
            background-color: ' . $sb_bc . ';
            border: 1px solid ' . $sb_bb . ';
        }
		
		#sidebar .widget .h1 {
            color: ' . $sb_hc . ';
            background-color: ' . at_rgba_rgb( $sb_hb_b ) . ';
            background: -moz-linear-gradient(top, ' . $sb_hb_t . ' 0%, ' . $sb_hb_b . ' 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . $sb_hb_t . '), color-stop(100%,' . $sb_hb_b . '));
            background: -webkit-linear-gradient(top, ' . $sb_hb_t . ' 0%,' . $sb_hb_b . ' 100%);
            background: -o-linear-gradient(top, ' . $sb_hb_t . ' 0%,' . $sb_hb_b . ' 100%);
            background: -ms-linear-gradient(top, ' . $sb_hb_t . ' 0%,' . $sb_hb_b . ' 100%);
            background: linear-gradient(to bottom, ' . $sb_hb_t . ' 0%,' . $sb_hb_b . ' 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . at_rgb_hex( at_rgba_rgb( $sb_hb_t ) ) . '\', endColorstr=\'' . at_rgb_hex( at_rgba_rgb( $sb_hb_b ) ) . '\',GradientType=0 );
        }
		
        #sidebar .widget_inline ul li,
        #sidebar .widget_block ul li a,
		#sidebar .widget_amazon_cart .price-sum,
        .filterform .form-group {
            border-top: 1px solid ' . $sb_bb . ';
        }
		
		#sidebar .widget hr {
			border-color:  ' . $sb_bb . ';
		}
		
		#sidebar .widget_amazon_cart .price-sum {
			border-bottom: 1px solid ' . $sb_bb . ';
		}
		
		#sidebar .widget a:not(.btn),
		.thumbnail[class*="product-"] .product-title {
			color:  ' . $sb_ilc . ';
		}
		
		#sidebar .widget a:not(.btn):hover,
		#sidebar .widget a:not(.btn):focus,
		.thumbnail[class*="product-"] .product-title:hover,
		.thumbnail[class*="product-"] .product-title:focus {
			color:  ' . $sb_ilc_h . ';
		}
		
        #sidebar .widget_block a:not(.btn),
		#sidebar .widget_product_feed ul li a p,
		#sidebar .widget_amazon_cart ul li a p {
            color: ' . $sb_lc . ';
        }
		
        #sidebar .widget_block a:not(.btn):hover,
        #sidebar .widget_block a:not(.btn):focus,
		#sidebar .widget_product_feed ul li a:hover p,
		#sidebar .widget_amazon_cart ul li a:hover p,
		#sidebar .widget_product_feed ul li a:focus p,
		#sidebar .widget_amazon_cart ul li a:focus p {
            background-color: ' . at_rgba_rgb( $sb_lb_h ) . ';
            background-color: ' . $sb_lb_h . ';
            color: ' . $sb_lc_h . ';
        }
		
        #sidebar .widget_block ul > li > a:hover + .count,
        #sidebar .widget_block ul > li > a:focus + .count {
            color: ' . $sb_lc_h . '; 
        }
		
        #sidebar .widget_inline ul li,
        #sidebar .widget .post-date,
        #sidebar .widget .rss-date,
        #sidebar .widget cite,
        #sidebar .widget .count,
        #sidebar .widget_inline caption,
		#sidebar .widget .filterform .slide span,
		#sidebar .widget_amazon_cart .remove a,
		#sidebar .widget .filterform .filter-instruction,
		#sidebar .widget_calendar #wp-calendar td,
		#sidebar .widget_product_advice .product-tax a {
            color: ' . $sb_tl . ';
        }
		
		#sidebar .widget .textwidget,
		#sidebar .widget .filterform label,
		#sidebar .widget .filterform .control-label,
		#sidebar .widget_calendar #wp-calendar th,
		#sidebar .widget_calendar #wp-calendar caption,
		#sidebar .widget label.screen-reader-text,
		#sidebar .widget_amazon_cart .price-sum {
            color: ' . $sb_tc . ';
		}
		
		.toc_widget > .toc_widget_list li {
			border-top: 1px solid ' . $sb_bb . ';
		}
		
		.toc_widget > .toc_widget_list li a > .toc_number {
			color: ' . $sb_lc_h . ';
		}
		
        #footer .widget {
            background-color: ' . at_rgba_rgb( $fw_bc ) . ';
            background-color: ' . $fw_bc . ';
            border: 1px solid ' . $fw_bb . ';
        }
		
		#footer .widget .h1 {
            color: ' . $fw_hc . ';
            background-color: ' . at_rgba_rgb( $fw_hb_b ) . ';
            background: -moz-linear-gradient(top, ' . $fw_hb_t . ' 0%, ' . $fw_hb_b . ' 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . $fw_hb_t . '), color-stop(100%,' . $fw_hb_b . '));
            background: -webkit-linear-gradient(top, ' . $fw_hb_t . ' 0%,' . $fw_hb_b . ' 100%);
            background: -o-linear-gradient(top, ' . $fw_hb_t . ' 0%,' . $fw_hb_b . ' 100%);
            background: -ms-linear-gradient(top, ' . $fw_hb_t . ' 0%,' . $fw_hb_b . ' 100%);
            background: linear-gradient(to bottom, ' . $fw_hb_t . ' 0%,' . $fw_hb_b . ' 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . at_rgb_hex( at_rgba_rgb( $fw_hb_t ) ) . '\', endColorstr=\'' . at_rgb_hex( at_rgba_rgb( $fw_hb_b ) ) . '\',GradientType=0 );	
			' . ( $fw_hlb == '1' ? 'border-bottom: 1px solid ' . $fw_bb . ';' : '' ) . '
		}
		
        #footer .widget_inline ul li,
        #footer .widget_block ul > li > a,
		#footer .widget_amazon_cart .price-sum,
        #footer .filterform .form-group {
            border-top: 1px solid ' . $fw_bb . ';
        }
		
		#footer .widget hr {
			border-color:  ' . $fw_bb . ';
		}
		
		#footer .widget_amazon_cart .price-sum {
			border-bottom: 1px solid ' . $fw_bb . ';
		}
		
		#footer .widget a:not(.btn),
		#footer .thumbnail[class*="product-"] .product-title {
			color:  ' . $fw_ilc . ';
		}
		
		#footer .widget a:not(.btn):hover,
		#footer .widget a:not(.btn):focus,
		#footer .thumbnail[class*="product-"] .product-title:hover,
		#footer .thumbnail[class*="product-"] .product-title:focus {
			color:  ' . $fw_ilc_h . ';
		}
		
        #footer .widget_block a:not(.btn),
		#footer .widget_product_feed ul li a p,
		#footer .widget_amazon_cart ul li a p {
            color: ' . $fw_lc . ';
        }
		
        #footer .widget_block a:not(.btn):hover,
        #footer .widget_block a:not(.btn):focus,
		#footer .widget_product_feed ul li a:hover p,
		#footer .widget_amazon_cart ul li a:hover p,
		#footer .widget_product_feed ul li a:focus p,
		#footer .widget_amazon_cart ul li a:focus p {
            background-color: ' . at_rgba_rgb( $fw_lb_h ) . ';
            background-color: ' . $fw_lb_h . ';
            color: ' . $fw_lc_h . ';
        }
		
        #footer .widget_block ul > li > a:hover + .count,
        #footer .widget_block ul > li > a:focus + .count {
            color: ' . $fw_lc_h . '; 
        }
		
        #footer .widget_inline ul li,
        #footer .widget .post-date,
        #footer .widget .rss-date,
        #footer .widget cite,
        #footer .widget .count,
        #footer .widget_inline caption,
		#footer .widget .filterform .slide span,
		#footer .widget_amazon_cart .remove a,
		#footer .widget .filterform .filter-instruction,
		#footer .widget_calendar #wp-calendar td,
		#footer .widget_product_advice .product-tax a {
            color: ' . $fw_tl . ';
        }
		
		#footer .widget .textwidget,
		#footer .widget .filterform label,
		#footer .widget .filterform .control-label,
		#footer .widget_calendar #wp-calendar th,
		#footer .widget_calendar #wp-calendar caption,
		#footer .widget label.screen-reader-text,
		#footer .widget_amazon_cart .price-sum {
            color: ' . $fw_tc . ';
		}
        
		.table-amazon-cart .product-title p a {
			color: ' . $st_c2 . ';
		}
		
		.table-amazon-cart .product-title p a:hover,
		.table-amazon-cart .product-title p a:focus {
			color: ' . $st_c1 . ';
		}
		
        #breadcrumbs {
            background-color: ' . at_rgba_rgb( $bc_bc ) . ';
            background-color: ' . $bc_bc . ';
        }
		
        #breadcrumbs p {
            color: ' . $bc_tc . ';
        }
		
        #breadcrumbs a {
            color: ' . $bc_lc . ';
        }
		
        #breadcrumbs a:hover,
        #breadcrumbs a:focus {
            color: ' . $bc_lc_h . ';
        }
 
        #footer-top {
            background-color: ' . at_rgba_rgb( $ft_bc ) . ';
            background-color: ' . $ft_bc . ';
        }
		
        #footer-bottom {
            background-color: ' . at_rgba_rgb( $fb_bc ) . ';
            background-color: ' . $fb_bc . ';
            color: ' . $fb_tc . ';
        }

        #footer-bottom a {
            color: ' . $fb_lc . ';
        }

        #footer-bottom a:hover, #footer-bottom a:focus {
            color: ' . $fb_lc_h . ';
        }

        .table-product > thead > tr > th {
            color: ' . $tah_tc . ';
            background: ' . $tah_bt . ';
            background: -moz-linear-gradient(top,  ' . $tah_bt . ' 0%, ' . $tah_bb . ' 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . $tah_bt . '), color-stop(100%,' . $tah_bb . '));
            background: -webkit-linear-gradient(top,  ' . $tah_bt . ' 0%,' . $tah_bb . ' 100%);
            background: -o-linear-gradient(top,  ' . $tah_bt . ' 0%,' . $tah_bb . ' 100%);
            background: -ms-linear-gradient(top,  ' . $tah_bt . ' 0%,' . $tah_bb . ' 100%);
            background: linear-gradient(to bottom,  ' . $tah_bt . ' 0%,' . $tah_bb . ' 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="' . at_rgb_hex( at_rgba_rgb( $tah_bt ) ) . '", endColorstr="' . at_rgb_hex( at_rgba_rgb( $tah_bb ) ) . '",GradientType=0 );
        }

        .table-product-x thead tr:first-of-type .table-highlight {
            color: ' . $tahi_tc . ';
            background: ' . $tahi_bt . ';
            background: -moz-linear-gradient(top,  ' . $tahi_bt . ' 0%, ' . $tahi_bb . ' 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . $tahi_bt . '), color-stop(100%,' . $tahi_bb . '));
            background: -webkit-linear-gradient(top,  ' . $tahi_bt . ' 0%,' . $tahi_bb . ' 100%);
            background: -o-linear-gradient(top,  ' . $tahi_bt . ' 0%,' . $tahi_bb . ' 100%);
            background: -ms-linear-gradient(top,  ' . $tahi_bt . ' 0%,' . $tahi_bb . ' 100%);
            background: linear-gradient(to bottom,  ' . $tahi_bt . ' 0%,' . $tahi_bb . ' 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="' . at_rgb_hex( at_rgba_rgb( $tahi_bt ) ) . '", endColorstr="' . at_rgb_hex( at_rgba_rgb( $tahi_bb ) ) . '",GradientType=0 );
            border-left: 2px solid ' . $tahi_bb . ' !important; border-right: 2px solid ' . $tahi_bb . ' !important;
       }

        .table-product-x tbody .table-highlight {
            border-left: 2px solid ' . $tahi_bb . ' !important; border-right: 2px solid ' . $tahi_bb . ' !important;
        }

        .table-product-x tbody tr:last-of-type .table-highlight {
            border-bottom: 2px solid ' . $tahi_bb . ' !important;
        }

        .table-product-y .table-highlight {
            border: none; box-shadow: 0 2px 0 ' . $tahi_bb . ' inset, 0 -2px 0 ' . $tahi_bb . ' inset;
        }

        .table-product-y .table-highlight:first-of-type {
            background: ' . $tahi_bb . ';
            color: ' . $tahi_tc . ';
        }

        .table-product-y .table-highlight:last-of-type {
            box-shadow: 0 2px 0 ' . $tahi_bb . ' inset, 0 -2px 0 ' . $tahi_bb . ' inset, -2px 0 0 ' . $tahi_bb . ' inset;
        }

        .table-product .table-highlight {
            background: ' . $tahi_td_bc . '; border-color: ' . $tahi_td_boc . ';
        }

        #header > .container .form-search .btn:hover, #header > .container .form-search .btn:focus {
            color: ' . $st_c1 . ';
        }

        .post-meta a:hover, .post-meta a:focus {
            color: ' . $st_c1 . ';
        }

        article[class*="post-"] > h2 > a:hover, article[class*="post-"] > h2 > a:focus, article[class*="post-"] > .post-inner > h2 > a:hover,
        article[class*="post-"] > .post-inner > h2 > a:focus {
            color: ' . $st_c1 . ';
        }

        .pagination > li > a:hover, .pagination > li > span:hover, .pagination > li > a:focus, .pagination > li > span:focus {
            color: ' . $st_c1 . ';
        }

        .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover,
        .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
            background-color: ' . $st_c1 . ';
            border-color: ' . $st_c1 . ';
        }

        .pager li > a:hover, .pager li > a:focus {
            color: ' . $st_c1 . ';
        }

        .comment .media-heading a:hover, .comment .media-heading a:focus {
            color: ' . $st_c1 . ';
        }

        .comment .comment-reply-link:hover, .comment .comment-reply-link:focus {
            color: ' . $st_c1 . ';
        }

        .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
            color: ' . $st_c1 . ';
        }

        div[id*="accordion"] .panel-heading .panel-title[aria-expanded="true"] {
            color: ' . $st_c1 . ';
        }

        @media (max-width: 767px) {
            #atTab.nav-tabs .dropdown-menu > li > a:focus, #atTab.nav-tabs .dropdown-menu > li > a:hover {
                color: ' . $st_c1 . ';
            }
            #atTab.nav-tabs .dropdown-menu > li.active > a {
                background: ' . $st_c1 . ';
            }
        }

        .result-filter .btn-link.active {
            color: ' . $st_c1 . ';
        }

        .badge-at  {
            background: ' . $st_c1 . ';
        }

        .table-product .product-title > a:hover, .table-product .product-title > a:focus {
            color: ' . $st_c1 . ';
        }

        .product-reviews-number .progress svg path {
            stroke: ' . $st_c1 . ';
        }

        .filterform .slider-selection {
            background: ' . $st_c1 . ';
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: ' . $st_c1 . ';
        }

        .select2-container--default .select2-results > .select2-results__options::-webkit-scrollbar-thumb:active {
            background: ' . $st_c1 . ';
        }

        article[class*="post-"] > h2 > a, article[class*="post-"] > .post-inner > h2 > a {
            color: ' . $st_c2 . ';
        }

        .comment .media-heading {
            color: ' . $st_c2 . ';
        }

        .form-control:focus {
            color:' . $st_c2 . ';
        }

        .result-filter .btn-link:hover, .result-filter .btn-link:focus {
            color: ' . $st_c2 . ';
        }

        .table-product .product-title > a {
            color: ' . $st_c2 . ';
        }

        .product_top_rated .title a {
            color: ' . $st_c2 . ';
        }

        .product_top_rated .title a:hover, .product_top_rated .title a:focus {
            color: ' . $st_c1 . ';
        }

        .product-select-shortcode .label-control {
            color: ' . $st_c2 . ';
        }

        .product_top_rated .progress-bar {
            background: ' . $st_c1 . ';
        }

        .product-grid-hover:hover .caption-hover {
            box-shadow: 0 0 0 3px ' . $st_c1 . ';
        }

        .product-grid-hover .caption-hover .caption-hover-txt {
            border: 3px solid ' . $st_c1 . ';
        }

        .page-nav > span {
            color: ' . $st_c1 . ';
        }

        .page-nav a:hover, .page-nav a:focus {
            color: ' . $st_c1 . ';
        }

		.product-price .price,
		.widget_amazon_cart .product-price {
			color: ' . $pr_pr . ';
		}
		
		.product-price .price del,
		.widget_amazon_cart .product-price del {
			color: ' . $pr_sp . ';
		}

		.product-rating {
			color: ' . $pr_stv . ';
		}
		
		.product-rating [class*="fa-star"] {
			color: ' . $pr_stl . ';
		}

		.product-price .price-hint {
			color: ' . $pr_hnt . ';
		}
		
		.table-product .product-reviews .rating-summary-value {
			color: ' . $st_c2 . ';
		}
		
		.cookie-bar { 
			background: rgba(' . at_hex_rgb( $st_c2 ) . ', 0.95); 
		}

    ';

	$search  = array(
		'/\>[^\S ]+/s',  // strip whitespaces after tags, except space
		'/[^\S ]+\</s',  // strip whitespaces before tags, except space
		'/(\s)+/s',       // shorten multiple whitespace sequences
	);
	$replace = array(
		'>',
		'<',
		'\\1',
	);

	$output = preg_replace( $search, $replace, $output );
	$output = str_replace( ': ', ':', $output );
	$output = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $output );

	return $output;
}