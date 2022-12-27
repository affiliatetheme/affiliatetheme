<?php

/**
 * Widget: Produktempfehlung
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    widgets
 */
class product_advice_widget extends WP_Widget
{
	public function __construct()
	{
		$widget_ops = array( 'classname' => 'widget_product_advice', 'description' => __( 'Dieses Widget ermöglicht es ein bestimmtes Produkt zu empfehlen.', 'affiliatetheme-backend' ) );
		parent::__construct( 'advice_widget', __( 'affiliatetheme.io &raquo; Produkt Empfehlung', 'affiliatetheme-backend' ), $widget_ops );
	}

	function widget( $args, $instance )
	{
		extract( $args, EXTR_SKIP );
		global $post;

		// VARS
		$product               = get_field( 'widget_advice_product', 'widget_' . $args['widget_id'] );
		$rating                = get_field( 'widget_advice_rating', 'widget_' . $args['widget_id'] );
		$thumbnail_link        = get_field( 'widget_advice_thumbnail_link', 'widget_' . $args['widget_id'] );
		$thumbnail_link_target = get_field( 'widget_advice_thumbnail_link_target', 'widget_' . $args['widget_id'] );
		$product_image_link = get_field( 'product_image_link', 'options' );
		$details_button        = get_field( 'widget_advice_details_button', 'widget_' . $args['widget_id'] );
		$price                 = get_field( 'widget_advice_price', 'widget_' . $args['widget_id'] );
		$buy_button            = get_field( 'widget_advice_buy_button', 'widget_' . $args['widget_id'] );

		if ( $rating == '1' ) {
			$force = true;
		} else {
			$force = false;
		}

		echo $before_widget;

		if ( $instance['title'] ) {
			echo $before_title . $instance['title'] . $after_title;
		}

		if ( $product ) {
			$post = $product;
			setup_postdata( $post );
			$product_fakeshop = at_is_fake_product( $post->ID );
			?>
			<div class="textwidget">
				<div class="thumbnail product-grid">
					<div class="caption">
						<?php
						if ( $highlight_text = get_product_highlight_text( $product->ID ) ) {
							echo '<span class="badge-at">' . $highlight_text . '</span>';
						}
						?>

						<?php if ( has_post_thumbnail( $product->ID ) ) { ?>
							<div class="img-grid-wrapper">
								<?php
								if ( '1' == $thumbnail_link ) {
									if ( 'shop' == $thumbnail_link_target ) {
										echo '<a href="' . get_product_link( $product->ID ) . '" ' . get_product_link_params( $product->ID, '1' ) . '>';
									} else {
										echo '<a href="' . ( ( '1' == $product_fakeshop ) ? get_product_link( $product->ID ) : get_permalink( $product->ID ) ) . '" ' . get_product_link_params( $post->ID, $product_fakeshop ) . '>';
									}
								} else {
									echo '<span class="img-wrapper-pos-fix">';
								}

								echo at_post_thumbnail( $product->ID, 'product_grid', array( 'class' => 'aligncenter img-responsive' ) );

								if ( '1' == $thumbnail_link ) {
									echo '</a>';
								} else {
									echo '</span>';
								}
								?>
							</div>
						<?php } ?>

						<div class="row row-product-meta">
							<div class="col-xs-6">
								<?php
								if ( get_product_grid_tax( $post->ID ) ) {
									echo get_product_grid_tax( $post->ID );
								}
								?>
							</div>
							<div class="col-xs-6">
								<?php if ( '1' == $rating ) { ?>
									<div class="product-rating text-right"><?php echo get_product_rating( $post->ID, $force ); ?></div>
								<?php } ?>
							</div>
						</div>

						<a title="<?php the_title(); ?>" href="<?php echo( ( '1' == $product_fakeshop ) ? get_product_link( $post->ID ) : get_permalink() ); ?>" class="product-title" <?php echo get_product_link_params( $post->ID, $product_fakeshop ); ?>>
							<?php the_title(); ?>
						</a>

						<?php if ( '1' == $price ) { ?>
							<?php get_template_part( 'parts/product/code', 'price' ); ?>
						<?php } ?>

						<?php if ( '1' == $details_button && '1' == $buy_button ) {
							do_action( 'at_product_advice_before_buttons' );
							?>
							<hr class="hidden-xs"/>

							<?php if ( '1' == get_field( 'product_button_among', 'option' ) ) { ?>
								<?php echo get_product_button( $post->ID, 0, 'detail', 'btn-block', true ); ?>
								<?php echo get_product_button( $post->ID, 0, 'buy', 'btn-block', true ); ?>
							<?php } else { ?>
								<div class="row row-btn">
									<div class="col-sm-6">
										<?php echo get_product_button( $post->ID, 0, 'detail', 'btn-block', true ); ?>
									</div>
									<div class="col-sm-6">
										<?php echo get_product_button( $post->ID, 0, 'buy', 'btn-block', true ); ?>
									</div>
								</div>
							<?php }
							do_action( 'at_product_advice_after_buttons' );
						} elseif ( '1' == $details_button ) {
							do_action( 'at_product_advice_before_buttons' );
							echo get_product_button( $post->ID, 0, 'detail', 'btn-block' );
							do_action( 'at_product_advice_after_buttons' );
						} elseif ( '1' == $buy_button ) {
							do_action( 'at_product_advice_before_buttons' );
							echo get_product_button( $post->ID, 0, 'buy', 'btn-block' );
							do_action( 'at_product_advice_after_buttons' );
						}
						?>
					</div>
				</div>
			</div>
			<?php wp_reset_query();
		} else {
			if ( is_user_logged_in() ) { ?>
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

add_action( 'widgets_init', 'at_product_advice_widget' );
function at_product_advice_widget()
{
	register_widget( 'product_advice_widget' );
}
