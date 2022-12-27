<?php
class AT_Product_Fields {
    function __construct($post_id, $pos = 'detail', $forced_groups = array()) {
        $this->post_id = $post_id;
        $this->pos = $pos;
        $this->forced_groups = $forced_groups;
        $this->field_groups = array();
    }

    function get() {
        if(empty($this->field_groups)) {
            $this->filter();
        }

        return $this->field_groups;
    }

    function filter() {
        $acf_field_groups = at_get_acf_field_groups(false, $this->forced_groups);

        if(!$acf_field_groups) {
            return;
        }

        if(empty($this->forced_groups)) {
            // filter groups and add to array
            foreach ($acf_field_groups as $acf_field_group) {
                // get visibility
                $visibility = acf_get_field_group_visibility($acf_field_group, array('post_id' => $this->post_id));

                if ($visibility) {
                    // filter by pos
                    if ($this->filter_by_pos($acf_field_group)) {
                        if(is_array(acf_get_fields($acf_field_group))) {
                            $this->field_groups = array_merge($this->field_groups, acf_get_fields($acf_field_group));
                        }
                    }
                }
            }
        } else {
            // add forced groups to array
            foreach ($acf_field_groups as $acf_field_group) {
                if(is_array(acf_get_fields($acf_field_group))) {
                    $this->field_groups = array_merge($this->field_groups, acf_get_fields($acf_field_group));
                }
            }
        }
    }

    private function filter_by_pos($acf_field_group) {
        if(!is_array($acf_field_group)) {
            return false;
        }

        $locations = $acf_field_group['location'];

        if(!is_array($locations)) {
            return false;
        }

        foreach($locations as $group_location) {
            $matches = array();

            $view_rule_pos = array_search('product_view', array_column($group_location, 'param'));

            if($view_rule_pos === false) {
                continue;
            }

            $view_rule = $group_location[$view_rule_pos];

            if ($view_rule['param'] == 'product_view' && $view_rule['operator'] == '==' && $view_rule['value'] == $this->pos) {
                foreach ($group_location as $location) {
                    // term
                    if ($location['param'] == 'post_taxonomy') {
                        $tax_term = explode(':', $location['value']);
                        if ($tax_term) {
                            if ($location['operator'] == '==') {
                                if (taxonomy_exists($tax_term[0])) {
                                    if (has_term($tax_term[1], $tax_term[0], $this->post_id)) {
                                        $matches[] = 'true';
                                    } else {
                                        $matches[] = 'false';
                                    }
                                } else {
                                    $matches[] = 'false';
                                }
                            }

                            if ($location['operator'] == '!=') {
                                if (taxonomy_exists($tax_term[0])) {
                                    if (has_term($tax_term[1], $tax_term[0], $this->post_id)) {
                                        $matches[] = 'false';
                                    } else {
                                        $matches[] = 'true';
                                    }
                                } else {
                                    $matches[] = 'false';
                                }
                            }
                        }
                    }
                }

                if(!in_array('false', $matches)) {
                    return true;
                }

            }
        }

        return false;
    }
}