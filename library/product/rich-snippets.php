<?php

/**
 * Render the product rich snippets
 *
 */
add_action( 'wp_footer', 'at_product_rich_snippets', 133337 );
function at_product_rich_snippets()
{
	if ( is_single() && 'product' == get_post_type() ) {
		$product_schema_hide = get_field( 'product_schema_hide', 'options' );
		if ( $product_schema_hide ) {
			return;
		}

		$title       = get_the_title();
		$image       = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large', true );
		$rating      = get_field( 'product_rating' );
		$shop_info   = get_field( 'product_shops' );
		$ean         = get_field( 'product_ean' );
		$description = get_field( 'product_description' ) ?: get_the_excerpt();
		$sku         = get_field( 'product_schema_sku' );
		$author      = at_product_rich_snippets_get_author( get_the_ID() );
		$brand       = at_product_rich_snippets_get_brand( get_the_ID() );

		// check if external image is set
		$externalImage = get_post_meta( get_the_ID(), '_thumbnail_ext_url', true );
		if ( $externalImage ) {
			$image[0] = $externalImage;
		}

		if ( is_array( $shop_info ) ) {
			echo PHP_EOL . '<script type="application/ld+json">' . PHP_EOL;
			echo '{' . PHP_EOL;
			echo '"@context": "http://schema.org/",' . PHP_EOL;
			echo '"@type": "Product",' . PHP_EOL;
			echo '"name": "' . $title . '",' . PHP_EOL;
			echo '"url": "' . get_permalink() . '",' . PHP_EOL;

			if ( $image ) {
				echo '"image": "' . $image[0] . '",' . PHP_EOL;
			}

			if ( $description ) {
				echo '"description": "' . htmlspecialchars( $description ) . '",' . PHP_EOL;
			}

			if ( $ean ) {
				echo '"gtin13": "' . $ean . '",' . PHP_EOL;
			}

			if ( $sku ) {
				echo '"sku": "' . $sku . '",' . PHP_EOL;
			}

			if ( $brand ) {
				echo '"brand": "' . $brand . '",' . PHP_EOL;
			}

			if ( $rating && get_product_rating( get_the_ID() ) ) {
				$rating_cnt = ( get_field( 'product_rating_cnt' ) ? get_field( 'product_rating_cnt' ) : '1' );

				// aggregateRating
				echo '"aggregateRating": {' . PHP_EOL;
				echo '"@type": "AggregateRating",' . PHP_EOL;
				echo '"ratingValue": "' . $rating . '",' . PHP_EOL;
				echo( $rating_cnt ? '"reviewCount": "' . $rating_cnt . '"' . PHP_EOL : '' );
				echo '},' . PHP_EOL;

				// review
				echo '"review": {' . PHP_EOL;
				echo '"@type": "Review",' . PHP_EOL;
				echo '"reviewRating": {' . PHP_EOL;
				echo '"@type": "Rating",' . PHP_EOL;
				echo '"ratingValue": "' . $rating . '",' . PHP_EOL;
				echo '"bestRating": "5"' . PHP_EOL;
				echo '},' . PHP_EOL;
				echo '"author": {' . PHP_EOL;
				echo '"@type": "Person",' . PHP_EOL;
				echo '"name": "' . $author . '"' . PHP_EOL;
				if ( get_field( 'product_review_rating_summary' ) ) {
					echo '},' . PHP_EOL;
					if ( get_field( 'product_review_rating_date' ) ) {
						echo '"reviewBody": "' . get_field( 'product_review_rating_summary' ) . '",' . PHP_EOL;
						echo '"datePublished": "' . date( 'Y-m-d', strtotime( get_field( 'product_review_rating_date' ) ) ) . '"' . PHP_EOL;
					} else {
						echo '"reviewBody": "' . get_field( 'product_review_rating_summary' ) . '"' . PHP_EOL;
					}
				} else {
					echo '}' . PHP_EOL;
				}
				echo '},' . PHP_EOL;
			}

			if ( $shop_info[0]['currency'] == 'euro' ) {
				$shop_info[0]['currency'] = 'EUR';
			}

			// set default currency if empty
			if ( ! $shop_info[0]['currency'] ) {
				$shop_info[0]['currency'] = 'EUR';
			}

			echo '"offers": {' . PHP_EOL;
			echo '"@type": "Offer",' . PHP_EOL;
			echo( isset( $shop_info[0]['currency'] ) ? '"priceCurrency": "' . $shop_info[0]['currency'] . '",' . PHP_EOL : '' );
			echo( isset( $shop_info[0]['price'] ) ? '"price": "' . $shop_info[0]['price'] . '",' . PHP_EOL : '' );
			echo '"availability": "http://schema.org/InStock",' . PHP_EOL;
			echo '"url": "' . get_permalink() . '"' . PHP_EOL;
			echo '}' . PHP_EOL;
			echo '}' . PHP_EOL;
			echo '</script>' . PHP_EOL;
		}
	}
}

/**
 * Get the review author of product
 *
 * @param $post_id
 *
 * @return bool|mixed
 */
function at_product_rich_snippets_get_brand( $post_id )
{
	$product_schema_brand_source = get_field( 'product_schema_brand_source', 'options' );

	if ( $product_schema_brand_source == 'product_field' ) {
		return get_field( 'product_schema_brand', $post_id );
	} else {
		if ( taxonomy_exists( $product_schema_brand_source ) ) {
			$terms = wp_get_post_terms( $post_id, $product_schema_brand_source );

			if ( $terms ) {
				return $terms[0]->name;
			}
		}
	}

	return false;
}

/**
 * Get the author of the product
 *
 * @param $post_id
 *
 * @return bool|mixed
 */
function at_product_rich_snippets_get_author( $post_id )
{
	// get author product based
	$author = get_field( 'product_schema_author', $post_id );
	if ( $author ) {
		return $author;
	}

	// global author
	$author_global = get_field( 'product_schema_author', 'options' );
	if ( $author_global ) {
		return $author_global;
	}

	// fallback
	return get_bloginfo( 'name' );
}

/**
 * Overwrite the choices of product_schema_brand_source
 *
 * @param $field
 *
 * @return mixed
 */
add_filter( 'acf/load_field/name=product_schema_brand_source', 'at_product_rich_snippets_get_brand_choices' );
function at_product_rich_snippets_get_brand_choices( $field )
{
	$field['choices'] = array(
		'product_field' => __( 'Benutzerdefiniertes Feld', 'affiliatetheme-backend' )
	);

	// get taxonomies
	$taxonomies = get_object_taxonomies( 'product', 'objects' );
	if ( $taxonomies ) {
		foreach ( $taxonomies as $tax ) {
			$field['choices'][ $tax->name ] = sprintf( __( 'Taxonomie: %s', 'affiliatetheme-backend' ), $tax->label );
		}
	}

	// set default
	$field['default'] = 'product_field';

	return $field;
}

