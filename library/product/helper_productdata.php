<?php
/**
 * Created by PhpStorm.
 * User: Kenanja
 * Date: 10.08.2017
 * Time: 09:37
 */

if ( ! function_exists( 'at_product_data_import_box' ) ) {
	/**
	 * at_product_data_import_box
	 *
	 * Add product data import metabox to product page
	 */
	add_action( 'add_meta_boxes', 'at_product_data_import_box' );
	function at_product_data_import_box()
	{
		add_meta_box(
			'product_data_import',
			__( 'Produktdaten Import', 'affiliatetheme-backend' ),
			'at_product_data_import_box_callback',
			'product', 'side', 'low'
		);
	}
}

if ( ! function_exists( 'at_product_data_import_box_callback' ) ) {
	function at_product_data_import_box_callback( $post )
	{
		?>
		<div class="at-productdata-import">
			<p><?php _e( 'Importiere Produktdaten oder lege eigene Felder vollautomatisch an. (<a href="https://affiliatetheme.io/doc/produktdaten-import/">Anleitung</a>)', 'affiliatetheme-backend' ); ?></p>
			<p><small><?php _e( 'Quellen: icecat.biz', 'affiliatetheme-backend' ); ?></small></p>

			<input type="hidden" id="product_data_import_post_id" name="product_data_import_post_id" value="<?php echo $post->ID ?>"/>
			<a type="button" class="at-productdata-import-thickbox button button-primary"><?php _e( 'Importieren', 'affiliatethem-backend' ); ?></a>
		</div>
		<div class="at-productdata-import-result"></div>
		<?php
	}
}

add_action( 'wp_ajax_at_product_data_import_thickbox', 'at_product_data_import_thickbox' );
if ( ! function_exists( 'at_product_data_import_thickbox' ) ) {
	function at_product_data_import_thickbox()
	{
		$post_id = $_GET['post_id'];
		?>
		<div class="at-productdata-import-thickbox">
			<div class="at-import-thickbox-input">
				<textarea id="at-productdata-source" placeholder="<?php _e( 'icecat.biz Produkt URL eingeben.', 'affiliatetheme-backend' ); ?>"></textarea>
				<button class="at-productdata-get-thickbox-content button button-primary"><?php _e( "Produktdaten suchen", 'affiliatetheme-backend' ); ?></button>
				<button type="button" class="at-productdata-generate-fields button alignright"><?php _e( 'Felder generieren', 'affiliatethem-backend' ); ?></button>
				<span class="spinner"></span>
				<input type="hidden" id="at-productdata-postid" value="<?php echo $post_id; ?>"/>
			</div>
			<div class="at-import-thickbox-result">
			</div>

			<div class="alert alert-info">
				<?php _e( 'Mit dieser Funktion kannst du voll automatisch Produktdaten von <strong>icecat.biz</strong> abfragen und diese Werte entweder 
                in bestehende Felder importieren (bei gleichem Namen wird das richtige Feld direkt ausgewählt) oder anhand der Werte eine neue Feldgruppe anlegen.', 'affiliatetheme-backend' ); ?>
			</div>
		</div>

		<script type="text/javascript">
			jQuery('.at-productdata-import-thickbox').closest('#TB_window').addClass('at-productdata-import');
		</script>
		<?php
		exit();
	}
}
add_action( 'wp_ajax_at_product_data_import_form', 'at_product_data_import_form' );
if ( ! function_exists( 'at_product_data_import_form' ) ) {
	function at_product_data_import_form()
	{
		$post_id = sanitize_text_field( $_POST['post_id'] );
		$url     = esc_url_raw( $_POST['url'] );
		if ( preg_match( '/^https:\/\/icecat\./', $url ) && preg_match( '/\/p\//', $url ) ) {
			$data = at_get_icecat_product_sheet( $url );
		} else {
			echo '<div class="alert alert-warning">' . __( 'Der eingegebene Text/Link ist keine gültige icecat Produkt URL.', 'affiliatetheme-backend' ) . '</div>';
			exit();
		}
		?>

		<form id="at_product_data_import_form">
			<div class="stupid-bullshit-acf-errors" style="display:none">
				<?php
				$selector    = new acf_field_field_selector();
				$fields      = $selector->get_selectable_item_fields( null, false );
				$selectables = $selector->get_items( "", $fields );
				$groups      = acf_get_field_groups( array( 'post_id' => $post_id ) );
				?>
			</div>
			<?php
			$groups_have_selectables = false;
			foreach ( $groups as $group ) {
				$hasselectables = false;
				foreach ( $selectables as $selectable ) {
					if ( $selectable['group']['ID'] == $group['ID'] && $selectable['type'] != "message" && $selectable['type'] != "tab" ) {
						$groups_have_selectables = true;
					}
				}
			}
			if ( ! $groups_have_selectables ) {
				echo '<div class="alert alert-warning">' . __( 'Du hast keine Felder für die Eigenschaften generiert. Bitte generiere diese durch klicken des "Felder generieren" Buttons.', 'affiliatetheme-backend' ) . '</div>';
			} else
				foreach ( $groups as $group ) {
					$hasselectables = false;
					foreach ( $selectables as $selectable ) {
						if ( $selectable['group']['ID'] == $group['ID'] && $selectable['type'] != "message" && $selectable['type'] != "tab" ) {
							$hasselectables = true;
						}
					}
					?>
					<?php if ( $hasselectables ) { ?><div class="product-attribute-group">
						<h2><?php echo $group['title'] ?></h2>
						<div class="product-data-item-wrapper"><?php
					}
					foreach ( $selectables as $selectable ) {
						if ( $selectable['group']['ID'] == $group['ID'] && $selectable['type'] != "message" && $selectable['type'] != "tab" ) {
							?>
							<div class="product-data-import-item">
								<label for="<?php echo $selectable['name'] ?>"><?php echo $selectable['label'] ?></label>
								<select id="<?php echo $selectable['name'] ?>" name="<?php echo $selectable['name'] ?>">
									<?php if ( isset( $data[ $selectable['label'] ] ) && ! empty( $data[ $selectable['label'] ] ) ) { ?>
										<option
										value="<?php echo $data[ $selectable['label'] ] ?>"><?php echo $data[ $selectable['label'] ] ?></option><?php } else {
										$meta = get_post_meta( $post_id, $selectable['name'], true );
										if ( is_array( $meta ) ) $meta = '';
										?>
										<option value="<?php echo $meta ?>"><?php echo $meta; ?></option>
									<?php } ?>
									<option value=""></option>
									<?php
									foreach ( $data as $key => $value ) {
										?>
										<option value="<?php echo $value; ?>"><?php echo $key . " - " . $value; ?></option>
										<?php
									}
									?>
								</select>
							</div>
							<?php
						}
					}
					?> </div></div><?php
				}
			?>
			<div class="clear"></div>
			<div class="at-product-data-form-end-button">
				<button type="button" class="at-update-product-data button button-primary" form-id="at_product_data_import_form"><?php _e( 'Speichern', 'affiliatetheme-backend' ) ?></button>
				<span class="spinner"></span>
				<input type="hidden" name="action" value="at_save_product_data"/>
				<input type="hidden" name="post_id" value="<?php echo $post_id ?>"/>
			</div>
		</form>
		<div class="import-product-data-result"></div>
		<?php
		exit();
	}
}


if ( ! function_exists( 'at_product_data_generate_fields' ) ) {
	add_action( 'wp_ajax_at_product_data_generate_fields', 'at_product_data_generate_fields' );
	function at_product_data_generate_fields()
	{
		$returndata = array();
		$url        = esc_url_raw( $_POST['url'] );
		if ( preg_match( '/^https:\/\/icecat\./', $url ) && preg_match( '/\/p\//', $url ) ) {
			$data = at_get_icecat_product_sheet( $url );
		} else {
			$returndata['error'] = '<div class="alert alert-warning">' . __( 'Der eingegebene Text/Link ist keine gültige icecat Produkt URL.', 'affiliatetheme-backend' ) . '</div>';
			echo json_encode( $returndata );
			exit();
		}

		$new_group  = array(
			"key"                   => 'group_' . at_getRandomHex( 7 ),
			"title"                 => sprintf( __( "Produktdaten - Automatic - %s", 'affiliatetheme-backend' ), rand( 0, 1000000 ) ),
			"fields"                => array(),
			"location"              => array(
				array(
					array(
						"param"    => "post_type",
						"operator" => "==",
						"value"    => "product",
					),
					array(
						"param"    => "product_view",
						"operator" => "==",
						"value"    => "productdata",
					),
				)
			),
			"menu_order"            => 0,
			"position"              => "normal",
			"style"                 => "default",
			"label_placement"       => "top",
			"instruction_placement" => "label",
			"hide_on_screen"        => "",
			"active"                => 1,
			"description"           => "",
		);
		$random_end = at_getRandomHex( 2 );
		foreach ( $data as $key => $value ) {
			$new_group["fields"][] = array(
				"key"               => 'field_' . at_getRandomHex( 7 ),
				"label"             => $key,
				"name"              => sanitize_title( $key ) . "_" . $random_end,
				"type"              => "text",
				"instructions"      => "",
				"required"          => 0,
				"conditional_logic" => 0,
				"default_value"     => "",
				"placeholder"       => "",
				"prepend"           => "",
				"append"            => "",
				"maxlength"         => "",
			);
		}
		$uploaddir = wp_upload_dir();
		$path      = $uploaddir['basedir'] . '/acf-json/' . $new_group['key'] . '.json';
		$dirname   = dirname( $path );
		if ( ! is_dir( $dirname ) ) {
			mkdir( $dirname, 0755, true );
		}
		$filepointer = fopen( $path, 'w' );
		if ( ! $filepointer ) {
			$returndata['error'] = '<div class="alert alert-danger">' . __( 'Datei konnte nicht erstellt werden.', 'affiliatetheme-backend' ) . '</div>';
		} else {
			fwrite( $filepointer, json_encode( $new_group ) );
			fclose( $filepointer );

			$returndata['success'] = '<div class="alert alert-success">' . __( 'Felder erfolgreich generiert.', 'affiliatetheme-backend' ) . '</div>';
		}
		echo json_encode( $returndata );
		exit();
	}
}


if ( ! function_exists( 'at_get_idealo_product_sheet' ) ) {
	function at_get_idealo_product_sheet( $url )
	{
		$doc = new DOMDocument();
		$url = stripslashes( $url );
		$doc->loadHTML( $url );
		$datasheet = $doc->getElementById( "Datenblatt" );
		if ( $datasheet != null && $datasheet->hasChildNodes() ) {
			$datalist = $datasheet->getElementsByTagName( "li" );
			foreach ( $datalist as $item ) {
				if ( $item->childNodes->length > 1 ) {
					foreach ( $item->childNodes as $node ) {
						$isKey = false;
						foreach ( $node->attributes as $attribute ) {
							if ( $attribute->name == "class" && preg_match( "/listItemKey/", $attribute->value ) ) {
								$isKey = true;
							}
						}
						if ( $isKey ) {
							$returndata[ trim( $node->textContent ) ] = trim( $node->nextSibling->nextSibling->textContent );
						}
					}
				}
			}
		}

		return $returndata;
	}
}

if ( ! function_exists( 'at_get_billiger_product_sheet' ) ) {
	function at_get_billiger_product_sheet( $url )
	{
		$returndata = array();
		$options    = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "spider", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false,    // don't verify ssl
		);

		$ch = curl_init( $url );
		curl_setopt_array( $ch, $options );
		$data = curl_exec( $ch );
		curl_close( $ch );
		$doc = new DOMDocument();
		$doc->loadHTML( $data );
		$datasheet = $doc->getElementById( "product-information" );
		$datasheet = $datasheet->childNodes->item( 1 );
		$datasheet = $datasheet->childNodes->item( 3 );
		if ( $datasheet != null && $datasheet->hasChildNodes() ) {
			$datalist = $datasheet->getElementsByTagName( "div" );
			foreach ( $datalist as $listitem ) {
				if ( $listitem->hasChildNodes() ) {
					foreach ( $listitem->childNodes as $group ) {
						if ( $group->hasChildNodes() ) {
							$isKeyValuePairs = false;
							foreach ( $group->attributes as $attribute ) {
								if ( $attribute->name == "class" && preg_match( "/key-value-pairs/", $attribute->value ) ) {
									$isKeyValuePairs = true;
								}
							}
							if ( $isKeyValuePairs ) {
								foreach ( $group->childNodes as $keyorvalue ) {
									if ( $keyorvalue->textContent != null && trim( $keyorvalue->textContent ) != "" ) {
										$isValue = false;
										foreach ( $keyorvalue->attributes as $attribute ) {
											if ( $attribute->name == "class" && preg_match( "/key/", $attribute->value ) ) {
												$key = trim( $keyorvalue->textContent );
												if ( preg_match( "/hover-tooltip/", $attribute->value ) ) $key = trim( $keyorvalue->getElementsByTagName( "span" )->item( 0 )->textContent );
											}
											if ( $attribute->name == "class" && preg_match( "/value/", $attribute->value ) ) {
												$isValue = true;
											}
										}
										if ( $isValue ) {
											$returndata[ $key ] = trim( $keyorvalue->textContent );
											$key                = '';
										}
									}
								}
							}
						}
					}
				}
			}
		}

		return $returndata;
	}
}

if ( ! function_exists( 'at_get_preisde_product_sheet' ) ) {
	function at_get_preisde_product_sheet( $url )
	{
		$returndata = array();
		$options    = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "spider", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false,    // don't verify ssl
		);

		$ch = curl_init( $url );
		curl_setopt_array( $ch, $options );
		$data = curl_exec( $ch );
		curl_close( $ch );
		$doc = new DOMDocument();
		$doc->loadHTML( $data );
		$xpath      = new DOMXpath( $doc );
		$datasheet  = $xpath->query( '//div[contains(@class, "info-table")]' );
		$datasheet  = $datasheet->item( 0 );
		$makersheet = $datasheet->getElementsByTagName( "span" );
		foreach ( $makersheet as $makernode ) {
			if ( preg_match( '/Marke:/', $makernode->textContent ) ) {
				$returndata["Marke"] = trim( substr( $makernode->textContent, 6 ) );
			}
		}
		$attributesheet = $xpath->query( '//div[contains(@class, "attribute-item")]' );
		foreach ( $attributesheet as $attributeitem ) {
			$divs                 = $attributeitem->getElementsByTagName( "div" );
			$label                = trim( $divs->item( 0 )->textContent );
			$value                = trim( $divs->item( 1 )->childNodes->item( 1 )->textContent );
			$returndata[ $label ] = $value;
		}

		return $returndata;
	}
}

if ( ! function_exists( 'at_get_icecat_product_sheet' ) ) {
	function at_get_icecat_product_sheet( $url )
	{
		$returndata = array();
		$url        = preg_replace( "/^https.\/\//", "", $url );

		// lang
		if ( strpos( $url, 'icecat.de' ) !== false ) {
			$lang = 'de';
		} elseif ( strpos( $url, 'icecat.nl' ) !== false ) {
			$lang = 'nl';
		} elseif ( strpos( $url, 'icecat.es' ) !== false ) {
			$lang = 'es';
		} elseif ( strpos( $url, 'icecat.co.uk' ) !== false ) {
			$lang = 'en';
		} elseif ( strpos( $url, 'icecat.us' ) !== false ) {
			$lang = 'en';
		} elseif ( strpos( $url, 'icecat.be' ) !== false ) {
			$lang = 'be';
		} elseif ( strpos( $url, 'icecat.ua' ) !== false ) {
			$lang = 'ua';
		} elseif ( strpos( $url, 'icecat.at' ) !== false ) {
			$lang = 'de';
		} elseif ( strpos( $url, 'icecat.ch' ) !== false ) {
			$lang = 'de';
		} elseif ( strpos( $url, 'icecat.it' ) !== false ) {
			$lang = 'it';
		} else {
			$lang = 'en';
		}

		// id
		if ( preg_match_all( '/\d+/', $url, $numbers ) ) $id = end( $numbers[0] );

		$api = "https://live.icecat.biz/api/?shopname=openIcecat-live&lang=$lang&content=&icecat_id=$id";

		$options = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "spider", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false,    // don't verify ssl
		);

		$ch = curl_init( $api );
		curl_setopt_array( $ch, $options );
		$data = curl_exec( $ch );
		curl_close( $ch );
		$productdata = json_decode( $data );
		if ( $productdata->statusCode == 9 ) {
			echo $productdata->message;
			die();
		}
		foreach ( $productdata->data->GeneralInfo as $key => $value ) {
			if ( is_object( $value ) ) {
				foreach ( $value as $ke => $val ) {
					if ( is_object( $val ) ) {
						foreach ( $val as $k => $v ) {
							if ( ! is_object( $v ) && ! is_array( $v ) ) $returndata[ $k ] = $v;
						}
					} elseif ( is_array( $val ) ) {
					} else {
						$returndata[ $ke ] = $val;
					}
				}
			} elseif ( is_array( $value ) ) {
			} else {
				$returndata[ $key ] = $value;
			}
		}
		foreach ( $productdata->data->FeaturesGroups as $featuresGroup ) {
			foreach ( $featuresGroup->Features as $feature ) {
				$returndata[ $feature->Feature->Name->Value ] = $feature->PresentationValue;
			}
		}
		unset( $returndata["LongDesc"] );

		return $returndata;
	}
}

if ( ! function_exists( 'at_save_product_data' ) ) {
	add_action( 'wp_ajax_at_save_product_data', 'at_save_product_data' );
	function at_save_product_data()
	{
		$returndata = array();
		$post_id    = $_POST['post_id'];
		$selector   = new acf_field_field_selector();
		$fields     = $selector->get_selectable_item_fields( null, true );
		$selectable = $selector->get_items( "", $fields );
		foreach ( $selectable as $field ) {
			// catch true_false
			if ( $field['type'] == 'true_false' && isset( $_POST[ $field['name'] ] ) ) {
				$_POST[ $field['name'] ] = at_productdata_check_true_false( $_POST[ $field['name'] ] );
			}

			update_post_meta( $post_id, $field['name'], $_POST[ $field['name'] ] );
		}
		$returndata['success'] = '<div class="alert alert-success">' . __( "Die Produktdaten wurden erfolgreich importiert. Bitte schließe das Fenster, das Produkt wird gespeichert und die Seite lädt automatisch neu.", 'affiliatetheme-backend' ) . '</div>';
		echo json_encode( $returndata );
		exit();
	}
}

if ( ! function_exists( 'at_getRandomHex' ) ) {
	function at_getRandomHex( $num_bytes = 4 )
	{
		return bin2hex( openssl_random_pseudo_bytes( $num_bytes ) );
	}
}

/**
 * Function that will update ACF fields via JSON file update
 */
add_action( 'admin_init', 'at_productdata_sync_acf_fields' );
function at_productdata_sync_acf_fields()
{
	// vars
	$groups = acf_get_field_groups();
	$sync   = array();

	// bail early if no field groups
	if ( empty( $groups ) )
		return;

	// find JSON field groups which have not yet been imported
	foreach ( $groups as $group ) {
		// vars
		$local    = acf_maybe_get( $group, 'local', false );
		$modified = acf_maybe_get( $group, 'modified', 0 );
		$private  = acf_maybe_get( $group, 'private', false );

		// ignore DB / PHP / private field groups
		if ( $local !== 'json' || $private ) {
			// do nothing

		} elseif ( ! $group['ID'] ) {
			$sync[ $group['key'] ] = $group;

		} elseif ( $modified && $modified > get_post_modified_time( 'U', true, $group['ID'], true ) ) {
			$sync[ $group['key'] ] = $group;
		}
	}

	// bail if no sync needed
	if ( empty( $sync ) )
		return;

	if ( ! empty( $sync ) ) { //if( ! empty( $keys ) ) {

		// vars
		$new_ids = array();

		foreach ( $sync as $key => $v ) { //foreach( $keys as $key ) {

			// append fields
			if ( acf_have_local_fields( $key ) ) {
				$sync[ $key ]['fields'] = acf_get_local_fields( $key );

			}
			// import
			$field_group = acf_import_field_group( $sync[ $key ] );
		}
	}
}

function at_productdata_check_true_false( $value )
{
	switch ( $value ) {
		case 'Si':
			$value = 1;
			break;

		case 'No':
			$value = 0;
			break;

		case 'Yes':
			$value = 1;
			break;

		case 'Ja':
			$value = 1;
			break;

		case 'Nein':
			$value = 0;
			break;
	}

	return apply_filters( 'at_productdata_check_true_false', $value );
}
