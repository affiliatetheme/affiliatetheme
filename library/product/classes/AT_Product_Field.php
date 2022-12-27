<?php
class AT_Product_Field {
    function __construct($field, $post_id) {
        $this->field = $field;
        $this->post_id = $post_id;

        if(is_array($this->field) && $this->post_id) {
            $this->db_value = get_field($this->field['name'], $this->post_id);
        }
    }

    function render() {
        switch($this->get_type()) {
            case 'text':
                $this->render_text();
                break;

            case 'true_false':
                $this->render_true_false();
                break;

            case 'select':
                $this->render_select();
                break;

            case 'checkbox':
                $this->render_checkbox();
                break;

            case 'radio':
                $this->render_radio();
                break;

            case 'url':
                $this->render_url();
                break;

            case 'image':
                $this->render_image();
                break;

            case 'gallery':
                $this->render_gallery();
                break;

            case 'file':
                $this->render_file();
                break;

            case 'post_object':
                $this->render_post_object();
                break;

            case 'page_link':
                $this->render_page_link();
                break;

            case 'relationship':
                $this->render_relationship();
                break;

            case 'taxonomy':
                $this->render_taxonomy();
                break;

            case 'user':
                $this->render_user();
                break;

            case 'color_picker':
                $this->render_color_picker();
                break;

            default:
                $this->render_text();
                break;
        }

        return $this->field;
    }

    function get_type() {
        if(!$this->field) {
            return;
        }

        return $this->field['type'];
    }

    function render_text() {
        if($this->db_value) {
            if(isset($this->field['prepend'])) $this->db_value = $this->field['prepend'] . $this->db_value;
            if(isset($this->field['append'])) $this->db_value .= $this->field['append'];
        }

        $this->field['value']  = $this->db_value;
    }

    function render_true_false() {
        $true = get_field('product_misc_truefalse_true', 'option');
        $false = get_field('product_misc_truefalse_false', 'option');

        if($this->db_value) {
            $this->db_value = apply_filters('at_product_fields_true_value', $true, $this->post_id);
        } else {
            $this->db_value = apply_filters('at_product_fields_false_value', $false, $this->post_id);
        }

        $this->field['value']  = $this->db_value;
    }

    function render_select() {
        if($this->db_value) {
            if(is_array($this->db_value)) {
                $arr = array();
                foreach($this->db_value as $k => $v) {
                    $arr[] = (isset($this->field['choices'][$v]) ? $this->field['choices'][$v] : $v);
                }

                if($arr) {
                    $this->db_value = implode(', ', $arr);
                }
            } else {
                $this->db_value = (isset($this->field['choices'][$this->db_value]) ? $this->field['choices'][$this->db_value] : $this->db_value);
            }
        }

        $this->field['value'] = $this->db_value;
    }

    function render_checkbox() {
        $arr = array();

        if(!is_array($this->db_value)) {
            $this->db_value = array($this->db_value);
        }

        foreach($this->db_value as $k => $v) {
            $arr[] = (isset($this->field['choices'][$v]) ? $this->field['choices'][$v] : $v);
        }

        $this->field['value'] = (!empty($arr) ? implode(', ', $arr) : $this->db_value);
    }

    function render_radio() {
        $arr = array();

        if(!is_array($this->db_value)) {
            $this->db_value = array($this->db_value);
        }

        foreach($this->db_value as $k => $v) {
            $arr[] = (isset($this->field['choices'][$v]) ? $this->field['choices'][$v] : $v);
        }

        $this->field['value'] = (!empty($arr) ? implode(', ', $arr) : $this->db_value);
    }

    function render_url() {
        if($this->db_value) {
            $this->db_value = '<a href="' . $this->db_value . '" target="_blank" rel="nofollow">' . $this->db_value . '</a>';
        }

        $this->field['value'] = $this->db_value;
    }

    function render_image() {
        if(is_array($this->db_value)) {
            if(isset($this->db_value['url'])) {
                $this->db_value = '<img src="' . $this->db_value['url'] . '" width="' . $this->db_value['width'] . '" height="' . $this->db_value['height'] . '" alt="' . $this->db_value['alt'] . '" class="img-responsive" />';
            }
        }

        $this->field['value'] = $this->db_value;
    }

    function render_gallery() {
        $ids = array();

        if(is_array($this->db_value)) {
            foreach($this->db_value as $image) {
                $ids[] = $image['ID'];
            }
        }

        $this->field['value'] = (!empty($ids) ? do_shortcode('[gallery ids="'.implode(',',$ids).'" link="file"]') : $this->db_value);
    }

    function render_file() {
        if (is_array($this->db_value)) {
            if(isset($this->db_value['url'])) {
                $this->db_value = '<a href="' . $this->db_value['url'] . '" target="_blank">' . $this->db_value['title'] . '</a>';
            }
        }

        $this->field['value'] = $this->db_value;
    }

    function render_post_object() {
        $id = $this->db_value;

        if(is_object($this->db_value)) {
            $id = $this->db_value->ID;
        }

        $this->db_value = '<a href="' . get_permalink($id) . '" title="' . get_the_title($id) . '">' . get_the_title($id) . '</a>';

        $this->field['value'] = $this->db_value;
    }

    function render_page_link() {
        if($this->db_value) {
            $this->db_value = '<a href="' . $this->db_value . '" title="' . $this->db_value . '">' . $this->db_value . '</a>';
        }

        $this->field['value'] = $this->db_value;
    }

    function render_relationship() {
        $items = array();

        if(is_array($this->db_value)) {
            foreach($this->db_value as $item) {
                $id = (is_object($item) ? $item->ID : $item);
                $items[] = '<a href="' . get_permalink($id) . '" title="' . get_the_title($id) . '">' . get_the_title($id) . '</a>';
            }
        }

        $this->field['value'] = (!empty($items) ? implode(', ', $items) : $this->db_value);
    }

    function render_taxonomy() {
        $tax = $this->field['taxonomy'];
        $items = array();

        if($this->db_value) {
            if(is_array($this->db_value)) {
                foreach ($this->db_value as $term) {
                    $term_obj = get_term_by('id', $term, $tax);

                    if($term_obj) {
                        $term_link = get_term_link($term_obj, $tax);
                        $items[] = '<a href="' . $term_link . '" title="' . $term_obj->name . '">' . $term_obj->name . '</a>';
                    }
                }
            } else {
                $term_obj = get_term_by('id', $this->db_value, $tax);

                if($term_obj) {
                    $term_link = get_term_link($term_obj, $tax);
                    $items[] = '<a href="' . $term_link . '" title="' . $term_obj->name . '">' . $term_obj->name . '</a>';
                }
            }
        }

        $this->field['value'] = (!empty($items) ? implode(', ', $items) : $this->db_value);
    }

    function render_user() {
        if(is_array($this->db_value)) {
            $this->db_value = '<a href="' . get_author_posts_url($this->db_value['ID']) . '" title="' . $this->db_value['display_name'] . '">' . $this->db_value['display_name'] . '</a>';
        }

        $this->field['value'] = (!empty($items) ? implode(', ', $items) : $this->db_value);
    }

    function render_color_picker() {
        if($this->db_value) {
            $this->db_value = '<span class="color_picker-holder" style="background:' . $this->db_value . '"></span> <span class="color_picker-text">' . $this->db_value . '</span>';
        }

        $this->field['value'] = $this->db_value;
    }

    function is_empty() {
		if($this->get_type() == 'true_false') {
			return false;
		}
		
        if(!$this->db_value) {
            return true;
        }

        return false;
    }
}