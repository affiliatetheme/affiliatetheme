<?php
/**
 * Widget: Social
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    widgets
 */

class social_widget extends WP_Widget
{
	public function __construct()
	{
		$widget_ops = array( 'classname' => 'widget_social', 'description' => __( 'Dieses Widget zeigt eine Auswahl von Social Media Links an.', 'affiliatetheme-backend' ) );
		parent::__construct( 'social_widget', __( 'affiliatetheme.io &raquo; Social Media', 'affiliatetheme-backend' ), $widget_ops );
	}

	function widget( $args, $instance )
	{
		extract( $args, EXTR_SKIP );
		echo $before_widget;

		if ( $instance['title'] ) {
			echo $before_title . $instance['title'] . $after_title;
		}

		?>
		<ul class="list-inline list-social">
			<?php
			if ( $instance['social_fb'] ) { ?>
				<li><a href="<?php echo $instance['social_fb']; ?>" target="_blank" rel="nofollow"><i class="fab fa-facebook"></i></a></li>
				<?php
			}
			if ( $instance['social_tw'] ) {
				?>
				<li><a href="<?php echo $instance['social_tw']; ?>" target="_blank" rel="nofollow"><i class="fab fa-twitter"></i></a></li>
				<?php
			}
			if ( $instance['social_yt'] ) { ?>
				<li><a href="<?php echo $instance['social_yt']; ?>" target="_blank" rel="nofollow"><i class="fab fa-youtube"></i></a></li>
				<?php
			}

			if ( $instance['social_xi'] ) { ?>
				<li><a href="<?php echo $instance['social_xi']; ?>" target="_blank" rel="nofollow"><i class="fab fa-xing"></i></a></li>
				<?php
			}
			if ( $instance['social_li'] ) { ?>
				<li><a href="<?php echo $instance['social_li']; ?>" target="_blank" rel="nofollow"><i class="fab fa-linkedin"></i></a></li>
				<?php
			}
			if ( $instance['social_pr'] ) { ?>
				<li><a href="<?php echo $instance['social_pr']; ?>" target="_blank" rel="nofollow"><i class="fab fa-pinterest"></i></a></li>
				<?php
			}
			if ( $instance['social_ig'] ) { ?>
				<li><a href="<?php echo $instance['social_ig']; ?>" target="_blank" rel="nofollow"><i class="fab fa-instagram"></i></a></li>
				<?php
			}
			if ( $instance['social_wa'] ) { ?>
				<li><a href="<?php echo $instance['social_wa']; ?>" target="_blank" rel="nofollow"><i class="fab fa-whatsapp"></i></a></li>
				<?php
			}
			if ( $instance['social_twitch'] ) { ?>
				<li><a href="<?php echo $instance['social_twitch']; ?>" target="_blank" rel="nofollow"><i class="fab fa-twitch"></i></a></li>
				<?php
			}
			if ( $instance['social_skype'] ) { ?>
				<li><a href="<?php echo $instance['social_skype']; ?>" target="_blank" rel="nofollow"><i class="fab fa-skype"></i></a></li>
				<?php
			}
			if ( $instance['social_tumblr'] ) { ?>
				<li><a href="<?php echo $instance['social_tumblr']; ?>" target="_blank" rel="nofollow"><i class="fab fa-tumblr"></i></a></li>
				<?php
			}
			if ( $instance['social_snapchat'] ) { ?>
				<li><a href="<?php echo $instance['social_snapchat']; ?>" target="_blank" rel="nofollow"><i class="fab fa-snapchat"></i></a></li>
				<?php
			}
			if ( $instance['social_rss'] ) { ?>
				<li><a href="<?php echo $instance['social_rss']; ?>" target="_blank" rel="nofollow"><i class="fas fa-rss"></i></a></li>
				<?php
			}
			?>
		</ul>
		<?php

		echo $after_widget;
	}

	function update( $new_instance, $old_instance )
	{
		$instance                    = $old_instance;
		$instance['title']           = strip_tags( $new_instance['title'] );
		$instance['social_fb']       = strip_tags( $new_instance['social_fb'] );
		$instance['social_tw']       = strip_tags( $new_instance['social_tw'] );
		$instance['social_yt']       = strip_tags( $new_instance['social_yt'] );
		$instance['social_xi']       = strip_tags( $new_instance['social_xi'] );
		$instance['social_li']       = strip_tags( $new_instance['social_li'] );
		$instance['social_pr']       = strip_tags( $new_instance['social_pr'] );
		$instance['social_ig']       = strip_tags( $new_instance['social_ig'] );
		$instance['social_wa']       = strip_tags( $new_instance['social_wa'] );
		$instance['social_twitch']   = strip_tags( $new_instance['social_twitch'] );
		$instance['social_skype']    = strip_tags( $new_instance['social_skype'] );
		$instance['social_tumblr']   = strip_tags( $new_instance['social_tumblr'] );
		$instance['social_snapchat'] = strip_tags( $new_instance['social_snapchat'] );
		$instance['social_rss']      = strip_tags( $new_instance['social_rss'] );

		return $instance;
	}

	function form( $instance )
	{
		$instance = wp_parse_args( (array)$instance, array(
				'title'           => '',
				'social_fb'       => '',
				'social_tw'       => '',
				'social_yt'       => '',
				'social_xi'       => '',
				'social_li'       => '',
				'social_pr'       => '',
				'social_ig'       => '',
				'social_wa'       => '',
				'social_twitch'   => '',
				'social_skype'    => '',
				'social_tumblr'   => '',
				'social_snapchat' => '',
				'social_rss'      => ''
			)
		);

		$networks = array(
			'social_fb'       => 'Facebook',
			'social_tw'       => 'Twitter',
			'social_yt'       => 'YouTube',
			'social_xi'       => 'Xing',
			'social_li'       => 'Linkedin',
			'social_pr'       => 'Pinterest',
			'social_ig'       => 'Instagram',
			'social_wa'       => 'WhatsApp',
			'social_twitch'   => 'Twitch',
			'social_skype'    => 'Skype',
			'social_tumblr'   => 'Tumblr',
			'social_snapchat' => 'Snapchat',
			'social_rss'      => 'RSS'
		);

		$title = $instance['title'];
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Titel:', 'affiliatetheme-backend' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>">
		</p>

		<p>
			<?php _e( 'Um die Ausgabe eines Netwerkes zu aktivieren, fülle einfach das entsprechende Feld mit der URL des Profils aus.', 'affiliatetheme-backend' ); ?>
		</p>

		<?php
		if ( $networks ) {
			foreach ( $networks as $key => $val ) {
				?>
				<p>
					<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $val; ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" value="<?php echo $instance[ $key ]; ?>">
				</p>
				<?php
			}
		}
	}
}

add_action( 'widgets_init', 'at_social_widget' );
function at_social_widget()
{
	register_widget( 'social_widget' );
}