<?php
/**
 * Widget: Customtext (Shop)
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    widgets
 */

class shop_custom_widget extends WP_Widget
{
	public function __construct()
	{
		$widget_ops = array( 'classname' => 'widget_shop_custom', 'description' => '' );
		parent::__construct( 'shop_custom', __( 'affiliatetheme.io &raquo; Shopinfo', 'affiliatetheme-backend' ), $widget_ops );
	}

	function widget( $args, $instance )
	{
		extract( $args, EXTR_SKIP );
		global $post;

		if ( ! is_single() ) {
			return;
		}

		if ( $shop_info = get_field( 'shop_widget_content', $post->ID ) ) {
			$shop_title = get_field( 'shop_widget_title', $post->ID );

			echo $before_widget;

			if ( $shop_title ) {
				echo $before_title . $shop_title . $after_title;
			}

			echo '<div class="textwidget">' . $shop_info . '</div>';

			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;

		return $instance;
	}

	function form( $instance )
	{
		$instance = wp_parse_args( (array)$instance, array() );
		?>
		<p>
			<?php _e( '<strong>Hinweis:</strong> Den Inhalt dieses Widgets kannst du in einem Customfield im Shop selbst bearbeiten. Falls du für einen Shop keinen Inhalt hast, erscheint dieses Widget nicht.', 'affiliatetheme-backend' ); ?>
		</p>
		<?php
	}
}

add_action( 'widgets_init', 'at_shop_custom_widget' );
function at_shop_custom_widget()
{
	register_widget( 'shop_custom_widget' );
}