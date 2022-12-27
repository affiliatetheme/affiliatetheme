<?php
/**
 * ACF Functions
 *
 * @author        Christian Lang
 * @version        1.1
 * @category    acf
 * @updated        03.02.2017
 */

define( 'ACF_LITE', false );

/**
 * Load ACF Plugins
 */
require_once( ENDCORE_PLUGINS . '/acf/field-type-autocomplete/acf-field-type-autocomplete.php' );
require_once( ENDCORE_PLUGINS . '/acf/field-type-code/acf-code_area.php' );
require_once( ENDCORE_PLUGINS . '/acf/field-type-selector/acf-field_selector.php' );
require_once( ENDCORE_PLUGINS . '/acf/field-type-taxonomies/acf-advanced_taxonomy_selector.php' );

/**
 * Setting-Pages
 * @ref: https://www.advancedcustomfields.com/resources/acf_add_options_page/
 */
add_action( 'init', 'at_add_options_pages' );
function at_add_options_pages() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		// Optionen
		acf_add_options_page(
			array(
				'page_title' => __( 'Optionen', 'affiliatetheme-backend' ),
				'menu_slug'  => 'acf-options-optionen',
				'menu_title' => __( 'Optionen', 'affiliatetheme-backend' ),
				'icon_url'   => 'dashicons-heart',
				'capability' => apply_filters( 'at_options_page_capability', 'manage_options' )
			)
		);

		// Optionen > Allgemein
		acf_add_options_sub_page(
			array(
				'title'      => __( 'Allgemein', 'affiliatetheme-backend' ),
				'menu_slug'  => 'acf-options-allgemein',
				'parent'     => 'acf-options-optionen',
				'capability' => apply_filters( 'at_options_page_capability', 'manage_options' )
			)
		);

		// Optionen > Design
		acf_add_options_sub_page(
			array(
				'title'      => __( 'Design', 'affiliatetheme-backend' ),
				'menu_slug'  => 'acf-options-design',
				'parent'     => 'acf-options-optionen',
				'capability' => apply_filters( 'at_options_page_capability', 'manage_options' )
			)
		);

		// Optionen > Blog
		acf_add_options_sub_page(
			array(
				'title'      => __( 'Blog', 'affiliatetheme-backend' ),
				'menu_slug'  => 'acf-options-blog',
				'parent'     => 'acf-options-optionen',
				'capability' => apply_filters( 'at_options_page_capability', 'manage_options' )
			)
		);

		// Optionen > Produkte
		acf_add_options_sub_page(
			array(
				'title'      => __( 'Produkte', 'affiliatetheme-backend' ),
				'menu_slug'  => 'acf-options-produkte',
				'parent'     => 'acf-options-optionen',
				'capability' => apply_filters( 'at_options_page_capability', 'manage_options' )
			)
		);

		// Optionen > Shops
		acf_add_options_sub_page(
			array(
				'title'      => __( 'Shops', 'affiliatetheme-backend' ),
				'menu_slug'  => 'acf-options-shops',
				'parent'     => 'acf-options-optionen',
				'capability' => apply_filters( 'at_options_page_capability', 'manage_options' )
			)
		);

		// Optionen > DSGVO
		acf_add_options_sub_page(
			array(
				'title'      => __( 'DSGVO', 'affiliatetheme-backend' ),
				'menu_slug'  => 'acf-options-dsgvo',
				'parent'     => 'acf-options-optionen',
				'capability' => apply_filters( 'at_options_page_capability', 'manage_options' )
			)
		);
	}
}

/**
 * Validate Slug fields
 */
add_filter( 'acf/update_value/key=field_553b81bf3f635', 'at_validate_slug', 10, 3 ); // product_cloak_slug
add_filter( 'acf/update_value/key=field_553b80684230d', 'at_validate_slug', 10, 3 ); // product_slug
add_filter( 'acf/update_value/key=field_553b70f1c4325', 'at_validate_slug', 10, 3 ); // taxonomy_slug
add_filter( 'acf/update_value/key=field_553b70f1c4172d33', 'at_validate_slug', 10, 3 ); // taxonomy_slug
function at_validate_slug( $value, $post_id, $field ) {
	if ( $value ) {
		$value = sanitize_title( $value );
	}

	return $value;
}

if ( ! function_exists( 'getMinMaxValue' ) ) {
	/**
	 * getMinMaxValue function.
	 *
	 * @param string $key
	 * @param string $posttype
	 *
	 * @return object
	 * @deprecated since 1.4.0
	 *
	 */
	function getMinMaxValue( $key, $posttype ) {
		global $wpdb;

		if ( 'price' == $key ) {
			$values = $wpdb->get_results( "
            SELECT MAX(CAST(pm.meta_value as UNSIGNED)) AS max, MIN(CAST(pm.meta_value as UNSIGNED)) AS min FROM {$wpdb->postmeta} pm
            LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
            WHERE pm.meta_key LIKE 'product_shops_%_price'
            AND p.post_type = '{$posttype}'
            AND p.post_status = 'publish'
            "
			);
		} else {
			$values = $wpdb->get_results( "
            SELECT MAX(CAST(ROUND(pm.meta_value) as UNSIGNED)) AS max, MIN(CAST(ROUND(pm.meta_value) as UNSIGNED)) AS min FROM {$wpdb->postmeta} pm
            LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
            WHERE pm.meta_key = '{$key}'
            AND p.post_type = '{$posttype}'
            AND p.post_status = 'publish'
            "
			);
		}

		return apply_filters( 'at_set_min_max_value', $values, $key, $posttype );
	}
}

if ( ! function_exists( 'at_field_database_min_max_value' ) ) {
	/**
	 * at_field_database_min_max_value function.
	 *
	 * @param string $name
	 * @param string $posttype
	 *
	 * @return object
	 */
	function at_field_database_min_max_value( $name, $posttype ) {
		global $wpdb;

		if ( 'price' == $name ) {
			$values = $wpdb->get_row( "
            SELECT MIN(CAST(pm.meta_value as UNSIGNED)) AS min, MAX(CEIL(pm.meta_value)) AS max FROM {$wpdb->postmeta} pm
            LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
            WHERE pm.meta_key LIKE 'product_shops_%_price'
            AND p.post_type = '{$posttype}'
            AND p.post_status = 'publish'
            "
			);
		} else {
			$values = $wpdb->get_row( "
            SELECT MIN(CAST(pm.meta_value as UNSIGNED)) AS min, MAX(ROUND(pm.meta_value)) AS max FROM {$wpdb->postmeta} pm
            LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
            WHERE pm.meta_key = '{$name}'
            AND p.post_type = '{$posttype}'
            AND p.post_status = 'publish'
            "
			);
		}

		// fix empty fields
		if ( ! $values->min ) {
			$values->min = '0';
		}

		if ( ! $values->max ) {
			$values->max = '0';
		}

		return apply_filters( 'at_set_min_max_value', $values, $name, $posttype );
	}
}

if ( ! function_exists( 'at_field_min_max_value' ) ) {
	/**
	 * at_field_min_max_value function.
	 *
	 * @param string $key
	 *
	 * @return array
	 */
	function at_field_min_max_value( $key, $name, $posttype = 'product' ) {
		$field = get_field_object( $key );
		$min   = '';
		$max   = '';

		if ( $field ) {
			if ( $field['min'] !== '' ) {
				$min = $field['min'];
			}

			if ( $field['max'] !== '' ) {
				$max = $field['max'];
			}
		}

		if ( $min === '' || $max === '' ) {
			$db_values = at_field_database_min_max_value( $name, $posttype );

			if ( $db_values ) {
				if ( $min === '' ) {
					$min = $db_values->min;
				}

				if ( $max === '' ) {
					$max = $db_values->max;
				}
			} else {
				$min = '0';
				$max = '100';
			}
		}

		$values = array( 'min' => $min, 'max' => $max );

		return (object) $values;
	}
}

if ( ! function_exists( 'getNumberFieldSteps' ) ) {
	/**
	 * getNumberFieldSteps function.
	 *
	 * @param float $min
	 * @param float $max
	 * @param string $field
	 *
	 * @return float
	 * @deprecated since 1.4.0
	 *
	 */
	function getNumberFieldSteps( $min, $max, $field = '' ) {
		$diff = abs( $max - $min );

		$value = '1';

		if ( $diff <= 1 ) {
			$value = '0.01';
		}

		if ( $diff >= 1 && $diff <= 5 ) {
			$value = '0.1';
		}

		if ( $diff > 5 && $diff <= 25 ) {
			$value = '0.5';
		}

		if ( $diff > 25 && $diff <= 50 ) {
			$value = '1';
		}

		if ( $diff > 50 && $diff <= 200 ) {
			$value = '5';
		}

		if ( $diff > 200 ) {
			$value = '10';
		}

		return apply_filters( 'at_set_step_value', $value, $min, $max, $field );
	}
}

if ( ! function_exists( 'at_field_step_value' ) ) {
	/**
	 * at_field_step_value function.
	 *
	 * @param float $min
	 * @param float $max
	 * @param string $field
	 *
	 * @return float
	 */
	function at_field_step_value( $min, $max, $key, $name = '' ) {
		$field = get_field_object( $key );
		$diff  = abs( $max - $min );
		$value = '1';

		if ( $name == 'product_rating' ) {
			return '0.5';
		}

		if ( $field ) {
			if ( $field['step'] ) {
				return $field['step'];
			}
		}

		if ( $diff <= 1 ) {
			$value = '0.01';
		}

		if ( $diff >= 1 && $diff <= 5 ) {
			$value = '0.1';
		}

		if ( $diff > 5 && $diff <= 25 ) {
			$value = '0.5';
		}

		if ( $diff > 25 && $diff <= 50 ) {
			$value = '1';
		}

		if ( $diff > 50 && $diff <= 200 ) {
			$value = '5';
		}

		if ( $diff > 200 ) {
			$value = '10';
		}

		return apply_filters( 'at_set_step_value', $value, $min, $max, $name );
	}
}

add_filter( 'acf/location/rule_types', 'acf_product_location_rules_types' );
function acf_product_location_rules_types( $choices ) {
	$choices['Produkte']['product_view'] = __( 'Ansicht', 'affiliatetheme-backend' );

	return $choices;
}

add_filter( 'acf/location/rule_values/product_view', 'acf_location_rules_values_product_view' );
function acf_location_rules_values_product_view( $choices ) {
	$choices['productdata'] = __( 'Tab: Produktdaten', 'affiliatetheme-backend' );
	$choices['detail']      = __( 'Eigenschaften', 'affiliatetheme-backend' );
	$choices['table']       = __( 'Tabelle', 'affiliatetheme-backend' );

	return $choices;
}

add_filter( 'acf/location/rule_match/product_view', 'acf_location_rules_match_product_view', 10, 3 );
function acf_location_rules_match_product_view( $match, $rule, $options ) {
	$current_user  = wp_get_current_user();
	$selected_user = (int) $rule['value'];

	return true;
}

/**
 * @TODO We need to remove this asap!
 *
 * @param $value
 * @param $post_id
 * @param $field
 *
 * @return array
 */
add_filter( 'acf/update_value/name=product_shops', 'acf_sort_shops_by_price', 10, 3 );
add_filter( 'acf/load_value/name=product_shops', 'acf_sort_shops_by_price', 10, 3 );
function acf_sort_shops_by_price( $value, $post_id, $field ) {
	if ( '1' == get_field( 'product_auto_sort_by_price', 'option' ) ) {
		return $value;
	}

	/*if(is_admin()) {
		return $value;
	}*/

	if ( is_array( $value ) && count( $value ) > 1 ) {
		usort( $value, 'sortByPrice' );
	}

	return $value;
}

add_filter( 'acf/load_field/key=field_57a0ba7a847a7', 'at_acf_set_currency' );
add_filter( 'acf/load_field/key=field_553b82b5246b6', 'at_acf_set_currency' );
function at_acf_set_currency( $field ) {
	$currency = at_get_currency();

	if ( $currency ) {
		$field['choices'] = $currency;
	}

	return $field;
}

add_filter( 'acf/load_field/key=field_553b82b5246b6', 'at_acf_set_default_currency' );
function at_acf_set_default_currency( $field ) {
	$product_default_currency = at_get_default_currency();

	if ( $product_default_currency ) {
		$field['default_value'] = $product_default_currency;
	}

	return $field;
}

/**
 * Calculate Reviews Summary on Save Product
 */
add_action( 'acf/save_post', 'at_product_caluclate_reviews_summary', 20 );
function at_product_caluclate_reviews_summary( $post_id ) {
	// bail early if no ACF data
	if ( empty( $_POST['acf'] ) ) {
		return;
	}

	if ( get_post_type( $post_id ) != 'product' ) {
		return;
	}

	$style   = get_field( 'field_5559ed60e152e', $post_id );
	$ratings = get_field( 'field_5559eda8e1531', $post_id );

	if ( empty( $ratings ) ) {
		update_post_meta( $post_id, 'reviews_summary', 0 );
	}

	$summary = at_product_review_calculate_summary( $post_id, $ratings, $style );
	if ( $summary ) {
		update_post_meta( $post_id, 'reviews_summary', $summary );
	}

	return;
}


/**
 * Add Meta Box to Option Panel
 */
add_action( 'acf/input/admin_head', 'at_register_support_metabox' );
function at_register_support_metabox() {
	if ( function_exists( 'add_meta_box' ) ) {
		add_meta_box( 'at_support_box', __( 'Wichtige Links & Support', 'affiliatetheme-backend' ), 'at_show_support_metabox', 'acf_options_page', 'side', 'low' );
	}
}

function at_show_support_metabox( $post ) {
	if ( at_locale_is( 'de_' ) ) {
		$url_root = 'https://affiliatetheme.io/';
	} else {
		$url_root = 'https://affiliatetheme.io/en/';
	}
	?>
    <img src="<?php echo get_template_directory_uri(); ?>/library/helper/images/at-support.png"/>

    <p>
		<?php _e( 'Du hast Fragen zur Installation, Konfiguration oder Anpassung des Themes?
		Dann wirf einen Blick auf die Folgenden Informationen:', 'affiliatetheme-backend' ); ?>
    </p>

    <p>
        <a href="<?php echo $url_root; ?>" target="_blank"><?php _e( 'Webseite', 'affiliatetheme-backend' ); ?></a><br>
        <a href="<?php echo $url_root; ?>dokumentation/" target="_blank"><?php _e( 'Dokumentation', 'affiliatetheme-backend' ); ?></a><br>
        <a href="https://www.youtube.com/channel/UCL24jbD3zwpI3Gv1TxMLf7w" target="_blank"><?php _e( 'Video Tutorials', 'affiliatetheme-backend' ); ?></a><br>
        <a href="<?php echo $url_root; ?>changelog/" target="_blank"><?php _e( 'Changelog', 'affiliatetheme-backend' ); ?></a>
    </p>

    <p>
		<?php printf( __( 'Copyright &copy; %s <a href="%s" target="_blank">affiliatetheme.io</a>', 'affiliatetheme-backend' ), date( 'Y' ), $url_root ); ?>
    </p>
	<?php
}

add_action( 'admin_footer', 'acf_custom_js' );
function acf_custom_js() {
	echo '
    <script type="text/javascript">
        jQuery(window).scroll(function() {
            var target = jQuery("body[class*=acf-options] #submitdiv");
            var target_width = jQuery(target).width();
            var scroll = jQuery(window).scrollTop();

            if (scroll >= 45) {
                target.addClass("acf-affix").width(target_width);
            } else {
                target.removeClass("acf-affix");
            }
        });
    </script>';
}

function at_get_hierarchical_dropdown( $args, $without_select = false ) {
	ob_start();
	wp_dropdown_categories( $args );
	$output = ob_get_contents();
	ob_end_clean();

	if ( $without_select ) {
		$output = preg_replace( "/<\\/?select(\\s+.*?>|>)/", "", $output );
	}

	$output = str_replace( 'value="', 'value="' . $args['taxonomy'] . '_', $output );

	return $output;
}

/**
 * Show wp custom fields
 */
add_filter( 'acf/settings/remove_wp_meta_box', '__return_false' );
?>