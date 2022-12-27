<div class="modal fade" id="priceTrend" tabindex="-1" role="dialog" aria-labelledby="priceTrendLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="priceTrendLabel"><?php _e( 'Preisverlauf', 'affiliatetheme' ); ?></h4>
			</div>
			<div class="modal-body">
				<?php get_template_part( 'parts/product/code', 'price_trend' ) ?>
			</div>
		</div>
	</div>
</div>