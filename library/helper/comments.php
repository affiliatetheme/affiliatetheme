<?php 
/**
 * Kommentare Template
 * 
 * @author		Christian Lang
 * @version		1.0
 * @category	helper
 */

$i=0;
function endcore_comments_template($comment, $args, $depth) {
	global $i;
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	?>

	<?php if($i!=0 && $depth==1) : echo '<hr class="clearfix">'; endif; ?>

<div <?php comment_class('media') ?> id="comment-<?php comment_ID() ?>">

	<div class="media-left">
		<?php echo get_avatar( get_comment_author_email(), 48 ); ?>
	</div>
	<div class="media-body">
		<p class="media-heading">
			<?php if(get_comment_author_url()!=""){ ?> <a href="<?php comment_author_url(); ?>" target="_blank" rel="nofollow"><?php comment_author(); ?></a> <?php } else { comment_author();  } ?>
			<?php printf( __('<small class="pull-right">%1$s um %2$s</small>', 'affiliatetheme'), get_comment_date(),  get_comment_time()) ?>
		</p>

		<?php if ($comment->comment_approved == '0') : ?>
			<small class="text-muted comment-awaiting-moderation"><?php _e('Dein Kommentar wartet auf Freischaltung.', 'affiliatetheme') ?></small>
		<?php endif; ?>

		<?php comment_text() ?>

		<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
	</div>

	<?php
	$i++;
}
?>