<p class="post-meta">
	<?php
	if ( get_field( 'blog_single_meta_published', 'option' ) != '1' ) { ?>
		<span class="post-meta-author">
			<?= __( 'Veröffentlicht von', 'affiliatetheme' ); ?> <a class="author-link" href="<?= esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?= esc_attr( get_the_author() ); ?></a>
		</span>
		<?php
	}

	if ( get_field( 'blog_single_meta_date', 'option' ) != '1' ) { ?>
		<span class="post-meta-date"><?= get_the_date(); ?></span>
		<?php
	}

	if ( get_field( 'blog_single_meta_categories', 'option' ) != '1' ) {
		if ( get_the_category_list() ) {
			printf( '<span class="post-meta-cats">' . __( 'Kategorie(n): %s', 'affiliatetheme' ) . '</span>', get_the_category_list( ', ' ) );
		}
	}

	if ( get_field( 'blog_single_meta_tags', 'option' ) != '1' ) {
		echo get_the_tag_list( '<span class="post-meta-tags"> ' . __( 'Schlagwörter: ', 'affiliatetheme' ), ', ', '</span>' );
	}

	if ( get_field( 'blog_single_meta_comments', 'option' ) != '1' ) {
		if ( comments_open() ) {
			echo '<span class="post-meta-comments"> <a href="' . get_permalink() . '#comments">';
			comments_number( __( 'Keine Kommentare', 'affiliatetheme' ), __( '1 Kommentar', 'affiliatetheme' ), __( '% Kommentare', 'affiliatetheme' ) );
			echo '</a></span>';
		}
	}
	?>
</p>