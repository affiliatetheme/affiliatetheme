<div id="footer-bottom">
	<div class="container">
		<div class="row">
			<?php if ( at_footer_structure() == 'nl_tr' ) { ?>
				<div class="col-sm-6">
					<?php
					if ( has_nav_menu( 'nav_footer' ) ) {
						wp_nav_menu(
							array(
								'menu_class'     => 'list-inline',
								'theme_location' => 'nav_footer', /* where in the theme it's assigned */
								'container'      => 'false', /* container class */
								'depth'          => '2', /* suppress lower levels for now */
								'walker'         => new at_navigation_walker()
							)
						);
					}
					?>
				</div>
			<?php } ?>

			<div class="col-sm-6">
				<?php
				if ( get_field( 'design_footer_text', 'option' ) ) {
					$footer_text = get_field( 'design_footer_text', 'option' );

					if ( get_field( 'design_footer_atio_link', 'option' ) == '1' && is_front_page() ) {
						$footer_text .= ' ' . get_field( 'design_footer_atio_link_text', 'option' );
					}

					echo '<p>' . do_shortcode( $footer_text ) . '</p>';
				}
				?>
			</div>

			<?php if ( at_footer_structure() == 'tl_nr' ) { ?>
				<div class="col-sm-6">
					<?php
					if ( has_nav_menu( 'nav_footer' ) ) {
						wp_nav_menu(
							array(
								'menu_class'     => 'list-inline pull-right',
								'theme_location' => 'nav_footer', /* where in the theme it's assigned */
								'container'      => 'false', /* container class */
								'depth'          => '2', /* suppress lower levels for now */
								'walker'         => new at_navigation_walker()
							)
						);
					}
					?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>