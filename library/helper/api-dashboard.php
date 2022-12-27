<?php
/**
 * AffiliateTheme Import Dashboard
 * 
 * @author		Christian Lang
 * @version		1.0
 * @category	helper
 */

add_action('admin_menu', 'load_api_dashboard_page');
function load_api_dashboard_page() {
	add_menu_page('affiliatetheme Import', 'Import', apply_filters('at_set_import_dashboard_capabilities', 'administrator'), 'endcore_api_dashboard', 'affiliatetheme_import_dashboard', 'dashicons-smiley');
	
	function affiliatetheme_import_dashboard() {
		?>
		<div class="wrap" id="xcore-page">
			<h1><?php _e('affiliatetheme.io &raquo; Import Dashboard', 'affiliatetheme-backend'); ?></h1>

			<div class="content-wrapper">
				<p>
					<?php _e('Unser Ziel ist es das affiliatetheme.io so vielseitig wie Möglich zu gestalten. Das affiliatetheme.io soll nicht nur auf Amazon optimiert werden,
					sondern für weitere Portale nutzbar sein.', 'affiliatetheme-backend'); ?>
				</p>

				<h3><?php _e('Unsere Schnittestellen im Überblick', 'affiliatetheme-backend'); ?></h3>

				<?php
				$lang = 'de';
				$locale = get_locale();

				if(strpos($locale, 'en_') !== false) {
					$lang = 'en';
				}

				$extensions_feed = 'https://affiliatetheme.io/wp-json/at/v1/extensions?lang=' . $lang;
				if( ini_get('allow_url_fopen') ) {
					$extensions = json_decode(file_get_contents($extensions_feed));
					if($extensions) {
						?>
						<table class="widefat fixed at-extensions">
							<thead>
								<tr>
									<th></th>
									<th><?php _e('Name', 'affiliatetheme-backend'); ?></th>
									<th><?php _e('Aktuelle Version', 'affiliatetheme-backend'); ?></th>
									<th><?php _e('Zuletzt aktualisiert', 'affiliatetheme-backend'); ?></th>
									<th></th>
								</tr>
							</thead>

							<tbody>
								<?php foreach($extensions as $extension) { ?>
									<tr>
										<td>
											<?php if($extension->post_thumbnail) { ?>
												<img src="<?php echo $extension->post_thumbnail; ?>" class="img-responsive" style="max-width:100px" />
											<?php } ?>
										</td>
										<td>
											<?php
											if($extension->post_title) {
												 echo $extension->post_title;
											}
											?>
										</td>
										<td>
											<?php
											if($extension->version) {
												echo $extension->version;
											} else {
												echo '-';
											}
											?>
										</td>
										<td>
											<?php
											if($extension->last_updated) {
												echo $extension->last_updated;
											} else {
												echo '-';
											}
											?>
										</td>
										<td>
											<?php
											if(isset($extension->permalink)) {
												?><a href="<?php echo $extension->permalink; ?>" target="_blank" title="<?php _e('Weitere Informationen', 'affiliatetheme-backend'); ?>"><span class="dashicons dashicons-info"></span></a><?php
											}
											if(isset($extension->download)) {
												?><a href="<?php echo $extension->download; ?>" target="_blank" title="<?php _e('Schnittstelle herunterladen', 'affiliatetheme-backend'); ?>"><span class="dashicons dashicons-download"></span></a><?php
											}
											if(isset($extension->support_forum)) {
												?><a href="<?php echo $extension->support_forum; ?>" target="_blank" title="<?php _e('Support', 'affiliatetheme-backend'); ?>"><span class="dashicons dashicons-sos"></span></a><?php
											}
											?>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<?php
					} else {
						printf(__('Ooops, es wurden keine Extensions gefunden, was ist denn hier los? Schau mal auf <a href="%s" target="_blank">unserer Webseite</a> nach.', 'affiliatetheme-backend'), 'https://affiliatetheme.io/extensions/');
					}
				} else {
					printf(__('Ooops, eine Serverfunktion (allow_url_fopen) fehlt bei Dir, wir können die Liste nicht laden. Schau mal auf <a href="%s" target="_blank">unserer Webseite</a> nach.', 'affiliatetheme-backend'), 'https://affiliatetheme.io/extensions/');
				}
				?>
			</div>
		</div>
		<?php
	}
}
