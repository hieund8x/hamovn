<?php function mopic_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>
	<li class="comment clearfix" id="comment-<?php echo $comment->comment_ID; ?>">

			<div class="comment-author comment-avatar vcard">
				<?php echo get_avatar($comment, $size = '80'); ?>
			</div>
			
			<div class="comment-post commentmetadata clearfix">
				<h4 class="comment-name"><a href="<?php comment_author_url(); ?>" class="commentor_url" rel="nofollow"><?php comment_author(); ?></a></h4>
				<h5 class="date">
					<a class="date" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a>
				</h5>
				<?php if ($comment->comment_approved == '0') : ?>
					<em><?php _e('Your comment is awaiting moderation.', 'ocmx') ?></em>
					<br />
				<?php endif; ?>
				<?php comment_text() ?>
				<?php edit_comment_link(__('(Edit)', 'ocmx'),'  ','') ?>
				<span class="reply-to-comment"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
			</div>
			<div id="new-reply-<?php echo $comment->comment_ID; ?>" style="display: none;" class="threaded-comments reply"></div>
	</li>

<?php
}