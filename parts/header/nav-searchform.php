<?php

$mobile  = get_field( 'design_nav_mobile_searchform', 'option' );
$desktop = get_field( 'design_nav_searchform', 'option' );
$classes = [];

if ( '1' != $mobile ) {
	$classes[] = 'hidden-xs';
}

if ( '1' != $desktop ) {
	$classes[] = 'hidden-lg hidden-md hidden-sm';
}
?>
<form class="navbar-form navbar-right form-search <?= implode( ' ', $classes ) ?>" action="<?= esc_url( home_url() ) ?>">
	<div class="input-group">
		<input type="search" class="form-control" name="s" placeholder="<?= __( 'Suche nach', 'affiliatetheme' ) ?>">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
		</span>
	</div>
</form>