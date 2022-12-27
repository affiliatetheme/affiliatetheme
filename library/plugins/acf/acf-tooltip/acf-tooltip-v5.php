<?php
add_action( 'acf/input/admin_head', 'act_tooltip_enqueue' );
function act_tooltip_enqueue() {
    wp_enqueue_script( 'acf_tooltip_script', get_template_directory_uri() . '/library/plugins/acf/acf-tooltip/js/acf-tooltip-v5.js', array('jquery-qtip'), '1.3' );
    wp_enqueue_style( 'acf_tooltip_css',get_template_directory_uri() . '/library/plugins/acf/acf-tooltip/css/acf-tooltip.css',  array(), '1.3' );
    wp_enqueue_script( 'jquery-qtip', get_template_directory_uri() . '/library/plugins/acf/acf-tooltip/js/jquery.qtip.min.js', array(), '1.3' );
	wp_enqueue_style( 'jquery-qtip.js', get_template_directory_uri() . '/library/plugins/acf/acf-tooltip/css/jquery.qtip.min.css', array(), '1.3' );
}
?>
