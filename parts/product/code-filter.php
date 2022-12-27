<?php
/*
 * VARS
 */

global $layout, $args, $orderby, $order, $default_orderby;

$orderby = $default_orderby ?: '';

if ( isset( $_GET['orderby'] ) ) {
	$orderby = sanitize_text_field( $_GET['orderby'] );
} else {
	switch ( $orderby ) {
		case 'price' :
			$orderby = $order == 'asc' ? 'price-asc' : 'price-desc';
			break;

		case 'name' :
			$orderby = $order == 'asc' ? 'a-z' : 'z-a';
			break;
	}
}

if ( isset( $_GET['order'] ) ) {
	$order = sanitize_text_field( $_GET['order'] );
}
?>
<div class="result-filter">
	<div class="row">
		<div class="col-sm-6 hidden-xs">
			<ul class="list-inline">
				<li><span class="result-title"><?php _e( 'Ansicht:', 'affiliatetheme' ); ?></li>
				<li>
					<a class="btn btn-link <?= ( $layout == 'grid' ? 'active' : '' ); ?>" title="<?php _e( 'Gridansicht', 'affiliatetheme' ); ?>" data-value="grid" href="<?= requestUriAddGetParams( array( 'layout' => 'grid' ) ); ?>">
						<i class="fas fa-th"></i>
					</a>
				</li>
				<li>
					<a class="btn btn-link <?= ( $layout == 'list' ? 'active' : '' ); ?>" title="<?php _e( 'Listenansicht', 'affiliatetheme' ); ?>" data-value="list" href="<?= requestUriAddGetParams( array( 'layout' => 'list' ) ); ?>">
						<i class="fas fa-bars"></i>
					</a>
				</li>
			</ul>

		</div>
		<div class="col-xs-12 col-sm-6 orderby">
			<select name="orderby" id="orderby" onchange="" class="form-control">
				<option value="date" <?php selected( 'date', $orderby, true ); ?>><?php _e( 'Neuheiten', 'affiliatetheme' ); ?></option>
				<option value="rating" <?php selected( 'rating', $orderby, true ); ?>><?php _e( 'Beliebtheit', 'affiliatetheme' ); ?></option>
				<option value="price-asc" <?php selected( 'price-asc', $orderby, true ); ?>><?php _e( 'Preis (aufsteigend)', 'affiliatetheme' ); ?></option>
				<option value="price-desc" <?php selected( 'price-desc', $orderby, true ); ?>><?php _e( 'Preis (absteigend)', 'affiliatetheme' ); ?></option>
				<option value="a-z" <?php selected( 'a-z', $orderby, true ); ?>><?php _e( 'Name (aufsteigend)', 'affiliatetheme' ); ?></option>
				<option value="z-a" <?php selected( 'z-a', $orderby, true ); ?>><?php _e( 'Name (absteigend)', 'affiliatetheme' ); ?></option>
			</select>
		</div>
	</div>
</div>

<hr>
