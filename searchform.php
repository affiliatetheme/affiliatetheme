<form role="search" method="get" id="searchform" class="searchform" action="<?= esc_url( home_url() ) ?>">
	<div class="input-group">
		<input type="search" class="form-control" name="s" placeholder="<?php _e( 'Suche nach', 'affiliatetheme' ) ?>" value="<?= get_search_query() ?>">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
		</span>
	</div>
</form>