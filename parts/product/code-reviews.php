<?php

if ( at_show_product_review() ) {
	$rounded_to                    = apply_filters( 'at_product_review_summary_rounded', 2, $post->ID );
	$product_review_style          = get_field( 'product_review_style' );
	$product_review_ratings        = get_field( 'product_review_ratings' );
	$product_review_rating_summary = get_field( 'product_review_rating_summary' );
	$summary                       = at_product_review_calculate_summary( $post->ID );

	// Fix Date Format
	if ( get_field( 'product_review_rating_date' ) ) {
		$product_review_rating_date   = get_field( 'product_review_rating_date' );
		$product_review_rating_date_y = substr( $product_review_rating_date, 0, 4 );
		$product_review_rating_date_m = substr( $product_review_rating_date, 4, 2 );
		$product_review_rating_date   = $product_review_rating_date_m . '/' . $product_review_rating_date_y;
	} else {
		$product_review_rating_date = date( 'm/Y' );
	}

	if ( $product_review_ratings ) {
		?>
		<div class="product-reviews product-reviews-<?php echo $product_review_style; ?>"><?php

			if ( 'procentual' == $product_review_style ) {
				$i = 0;
				?>
				<div class="row">
					<div class="col-sm-3 col-lg-2">
						<div class="rating-summary">
							<div class="summary-header">
								<p><?php _e( 'Gesamtbewertung', 'affiliatetheme' ); ?></p>
							</div>

							<div class="summary-detail">
								<p><strong><?php echo round( $summary, $rounded_to ); ?>%</strong></p>
								<?php if ( $product_review_rating_summary ) { ?><p>
									"<?php echo $product_review_rating_summary; ?>"</p><?php } ?>
							</div>

							<?php if ( $product_review_rating_date ) { ?>
								<div class="summary-footer">
									<p><?php echo $product_review_rating_date; ?></p>
								</div>
							<?php } ?>
						</div>
					</div>

					<div class="col-sm-9 col-lg-10">
						<?php
						//check hint
						$show_hint = false;
						foreach ( $product_review_ratings as $rating ) {
							if ( $rating['hint'] ) {
								$show_hint = true;
							}
						}

						foreach ( $product_review_ratings as $rating ) {
							$classes = array();

							if ( $rating['value'] <= 33 )
								$classes[] = 'progress-red';

							if ( $rating['value'] > 33 && $rating['value'] <= 66 )
								$classes[] = 'progress-orange';

							if ( $rating['value'] > 66 )
								$classes[] = 'progress-green';
							?>
							<div class="row">
								<div class="col-sm-3"><strong><?php echo $rating['name']; ?></strong></div>
								<div class="col-sm-<?php echo( $show_hint == false ? '9' : '6' ); ?>">
									<div class="rating rating-<?php echo $i; ?>">
										<div class="progress">
											<div class="progress-bar <?php echo implode( ' ', $classes ); ?>"
												 role="progressbar" aria-valuenow="<?php echo $rating['value']; ?>"
												 aria-valuemin="0" aria-valuemax="100"
												 style="width: <?php echo $rating['value']; ?>%;">
												<?php echo $rating['value']; ?>%
											</div>
										</div>
									</div>
								</div>
								<?php if ( $rating['hint'] ) { ?>
									<div class="col-sm-3">
										<small class="rating-hint"><?php echo $rating['hint']; ?></small>
									</div>
								<?php } ?>
							</div>
							<?php $i++;
						} ?>
					</div>
				</div>

				<?php
			} elseif ( 'number' == $product_review_style ) {
				$product_review_system     = get_field( 'product_review_system' );
				$product_review_max_value  = (int)get_field( 'product_review_max_value' );
				$product_review_icon_empty = get_field( 'product_review_icon_empty' );
				$product_review_icon_half  = get_field( 'product_review_icon_half' );
				$product_review_icon_full  = get_field( 'product_review_icon_full' );
				$procentage_summary        = ( 100 / $product_review_max_value ) * $summary;
				?>
				<div class="row">
					<div class="col-sm-4 col-lg-3">
						<div class="rating-summary">
							<div class="summary-detail">
								<ul class="progress">
									<li data-name="<?php echo $product_review_rating_summary; ?>"
										data-percent="<?php echo $summary . '/' . $product_review_max_value; ?>">
										<svg viewBox="-10 -10 220 220">
											<g fill="none" stroke-width="3" transform="translate(100,100)">
												<path d="M 0,-100 A 100,100 0 0,1 86.6,-50" stroke="url(#cl1)"/>
												<path d="M 86.6,-50 A 100,100 0 0,1 86.6,50" stroke="url(#cl2)"/>
												<path d="M 86.6,50 A 100,100 0 0,1 0,100" stroke="url(#cl3)"/>
												<path d="M 0,100 A 100,100 0 0,1 -86.6,50" stroke="url(#cl4)"/>
												<path d="M -86.6,50 A 100,100 0 0,1 -86.6,-50" stroke="url(#cl5)"/>
												<path d="M -86.6,-50 A 100,100 0 0,1 0,-100" stroke="url(#cl6)"/>
											</g>
										</svg>
										<svg viewBox="-10 -10 220 220">
											<path
													d="M200,100 C200,44.771525 155.228475,0 100,0 C44.771525,0 0,44.771525 0,100 C0,155.228475 44.771525,200 100,200 C155.228475,200 200,155.228475 200,100 Z"
													stroke-dashoffset="<?php echo 6.29 * $procentage_summary; ?>"></path>
										</svg>
									</li>
								</ul>
								<?php if ( $product_review_rating_summary ) {
									echo '<p>"' . $product_review_rating_summary . '"</p>';
								} ?>
							</div>
						</div>
					</div>

					<div class="col-sm-8 col-lg-9">
						<?php $i = 0;
						foreach ( $product_review_ratings as $rating ) { ?>
							<div class="row">
								<div class="col-sm-3"><strong><?php echo $rating['name']; ?></strong></div>
								<div class="col-sm-5">
									<div class="product-rating"><?php echo get_product_review_rating( $rating['value'], $product_review_max_value, $product_review_icon_empty, $product_review_icon_half, $product_review_icon_full ); ?></div>
									<span class="rating-text">(<?php echo $rating['value'] . '/' . $product_review_max_value; ?>)</span>
								</div>
								<div class="col-sm-4">
									<small class="rating-hint"><?php echo $rating['hint']; ?></small>
								</div>
							</div>
							<?php $i++;
						} ?>
					</div>
				</div>
				<?php
			}

			?></div>
		<hr><?php
	}
}