<?php

if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) :
	die( 'Die Datei "comments.php" kann nicht direkt aufgerufen werden.' );
endif;

$product_single_show_user_rating = get_field( 'product_single_show_user_rating', 'option' );

$consent      = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
$consent_text = apply_filters( 'at_comments_cookie_consent_text', __( 'Save my name, email, and website in this browser for the next time I comment.' ) );

if ( get_post_type() == 'product' && $product_single_show_user_rating == '1' ) {
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$reg      = get_option( 'require_name_email' );
	$i        = 0;
	wp_list_comments( array( 'callback' => 'at_product_comments_template', 'style' => 'div', 'avatar_size' => 48 ) );
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
		<div class="comment-nav">
			<nav>
				<div class="row">
					<div class="col-sm-6">
						<?php previous_comments_link(); ?>
					</div>
					<div class="col-sm-6 text-right">
						<?php next_comments_link(); ?>
					</div>
				</div>
			</nav>
		</div>
	<?php } ?>

	<hr>

	<div id="comments_reply">
		<?php
		comment_form(
			array(
				'comment_notes_after'  => '',
				'label_submit'         => __( 'Senden', 'affiliatetheme' ),
				'title_reply'          => __( 'Du hast eine Frage oder eine Meinung zum Produkt? Teile sie mit uns!', 'affiliatetheme' ),
				'comment_notes_before' => '<p class="comment-notes text-muted">' . __( 'Deine E-Mail-Adresse wird nicht veröffentlicht. Erforderliche Felder sind markiert *', 'affiliatetheme' ) . '</p>',
				'comment_field'        => '',
				'fields'               => apply_filters( 'comment_form_default_fields', array(
					'author' => '<div class="row"><div class="form-group col-md-4"><label for="author" class="control-label">' . __( 'Name', 'affiliatetheme' ) . ( $req ? ' <sup class="required">*</sup>' : '' ) . '</label> <input id="author" name="author" type="text" class="form-control" value="' . ( isset( $commenter['comment_author'] ) ? esc_attr( $commenter['comment_author'] ) : '' ) .
						'"' . ( $reg ? $aria_req : '' ) . ' /></div>',
					'email'  => '<div class="form-group col-md-4"><label for="email" class="control-label">' . __( 'E-Mail Adresse', 'affiliatetheme' ) . ( $req ? ' <sup class="required">*</sup>' : '' ) . '</label>
						<input id="email" name="email" type="text" class="form-control" value="' . ( isset( $commenter['comment_author__mail'] ) ? esc_attr( $commenter['comment_author__mail'] ) : '' ) .
						'"' . ( $reg ? $aria_req : '' ) . ' /></div>',
					'url'    => '<div class="form-group col-md-4"><label for="url" class="control-label">' . __( 'Webseite', 'affiliatetheme' ) . '</label><input id="url" name="url" type="text" class="form-control" value="' . ( isset( $commenter['comment_author_url'] ) ? esc_attr( $commenter['comment_author_url'] ) : '' ) . '" /></div></div>',

					'product_rating' => '
					<div class="row">
						<div class="form-group col-sm-12">
							<label class="control-label">' . __( 'Bewertung *', 'affiliatetheme' ) . '</label>
							<div class="comment-respond-rating">
								<span class="rating">
									<input type="radio" class="rating-input" id="product_rating-5" value="5" name="product_rating"/>
									<label for="product_rating-5" class="rating-star"></label>
									<input type="radio" class="rating-input" id="product_rating-4" value="4" name="product_rating"/>
									<label for="product_rating-4" class="rating-star"></label>
									<input type="radio" class="rating-input" id="product_rating-3" value="3" name="product_rating"/>
									<label for="product_rating-3" class="rating-star"></label>
									<input type="radio" class="rating-input" id="product_rating-2" value="2" name="product_rating"/>
									<label for="product_rating-2" class="rating-star"></label>
									<input type="radio" class="rating-input" id="product_rating-1" value="1" name="product_rating"/>
									<label for="product_rating-1" class="rating-star"></label>
								</span>
							</div>
						</div>
					</div>',
					'comment_field'  => '<div class="row"><div class="form-group col-md-12"><label for="comment" class="control-label">' . __( 'Kommentar', 'affiliatetheme' ) .
						( $req ? ' <sup class="required">*</sup>' : '' ) . '</label><textarea id="comment" name="comment" class="form-control" rows="5" aria-required="true">' .
						'</textarea></div></div>',
					'cookies'        => '<div class="form-group"><div class="checkbox"><label for="wp-comment-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
						'' . $consent_text . '</label></div></div>',
				) )
			)
		); ?>
		<div class="clearfix"></div>
	</div>
	<?php
} else {
	$aria_req = '';
	$reg      = get_option( 'require_name_email' );
	$i        = 0;
	wp_list_comments( array( 'callback' => 'endcore_comments_template', 'style' => 'div', 'avatar_size' => 48 ) );
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
		<div class="comment-nav">
			<nav>
				<div class="row">
					<div class="col-sm-6">
						<?php previous_comments_link(); ?>
					</div>
					<div class="col-sm-6 text-right">
						<?php next_comments_link(); ?>
					</div>
				</div>
			</nav>
		</div>
	<?php } ?>

	<hr>

	<div id="comments_reply">
		<?php
		comment_form(
			array(
				'comment_notes_after'  => '',
				'label_submit'         => __( 'Senden', 'affiliatetheme' ),
				'title_reply'          => __( 'Du hast eine Frage oder eine Meinung zum Artikel? Teile sie mit uns!', 'affiliatetheme' ),
				'comment_notes_before' => '<p class="comment-notes text-muted">' . __( 'Deine E-Mail-Adresse wird nicht veröffentlicht. Erforderliche Felder sind markiert *', 'affiliatetheme' ) . '</p>',
				'comment_field'        => '<div class="row"><div class="form-group col-md-12"><label for="comment" class="control-label">' . __( 'Kommentar', 'affiliatetheme' ) .
					( $req ? ' <sup class="required">*</sup>' : '' ) . '</label><textarea id="comment" name="comment" class="form-control" rows="5" aria-required="true">' .
					'</textarea></div></div>',

				'fields' => apply_filters( 'comment_form_default_fields', array(
					'author'  => '<div class="row"><div class="form-group col-md-4"><label for="author" class="control-label">' . __( 'Name', 'affiliatetheme' ) . ( $req ? ' <sup class="required">*</sup>' : '' ) . '</label> <input id="author" name="author" type="text" class="form-control" value="' . ( isset( $commenter['comment_author'] ) ? esc_attr( $commenter['comment_author'] ) : '' ) .
						'"' . ( $reg ? $aria_req : '' ) . ' /></div>',
					'email'   => '<div class="form-group col-md-4"><label for="email" class="control-label">' . __( 'E-Mail Adresse', 'affiliatetheme' ) . ( $req ? ' <sup class="required">*</sup>' : '' ) . '</label>
						<input id="email" name="email" type="text" class="form-control" value="' . ( isset( $commenter['comment_author__mail'] ) ? esc_attr( $commenter['comment_author__mail'] ) : '' ) .
						'"' . ( $reg ? $aria_req : '' ) . ' /></div>',
					'url'     => '<div class="form-group col-md-4"><label for="url" class="control-label">' . __( 'Webseite', 'affiliatetheme' ) . '</label><input id="url" name="url" type="text" class="form-control" value="' . ( isset( $commenter['comment_author_url'] ) ? esc_attr( $commenter['comment_author_url'] ) : '' ) . '" /></div></div>',
					'cookies' => '<div class="form-group"><div class="checkbox"><label for="wp-comment-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
						'' . $consent_text . '</label></div></div>',
				) )
			)
		); ?>
		<div class="clearfix"></div>
	</div>
	<?php
}
?>