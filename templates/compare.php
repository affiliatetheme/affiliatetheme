<?php

/*
 * Template Name: Produktvergleich
 */
__( 'Produktvergleich', 'affiliatetheme' );

get_header();

/*
 * VARS
 */
global $products;

if ( false == ( $products_obj = get_field( 'compare_products' ) ) ) {
	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => -1
	);


	// find taxonomies and set to query
	foreach ( $_POST as $k => $v ) {
		if ( strpos( $k, 'tax-' ) !== false ) {
			$tax = str_replace( 'tax-', '', $k );

			$args[ $tax ] = $v;
		}
	}

	$args = apply_filters( 'at_product_compare_args', $args );

	$products_obj = get_posts( $args );
}

$products_cnt = count( $products_obj );
?>

<div id="main" class="<?php echo at_get_section_layout_class( 'content' ); ?>">
	<div class="container">
		<div id="content">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?><?php
				if ( at_get_social( 'page' ) && ( 'top' == at_get_social_pos( 'page' ) || 'both' == at_get_social_pos( 'page' ) ) ) {
					get_template_part( 'parts/stuff/code', 'social' );
				}

				the_content();

				// reset products
				$products = '';

				if ( isset( $_POST['submit'] ) ) {
					$products_selected = array();

					if ( isset( $_POST['product_1'] ) ) {
						$products_selected[] = $_POST['product_1'];
					}

					if ( isset( $_POST['product_2'] ) ) {
						$products_selected[] = $_POST['product_2'];
					}

					if ( isset( $_POST['product_3'] ) ) {
						$products_selected[] = $_POST['product_3'];
					}

					if ( isset( $_POST['product_4'] ) ) {
						$products_selected[] = $_POST['product_4'];
					}

					if ( isset( $_POST['product_5'] ) ) {
						$products_selected[] = $_POST['product_5'];
					}

					$args = array(
						'post_type' => 'product',
						'post__in'  => $products_selected,
						'orderby'   => 'post__in'
					);

					$products = get_posts( $args );
				}
				?>

				<?php
				if ( $products_obj ) {
					?>
					<div class="product-select">
						<form action="" method="POST" class="">
							<div class="row">
								<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-15">
									<div class="form-group">
										<select name="product_1" id="product_1" class="form-control">
											<option selected data-ean=""><?php _e( 'Produkt auswählen', 'affiliatetheme' ); ?></option>
											<?php foreach ( $products_obj as $product ) { ?>
												<option value="<?php echo $product->ID; ?>" data-ean="<?= get_field( 'product_ean', $product->ID ) ?>" <?php if ( isset( $_POST['product_1'] ) && ( $_POST['product_1'] == $product->ID ) ) {
													echo 'selected';
												} ?>><?php echo $product->post_title; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-15">
									<div class="form-group">
										<select name="product_2" id="product_2" class="form-control">
											<option selected data-ean=""><?php _e( 'Produkt auswählen', 'affiliatetheme' ); ?></option>
											<?php foreach ( $products_obj as $product ) { ?>
												<option value="<?php echo $product->ID; ?>" data-ean="<?= get_field( 'product_ean', $product->ID ) ?>" <?php if ( isset( $_POST['product_2'] ) && ( $_POST['product_2'] == $product->ID ) ) {
													echo 'selected';
												} ?>><?php echo $product->post_title; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<?php if ( $products_cnt > 2 ) { ?>
									<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-15">
										<div class="form-group">
											<select name="product_3" id="product_3" class="form-control">
												<option selected data-ean=""><?php _e( 'Produkt auswählen', 'affiliatetheme' ); ?></option>
												<?php foreach ( $products_obj as $product ) { ?>
													<option value="<?php echo $product->ID; ?>" data-ean="<?= get_field( 'product_ean', $product->ID ) ?>" <?php if ( isset( $_POST['product_3'] ) && ( $_POST['product_3'] == $product->ID ) ) {
														echo 'selected';
													} ?>><?php echo $product->post_title; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								<?php } ?>
								<?php if ( $products_cnt > 3 ) { ?>
									<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-15">
										<div class="form-group">
											<select name="product_4" id="product_4" class="form-control">
												<option selected data-ean=""><?php _e( 'Produkt auswählen', 'affiliatetheme' ); ?></option>
												<?php foreach ( $products_obj as $product ) { ?>
													<option value="<?php echo $product->ID; ?>" data-ean="<?= get_field( 'product_ean', $product->ID ) ?>" <?php if ( isset( $_POST['product_4'] ) && ( $_POST['product_4'] == $product->ID ) ) {
														echo 'selected';
													} ?>><?php echo $product->post_title; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								<?php } ?>
								<?php if ( $products_cnt > 4 ) { ?>
									<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-15">
										<div class="form-group">
											<select name="product_5" id="product_5" class="form-control">
												<option selected data-ean=""><?php _e( 'Produkt auswählen', 'affiliatetheme' ); ?></option>
												<?php foreach ( $products_obj as $product ) { ?>
													<option value="<?php echo $product->ID; ?>" <?php if ( isset( $_POST['product_5'] ) && ( $_POST['product_5'] == $product->ID ) ) {
														echo 'selected';
													} ?>><?php echo $product->post_title; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								<?php } ?>
								<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-15 col-md-offset-45">
									<div class="form-group">
										<button type="submit" name="submit" class="btn btn-block btn-at"><?php _e( 'Vergleichen', 'affiliatetheme' ); ?> <i class="fas fa-retweet"></i></button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<?php
				}

				if ( isset( $_POST['submit'] ) ) {
					echo '<hr>';

					$layout = 'table-x';

					get_template_part( 'parts/product/loop', $layout );
				}

				if ( at_get_social( 'page' ) && ( 'bottom' == at_get_social_pos( 'page' ) || 'both' == at_get_social_pos( 'page' ) ) ) {
					get_template_part( 'parts/stuff/code', 'social' );
				}
				?><?php endwhile; endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
