<?php

global $product_items, $taxonomies;

if ( $product_items ) {
	if ( $compare_page = get_posts( array( 'post_type' => 'page', 'meta_key' => '_wp_page_template', 'meta_value' => 'templates/compare.php', 'posts_per_page' => 1 ) ) ) {
		if ( apply_filters( 'at_product_compare_predefine_current_product', false ) ) {
			if ( is_singular( 'product' ) ) {
				$_POST['product_1'] = $post->ID;
			}
		}
		?>
		<div class="product-select product-select-shortcode">
			<form action="<?php echo get_permalink( $compare_page[0]->ID ); ?>" method="POST" class="">
				<div class="row">
					<div class="col-xxs-12 col-xs-6">
						<div class="form-group">
							<label class="label-control" for="product_1"><?php _e( 'Vergleiche ...', 'affiliatetheme' ); ?></label>
							<select name="product_1" id="product_1" class="form-control">
								<option selected><?php _e( 'Produkt auswählen', 'affiliatetheme' ); ?></option>
								<?php foreach ( $product_items as $product ) { ?>
									<option value="<?php echo $product->ID; ?>" <?php if ( isset( $_POST['product_1'] ) && ( $_POST['product_1'] == $product->ID ) ) echo 'selected'; ?>><?php echo $product->post_title; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-xxs-12 col-xs-6">
						<div class="form-group">
							<label class="label-control" for="product_2"><?php _e( 'mit', 'affiliatetheme' ); ?></label>
							<select name="product_2" id="product_2" class="form-control">
								<option selected><?php _e( 'Produkt auswählen', 'affiliatetheme' ); ?></option>
								<?php foreach ( $product_items as $product ) { ?>
									<option value="<?php echo $product->ID; ?>" <?php if ( isset( $_POST['product_2'] ) && ( $_POST['product_2'] == $product->ID ) ) echo 'selected'; ?>><?php echo $product->post_title; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<?php
							if ( $taxonomies ) {
								foreach ( $taxonomies as $k => $v ) {
									?>
									<input type="hidden" name="tax-<?= $k ?>" value="<?= $v ?>"/>
									<?php
								}
							}
							?>
							<button type="submit" name="submit" class="btn btn-block btn-at"><?php _e( 'Vergleichen', 'affiliatetheme' ); ?> <i class="fas fa-retweet"></i></button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<?php
	} else {
		if ( is_user_logged_in() ) {
			?>
			<div class="alert alert-warning">
				<strong><?php _e( 'Hinweis:', 'affiliatetheme' ); ?></strong>
				<?php _e( 'Bitte lege eine Seite mit dem Template "Produktvergleich" fest, damit der Produktvergleich korrekt funktionieren kann.', 'affiliatetheme' ); ?>
			</div>
			<?php
		}
	}
}