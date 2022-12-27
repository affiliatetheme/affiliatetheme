<?php
/**
 * Widget: Customtext (Produkt)
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    widgets
 */

class product_custom_widget extends WP_Widget
{
	public function __construct()
	{
		$widget_ops = array( 'classname' => 'widget_product_custom', 'description' => '' );
		parent::__construct( 'product_custom', __( 'affiliatetheme.io &raquo; Produktinfo', 'affiliatetheme-backend' ), $widget_ops );
	}

	function widget( $args, $instance )
	{
		extract( $args, EXTR_SKIP );
		global $post;

		if ( ! is_single() ) {
			return;
		}

		if ( $product_info = get_field( 'product_widget_content', $post->ID ) ) {
			$product_title = get_field( 'product_widget_title', $post->ID );

			echo $before_widget;

			if ( $product_title ) {
				echo $before_title . $product_title . $after_title;
			}

			echo '<div class="textwidget">' . $product_info . '</div>';

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
			<?php _e( '<strong>Hinweis:</strong> Den Inhalt dieses Widgets kannst du in einem Customfield im Produkt selbst bearbeiten. Falls du für ein Produkt keinen Inhalt hast, erscheint dieses Widget nicht.', 'affiliatetheme-backend' ); ?>
		</p>
		<?php
	}
}

add_action( 'widgets_init', 'at_product_custom_widget' );
function at_product_custom_widget()
{
	register_widget( 'product_custom_widget' );
}

