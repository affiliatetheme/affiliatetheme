<?php
/**
 * Diverse Hilfsfunktionen
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    filter
 */

if ( ! function_exists( 'at_filter_backend_load_custom_js' ) ) {
	/**
	 * at_filter_backend_load_custom_js
	 *
	 * Add custom JS for filter
	 */
	add_action( 'acf/input/admin_footer', 'at_filter_backend_load_custom_js' );
	function at_filter_backend_load_custom_js()
	{
		global $post_type;
		if ( $post_type != 'filter' ) {
			return;
		}
		if ( ! is_admin() ) {
			return;
		}
		?>
		<script type="text/javascript">
			/**
			 * Populate choices of term select
			 */
			function at_filter_backend_set_term_select(target) {
				var value                = jQuery(target).val();
				var default_value_picker = jQuery(target).closest('.acf-fields').find('.acf-field-58b851e309213 select');

				if (!value) {
					jQuery(default_value_picker).find('option').each(function () {
						jQuery(this).attr('disabled', false);
					});
				} else {
					jQuery(default_value_picker).find('option').each(function () {
						term = jQuery(this).val();

						if (term) {
							if (term.indexOf(value + '_') == 0) {
								jQuery(this).attr('disabled', false);
							} else {
								jQuery(this).attr('disabled', true);
							}
						}
					});
				}
			}

			/**
			 * Fire when taxonomy select changes
			 */
			jQuery(document).on('change', '.acf-field-58b851e309212 select', function () {
				at_filter_backend_set_term_select(this);
			});

			/**
			 * Fire on load
			 */
			acf.add_action('load', function ($el) {
				jQuery('.acf-field-58b84ee9091ff div[data-layout="taxonomy"]').each(function () {
					var taxonomy_select = jQuery(this).find('.acf-field-58b851e309212 select');
					at_filter_backend_set_term_select(taxonomy_select);
				});
			});
		</script>
		<?php
	}
}

if ( ! function_exists( 'at_filter_backend_add_metabox' ) ) {
	/**
	 * at_filter_backend_add_metabox
	 *
	 * Add meta box for filter
	 */
	add_action( 'add_meta_boxes', 'at_filter_backend_add_metabox' );
	function at_filter_backend_add_metabox()
	{
		add_meta_box( 'at_filter_backend_metabox', __( 'Ausgabe', 'affiliatetheme-backend' ), 'at_filter_backend_metabox', 'filter', 'side', 'high' );
	}
}

if ( ! function_exists( 'at_filter_backend_metabox' ) ) {
	/**
	 * at_filter_backend_metabox
	 *
	 * Add meta box content for filter
	 */
	function at_filter_backend_metabox()
	{
		global $post;

		if ( get_post_status( $post->ID ) == 'publish' ) {
			?>
			<p>
				<?php _e( 'Benutze folgenden Shortcode um den Filter an der gewünschten Stelle auszugeben:', 'affiliatetheme-backend' ); ?>
			</p>

			<pre><mark>[at_filter id="<?php echo $post->ID; ?>" /]</mark></pre>

			<p><strong><?php _e( 'Parameter:', 'affiliatetheme-backend' ); ?></strong><br>
				<strong>id:</strong> <?php _e( 'ID des Filters', 'affiliatetheme-backend' ); ?><br>
				<strong>in_sidebar:</strong>
				<mark>true</mark> <?php _e( 'oder', 'affiliatetheme-backend' ); ?>
				<mark>false</mark>
			</p>
			<?php
		} else {
			?>
			<p>
				<?php _e( 'Um den Filter zu nutzen, musst du diesen erst veröffentlichen.', 'affiliatetheme-backend' ); ?>
			</p>
			<?php
		}
	}
}

if ( ! function_exists( 'at_filter_activate_pagination' ) ) {
	/**
	 * at_filter_activate_pagination
	 *
	 * Fix filter pagination
	 */
	add_action( 'template_redirect', 'at_filter_activate_pagination', 0 );
	function at_filter_activate_pagination()
	{
		if ( is_singular( 'filter' ) ) {
			global $wp_query;
			$page = ( int )$wp_query->get( 'page' );
			if ( $page > 1 ) {
				// convert 'page' to 'paged'
				$query->set( 'page', 1 );
				$query->set( 'paged', $page );
			}
			// prevent redirect
			remove_action( 'template_redirect', 'redirect_canonical' );
		}
	}
}

if ( ! function_exists( 'at_filter_backend_table_columns' ) ) {
	/**
	 * at_filter_backend_table_columns
	 *
	 * Added filter backend columns
	 */
	add_filter( 'manage_edit-filter_columns', 'at_filter_backend_table_columns' );
	function at_filter_backend_table_columns( $columns )
	{
		$columns = array(
			'cb'               => '<input type="checkbox" />',
			'title'            => __( 'Titel', 'affiliatetheme-backend' ),
			'filter_shortcode' => __( 'Shortcode', 'affiliatetheme-backend' ),
			'filter_elements'  => __( 'Felder', 'affiliatetheme-backend' ),
			'filter_date'      => __( 'Erstellt am', 'affiliatetheme-backend' ),
		);

		return $columns;
	}
}

if ( ! function_exists( 'at_filter_backend_table_columns_content' ) ) {
	/**
	 * at_filter_backend_table_columns_content
	 *
	 * Added filter backend columns content
	 */
	add_action( 'manage_filter_posts_custom_column', 'at_filter_backend_table_columns_content', 10, 2 );
	function at_filter_backend_table_columns_content( $column, $post_id )
	{
		switch ( $column ) {
			case 'filter_shortcode':
				echo '<pre style="margin: 0;">[at_filter id="' . $post_id . '" /]</pre>';
				break;

			case 'filter_elements':
				$filter_elements = get_field( 'filter_elements', $post_id );
				echo( $filter_elements ? count( $filter_elements ) : '0' );
				break;

			case 'filter_date':
				echo get_the_time( get_option( 'date_format' ), $post_id );
				break;

			default :
				break;
		}
	}
}

if ( ! function_exists( 'at_product_filter_ajax_results' ) ) {
	/**
	 * at_product_filter_ajax_results
	 *
	 * Added filter ajax functions
	 */
	add_action( 'wp_ajax_product_filter_ajax', 'at_product_filter_ajax_results' );
	add_action( 'wp_ajax_nopriv_product_filter_ajax', 'at_product_filter_ajax_results' );
	function at_product_filter_ajax_results()
	{
		$filter_id = (int)$_POST['filter_id'];
		$source_id = (int)$_POST['source_id'];

		if ( ! $filter_id ) {
			exit;
		}

		global $products, $grid_col;

		$filter = new AT_Filter( $filter_id );

		// layout
		$layout = 'list';
		if ( $_POST['layout'] ) {
			$layout = $_POST['layout'];
		} elseif ( is_a( $filter, 'AT_Filter' ) ) {
			$layout = $filter->get_product_layout();
		}

		// clean fields
		unset( $_POST['layout'] );

		$sidebar  = $filter->get_sidebar();
		$grid_col = apply_filters( 'at_product_filter_grid_col', ( 'none' == $sidebar ? '3' : '4' ) );

		$filter_query = new AT_Filter_Query( $filter );
		$args         = apply_filters( 'at_set_product_filter_query', $filter_query->args() );
		$products     = new WP_Query( $args );

		// add filter to manipulate query
		$products = apply_filters( 'at_filter_wp_query', $products );

		// show content?
		$show_content = apply_filters( 'at_filter_ajax_show_content', true );
		if ( $filter_id == $source_id && apply_filters( 'at_filter_single_show_content', true ) ) {
			$show_content = false;
		}
		if ( $show_content ) {
			echo apply_filters( 'the_content', get_post_field( 'post_content', $filter_id ) );
		}

		if ( $products->have_posts() ) {
			if ( 'grid' == $layout ) {
				echo '<div class="row">';
			}

			while ( $products->have_posts() ) : $products->the_post();
				get_template_part( 'parts/product/loop', $layout );
			endwhile;

			if ( 'grid' == $layout ) {
				echo '</div>';
			}
			echo atio_pagination( 3 );
		} else {
			echo '<div class="box">' . __( 'Es wurden keine Produkte gefunden.', 'affiliatetheme' ) . '</div>';
		}

		exit;
	}
}

if ( ! function_exists( 'at_filter_reduced_products' ) ) {
	/**
	 * Filter reduced products
	 */
	add_filter( 'at_filter_wp_query', 'at_filter_reduced_products', 10, 2 );
	function at_filter_reduced_products( $query )
	{
		if ( isset( $query->query['product_reduced'] ) && $query->query['product_reduced'] == 1 ) {
			$args                   = $query->query;
			$args['posts_per_page'] = -1;
			$args['fields']         = 'ids';

			$new_products = new WP_Query( $args );
			if ( $new_products->have_posts() ) {
				$filtered_ids = array();

				foreach ( $new_products->posts as $post_id ) {
					// check product price
					$product_shops = get_field( 'product_shops', $post_id );

					if ( $product_shops ) {
						$price     = $product_shops[0]['price'];
						$price_old = $product_shops[0]['price_old'];

						if ( $price_old && $price_old < $price ) {
							$filtered_ids[] = $post_id;
						}
					}
				}

				if ( $filtered_ids ) {
					$args             = $query->query;
					$args['post__in'] = $filtered_ids;

					$products = new WP_Query( $args );

					return $products;
				} else {
					$query->post_count = 0;
				}
			}
		}

		return $query;
	}
}