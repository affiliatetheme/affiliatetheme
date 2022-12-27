<?php

class AT_Filter
{
	function __construct( $post_id = '', $sidebar = false )
	{
		global $post;

		if ( is_singular( 'filter' ) ) {
			$post_id = $post->ID;
		}

		$this->source_id = ( $post ? $post->ID : 0 );
		$this->post_id   = $post_id;
		$this->sidebar   = $sidebar;
		$this->method    = apply_filters( 'at_filter_set_method', 'GET', $this->post_id );
		$this->elements  = get_field( 'filter_elements', $this->post_id );
	}

	public function build()
	{
		?>
		<form action="<?php echo $this->target(); ?>" method="<?php echo $this->method; ?>" class="<?php echo $this->form_classes(); ?>" data-ajax="<?php echo( $this->is_ajax() ? 'true' : 'false' ); ?>" data-id="<?php echo $this->post_id; ?>" data-source-id="<?php echo $this->source_id; ?>">
			<?php
			// render fields
			echo $this->fields();

			// hidden fields
			echo $this->hidden_fields();

			// submit
			?>
			<div class="form-group form-group-block">
				<?php echo $this->submit_button(); ?>
			</div>

			<div class="clearfix"></div>
		</form>
		<?php

		if ( $this->is_ajax() && ! $this->is_sidebar() && ! is_singular( 'filter' ) ) {
			?>
			<div id="filter-results-<?php echo $this->post_id; ?>" class="filter-results" data-form-id="<?php echo $this->post_id; ?>">
				<!-- products -->
			</div>
			<?php
		}
	}

	public function form_classes()
	{
		$classes = array( 'filterform' );

		if ( ! $this->is_sidebar() ) {
			$classes[] = 'form-inline';
		}

		return implode( ' ', $classes );
	}

	public function fields()
	{
		if ( ! $this->elements ) {
			return;
		}

		$fields = '';
		foreach ( $this->elements as $el ) {
			$field  = new AT_Filter_Field( $el, $this->sidebar );
			$fields .= $field->render();
		}

		return $fields;
	}

	public function hidden_fields()
	{
		if ( ! $this->elements ) {
			return;
		}

		$fields = '';
		foreach ( $this->elements as $el ) {
			$field  = new AT_Filter_Field( $el, $this->sidebar );
			$fields .= $field->render_hidden();
		}

		if ( $this->is_ajax() ) {
			$fields .= '<input type="hidden" name="paged" value="1" />';
			$fields .= '<input type="hidden" name="layout" value="" />';
			$fields .= '<input type="hidden" name="orderby" value="" />';
		}

		return $fields;
	}

	public function target()
	{
		$url = get_permalink( $this->post_id );

		return $url;
	}

	public function submit_button()
	{
		$label               = apply_filters( 'at_set_filter_search_button_label', __( 'Filtern', 'affiliatetheme' ) );
		$filter_submit_label = get_field( 'filter_submit_label', $this->post_id );
		if ( $filter_submit_label ) {
			$label = $filter_submit_label;
		}

		?>
		<a href="<?php echo parse_url( $_SERVER["REQUEST_URI"], PHP_URL_PATH ); ?>" class="btn btn-xs btn-link filter-reset pull-right"><?php _e( 'Filter zurücksetzen', 'affiliatetheme' ); ?></a>
		<button type="submit" class="btn btn-at">
			<?php echo $label; ?>
		</button>
		<?php
	}

	public function show_on_results_page()
	{
		$filter_show_on_results = get_field( 'filter_show_on_results', $this->post_id );

		if ( $filter_show_on_results == '1' ) {
			return true;
		}

		return false;
	}

	public function get_sidebar()
	{
		$sidebar = at_get_sidebar( 'filter', 'single', $this->post_id );

		if ( $sidebar ) {
			return $sidebar;
		}

		return false;
	}

	public function get_sidebar_size()
	{
		$sidebar_size = at_get_sidebar_size( 'filter', 'single', $this->post_id );

		if ( $sidebar_size ) {
			return $sidebar_size;
		}

		return false;
	}

	public function get_product_layout()
	{
		if ( isset( $_GET['layout'] ) && $_GET['layout'] != '' ) {
			return $_GET['layout'];
		}

		$val = get_field( 'filter_product_layout', $this->post_id );

		if ( $val ) {
			return $val;
		}

		return 'list';
	}

	public function get_product_per_page()
	{
		$val = get_field( 'filter_product_per_page', $this->post_id );

		if ( $val ) {
			return $val;
		}

		return 12;
	}

	public function get_product_orderby()
	{
		$val = get_field( 'filter_product_orderby', $this->post_id );

		if ( $val ) {
			return $val;
		}

		return 'date';
	}

	public function get_product_order()
	{
		$val = get_field( 'filter_product_order', $this->post_id );

		if ( $val ) {
			return $val;
		}

		return 'desc';
	}

	public function is_sidebar()
	{
		return $this->sidebar;
	}

	public function is_ajax()
	{
		$ajax = get_field( 'filter_ajax', $this->post_id );
		if ( $ajax ) {
			return true;
		}

		return false;
	}
}