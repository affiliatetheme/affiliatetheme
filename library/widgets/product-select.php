<?php
/**
 * Widget: Produktauswahl
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    widgets
 */

class product_select_widget extends WP_Widget
{
	public function __construct()
	{
		$widget_ops = array( 'classname' => 'widget_product_feed', 'description' => __( 'Dieses Widget ermöglicht es eine bestimmte Auswahl von Produkten im Widget anzuzeigen.', 'affiliatetheme-backend' ) );
		parent::__construct( 'product_feed', __( 'affiliatetheme.io &raquo; Auswahl von Produkten', 'affiliatetheme-backend' ), $widget_ops );
	}

	function widget( $args, $instance )
	{
		extract( $args, EXTR_SKIP );

		// VARS
		$manual         = get_field( 'widget_feed_manual', 'widget_' . $args['widget_id'] );
		$products       = get_field( 'widget_feed_products', 'widget_' . $args['widget_id'] );
		$product_ids    = get_field( 'widget_feed_products_ids', 'widget_' . $args['widget_id'] );
		$taxonomies     = get_field( 'widget_feed_taxonomie', 'widget_' . $args['widget_id'] );
		$posts_per_page = get_field( 'widget_feed_posts_per_page', 'widget_' . $args['widget_id'] );
		$orderby        = get_field( 'widget_feed_orderby', 'widget_' . $args['widget_id'] );
		$order          = get_field( 'widget_feed_order', 'widget_' . $args['widget_id'] );
		$thumbnail      = get_field( 'widget_feed_thumbnail', 'widget_' . $args['widget_id'] );
		$rating         = get_field( 'widget_feed_rating', 'widget_' . $args['widget_id'] );
		$deeplink       = get_field( 'widget_feed_deeplink', 'widget_' . $args['widget_id'] );
		$tax_query      = array();

		if ( $rating == '1' ) {
			$force = true;
		} else {
			$force = false;
		}

		echo $before_widget;

		if ( $instance['title'] ) {
			echo $before_title . $instance['title'] . $after_title;
		}

		if ( $taxonomies ) {
			foreach ( $taxonomies as $term ) {
				$tax_query[ $term->taxonomy ][] = $term->term_id;
			}
		}

		if ( '1' != $manual ) {
			$query_args = array(
				'post_type'      => 'product',
				'posts_per_page' => $posts_per_page,
				'orderby'        => $orderby,
				'order'          => $order
			);

			//fix orderby for meta_key
			if ( 'rating' == $orderby ) {
				$query_args['orderby']  = 'meta_value';
				$query_args['meta_key'] = 'product_rating';
			} elseif ( 'price' == $orderby ) {
				$query_args['orderby']  = 'meta_value_num';
				$query_args['meta_key'] = 'product_shops_0_price';
			}

			if ( $tax_query ) {
				foreach ( $tax_query as $key => $value ) {
					$query_args['tax_query'][] = array(
						'taxonomy' => $key,
						'field'    => 'term_id',
						'terms'    => $value
					);
				}
			}

			$query_args = apply_filters( 'at_product_select_widget_query', $query_args );
			$products   = get_posts( $query_args );
		}

		if ( '1' == $manual && $product_ids != '' ) {
			$product_ids = explode( ',', $product_ids );

			$query_args = array(
				'post_type' => 'product',
				'orderby'   => 'post__in',
				'post__in'  => $product_ids
			);

			$query_args = apply_filters( 'at_product_select_widget_query', $query_args );
			$products   = get_posts( $query_args );
		}

		if ( $products ) { ?>
			<ul class="items list-unstyled">
				<?php
				foreach ( $products as $post ) {
					$product_fakeshop = at_is_fake_product( $post->ID );
					if ( $deeplink == '1' ) {
						$product_fakeshop = '1';
					}
					?>
					<li class="product product-<?php echo $post->ID; ?>">
						<a href="<?php echo( ( '1' == $deeplink ) ? get_product_link( $post->ID ) : ( ( '1' == $product_fakeshop ) ? get_product_link( $post->ID ) : get_permalink( $post->ID ) ) ); ?>" <?php echo get_product_link_params( $post->ID, $product_fakeshop ); ?>>
							<div class="media">
								<?php if ( "1" == $thumbnail ) : ?>
									<div class="media-left">
										<?php echo at_post_thumbnail( $post->ID, 'product_tiny' ); ?>
									</div>
								<?php endif; ?>

								<div class="media-body">
									<?php if ( "1" == $rating && get_product_rating( $post->ID, $force ) ) {
										echo '<div class="product-rating">' . get_product_rating( $post->ID, $force ) . '</div>';
									} ?>
									<p><?php echo get_the_title( $post->ID ); ?></p>
								</div>
							</div>
						</a>
					</li>
				<?php }
				wp_reset_query(); ?>
			</ul>
		<?php } else { ?>
			<?php if ( is_user_logged_in() ) { ?>
				<div class="textwidget"><p><?php _e( '<strong>Fehler:</strong> Es wurden keine Produkte gefunden.', 'affiliatetheme' ); ?></p></div>
			<?php }
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
		$instance = wp_parse_args( (array)$instance, array( 'title' => '' ) );
		$title    = $instance['title'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Titel:', 'affiliatetheme-backend' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>">
		</p>
		<?php
	}
}

add_action( 'widgets_init', 'at_product_select_widget' );
function at_product_select_widget()
{
	register_widget( 'product_select_widget' );
}