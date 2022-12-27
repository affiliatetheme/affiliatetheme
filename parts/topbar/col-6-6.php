<?php

if ( at_get_topbar() ) {
	$topbarText = get_field( 'design_topbar_text', 'option' );
	?>
	<section id="topbar" class="<?php echo at_get_section_layout_class( 'topbar' ); ?>">
		<div class="container">
			<div class="row">
				<?php
				if ( at_topbar_structure() == 'nl_tr' ) {
					?>
					<div class="col-sm-6">
						<?php
						if ( has_nav_menu( 'nav_topbar' ) ) {
							wp_nav_menu(
								array(
									'menu_class'     => 'list-inline',
									'theme_location' => 'nav_topbar',
									'container'      => 'false',
									'depth'          => '1',
									'walker'         => new at_navigation_walker()
								)
							);
						}
						?>
					</div>
					<?php
				}
				?>

				<div class="col-sm-6">
					<?php
					if ( $topbarText ) {
						?>
						<p><?= $topbarText ?></p>
						<?php
					}
					?>
				</div>

				<?php
				if ( at_topbar_structure() == 'tl_nr' ) {
					?>
					<div class="col-sm-6">
						<?php
						if ( has_nav_menu( 'nav_topbar' ) ) {
							wp_nav_menu(
								array(
									'menu_class'     => 'list-inline pull-right',
									'theme_location' => 'nav_topbar',
									'container'      => 'false',
									'depth'          => '1',
									'walker'         => new at_navigation_walker()
								)
							);
						}
						?>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</section>
	<?php
}