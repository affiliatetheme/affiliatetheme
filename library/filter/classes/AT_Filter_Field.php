<?php

class AT_Filter_Field
{
	function __construct( $field, $sidebar = false )
	{
		$this->field   = $field;
		$this->sidebar = $sidebar;

		if ( is_array( $this->field ) ) {
			$rand               = rand( 100, 9999 );
			$this->layout       = $field['acf_fc_layout'];
			$this->field_object = $this->get_field_object();
			$this->id           = $this->get_name() . $rand;
			$this->name         = $this->get_name();
			$this->value        = $this->get_value();
		}
	}

	public function render()
	{
		if ( $this->is_hide( $this->field ) ) {
			return;
		}

		switch ( $this->layout ) {
			case 'price':
				$this->show_price();
				break;

			case 'rating':
				$this->show_rating();
				break;

			case 'taxonomy':
				$this->show_taxonomy();
				break;

			case 'custom_field':
				$this->show_custom_field();
				break;

			case 'reduced':
				$this->show_reduced_field();
				break;
		}

		return false;
	}

	public function render_hidden()
	{
		if ( $this->is_hide( $this->field ) ) {
			$this->show_hidden_field();
		}

		return false;
	}

	private function show_price()
	{
		// title
		$title = apply_filters( 'at_filter_price_title', __( 'Preis', 'affiliatetheme' ) );
		if ( isset( $this->field['title'] ) && $this->field['title'] != '' ) $title = $this->field['title'];

		// instruction
		$instruction = apply_filters( 'at_filter_price_instruction', ( isset( $this->field['instruction'] ) ? $this->field['instruction'] : '' ) );

		// values & steps
		$values = at_field_database_min_max_value( $this->name, 'product' );
		if ( isset( $this->field['min_value'] ) && $this->field['min_value'] != false ) $values->min = $this->field['min_value'];
		if ( isset( $this->field['max_value'] ) && $this->field['max_value'] != false ) $values->max = $this->field['max_value'];
		$steps = at_field_step_value( $values->min, $values->max, '', $this->name );
		?>
		<div class="form-group">
			<label for="<?php echo $this->id; ?>" class="control-label"><?php echo $title ?></label>
			<div class="slide">
				<span><?php echo $values->min; ?></span>
				<input id="<?php echo $this->id; ?>" name="<?php echo $this->name; ?>" data-slider-label="<?php echo apply_filters( 'at_filter_price_label', ' ' . at_get_default_currency( true ) ); ?>" type="text" class="bt-slider" value="<?php if ( $this->value ) {
					echo $this->value;
				} ?>" data-slider-min="<?php echo $values->min; ?>" data-slider-max="<?php echo $values->max; ?>" data-slider-step="<?php echo $steps; ?>" data-slider-value="[<?php if ( $this->value ) {
					echo $this->value;
				} else {
					echo $values->min . ',' . $values->max;
				} ?>]">
				<span><?php echo $values->max; ?></span>
			</div>
			<?php echo( $instruction ? '<span class="filter-instruction">' . $instruction . '</span>' : '' ); ?>
			<div class="clearfix"></div>
		</div>
		<?php
	}

	private function show_rating()
	{
		// title
		$title = apply_filters( 'at_filter_rating_title', __( 'Bewertung', 'affiliatetheme' ) );
		if ( isset( $this->field['title'] ) && $this->field['title'] != '' ) $title = $this->field['title'];

		// instruction
		$instruction = apply_filters( 'at_filter_rating_instruction', ( isset( $this->field['instruction'] ) ? $this->field['instruction'] : '' ) );

		// values & steps
		$values = (object)array( 'min' => 0, 'max' => 5 );
		$steps  = at_field_step_value( $values->min, $values->max, '', $this->name );
		?>
		<div class="form-group">
			<label for="<?php echo $this->id; ?>" class="control-label"><?php echo $title; ?></label>
			<div class="slide">
				<span><?php echo $values->min; ?></span>
				<input id="<?php echo $this->id; ?>" name="<?php echo $this->name; ?>" data-slider-label="<?php echo apply_filters( 'at_filter_rating_label', __( ' Sterne', 'affiliatetheme' ) ); ?>" type="text" class="bt-slider" value="<?php if ( $this->value ) {
					echo $this->value;
				} ?>" data-slider-min="<?php echo $values->min; ?>" data-slider-max="<?php echo $values->max; ?>" data-slider-step="<?php echo $steps; ?>" data-slider-value="[<?php if ( $this->value ) {
					echo $this->value;
				} else {
					echo $values->min . ',' . $values->max;
				} ?>]">
				<span><?php echo $values->max; ?></span>
			</div>
			<?php echo( $instruction ? '<span class="filter-instruction">' . $instruction . '</span>' : '' ); ?>
			<div class="clearfix"></div>
		</div>
		<?php
	}

	private function show_taxonomy()
	{
		$tax = $this->field['taxonomy'][0];
		if ( $tax ) {
			$terms    = get_terms( $tax->name, 'hide_empty=0' );
			$multiple = $this->field['multiple'];

			// title
			$title = $tax->labels->name;;
			if ( isset( $this->field['title'] ) && $this->field['title'] != '' ) $title = $this->field['title'];

			// instruction
			$instruction = apply_filters( 'at_filter_rating_instruction', ( isset( $this->field['instruction'] ) ? $this->field['instruction'] : '' ) );

			// first label
			$first_label = apply_filters( 'at_set_filter_taxonomy_first_label', sprintf( __( '%s wählen', 'affiliatetheme' ), $tax->labels->name ), $tax );
			if ( isset( $this->field['first_label'] ) && $this->field['first_label'] != '' ) $first_label = $this->field['first_label'];

			if ( $terms ) {
				?>
				<div class="form-group">
					<label for="<?php echo $this->id; ?>" class="control-label"><?php echo $title; ?></label>
					<select id="<?php echo $this->id; ?>" name="<?= $multiple ? $tax->name . '[]' : $tax->name; ?>" class="form-control" <?= $multiple ? 'multiple' : '' ?>>
						<?php
						if ( ! $multiple ) {
							?>
							<option value=""><?php echo $first_label; ?></option>
							<?php
						}

						if ( apply_filters( 'at_filter_taxonomy_show_hierachical', true ) ) {
							echo at_get_terms_hierarchical( $terms, '', 0, 0, $this->value );
						}
						?>
					</select>
					<?php echo( $instruction ? '<span class="filter-instruction">' . $instruction . '</span>' : '' ); ?>
					<div class="clearfix"></div>
				</div>
				<?php
			}
		}
	}

	private function show_custom_field()
	{
		$type = $this->field_object['type'];
		$rand = rand( 100, 9999 );

		// title
		$title = $this->field_object['label'];
		if ( isset( $this->field['title'] ) && $this->field['title'] != '' ) $title = $this->field['title'];

		// instruction
		$instruction = ( isset( $this->field['instruction'] ) ? $this->field['instruction'] : $this->field_object['instructions'] );

		if ( $type == 'number' ) {
			// append
			$append = $this->field_object['append'];

			// values & steps
			$values = at_field_min_max_value( $this->field_object['key'], $this->name, 'product' );
			if ( isset( $this->field['min_value'] ) && $this->field['min_value'] != false ) $values->min = $this->field['min_value'];
			if ( isset( $this->field['max_value'] ) && $this->field['max_value'] != false ) $values->max = $this->field['max_value'];
			$steps = at_field_step_value( $values->min, $values->max, $this->field_object['key'], $this->name );
			?>
			<div class="form-group"<?php if ( $this->is_hide( $this->field ) ) echo ' style="display: none;"'; ?>>
				<label for="<?php echo $this->id; ?>" class="control-label"><?php echo $title; ?></label>
				<div class="slide">
					<span><?php echo $values->min; ?></span>
					<input id="<?php echo $this->id; ?>" name="<?php echo $this->name; ?>" data-slider-label="<?php echo apply_filters( 'at_filter_customfield_label', $append, $this->field_object ); ?>" type="text" class="bt-slider" value="<?php if ( $this->value ) {
						echo $this->value;
					} ?>" data-slider-min="<?php echo $values->min; ?>" data-slider-max="<?php echo $values->max; ?>" data-slider-step="<?php echo $steps; ?>" data-slider-value="[<?php if ( $this->value ) {
						echo $this->value;
					} else {
						echo $values->min . ',' . $values->max;
					} ?>]">
					<span><?php echo $values->max; ?></span>
				</div>
				<?php echo( $instruction ? '<span class="filter-instruction">' . $instruction . '</span>' : '' ); ?>
				<div class="clearfix"></div>
			</div>
			<?php
		} elseif ( $type == 'true_false' ) {
			?>
			<div class="form-group"<?php if ( $this->is_hide( $this->field ) ) echo ' style="display: none;"'; ?>>
				<?php if ( ! $this->sidebar ) { ?>
					<label for="<?php echo $this->id; ?>" class="control-label"><?php echo $title; ?></label>
				<?php } ?>
				<div class="checkbox">
					<label for="<?php echo $this->id; ?>">
						<input type="checkbox" value="1" name="<?php echo $this->name; ?>" id="<?php echo $this->id; ?>" <?php echo( $this->value == '1' ? 'checked' : '' ); ?>/>
						<?php
						if ( $this->sidebar ) {
							echo $title;
						} else {
							_e( 'ja', 'affiliatetheme-backend' );
						}
						?>
					</label>
				</div>
				<?php echo( $instruction ? '<span class="filter-instruction">' . $instruction . '</span>' : '' ); ?>
				<div class="clearfix"></div>
			</div>
			<?php
		} elseif ( $type == 'select' ) {
			$choices     = $this->field_object['choices'];
			$first_label = apply_filters( 'at_set_filter_customfield_first_label', ( isset( $this->field['first_label'] ) && $this->field['first_label'] != '' ? $this->field['first_label'] : '-' ), $this->name, $title );
			?>
			<div class="form-group"<?php if ( $this->is_hide( $this->field ) ) echo ' style="display: none;"'; ?>>
				<label for="<?php echo $this->id; ?>" class="control-label"><?php echo $title; ?></label>
				<select name="<?= $this->field_object['multiple'] ? $this->name . '[]' : $this->name ?>" id="<?php echo $this->id; ?>" class="form-control" <?= $this->field_object['multiple'] ? 'multiple' : '' ?>>
					<?php
					if ( ! $this->field_object['multiple'] ) {
						?>
						<option value="" selected><?php echo $first_label; ?></option>
						<?php
					}

					foreach ( $choices as $k => $v ) { ?>
						<option value="<?php echo $k; ?>" <?php echo( $k == $this->value ? 'selected' : '' ); ?>><?php echo $v; ?></option>
					<?php } ?>
				</select>
				<?php echo( $instruction ? '<span class="filter-instruction">' . $instruction . '</span>' : '' ); ?>
				<div class="clearfix"></div>
			</div>
			<?php
		}
	}

	private function show_reduced_field()
	{
		$rand = rand( 100, 9999 );
		?>
		<div class="form-group" style="display: none;">
			<input type="checkbox" value="1" name="<?php echo $this->name; ?>" checked/>
		</div>
		<?php
	}

	private function show_hidden_field()
	{
		if ( $this->layout == 'price' ) {
			$values = at_field_database_min_max_value( $this->name, 'product' );
			if ( isset( $this->field['min_value'] ) && $this->field['min_value'] != false ) $values->min = $this->field['min_value'];
			if ( isset( $this->field['max_value'] ) && $this->field['max_value'] != false ) $values->max = $this->field['max_value'];

			if ( ! $this->value ) {
				$this->value = $values->min . ',' . $values->max;
			}
		}

		?>
		<input type="hidden" name="<?php echo $this->name; ?>" value="<?php echo $this->value; ?>">
		<?php
	}

	private function is_hide()
	{
		$hide = ( isset( $this->field['hide'] ) ? $this->field['hide'] : '' );

		if ( $hide == '1' ) {
			return true;
		}

		return false;
	}

	private function get_field_object()
	{
		if ( $this->layout == 'custom_field' ) {
			return get_field_object( $this->field['field'] );
		}
	}

	private function get_name()
	{
		switch ( $this->layout ) {
			case 'price':
				return 'price';
				break;

			case 'rating':
				return 'product_rating';
				break;

			case 'taxonomy':
				$tax = $this->field['taxonomy'][0];

				return $tax->name;
				break;

			case 'custom_field':
				return $this->field_object['name'];
				break;

			case 'reduced':
				return 'product_reduced';
				break;

			default:
				return $this->field['name'];
				break;
		}

		return false;
	}

	private function get_value()
	{
		$request = ( isset( $_REQUEST[ $this->name ] ) ? $_REQUEST[ $this->name ] : false );

		if ( $request !== false ) {
			return at_clean_data( $request );
		}

		if ( isset( $this->field['default_value'] ) ) {
			switch ( $this->layout ) {
				case 'taxonomy':
					$term = ( isset( $this->field['default_value'][0] ) ? $this->field['default_value'][0] : '' );
					if ( is_object( $term ) ) {
						return $term->slug;
					}
					break;

				default:
					return $this->field['default_value'];
					break;
			}
		}

		return false;
	}
}