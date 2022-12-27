<?php

global $wp, $cloak_slug;

/*
 * VARS
 *
 */
$post_id = $wp->query_vars[ $cloak_slug ];
$shop_id = ( $wp->query_vars['shop_id'] ? $wp->query_vars['shop_id'] : '0' );

if ( $post_id != "" ) {
	$link = apply_filters( 'at_page_cloaker_link', get_product_link( $post_id, $shop_id, true ), $post_id, $shop_id );
} else {
	wp_redirect( home_url(), 301 );
}
?>
<html>
<head>
	<title><?php _e( 'Weiterleitung', 'affiliatetheme' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta name="robots" content="noindex, nofollow">
	<link rel="canonical" href="<?= get_permalink( $post_id ); ?>"/>
	<style>body {
			height: 100%;
			margin: 0
		}

		.notice {
			position: absolute;
			left: 0;
			right: 0;
			font-size: 12px;
			color: #9fa2a5;
			font-family: Verdana, sans-serif;
			text-align: center;
			margin: 40px 0 0
		}

		.notice a {
			color: #101820;
			text-decoration: none
		}

		.notice a:focus, .notice a:hover {
			color: #c01313
		}

		.preloader-scan {
			position: fixed;
			left: 0;
			right: 0;
			max-width: 200px;
			width: 100%;
			display: table;
			margin: 0 auto;
			height: 100%;
			text-align: center
		}

		.preloader-scan li:nth-child(1) {
			width: 3px
		}

		.preloader-scan li:nth-child(2), .preloader-scan li:nth-child(3), .preloader-scan li:nth-child(4) {
			width: 4px
		}

		.preloader-scan li:nth-child(5) {
			width: 1px
		}

		.preloader-scan li:nth-child(6) {
			width: 3px
		}

		.preloader-scan li:nth-child(7), .preloader-scan li:nth-child(8) {
			width: 5px
		}

		.preloader-scan li:nth-child(9) {
			width: 3px
		}

		.preloader-scan li:nth-child(10) {
			width: 2px
		}

		.preloader-scan li:nth-child(11), .preloader-scan li:nth-child(12) {
			width: 3px
		}

		.preloader-scan li:nth-child(13) {
			width: 4px
		}

		.preloader-scan li:nth-child(14) {
			width: 5px
		}

		.preloader-scan li:nth-child(15), .preloader-scan li:nth-child(16), .preloader-scan li:nth-child(17), .preloader-scan li:nth-child(18) {
			width: 3px
		}

		.preloader-scan li:nth-child(19) {
			width: 1px
		}

		.preloader-scan li:nth-child(20), .preloader-scan li:nth-child(21) {
			width: 4px
		}

		.preloader-scan li:nth-child(22) {
			width: 1px
		}

		.preloader-scan li:nth-child(23) {
			width: 2px
		}

		.preloader-scan li:nth-child(24) {
			width: 3px
		}

		.preloader-scan ul {
			height: 100%;
			display: table-cell;
			vertical-align: middle;
			list-style-type: none;
			text-align: center;
			margin: 0;
			padding: 0;
			border: 0;
			font-size: 100%
		}

		.preloader-scan li {
			display: inline-block;
			width: 2px;
			height: 50px;
			background-color: #444
		}

		.preloader-scan .laser {
			width: 150%;
			margin-left: -25%;
			background-color: tomato;
			height: 1px;
			position: absolute;
			top: 45%;
			z-index: 2;
			box-shadow: 0 0 4px red;
			-webkit-animation: scanning 2s infinite;
			animation: scanning 2s infinite
		}

		.preloader-scan .diode {
			-webkit-animation: beam .01s infinite;
			animation: beam .01s infinite
		}

		@-webkit-keyframes beam {
			50% {
				opacity: 0
			}
		}

		@keyframes beam {
			50% {
				opacity: 0
			}
		}

		@-webkit-keyframes scanning {
			50% {
				-webkit-transform: translateY(75px);
				transform: translateY(75px)
			}
		}

		@keyframes scanning {
			50% {
				-webkit-transform: translateY(75px);
				transform: translateY(75px)
			}
		}

		#footer {
			position: absolute;
			left: 0;
			right: 0;
			font-size: 12px;
			color: #9fa2a5;
			font-family: Verdana, sans-serif;
			text-align: center;
			margin: 0 0 40px 0;
		}

		#footer ul {
			padding: 0;
			margin: 0;
			list-style: none;
		}

		#footer ul li {
			display: inline-block;
			padding: 0 10px;
		}

		#footer a {
			color: #101820;
			text-decoration: none;
		}

		#footer a:focus, #footer a:hover {
			color: #c01313;
		}</style>
</head>
<body>
<?php do_action( 'at_page_cloaker_before_content' ); ?>
<p class="notice"><?php printf( __( 'Du wirst sofort weitergeleitet. Falls nicht, klicke <a href="%s" rel="nofollow">hier.', 'affiliatetheme' ), $link ); ?></a></p>
<div clas="preloader-scan-wrapper">
	<div class="preloader-scan">
		<ul>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<div class="diode">
				<div class="laser"></div>
			</div>
		</ul>
	</div>
</div>
<script type="text/javascript">
	setTimeout(function () {
		window.location = "<?= $link; ?>";
	}, <?= apply_filters( 'at_page_cloaker_wait_time', 2000, $post_id, $shop_id ); ?>);
</script>
<?php do_action( 'at_page_cloaker_after_content' ); ?>
</body>
</html>

