<?php

class AT_Filter_Query
{
	function __construct( $filter = array() )
	{
		$this->filter  = $filter;
		$this->request = $_REQUEST;
		$this->args    = array( 'post_type' => 'product', 'post_status' => 'publish' );
	}

	public function args()
	{
		// iterate through fields
		if ( empty( $this->request ) ) {
			// load defaults
			$this->load_default_args();
		}

		unset( $this->request['source_id'] );

		foreach ( $this->request as $key => $val ) {
			if ( ! $val || $key == 'layout' || $key == 'orderby' || $key == 'action' || $key == 'filter_id' || $key == "paged" ) continue;

			if ( taxonomy_exists( $key ) ) {
				// taxonomy
				if ( is_array( $val ) ) {
					$this->args['tax_query'][] = array(
						'taxonomy' => $key,
						'field'    => 'slug',
						'terms'    => $val,
						'compare'  => 'IN'
					);
				} else {
					$this->args['tax_query'][] = array(
						'taxonomy' => $key,
						'field'    => 'slug',
						'terms'    => array( $val ),
					);
				}

			} elseif ( $key == 'product_rating' ) {
				// rating
				$value                      = explode( ',', $val );
				$this->args['meta_query'][] = array(
					'key'     => $key,
					'value'   => $value,
					'compare' => 'BETWEEN',
					'type'    => 'NUMERIC'
				);
			} elseif ( $key == 'price' ) {
				// price
				$value                      = explode( ',', $val );
				$this->args['meta_query'][] = array(
					'key'     => 'product_shops_0_price',
					'value'   => $value,
					'compare' => 'BETWEEN',
					'type'    => apply_filters( 'at_filter_query_price_type', 'DECIMAL(10,3)' )
				);
			} else {
				// product reduced
				if ( $key == 'product_reduced' ) {
					$this->args['product_reduced'] = true;
				} else {
					// custom fields
					if ( is_array( $val ) ) {
						$fieldQuery = [ 'relation' => 'OR' ];
						foreach ( $val as $valArr ) {
							if ( $valArr ) {
								$fieldQuery[] = array(
									'key'     => $key,
									'value'   => '"' . $valArr . '"',
									'compare' => 'LIKE'
								);
							}
						}
						if ( count( $fieldQuery ) > 1 ) {
							$this->args['meta_query'][] = $fieldQuery;
						}
					} else {
						$value = explode( ',', $val );
						if ( is_array( $value ) && count( $value ) > 1 ) {
							$this->args['meta_query'][] = array(
								'key'     => $key,
								'value'   => $value,
								'compare' => 'BETWEEN',
								'type'    => apply_filters( 'at_filter_query_cf_type', 'NUMERIC', $key )
							);
						} else {
							$this->args['meta_query'][] = array(
								'key'     => $key,
								'value'   => $val,
								'compare' => 'LIKE'
							);
						}
					}
				}
			}
		}

		if ( is_a( $this->filter, 'AT_Filter' ) ) {
			// set orderby
			if ( $this->filter->get_product_orderby() == 'price' ) {
				$this->set( 'meta_key', 'product_shops_0_price' );
				$this->set( 'orderby', 'meta_value_num' );
			} elseif ( $this->filter->get_product_orderby() == 'rating' ) {
				$this->set( 'meta_key', 'product_rating' );
				$this->set( 'orderby', 'meta_value_num' );
			} else {
				$this->set( 'orderby', ( $this->filter->get_product_orderby() ? $this->filter->get_product_orderby() : '' ) );
			}

			// order
			$this->set( 'order', ( $this->filter->get_product_order() ? $this->filter->get_product_order() : '' ) );

			// set posts per page
			$this->set( 'posts_per_page', ( $this->filter->get_product_per_page() ? $this->filter->get_product_per_page() : 12 ) );
		}

		// set page
		if ( isset( $_REQUEST['paged'] ) ) set_query_var( 'paged', $_REQUEST['paged'] );
		$this->set( 'paged', ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1 );

		// set user filter order
		$this->set_user_filter_order();

		return $this->args;
	}

	public function set( $k, $v )
	{
		if ( ! $k ) {
			return;
		}

		$this->args[ $k ] = $v;
	}

	public function set_user_filter_order()
	{
		// user filter order
		if ( isset( $this->request['orderby'] ) && $this->request['orderby'] != '' ) {
			if ( $this->request['orderby'] == 'a-z' ) {
				$orderby = 'title';
				$order   = 'asc';
			} elseif ( $this->request['orderby'] == 'z-a' ) {
				$orderby = 'title';
				$order   = 'desc';
			} elseif ( $this->request['orderby'] == 'date' ) {
				$orderby = 'date';
				$order   = 'desc';
			} elseif ( $this->request['orderby'] == 'price-asc' ) {
				$orderby                = 'meta_value_num';
				$order                  = 'asc';
				$this->args['meta_key'] = 'product_shops_0_price';
			} elseif ( $this->request['orderby'] == 'price-desc' ) {
				$orderby                = 'meta_value_num';
				$order                  = 'desc';
				$this->args['meta_key'] = 'product_shops_0_price';
			} elseif ( $this->request['orderby'] == 'rating' ) {
				$orderby                = 'meta_value_num';
				$order                  = 'desc';
				$this->args['meta_key'] = 'product_rating';
			}

			$this->args['orderby'] = $orderby;
			$this->args['order']   = $order;
		}
	}

	public function load_default_args()
	{
		$elements = $this->filter->elements;

		if ( $elements ) {
			foreach ( $elements as $el ) {
				// set data
				switch ( $el['acf_fc_layout'] ) {
					case 'price':
						$min_value              = $el['min_value'];
						$max_value              = $el['max_value'];
						$values                 = at_field_database_min_max_value( 'price', 'product' );
						$this->request['price'] = '' . ( $min_value ? $min_value : $values->min ) . ',' . ( $max_value ? $max_value : $values->max ) . '';
						break;

					case 'custom_field':
						if ( $el['default_value'] ) {
							$field_object = get_field_object( $el['field'] );
							if ( $field_object ) {
								$this->request[ $field_object['name'] ] = $el['default_value'];
							}
						}
						break;

					case 'taxonomy':
						if ( ! empty( $el['taxonomy'] ) && ! empty( $el['default_value'] ) ) {
							$tax                   = $el['taxonomy'][0]->name;
							$val                   = $el['default_value'][0]->slug;
							$this->request[ $tax ] = $val;
						}
						break;

					default:
						break;
				}
			}
		}
	}
}