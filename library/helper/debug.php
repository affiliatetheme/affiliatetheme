<?php
/**
 * affiliatetheme.io Debug Page
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    helper
 */

function at_let_to_num( $size ) {
	$l   = substr( $size, - 1 );
	$ret = substr( $size, 0, - 1 );
	switch ( strtoupper( $l ) ) {
		case 'P':
			$ret *= 1024;
		case 'T':
			$ret *= 1024;
		case 'G':
			$ret *= 1024;
		case 'M':
			$ret *= 1024;
		case 'K':
			$ret *= 1024;
	}

	return $ret;
}

add_action( 'admin_menu', 'load_debug_page' );
function load_debug_page() {
	add_menu_page( 'affiliatetheme.io Debug', 'Debug', 'administrator', 'affiliatetheme_debug', 'affiliatetheme_debug_page', 'dashicons-sos' );

	function affiliatetheme_debug_page() {
		global $wpdb;
		$upload_dir    = wp_upload_dir();
		$upload_folder = str_replace( $_SERVER['DOCUMENT_ROOT'], '', $upload_dir['basedir'] );

		// test upload folder
		$test_file = @fopen( $upload_dir['path'] . "/chmod-test-file", "a+" );
		if ( $test_file ) {
			$upload_folder_access = true;
		} else {
			$upload_folder_access = false;
		}
		@fclose( $test_file );
		@unlink( $upload_dir['path'] . "/chmod-test-file" );

		// plugins
		$at_debug_info_plugins = '';
		$active_plugins        = (array) get_option( 'active_plugins', array() );
		if ( is_multisite() ) {
			$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
		}
		foreach ( $active_plugins as $plugin ) {
			$plugin_data    = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
			$dirname        = dirname( $plugin );
			$version_string = '';
			$network_string = '';

			if ( ! empty( $plugin_data['Name'] ) ) {
				// link the plugin name to the plugin url if available
				$plugin_name = esc_html( $plugin_data['Name'] );

				if ( ! empty( $plugin_data['PluginURI'] ) ) {
					$plugin_name = '<a href="' . esc_url( $plugin_data['PluginURI'] ) . '" title="' . __( 'Besuche die Plugin-Homepage', 'affiliatetheme-backend' ) . '" target="_blank">' . $plugin_name . '</a>';
				}

				$at_debug_info_plugins .= $plugin_data['Name'] . ' - ' . $plugin_data['Version'] . "\r\n";
			}
		}

		// themes
		$at_debug_info_themes = '';
		$installed_themes     = wp_get_themes();
		$active_theme         = wp_get_theme();
		foreach ( $installed_themes as $theme ) {
			if ( $theme == $active_theme ) {
				$activated = true;
			} else {
				$activated = false;
			}

			$name    = $theme->get( 'Name' );
			$version = $theme->get( 'Version' );

			$at_debug_info_themes .= $name . ( $activated ? ' (active)' : '' ) . ' - ' . $version . "\r\n";
		}

		$at_debug_info = sprintf( __( 'Debug-Informationen zu: %s', 'affiliatetheme-backend' ), home_url() ) . '
##################################
Home URL: ' . home_url() . '
Site URL: ' . site_url() . '
Document Root: ' . $_SERVER['DOCUMENT_ROOT'] . '
Template URL: ' . get_template_directory_uri() . '
Stylesheet URL: ' . get_stylesheet_directory_uri() . '
Template Ordner: ' . get_template_directory() . '
Stylesheet Ordner: ' . get_stylesheet_directory() . '
Uploads Ordner: ' . $upload_dir['basedir'] . '
##################################
WP Version: ' . get_bloginfo( 'version' ) . '
WP Multisite: ' . ( is_multisite() ? 'Ja' : 'Nein' ) . '
WP Memory Limit: ' . size_format( at_let_to_num( WP_MEMORY_LIMIT ) ) . '
Server Memory Limit: ' . ( ini_get( 'memory_limit' ) ? size_format( at_let_to_num( ini_get( 'memory_limit' ) ) ) : '0' ) . '
WP Debug Mode: ' . ( defined( 'WP_DEBUG' ) && WP_DEBUG ? 'Ja' : 'Nein' ) . '
Language: ' . get_locale() . '
###################################
Server:	' . esc_html( $_SERVER['SERVER_SOFTWARE'] ) . '
PHP Version: ' . phpversion() . '
cURL: ' . ( extension_loaded( 'curl' ) != function_exists( 'curl_version' ) ? 'Nein' : 'Ja' ) . '
SOAP: ' . ( extension_loaded( 'soap' ) == false ? 'Nein' : 'Ja' ) . '
PHP Allow URL Fopen: ' . ( ini_get( 'allow_url_fopen' ) == false ? 'Nein' : 'Ja' ) . '
PHP Post Max Size: ' . size_format( at_let_to_num( ini_get( 'post_max_size' ) ) ) . '
PHP Time Limit: ' . ini_get( 'max_execution_time' ) . '
PHP Max Input Vars: ' . ini_get( 'max_input_vars' ) . '
MySQL Version: ' . $wpdb->db_version() . '
Max Upload Size: ' . size_format( wp_max_upload_size() ) . '
###################################
' . $at_debug_info_themes . '###################################
' . $at_debug_info_plugins;

		?>
        <div class="wrap" id="xcore-page">
            <h1 style="margin-bottom:20px"><?php _e( 'affiliatetheme.io &raquo; Debug', 'affiliatetheme-backend' ); ?></h1>

            <p><?php _e( '<strong>Wichtig:</strong> Wenn du einen Thread im Forum erstellst, füge bitte diese Information im entsprechenden Feld dafür hinzu. So können wir Dir besser helfen.', 'affiliatetheme-backend' ); ?></p>
            <textarea readonly="readonly" style="width:100%;height:200px;margin:0 0 20px 0;" onclick="this.focus();this.select()"><?php echo $at_debug_info; ?></textarea>

			<?php if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON == 1 ) { ?>
                <div class="alert alert-danger">
                    <h4><?php _e( 'Cronjobs deaktiviert', 'affiliatetheme-backend' ); ?></h4>
                    <p><?php _e( 'In deiner Installation sind Cronjobs deaktiviert. Bitte trage folgenden Wert in die <mark>wp-config.php</mark> ein:', 'affiliatetheme-backend' ); ?></p>
                    <p>
                        <mark>define('DISABLE_WP_CRON', 'false');</mark>
                    </p>
                    <p<?php _e( 'Alternativ kannst du die Cronjobs auch über deinen Hoster ausführen lassen, scroll dazu bitte ganz nach unten und lies die Anleitung durch.', 'affiliatetheme-backend' ); ?></p>
                </div>
			<?php } ?>

            <table class="at_debug_table widefat" cellspacing="0" id="status">
                <thead>
                <tr>
                    <th colspan="2" data-export-label="WordPress"><?php _e( 'WordPress', 'affiliatetheme-backend' ); ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td data-export-label="Home URL" width="200"><?php _e( 'Home URL', 'affiliatetheme-backend' ); ?>:</td>
                    <td><?php echo home_url(); ?></td>
                </tr>
                <tr>
                    <td data-export-label="Site URL"><?php _e( 'Site URL', 'affiliatetheme-backend' ); ?>:</td>
                    <td><?php echo site_url(); ?></td>
                </tr>
                <tr>
                    <td data-export-label="Document Root"><?php _e( 'Document Root', 'affiliatetheme-backend' ); ?>:</td>
                    <td><?php echo $_SERVER['DOCUMENT_ROOT']; ?></td>
                </tr>
                <tr>
                    <td data-export-label="Template URL"><?php _e( 'Template URL', 'affiliatetheme-backend' ); ?>:</td>
                    <td><?php echo get_template_directory_uri(); ?></td>
                </tr>
                <tr>
                    <td data-export-label="Stylesheet URL"><?php _e( 'Stylesheet URL', 'affiliatetheme-backend' ); ?>:</td>
                    <td><?php echo get_stylesheet_directory_uri(); ?></td>
                </tr>
                <tr>
                    <td data-export-label="Tmplate Ordner"><?php _e( 'Template Ordner', 'affiliatetheme-backend' ); ?>:</td>
                    <td><?php echo get_template_directory(); ?></td>
                </tr>
                <tr>
                    <td data-export-label="Stylesheet Ordner"><?php _e( 'Stylesheet Ordner', 'affiliatetheme-backend' ); ?>:</td>
                    <td><?php echo get_stylesheet_directory(); ?></td>
                </tr>
                <tr>
                    <td data-export-label="Uploads Ordner"><?php _e( 'Uploads Ordner', 'affiliatetheme-backend' ); ?>:</td>
                    <td>
						<?php
						if ( $upload_folder_access == false ) {
							echo '<mark>' . $upload_dir['basedir'] . ' -  ' . __( 'bitte Schreibrechte setzen (chmod 775 / 777)', 'affiliatetheme-backend' ) . '</mark>';
						} else {
							echo $upload_dir['basedir'];
						}
						?>
                    </td>
                </tr>
                <tr>
                    <td data-export-label="WP Version"><?php _e( 'WP Version', 'affiliatetheme-backend' ); ?>:</td>
                    <td><?php bloginfo( 'version' ); ?></td>
                </tr>
                <tr>
                    <td data-export-label="WP Multisite"><?php _e( 'WP Multisite', 'affiliatetheme-backend' ); ?>:</td>
                    <td><?php if ( is_multisite() ) {
							echo '&#10004;';
						} else {
							echo '&ndash;';
						} ?></td>
                </tr>
                <tr>
                    <td data-export-label="WP Memory Limit"><?php _e( 'WP Memory Limit', 'affiliatetheme-backend' ); ?>:</td>
                    <td><?php
						$memory = at_let_to_num( WP_MEMORY_LIMIT );
						echo size_format( $memory );
						?></td>
                </tr>
                <tr>
                    <td data-export-label="Server Memory Limit"><?php _e( 'Server Memory Limit', 'affiliatetheme-backend' ); ?>:</td>
                    <td><?php
						$memory = ( ini_get( 'memory_limit' ) ? at_let_to_num( ini_get( 'memory_limit' ) ) : '0' );

						if ( $memory < 67108864 ) {
							echo '<mark>' . sprintf( __( '%s - Damit WordPress reibungslos funktioniert, empfehlen wir ein Memory Limit von min. 64MB. <a href="%s" target="_blank">Mehr Informationen</a>', 'affiliatetheme-backend' ), size_format( $memory ), 'http://drwp.de/wordpress-memory-limit/' ) . '</mark>';
						} else {
							echo size_format( $memory );
						}
						?></td>
                </tr>
                <tr>
                    <td data-export-label="WP Debug Mode"><?php _e( 'WP Debug Mode', 'affiliatetheme-backend' ); ?>:</td>
                    <td><?php if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
							echo '<mark>' . '&#10004;' . '</mark>';
						} else {
							echo '&ndash;';
						} ?></td>
                </tr>
                <tr>
                    <td data-export-label="Language"><?php _e( 'Language', 'affiliatetheme-backend' ); ?>:</td>
                    <td><?php echo get_locale() ?></td>
                </tr>
                </tbody>
            </table>

            &nbsp;

            <table class="at_debug_table widefat" cellspacing="0" id="status">
                <thead>
                <tr>
                    <th colspan="2" data-export-label="Server"><?php _e( 'Server', 'affiliatetheme-backend' ); ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td data-export-label="Server Info" width="200"><?php _e( 'Server', 'affiliatetheme-backend' ); ?>:</td>
                    <td><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ); ?></td>
                </tr>
                <tr>
                    <td data-export-label="PHP Version"><?php _e( 'PHP Version', 'affiliatetheme-backend' ); ?>:</td>
                    <td><?php
						if ( function_exists( 'phpversion' ) ) {
							$php_version = phpversion();

							if ( version_compare( $php_version, '5.5', '<' ) ) {
								echo '<mark>' . sprintf( __( '%s - Benutze mind. Version 5.5. <a href="%s" target="_blank">Mehr Informationen</a>', 'affiliatetheme-backend' ), esc_html( $php_version ), 'http://docs.woothemes.com/document/how-to-update-your-php-version/' ) . '</mark>';
							} else {
								echo esc_html( $php_version );
							}
						} else {
							_e( "PHP Version nicht abrufbar, die Funktion phpversion() existiert nicht.", 'affiliatetheme-backend' );
						}
						?></td>
                </tr>
                <tr>
                    <td data-export-label="cURL"><?php _e( 'cURL', 'affiliatetheme-backend' ); ?>:</td>
                    <td>
						<?php
						if ( extension_loaded( 'curl' ) != function_exists( 'curl_version' ) ) :
							echo '<mark>' . __( 'Für die Verwendung der Schnittstellen benötigst du cURL. <a href="http://php.net/manual/de/book.curl.php" taget="_blank">Hier</a> findest du mehr Informationen darüber. Kontaktiere im Zweifel deinen Systemadministrator.', 'affiliatetheme-backend' ) . '</mark>';
						else :
							echo '&#10004;';
						endif;
						?>
                    </td>
                </tr>
                <tr>
                    <td data-export-label="SOAP"><?php _e( 'SOAP', 'affiliatetheme-backend' ); ?>:</td>
                    <td>
						<?php
						if ( extension_loaded( 'soap' ) == false ) :
							echo '<mark>' . __( 'Für die Verwendung der Schnittstellen benötigst du SOAP. <a href="http://php.net/manual/de/book.soap.php" taget="_blank">Hier</a> findest du mehr Informationen darüber. Kontaktiere im Zweifel deinen Systemadministrator.', 'affiliatetheme-backend' ) . '</mark>';
						else :
							echo '&#10004;';
						endif;
						?>
                    </td>
                </tr>

				<?php if ( function_exists( 'ini_get' ) ) : ?>
                    <tr>
                        <td data-export-label="PHP Allow URL Fopen"><?php _e( 'PHP Allow URL Fopen', 'affiliatetheme-backend' ); ?>:</td>
                        <td>
							<?php
							if ( ini_get( 'allow_url_fopen' ) == false ):
								echo '<mark>' . __( 'Du hast allow_url_fopen deaktiviert. Du benötigst diese Funktionen für versch. Funktionen der Schnittstellen.', 'affiliatetheme-backend' ) . '</mark>';
							else :
								echo '&#10004;';
							endif;
							?>
                        </td>
                    </tr>
                    <tr>
                        <td data-export-label="PHP Post Max Size"><?php _e( 'PHP Post Max Size', 'affiliatetheme-backend' ); ?>:</td>
                        <td><?php echo size_format( at_let_to_num( ini_get( 'post_max_size' ) ) ); ?></td>
                    </tr>
                    <tr>
                        <td data-export-label="PHP Time Limit"><?php _e( 'PHP Time Limit', 'affiliatetheme-backend' ); ?>:</td>
                        <td><?php echo ini_get( 'max_execution_time' ); ?></td>
                    </tr>
                    <tr>
                        <td data-export-label="PHP Max Input Vars"><?php _e( 'PHP Max Input Vars', 'affiliatetheme-backend' ); ?>:</td>
                        <td><?php echo ini_get( 'max_input_vars' ); ?></td>
                    </tr>
				<?php endif; ?>
                <tr>
                    <td data-export-label="MySQL Version"><?php _e( 'MySQL Version', 'affiliatetheme-backend' ); ?>:</td>
                    <td>
						<?php echo $wpdb->db_version(); ?>
                    </td>
                </tr>
                <tr>
                    <td data-export-label="Max Upload Size"><?php _e( 'Max Upload Size', 'affiliatetheme-backend' ); ?>:</td>
                    <td><?php echo size_format( wp_max_upload_size() ); ?></td>
                </tr>
                </tbody>
            </table>

            &nbsp;

            <table class="at_debug_table widefat" cellspacing="0" id="status">
                <thead>
                <tr>
                    <th colspan="2" data-export-label="Themes (<?php echo count( (array) $installed_themes ); ?>)"><?php _e( 'Themes', 'affiliatetheme-backend' ); ?> (<?php echo count( (array) $installed_themes ); ?>)</th>
                </tr>
                </thead>
                <tbody>
				<?php
				foreach ( $installed_themes as $theme ) {
					if ( $theme == $active_theme ) {
						$activated = true;
					} else {
						$activated = false;
					}

					$name    = $theme->get( 'Name' );
					$author  = $theme->get( 'Author' );
					$version = $theme->get( 'Version' );
					?>
                    <tr>
                        <td width="300"><?php echo $name;
							if ( $activated ) {
								echo ' (active)';
							} ?></td>
                        <td><?php echo sprintf( _x( 'von %s', 'von', 'affiliatetheme-backend' ), $author ) . ' &ndash; ' . esc_html( $version ); ?></td>
                    </tr>
					<?php
				}
				?>
                </tbody>
            </table>&nbsp;

            &nbsp;

            <table class="at_debug_table widefat" cellspacing="0" id="status">
                <thead>
                <tr>
                    <th colspan="2" data-export-label="Plugins (<?php echo count( (array) $active_plugins ); ?>)"><?php _e( 'Plugins', 'affiliatetheme-backend' ); ?> (<?php echo count( (array) $active_plugins ); ?>)</th>
                </tr>
                </thead>
                <tbody>
				<?php
				if ( is_multisite() ) {
					$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
				}

				foreach ( $active_plugins as $plugin ) {
					$plugin_data    = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
					$dirname        = dirname( $plugin );
					$version_string = '';
					$network_string = '';

					if ( ! empty( $plugin_data['Name'] ) ) {
						// link the plugin name to the plugin url if available
						$plugin_name = esc_html( $plugin_data['Name'] );

						if ( ! empty( $plugin_data['PluginURI'] ) ) {
							$plugin_name = '<a href="' . esc_url( $plugin_data['PluginURI'] ) . '" title="' . __( 'Besuche die Plugin-Homepage', 'affiliatetheme-backend' ) . '" target="_blank">' . $plugin_name . '</a>';
						}
						?>
                        <tr>
                            <td width="300"><?php echo $plugin_name; ?></td>
                            <td><?php echo sprintf( _x( 'von %s', 'von', 'affiliatetheme-backend' ), $plugin_data['Author'] ) . ' &ndash; ' . esc_html( $plugin_data['Version'] ) . $version_string . $network_string; ?></td>
                        </tr>
						<?php
					}
				}
				?>
                </tbody>
            </table>

            &nbsp;

            <table class="at_debug_table table-cronjob widefat" cellspacing="0" id="status">
				<?php $cronjobs = _get_cron_array(); ?>
                <thead>
                <tr>
                    <th colspan="4" data-export-label="Plugins (<?php echo count( $cronjobs ) + 2; ?>)"><?php _e( 'Cronjobs', 'affiliatetheme-backend' ); ?> (<?php echo count( $cronjobs ) + 2; ?>)</th>
                </tr>
                </thead>
                <tbody>
                <tr class="first">
                    <td><strong><?php _e( 'Name', 'affiliatetheme-backend' ); ?></strong></td>
                    <td><strong><?php _e( 'Argumente', 'affiliatetheme-backend' ); ?></strong></td>
                    <td><strong><?php _e( 'Intervall', 'affiliatetheme-backend' ); ?></strong></td>
                    <td><strong><?php _e( 'Nächste Laufzeit', 'affiliatetheme-backend' ); ?></strong></td>
                </tr>
				<?php
				foreach ( $cronjobs as $key => $val ) {
					$next_run = $key;
					foreach ( $val as $cron => $data ) {
						foreach ( $data as $hash => $info ) {
							?>
                            <tr>
                                <td>
									<?php
									if ( 0 < strpos( $cron, 'ffiliatetheme' ) ) {
										echo '<strong>(Theme API)</strong> ' . $cron;

										if ( 'affiliatetheme_amazon_api_update' == $cron && defined( 'AWS_CRON_HASH' ) ) {
											echo ' (<a href="#" class="start-cron" data-cron="amazon_api_update" data-hash="' . AWS_CRON_HASH . '">' . __( 'Cronjob jetzt ausführen', 'affiliatetheme-backend' ) . '</a>)';
										} elseif ( 'affiliatetheme_belboon_api_update' == $cron && defined( 'BBOON_CRON_HASH' ) ) {
											echo ' (<a href="#" class="start-cron" data-cron="belboon_api_update" data-hash="' . BBOON_CRON_HASH . '">' . __( 'Cronjob jetzt ausführen', 'affiliatetheme-backend' ) . '</a>)';
										}
									} else {
										echo $cron;
									}
									?>
                                </td>
                                <td>
									<?php echo json_encode( $info['args'] ); ?>
                                </td>
                                <td>
									<?php
									echo( isset( $info['interval'] ) ? $info['interval'] . 's' : '-' );
									echo( isset( $info['interval'] ) ? '<br>' . ( $info['interval'] / ( 60 ) ) . 'm' : '' );
									echo( isset( $info['interval'] ) ? '<br>' . round( ( $info['interval'] / ( 60 * 60 ) ), 2 ) . 'h' : '' );
									?>
                                </td>
                                <td><?php echo date_i18n( 'd.m.Y H:i:s', $next_run ); ?></td>
                            </tr>
							<?php
						}
					}
				}
				?>
                </tbody>
            </table>

            &nbsp;

            <div class="alert alert-info">
                <h2 style="margin-top: 0"><?php _e( 'Cronjobs manuell ausführen', 'affiliatetheme-backend' ); ?></h2>
                <p><?php _e( 'Die WordPress Cronjobs laufen nicht auf jedem Server optimal. Wenn du die Cronjobs für die API gerne über deinen Hoster anstoßen willst, musst du die folgenden URLs verwenden:', 'affiliatetheme-backend' ); ?></p>

				<?php
				if ( is_plugin_active( 'affiliatetheme-amazon/affiliatetheme-amazon.php' ) ) {
					echo '<h3>' . __( 'Amazon API', 'affiliatetheme-backend' ) . '</h3>' . admin_url( 'admin-ajax.php?action=amazon_api_update&hash=' . AWS_CRON_HASH );
				}
				if ( is_plugin_active( 'affiliatetheme-belboon/affiliatetheme-belboon.php' ) ) {
					echo '<h3>' . __( 'Belboon API', 'affiliatetheme-backend' ) . '</h3>' . admin_url( 'admin-ajax.php?action=belboon_api_update&hash=' . BBOON_CRON_HASH );
				}
				if ( is_plugin_active( 'affiliatetheme-ebay/affiliatetheme-ebay.php' ) ) {
					echo '<h3>' . __( 'eBay API', 'affiliatetheme-backend' ) . '</h3>' . admin_url( 'admin-ajax.php?action=ebay_api_update&hash=' . EBAY_CRON_HASH );
				}
				if ( is_plugin_active( 'affiliatetheme-adcell/affiliatetheme-adcell.php' ) ) {
					echo '<h3>' . __( 'Adcell API', 'affiliatetheme-backend' ) . '</h3>' . admin_url( 'admin-ajax.php?action=adcell_api_update&hash=' . ADCELL_CRON_HASH );
				}
				if ( is_plugin_active( 'affiliatetheme-cj/affiliatetheme-cj.php' ) ) {
					echo '<h3>' . __( 'CJ API', 'affiliatetheme-backend' ) . '</h3>' . admin_url( 'admin-ajax.php?action=cj_api_update&hash=' . CJ_CRON_HASH );
				}
				if ( is_plugin_active( 'affiliatetheme-rakuten/affiliatetheme-rakuten.php' ) ) {
					echo '<h3>' . __( 'Rakuten API', 'affiliatetheme-backend' ) . '</h3>' . admin_url( 'admin-ajax.php?action=rakuten_api_update&hash=' . RAKUTEN_CRON_HASH );
				}
				if ( is_plugin_active( 'affiliatetheme-tradetracker/affiliatetheme-tradetracker.php' ) ) {
					echo '<h3>' . __( 'Tradetracker API', 'affiliatetheme-backend' ) . '</h3>' . admin_url( 'admin-ajax.php?action=tradetracker_api_update&hash=' . TRADETRACKER_CRON_HASH );
				}
				if ( is_plugin_active( 'affiliatetheme-tradedoubler/affiliatetheme-tradedoubler.php' ) ) {
					echo '<h3>' . __( 'Tradedoubler API', 'affiliatetheme-backend' ) . '</h3>' . admin_url( 'admin-ajax.php?action=tradedoubler_api_update&hash=' . TRADEDOUBLER_CRON_HASH );
				}
				if ( is_plugin_active( 'affiliatetheme-daisycon/affiliatetheme-daisycon.php' ) ) {
					echo '<h3>' . __( 'Daisycon API', 'affiliatetheme-backend' ) . '</h3>' . admin_url( 'admin-ajax.php?action=daisycon_api_update&hash=' . DAISYCON_CRON_HASH );
				}
				if ( is_plugin_active( 'affiliatetheme-financeads/affiliatetheme-financeads.php' ) ) {
					echo '<h3>' . __( 'FinanceAds API', 'affiliatetheme-backend' ) . '</h3>' . admin_url( 'admin-ajax.php?action=financeads_api_update&hash=' . FINANCEADS_CRON_HASH );
				}
				if ( is_plugin_active( 'affiliatetheme-yadore/affiliatetheme-yadore.php' ) ) {
					echo '<h3>' . __( 'Yadore API', 'affiliatetheme-backend' ) . '</h3>' . admin_url( 'admin-ajax.php?action=yadore_api_update&hash=' . YADORE_CRON_HASH );
				}
				if ( is_plugin_active( 'affiliatetheme-ccsv/affiliatetheme-ccsv.php' ) ) {
					echo '<h3>' . __( 'Custom CSV', 'affiliatetheme-backend' ) . '</h3>' . admin_url( 'admin-ajax.php?action=ccsv_api_update&hash=' . CCSV_CRON_HASH );
				}
				if ( is_plugin_active( 'affiliatetheme-tracdelight/affiliatetheme-tracdelight.php' ) ) {
					echo '<h3>' . __( 'Tracdelight API', 'affiliatetheme-backend' ) . '</h3>' . admin_url( 'admin-ajax.php?action=tracdelight_api_update&hash=' . TRACDELIGHT_CRON_HASH );
				}
				?>
            </div>
        </div>

        <script type="text/javascript">
            jQuery('.start-cron:not(.noevent)').click(function (e) {
                var btn = jQuery(this);
                jQuery(btn).append(' <i class="fas fa-circle-o-notch fa-spin"></i>').addClass('noevent');

                var action = jQuery(this).data('cron');
                var hash = jQuery(this).data('hash');

                jQuery.ajax({
                    url: ajaxurl,
                    type: 'GET',
                    data: {'action': action, 'hash': hash},
                    success: function (data) {
                        jQuery(btn).removeClass('noevent').find('i').remove();
                    },
                    error: function () {
                        jQuery(btn).removeClass('noevent').find('i').remove();
                    }
                });

                e.preventDefault();
            });
        </script>
		<?php


	}
}