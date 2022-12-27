<?php
/**
 * Cloaker
 *
 * @author        Christian Lang
 * @version        1.0
 * @category    product
 */

global $cloak_slug;
$cloak_slug = ( get_field( 'product_cloak_slug', 'option' ) ? get_field( 'product_cloak_slug', 'option' ) : 'out' );

add_action( 'init', 'cloak_rewrite' );
function cloak_rewrite()
{
	global $wp_rewrite, $cloak_slug;

	add_rewrite_rule( '^' . $cloak_slug . '/([^/]*)/([^/]*)', 'index.php?' . $cloak_slug . '=$matches[1]&shop_id=$matches[2]', 'top' );
}

add_action( 'query_vars', 'cloak_query_vars' );
function cloak_query_vars( $query_vars )
{
	global $cloak_slug;

	$query_vars[] = $cloak_slug;
	$query_vars[] = 'shop_id';

	return $query_vars;
}

add_action( 'parse_request', 'out_parse_request' );
function out_parse_request( $wp )
{
	global $cloak_slug;

	if ( array_key_exists( $cloak_slug, $wp->query_vars ) ) {
		get_template_part( 'parts/product/page', 'cloak' );
		exit();
	}
}

/**
 * Add dsgvo needed links to cloaker footer
 */
add_action( 'at_page_cloaker_after_content', 'at_dsgvo_cloaker_page_links' );
function at_dsgvo_cloaker_page_links()
{
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