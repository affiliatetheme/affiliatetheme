<?php
/**
 * Widget: Produkt Filter
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    widgets
 */

class at_product_filter_widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array( 'classname' => 'widget_filter', 'description' => __( 'Dieses Widget zeigt den neuen Produktfilter an.', 'affiliatetheme-backend' ) );
		parent::__construct( 'at_product_filter_widget', __( 'affiliatetheme.io &raquo; Filter', 'affiliatetheme-backend' ), $widget_ops );
	}

	function widget( $args, $instance )
	{
		extract( $args, EXTR_SKIP );

		// VARS
		$filter = get_field( 'filter', 'widget_' . $args['widget_id'] );

		echo $before_widget;

		if ( $instance['title'] ) {
			echo $before_title . $instance['title'] . $after_title;
		}

		if ( $filter ) {
			echo do_shortcode( '[at_filter id="' . $filter . '" in_sidebar="true" /]' );
		}

		echo $after_widget;
	}

	function update( $new_instance, $old_instance )
	{
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	function form( $instance )
	{
		$instance = wp_parse_args( (array)$instance, array( 'title' => '', 'price' => '', 'price_title' => '', 'rating' => '', 'rating_title' => '', 'taxonomies' => '' ) );
		$title    = $instance['title'];

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Titel:', 'affiliatetheme-backend' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>">
		</p>
		<?php
	}
}

add_action( 'widgets_init', function () {
	register_widget( 'at_product_filter_widget' );
} );
