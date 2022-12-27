<?php
/**
 * Widget: Taxonomie
 * @author        Christian Lang
 * @version        1.1
 * @category    widgets
 * @thanks_to   Ronny, mindlands.de
 */

class terms_widget extends WP_Widget
{
	public function __construct()
	{
		$widget_ops = array( 'classname' => 'widget_terms', 'description' => __( 'Dieses Widget zeigt Einträge einer bestimmten Taxonomie an.', 'affiliatetheme-backend' ) );
		parent::__construct( 'term_widget', __( 'affiliatetheme.io &raquo; Einträge einer Taxonomie', 'affiliatetheme-backend' ), $widget_ops );
	}

	function widget( $args, $instance )
	{
		extract( $args, EXTR_SKIP );

		// VARS
		$taxonomie = ( isset( $instance['taxonomie'] ) ? $instance['taxonomie'] : '' );
		$exclude   = ( isset( $instance['exclude'] ) ? $instance['exclude'] : '' );

		if ( ! $taxonomie )
			return;

		echo $before_widget;

		if ( $instance['title'] ) {
			echo $before_title . $instance['title'] . $after_title;
		}

		$args = array(
			'title_li'           => '',
			'show_count'         => ( isset( $instance['widget_term_count'] ) && $instance['widget_term_count'] == 'on' ? true : false ),
			'hierarchical'       => ( isset( $instance['widget_hierarchical'] ) && $instance['widget_hierarchical'] == 'on' ? true : false ),
			'taxonomy'           => $taxonomie,
			'exclude'            => $exclude,
			'hide_empty'         => ( isset( $instance['widget_hide'] ) && $instance['widget_hide'] == 'on' ? true : false ),
			'use_desc_for_title' => ( isset( $instance['widget_notitle'] ) && $instance['widget_notitle'] == 'on' ? true : false )
		);

		echo '<ul ' . ( isset( $instance['widget_scroll'] ) && $instance['widget_scroll'] == 'on' ? 'class="list-scroll"' : '' ) . '>';

		echo wp_list_categories( $args );

		echo '</ul>';


		echo $after_widget;
	}

	function update( $new_instance, $old_instance )
	{
		$instance                        = $old_instance;
		$instance['title']               = strip_tags( $new_instance['title'] );
		$instance['taxonomie']           = $new_instance['taxonomie'];
		$instance['exclude']             = $new_instance['exclude'];
		$instance['widget_term_count']   = $new_instance['widget_term_count'];
		$instance['widget_hierarchical'] = $new_instance['widget_hierarchical'];
		$instance['widget_scroll']       = $new_instance['widget_scroll'];
		$instance['widget_hide']         = $new_instance['widget_hide'];
		$instance['widget_notitle']      = $new_instance['widget_notitle'];

		return $instance;
	}

	function form( $instance )
	{
		$instance            = wp_parse_args( (array)$instance, array( 'title' => '', 'taxonomie' => '', 'exclude' => '', 'widget_term_count' => '', 'widget_hierarchical' => '', 'widget_scroll' => '', 'widget_hide' => '', 'widget_notitle' => '' ) );
		$title               = $instance['title'];
		$taxonomie           = $instance['taxonomie'];
		$exclude             = $instance['exclude'];
		$widget_term_count   = $instance['widget_term_count'];
		$widget_hierarchical = $instance['widget_hierarchical'];
		$widget_scroll       = $instance['widget_scroll'];
		$widget_hide         = $instance['widget_hide'];
		$widget_notitle      = $instance['widget_notitle'];

		$args          = array( 'public' => true, '_builtin' => false );
		$taxonomie_arr = get_taxonomies( $args, 'objects', 'and' );


		if ( false == ( $taxonomie_arr ) ) {
			echo '<p>' . __( '<strong>Wichtiger Hinweis:</strong> Um dieses Widget zu nutzen, musst du zuerst Taxonomien anlegen.', 'affiliatetheme-backend' ) . '</p>';
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Titel:', 'affiliatetheme-backend' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'taxonomie' ); ?>"><?php _e( 'Taxonomie:', 'affiliatetheme-backend' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'taxonomie' ); ?>" name="<?php echo $this->get_field_name( 'taxonomie' ); ?>">
				<?php if ( is_array( $taxonomie_arr ) ) { ?>
					<?php foreach ( $taxonomie_arr as $item ) { ?>
						<option value="<?php echo $item->name; ?>" <?php if ( $item->name == $taxonomie ) echo 'selected'; ?>><?php echo $item->labels->name; ?></option>
					<?php } ?>
				<?php } else { ?>
					<option><?php _e( 'Keine Taxonomien vorhanden', 'affiliatetheme-backend' ); ?></option>
				<?php } ?>
			</select>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'exclude' ); ?>"><?php _e( 'Exclude:', 'affiliatetheme-backend' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>" value="<?php echo $exclude; ?>">
			<br/><small><?php _e( 'Terms die exkludiert werden sollen. Bitte die IDs kommasepariert angeben.', 'affiliatetheme-backend' ); ?></small>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['widget_term_count'], 'on' ); ?> id="<?php echo $this->get_field_id( 'widget_term_count' ); ?>" name="<?php echo $this->get_field_name( 'widget_term_count' ); ?>"/>
			<label for="<?php echo $this->get_field_id( 'widget_term_count' ); ?>"><?php _e( 'Zeige Beitragszähler', 'affiliatetheme-backend' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['widget_hierarchical'], 'on' ); ?> id="<?php echo $this->get_field_id( 'widget_hierarchical' ); ?>" name="<?php echo $this->get_field_name( 'widget_hierarchical' ); ?>"/>
			<label for="<?php echo $this->get_field_id( 'widget_hierarchical' ); ?>"><?php _e( 'Zeige Hierarchie', 'affiliatetheme-backend' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['widget_scroll'], 'on' ); ?> id="<?php echo $this->get_field_id( 'widget_scroll' ); ?>" name="<?php echo $this->get_field_name( 'widget_scroll' ); ?>"/>
			<label for="<?php echo $this->get_field_id( 'widget_scroll' ); ?>"><?php _e( 'Scrollbares Widget?', 'affiliatetheme-backend' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['widget_hide'], 'on' ); ?> id="<?php echo $this->get_field_id( 'widget_hide' ); ?>" name="<?php echo $this->get_field_name( 'widget_hide' ); ?>"/>
			<label for="<?php echo $this->get_field_id( 'widget_hide' ); ?>"><?php _e( 'Leere Taxonomien verstecken?', 'affiliatetheme-backend' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['widget_notitle'], 'on' ); ?> id="<?php echo $this->get_field_id( 'widget_notitle' ); ?>" name="<?php echo $this->get_field_name( 'widget_notitle' ); ?>"/>
			<label for="<?php echo $this->get_field_id( 'widget_notitle' ); ?>"><?php _e( 'Taxonomy Desc als Linktext verwenden?', 'affiliatetheme-backend' ); ?></label>
		</p>
		<?php
	}
}

add_action( 'widgets_init', 'at_terms_widget' );
function at_terms_widget()
{
	register_widget( 'terms_widget' );
}