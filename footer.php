			<?php
			do_action( 'at_after_content' );

			if ( function_exists( 'yoast_breadcrumb' ) && ( 'above_footer' == get_field( 'design_breadcrumbs_pos', 'option' ) ) ) {
				if ( yoast_breadcrumb( "", "", false ) ) {
					wp_reset_postdata();
					?>
					<section id="breadcrumbs" class="<?php echo at_get_section_layout_class( 'breadcrumbs' ); ?>">
						<div class="container">
							<?php
							yoast_breadcrumb( '<p>', '</p>' );
							?>
						</div>
					</section>
					<?php
				}
			} ?>

			<footer id="footer" class="<?php echo at_get_section_layout_class( 'footer' ); ?>">
				<?php
				if ( get_field( 'design_footer_widgets', 'option' ) ) {
					get_template_part( 'parts/footer/code', 'top' );
				}

				get_template_part( 'parts/footer/code', 'bottom' );
				?>
			</footer>

			<?php
			the_field( 'custom_code_footer', 'option' );

			wp_footer();
			?>
		</div>
	</body>
</html>