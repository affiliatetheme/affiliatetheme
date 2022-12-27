<?php
/**
 * Affiliate Theme Shortcode Generator
 *
 * @author		Christian Lang
 * @version		1.0
 * @category	tinymce
 */

add_action('admin_head', 'at_shortcodes_generator_add_button');
function at_shortcodes_generator_add_button() {
	if (!current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
		return;
	}

	if (get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "at_shortcodes_generator_tinymce_plugin");
		add_filter('mce_buttons', 'at_shortcodes_generator_register_button');
	}
}
function at_shortcodes_generator_tinymce_plugin($plugin_array) {
	$plugin_array['at_shortcodes_generator_button'] = esc_url(get_template_directory_uri()) . '/library/plugins/tinymce/shortcodes.js';
	return $plugin_array;
}
function at_shortcodes_generator_register_button($buttons) {
	array_push($buttons, "at_shortcodes_generator_button");
	return $buttons;
}

add_filter('admin_enqueue_scripts', 'at_shortcodes_generator_scripts');
function at_shortcodes_generator_scripts() {
    wp_register_script('at-shortcodes-multiselect', get_template_directory_uri() . '/library/plugins/tinymce/_/js/ui.multiselect.js', 'jquery-ui-widegt', '1.0', true);
    wp_enqueue_style('at-shortcodes-jquery-ui', get_template_directory_uri() . '/library/plugins/tinymce/_/css/jquery.ui.min.css');

    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-widget');
    wp_enqueue_script('at-shortcodes-multiselect');
}

/*
 * AJAX Requests
 */
add_action( 'wp_ajax_at_get_filter_products', 'at_get_filter_products' );
function at_get_filter_products() {
    $args = array(
        'post_type'         => 'product',
        'posts_per_page'    => 500,
    );
    $products = get_posts($args);
    if($products) {
        foreach($products as $product) {
            echo '<option value="'.$product->ID.'">'.$product->post_title.'</option>';
        }
    }
    exit();
}

add_action( 'wp_ajax_at_get_products_multiselect_tax', 'at_get_products_multiselect_tax' );
function at_get_products_multiselect_tax() {
    $taxonomy_names = get_object_taxonomies( 'product' );

    foreach($taxonomy_names as $tax) {
        if(!is_wp_error($terms = get_terms($tax, 'hide_empty=0'))) {
            $taxonomy = get_taxonomy($tax);
            echo '
			<tr>
				<th><label>' . $taxonomy->labels->name . '</label></th>
				<td>
					<select fieldname="' . $taxonomy->name . '" multiple>';
            foreach($terms as $term) {
                echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
            }
            echo '</select>
				</td>
			</tr>
			';
        }
    }
    exit();
}

add_action( 'wp_ajax_at_get_posts_multiselect_tax', 'at_get_posts_multiselect_tax' );
function at_get_posts_multiselect_tax() {
    $taxonomy_names = get_object_taxonomies( 'post' );

    foreach($taxonomy_names as $tax) {
        if($tax == 'post_format')
            continue;

        if(!is_wp_error($terms = get_terms($tax, 'hide_empty=0'))) {
            $taxonomy = get_taxonomy($tax);
            if($tax == 'category') {
                $fieldname = $taxonomy->name . '_name';
            } else if($tax == 'post_tag') {
                $fieldname = 'tag';
            } else {
                $fieldname = $taxonomy->name;
            }
            echo '
			<tr>
				<th><label>' . $taxonomy->labels->name . '</label></th>
				<td>
					<select fieldname="' . $fieldname . '" multiple>';
            foreach($terms as $term) {
                echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
            }
            echo '</select>
				</td>
			</tr>
			';
        }
    }
    exit();
}
?>