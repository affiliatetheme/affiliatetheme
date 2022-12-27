<?php
/**
 * Load ACF Fields
 *
 * @author		Christian Lang
 * @version		1.0
 * @category	_load
 */

if ( ! function_exists( 'at_get_current_post_types' ) ) {
    /**
     * at_get_current_post_types function.
     *
     * @return string
     */
    function at_get_current_post_types() {
        $post_types = array(
            'post' => __('Beiträge', 'affiliatetheme-backend'),
            'page' => __('Seiten', 'affiliatetheme-backend'),
            'product' => __('Produkte', 'affiliatetheme-backend'),
            'shop' => __('Shops', 'affiliatetheme-backend')
        );

        return apply_filters('at_search_post_types', $post_types);
    }
}

add_action('after_setup_theme', 'at_load_exported_fields', 100);
function at_load_exported_fields(){
	require_once(ENDCORE_PLUGINS . '/acf/fields/options_general.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/options_blog.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/options_design.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/options_product.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/options_shop.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/options_dsgvo.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/slider.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/page_builder.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/page.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/shop.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/product.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/product_compare.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/taxonomy.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/widget_filter.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/widget_product_filter.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/widget_product_advice.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/widget_product_select.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/filter.php');
	require_once(ENDCORE_PLUGINS . '/acf/fields/filter_design.php');
}

function at_get_core_fields() {
	$groups = array(
		'group_554b94039138a', 
		'group_56d70e8a55693', 
		'group_558c1d86807b0', 
		'group_555b2395904ef', 
		'group_5559aa9c154f9',
		'group_555af959627b0', 
		'group_5555f16e6add6', 
		'group_5559aa9c154f9', 
		'group_552a53b6bcc37', 
		'group_552bd329a6457', 
		'group_552bdb878e1a9', 
		'group_553b6f6e9891b', 
		'group_5582afd4210dc',
		'group_58b84eddd1c88',
		'group_58b8b2b63c1e2',
		'group_58b96dc77e339',
		'group_5af14e955e06c'
	);
	
	return apply_filters('at_core_fields', $groups);
}

