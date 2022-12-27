<?php
/**
 * Custom Class für jedes Widget (auch Core Widgets)
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    widgets
 */

add_action( 'in_widget_form', 'at_in_widget_form', 99, 99 );
function at_in_widget_form( $t, $return, $instance )
{
	$instance = wp_parse_args( (array)$instance, array( 'at_class' => '' ) );
	if ( ! isset( $instance['at_class'] ) )
		$instance['at_class'] = null;
	?>
	<p>
		<label for="<?php echo $t->get_field_id( 'at_class' ); ?>"><?php _e( 'CSS-Klasse:', 'affiliatetheme-backend' ); ?></label><br>
		<input type="text" class="widefat" id="<?php echo $t->get_field_id( 'at_class' ); ?>" name="<?php echo $t->get_field_name( 'at_class' ); ?>" value="<?php echo $instance['at_class']; ?>"/>
	</p>
	<?php
	$return = null;

	return array( $t, $return, $instance );
}

add_filter( 'widget_update_callback', 'at_in_widget_form_update', 5, 3 );
function at_in_widget_form_update( $instance, $new_instance, $old_instance )
{
	$instance['at_class'] = $new_instance['at_class'];

	return $instance;
}

add_filter( 'dynamic_sidebar_params', 'at_dynamic_sidebar_params' );
function at_dynamic_sidebar_params( $params )
{
	global $wp_registered_widgets;
	$widget_id  = $params[0]['widget_id'];
	$widget_obj = $wp_registered_widgets[ $widget_id ];
	$widget_opt = get_option( $widget_obj['callback'][0]->option_name );
	$widget_num = $widget_obj['params'][0]['number'];

	// widget_block
	$class_widget_block_search  = array(
		'/widget_archive/',
		'/widget_categories/',
		'/widget_meta/',
		'/widget_nav_menu/',
		'/widget_pages/',
		'/widget_product_feed/',
		'/widget_terms/'
	);
	$class_widget_block_replace = array(
		'widget_block widget_archive',
		'widget_block widget_categories',
		'widget_block widget_meta',
		'widget_block widget_nav_menu',
		'widget_block widget_pages',
		'widget_block widget_product_feed',
		'widget_block widget_terms'
	);
	$params[0]['before_widget'] = preg_replace( $class_widget_block_search, $class_widget_block_replace, $params[0]['before_widget'], 1 );

	// widget_inline
	$class_widget_inline_search  = array(
		'/widget_recent_comments/',
		'/widget_recent_entries/',
		'/widget_rss/',
	);
	$class_widget_inline_replace = array(
		'widget_inline widget_recent_comments',
		'widget_inline widget_recent_entries',
		'widget_inline widget_rss'
	);
	$params[0]['before_widget']  = preg_replace( $class_widget_inline_search, $class_widget_inline_replace, $params[0]['before_widget'], 1 );

	if ( isset( $widget_opt[ $widget_num ]['at_class'] ) )
		$at_class = $widget_opt[ $widget_num ]['at_class'];
	else
		$at_class = '';
	$params[0]['before_widget'] = preg_replace( '/class="/', 'class="' . $at_class . ' ', $params[0]['before_widget'], 1 );

	return $params;
}
