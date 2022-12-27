<?php
class AT_Product {
    var $post_id = "";

    function __construct($post_id) {
        $this->post_id = $post_id;
    }

    function getTitle() {
        return apply_filters('at_product_title', get_the_title($this->post_id), $this->post_id);
    }

    function getDescription() {
        return apply_filters('the_content', get_post_field('post_content', $this->post_id));
    }

    function getThumbnail($size = 'product_grid', $args = array()) {
        return at_post_thumbnail($this->post_id, $size, $args);
    }
    
    function getEAN() {
        return apply_filters('at_product_ean', get_field('product_ean', $this->post_id));
    }
}