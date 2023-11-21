<?php
/**
 * Cloaker
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    product
 */

add_action( 'init', 'at_cloak_rewrite' );
add_action( 'query_vars', 'at_cloak_query_vars' );
add_action( 'parse_request', 'at_cloak_out_parse_request' );
add_action( 'at_page_cloaker_after_content', 'at_cloak_dsgvo_page_links' );

/**
 * Cloaker rewrite rule
 *
 * @return void
 */
function at_cloak_rewrite()
{
	$cloak_active = get_field( 'product_cloak', 'option' );

	if ( $cloak_active ) {
		$cloak_slug = get_field( 'product_cloak_slug', 'option' ) ?? 'out';
		add_rewrite_rule( '^' . $cloak_slug . '/([^/]*)/([^/]*)', 'index.php?' . $cloak_slug . '=$matches[1]&shop_id=$matches[2]', 'top' );
	}
}

/**
 * Cloaker query vars
 *
 * @param $query_vars
 *
 * @return mixed
 */
function at_cloak_query_vars( $query_vars )
{
	$cloak_active = get_field( 'product_cloak', 'option' );
	if ( $cloak_active ) {
		$cloak_slug = get_field( 'product_cloak_slug', 'option' ) ?? 'out';

		$query_vars[] = $cloak_slug;
		$query_vars[] = 'shop_id';
	}

	return $query_vars;
}

/**
 * Parse request for cloaker
 *
 * @param $wp
 *
 * @return void
 */
function at_cloak_out_parse_request( $wp )
{
	$cloak_active = get_field( 'product_cloak', 'option' );
	if ( $cloak_active ) {
		$cloak_slug = get_field( 'product_cloak_slug', 'option' ) ?? 'out';

		if ( array_key_exists( $cloak_slug, $wp->query_vars ) ) {
			get_template_part( 'parts/product/page', 'cloak' );
			exit();
		}
	}
}

/**
 * Add dsgvo needed links to cloaker footer
 */
function at_cloak_dsgvo_page_links()
{
	$cloak_active = get_field( 'product_cloak', 'option' );
	if ( $cloak_active ) {
		$dsgvo_privacy_pages = get_field( 'dsgvo_privacy_pages', 'options' );

		if ( $dsgvo_privacy_pages ) {
			?>
            <div id="footer">
                <ul class="list-inline">
					<?php
					foreach ( $dsgvo_privacy_pages as $page ) {
						?>
                        <li>
                            <a href="<?php echo get_permalink( $page ); ?>">
								<?php echo get_the_title( $page ); ?>
                            </a>
                        </li>
						<?php
					}
					?>
                </ul>
            </div>
			<?php
		}
	}
}