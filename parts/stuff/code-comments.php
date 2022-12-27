<?php if ( comments_open() ) { ?>
	<div class="clearfix"></div>
	<hr>
	<div class="post-comments" id="comments">
		<?php
		if ( get_comments_number( $post->ID ) == 0 ) {
			echo '<p class="h2">' . __( 'Keine Kommentare vorhanden', 'affiliatetheme' ) . '</p>';
		} else {
			echo '<p class="h2">' . __( 'Kommentare', 'affiliatetheme' ) . '</p>';
		}

		comments_template();
		?>
	</div>
<?php } ?>