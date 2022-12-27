<?php

/*
 * VARS
 */
$networks     = ( is_array( get_field( 'socialbuttons_networks', 'option' ) ) ? get_field( 'socialbuttons_networks', 'option' ) : array() );
$hide_summary = get_field( 'socialbuttons_signals_hide_summary', 'option' );
$show_text    = get_field( 'socialbuttons_text', 'option' );
$btn_size     = get_field( 'socialbuttons_size', 'option' );
$url          = at_get_current_url();
?>
<div class="post-social">
	<div class="btn-group btn-group-social btn-group-justified <?php echo( ( ! $btn_size ) ? 'btn-group-md' : 'btn-group-' . $btn_size ); ?>">
		<?php if ( in_array( 'wa', $networks ) ) { ?>
			<a class="btn btn-social btn-whatsapp visible-xs" href="whatsapp://send?text=<?php echo urlencode( get_the_title() ) . ' - ' . urlencode( $url ); ?>" target="_blank" rel="nofollow">
				<i class="fab fa-whatsapp"></i>
				<?php if ( '1' != $show_text ) { ?><span class="hidden-xs hidden-sm"><?php _e( 'WhatsApp', 'affiliatetheme' ); ?></span><?php } ?>
			</a>
		<?php } ?>

		<?php if ( in_array( 'fb_share', $networks ) ) { ?>
			<a class="btn btn-social btn-facebook-share" href="https://www.facebook.com/sharer.php?u=<?= urlencode( $url ); ?>" onclick="socialp(this, 'fb');return false;" target="_blank" rel="nofollow">
				<i class="fab fa-facebook"></i>
				<?php if ( '1' != $show_text ) { ?><span class="hidden-xs hidden-sm"><?php _e( 'teilen', 'affiliatetheme' ); ?></span><?php } ?>
			</a>
		<?php } ?>

		<?php if ( in_array( 'twitter', $networks ) ) { ?>
			<a class="btn btn-social btn-twitter" href="https://twitter.com/share?url=<?= urlencode( $url ); ?>" onclick="socialp(this, 'twitter');return false;" target="_blank" rel="nofollow">
				<i class="fab fa-twitter"></i>
				<?php if ( '1' != $show_text ) { ?><span class="hidden-xs hidden-sm"><?php _e( 'tweeten', 'affiliatetheme' ); ?></span><?php } ?>
			</a>
		<?php } ?>

		<?php if ( in_array( 'linkedin', $networks ) ) { ?>
			<a class="btn btn-social btn-linkedin" href="https://www.linkedin.com/cws/share?url=<?= urlencode( $url ); ?>" onclick="socialp(this, 'linkedin');return false;" target="_blank" rel="nofollow">
				<i class="fab fa-linkedin"></i>
				<?php if ( '1' != $show_text ) { ?><span class="hidden-xs hidden-sm"><?php _e( 'sharen', 'affiliatetheme' ); ?></span><?php } ?>
			</a>
		<?php } ?>

		<?php if ( in_array( 'pinterest', $networks ) ) { ?>
			<a class="btn btn-social btn-pinterest" href="https://pinterest.com/pin/create/button/?url=<?= urlencode( $url ); ?>&description=<?= urlencode( get_the_title() ); ?>" onclick="socialp(this, 'pinterest');return false;" target="_blank" rel="nofollow">
				<i class="fab fa-pinterest"></i>
				<?php if ( '1' != $show_text ) { ?><span class="hidden-xs hidden-sm"><?php _e( 'sharen', 'affiliatetheme' ); ?></span><?php } ?>
			</a>
		<?php } ?>

		<?php if ( in_array( 'xing', $networks ) ) { ?>
			<a class="btn btn-social btn-xing" href="https://www.xing-share.com/app/user?op=share;sc_p=xing-share;url=<?= urlencode( $url ); ?>" onclick="socialp(this, 'xing');return false;" target="_blank" rel="nofollow">
				<i class="fab fa-xing"></i>
				<?php if ( '1' != $show_text ) { ?><span class="hidden-xs hidden-sm"><?php _e( 'sharen', 'affiliatetheme' ); ?></span><?php } ?>
			</a>
		<?php } ?>

		<?php if ( in_array( 'mail', $networks ) ) { ?>
			<a class="btn btn-social btn-mail" href="mailto:?body=<?= urlencode( $url ); ?>&subject=<?php _e( 'Meine Empfehlung f&uuml;r dich', 'affiliatetheme' ); ?>" target="_blank" rel="nofollow">
				<i class="fas fa-envelope"></i>
				<?php if ( '1' != $show_text ) { ?><span class="hidden-xs hidden-sm"><?php _e( 'mailen', 'affiliatetheme' ); ?></span><?php } ?>
			</a>
		<?php } ?>
	</div>
</div>