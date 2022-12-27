<?php

$product_tabs_nav     = '';
$product_tabs_content = '';
$hide_tabs            = get_field( 'product_single_tabs_remove', 'option' );

if ( '1' == $hide_tabs ) {
	do_action( 'at_product_sections_first' );

	?>
	<div class="section section-content">
		<p class="h2 section-title"><?php echo apply_filters( 'at_product_tab_description_title', __( 'Beschreibung', 'affiliatetheme' ) ); ?></p>
		<?php the_content(); ?>
	</div>

	<?php
	if ( at_show_price_trend( $post->ID, 'tab' ) ) {
		?>
		<div class="section section-price_trend" id="price_trend">
			<p class="h2 section-title"><?php echo apply_filters( 'at_product_tab_price_tend_title', __( 'Preisverlauf', 'affiliatetheme' ) ); ?></p>
			<?php get_template_part( 'parts/product/code', 'price_trend' ); ?>
		</div>
		<?php
	}

	do_action( 'at_product_sections_after_content' );

	if ( comments_open() ) {
		?>
		<hr>
		<div class="section section-comments">
			<p class="h2 section-title"><?php echo apply_filters( 'at_product_tab_comments_title', __( 'Erfahrungsberichte', 'affiliatetheme' ) ); ?></p>
			<?php get_template_part( 'parts/product/code', 'comments' ); ?>
		</div>
		<?php
	}

	do_action( 'at_product_sections_after_comments' );

	if ( '1' == get_field( 'product_single_show_related', 'option' ) ) {
		?>
		<hr>
		<div class="section section-related">
			<p class="h2 section-title"><?php echo apply_filters( 'at_product_tab_related_title', __( 'Ähnliche Produkte', 'affiliatetheme' ) ); ?></p>
			<?php get_template_part( 'parts/product/code', 'related' ); ?>
		</div>
		<?php
	}

	do_action( 'at_product_sections_after_related' );

	if ( get_field( 'product_accessories' ) && ( '1' == get_field( 'product_single_show_accessories', 'option' ) ) ) {
		?>
		<hr>
		<div class="section section-accessories">
			<p class="h2 section-title"><?php echo apply_filters( 'at_product_tab_accessories_title', __( 'Zubehör', 'affiliatetheme' ) ); ?></p>
			<?php get_template_part( 'parts/product/code', 'accessories' ); ?>
		</div>
		<?php
	}

	do_action( 'at_product_sections_last' );

} else {
	?>
	<div role="tabpanel">
		<ul class="nav nav-tabs" role="tablist" id="atTab">
			<?php
			do_action( 'at_product_tabs_nav_first' );
			if ( at_phone_detect() ) {
			?>
			<li role="presentation" class="dropdown">
				<a href="#" id="atTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="atTabDrop1-contents" aria-expanded="false">
					<?php _e( 'Menu', 'affiliatetheme' ); ?> <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" aria-labelledby="atTabDrop1" id="atTabDrop1-contents">
					<?php } ?>

					<li role="presentation" <?php if ( ! at_phone_detect() ) { ?>class="active"<?php } ?>><a href="#tab-description" aria-controls="tab-description" role="tab" data-toggle="tab"><?php echo apply_filters( 'at_product_tab_description_title', __( 'Beschreibung', 'affiliatetheme' ) ); ?></a></li>

					<?php do_action( 'at_product_tabs_nav_after_content' ); ?>

					<?php if ( at_show_price_trend( $post->ID, 'tab' ) ) { ?>
						<li role="presentation"><a href="#tab-price_trend" aria-controls="tab-price_trend" role="tab" data-toggle="tab"><?php echo apply_filters( 'at_product_tab_price_trend', __( 'Preisverlauf', 'affiliatetheme' ) ); ?></a></li>
					<?php } ?>

					<?php do_action( 'at_product_tabs_nav_after_price_trend' ); ?>

					<?php
					if ( comments_open() ) {
						$comments_count = wp_count_comments( $post->ID );
						?>
						<li role="presentation">
							<a href="#tab-comments" aria-controls="tab-comments" role="tab" data-toggle="tab">
								<?php echo apply_filters( 'at_product_tab_comments_title', sprintf( __( 'Erfahrungsberichte <span class="badge">%d</span>', 'affiliatetheme' ), $comments_count->approved ) ); ?>
							</a>
						</li>
						<?php
					}

					do_action( 'at_product_tabs_nav_after_comments' );
					?>

					<?php if ( '1' == get_field( 'product_single_show_related', 'option' ) ) { ?>
						<li role="presentation"><a href="#tab-related" aria-controls="tab-related" role="tab" data-toggle="tab"><?php echo apply_filters( 'at_product_tab_related_title', __( 'Ähnliche Produkte', 'affiliatetheme' ) ); ?></a></li>
					<?php } ?>

					<?php do_action( 'at_product_tabs_nav_after_related' ); ?>

					<?php if ( get_field( 'product_accessories' ) && ( '1' == get_field( 'product_single_show_accessories', 'option' ) ) ) { ?>
						<li role="presentation"><a href="#tab-accessories" aria-controls="tab-accessories" role="tab" data-toggle="tab"><?php echo apply_filters( 'at_product_tab_accessories_title', __( 'Zubehör', 'affiliatetheme' ) ); ?></a></li>
					<?php } ?>

					<?php apply_filters( 'at_product_tabs_nav', $product_tabs_nav, $post->ID ); /* @depcreated */ ?>

					<?php do_action( 'at_product_tabs_nav_last' ); ?>

					<?php if ( at_phone_detect() ) { ?>
				</ul>
				<?php
				}
				?>
		</ul>

		<div class="tab-content">
			<?php do_action( 'at_product_tabs_content_first' ); ?>

			<div role="tabpanel" class="tab-pane active" id="tab-description"><?php the_content(); ?></div>

			<?php do_action( 'at_product_tabs_content_after_content' ); ?>

			<?php if ( at_show_price_trend( $post->ID, 'tab' ) ) { ?>
				<div role="tabpanel" class="tab-pane" id="tab-price_trend"><?php get_template_part( 'parts/product/code', 'price_trend' ); ?></div>
			<?php } ?>

			<?php do_action( 'at_product_tabs_content_after_price_trend' ); ?>

			<?php if ( comments_open() ) { ?>
				<div role="tabpanel" class="tab-pane" id="tab-comments"><?php get_template_part( 'parts/product/code', 'comments' ); ?></div>
			<?php } ?>

			<?php do_action( 'at_product_tabs_content_after_comments' ); ?>

			<?php if ( '1' == get_field( 'product_single_show_related', 'option' ) ) { ?>
				<div role="tabpanel" class="tab-pane" id="tab-related"><?php get_template_part( 'parts/product/code', 'related' ); ?></div>
			<?php } ?>

			<?php do_action( 'at_product_tabs_content_after_related' ); ?>

			<?php if ( get_field( 'product_accessories' ) && ( '1' == get_field( 'product_single_show_accessories', 'option' ) ) ) { ?>
				<div role="tabpanel" class="tab-pane" id="tab-accessories"><?php get_template_part( 'parts/product/code', 'accessories' ); ?></div>
			<?php } ?>

			<?php apply_filters( 'at_product_tabs_content', $product_tabs_content, $post->ID ); ?>

			<?php do_action( 'at_product_tabs_content_last' ); ?>
		</div>
	</div>
<?php } ?>