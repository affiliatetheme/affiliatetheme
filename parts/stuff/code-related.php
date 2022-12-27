<?php

/*
 * VARS
 */
$posts_per_page = ( get_field( 'blog_single_related_numberposts', 'option' ) ? get_field( 'blog_single_related_numberposts', 'option' ) : '3' );
$layout         = ( get_field( 'blog_single_related_layout', 'option' ) ? get_field( 'blog_single_related_layout', 'option' ) : 'list' );
$filter         = ( get_field( 'blog_single_related_filter', 'option' ) ? get_field( 'blog_single_related_filter', 'option' ) : '' );
$orderby        = ( get_field( 'blog_single_related_orderby', 'option' ) ? get_field( 'blog_single_related_orderby', 'option' ) : 'date' );
$order          = ( get_field( 'blog_single_related_order', 'option' ) ? get_field( 'blog_single_related_order', 'option' ) : 'DESC' );
$post_type      = $post->post_type;

$args = array(
	'post_type'        => $post_type,
	'posts_per_page'   => $posts_per_page,
	'post__not_in'     => array( get_the_ID() ),
	'orderby'          => $orderby,
	'order'            => $order,
	'suppress_filters' => 0
);

if ( 'post' == $post_type ) {
	$cats = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
	$tags = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );

	if ( 'cat' == $filter ) {
		$args['category__in'] = $cats;
	} elseif ( 'tag' == $filter ) {
		$args['tag__in'] = $tags;
	} elseif ( 'cat_tag' == $filter ) {
		$args['category__in'] = $cats;
		$args['tag__in']      = $tags;
	}
}

$args = apply_filters( 'at_set_post_related_query', $args );

if ( $related = get_posts( $args ) ) { ?>
	<hr>
	<div class="post-related">
		<p class="h2"><?php _e( 'Ähnliche Beiträge', 'affiliatetheme' ); ?></p><?php
		if ( 'grid' == $layout ) echo '<div class="row">';
		elseif ( 'list' == $layout ) echo '<ul>';

		foreach ( $related as $post ) {
			setup_postdata( $post );

			get_template_part( 'parts/post/loop', $layout );
		}

		if ( 'grid' == $layout ) echo '</div>';
		elseif ( 'list' == $layout ) echo '</ul>';
		?>
	</div>
	<?php
}
wp_reset_query();
?>

