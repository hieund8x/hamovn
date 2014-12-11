<?php $link = get_permalink($post->ID);
 $args  = array('postid' => $post->ID, 'width' => 940, 'hide_href' => true, 'imglink' => false, 'imgnocontainer' => true, 'resizer' => '940');
$image = get_obox_media($args);
$hd_video = get_post_meta($post->ID, "hd_video", true);

$vid_info = array();
$vid_info = get_post_meta($post->ID, "oembed_info", true);

?>
<div id="hd-container">
	<ul class="next-prev-post-nav">
		<li>
			<?php if (get_adjacent_post(false, '', true)): // if there are older posts ?>
				&larr;
				<?php previous_post_link("%link", "%title"); ?>
			<?php else : ?>
				&nbsp;
			<?php endif; ?>
		</li>
		<li>
			<?php if (get_adjacent_post(false, '', false)): // if there are newer posts ?>
				<?php next_post_link("%link", "%title"); ?>
				&rarr;
			<?php else : ?>
				&nbsp;
			<?php endif; ?>
		</li>
	</ul>
	<div class="post-title-block">
		<?php if(!is_page())  : ?>
			<h5 class="date post-date">
				<!--If Dates or Author are checked in Theme Options, show them -->
				<?php if(get_option("ocmx_meta_date") != "false"):
						echo the_time( get_option( 'date_format' ) );
					endif;
					if(get_option("ocmx_meta_author") != "false"):
						_e(" by "); the_author_posts_link();
					endif;
						_e(" in "); the_category(", "); ?>&nbsp;
				<!--If this is an oEmbed video and you have Video Meta checked in Theme Options, show Likes and Views -->
				<?php if ( get_option( "ocmx_video_meta" ) != "false") : ?>
					<?php if( isset( $vid_info['views'] ) ) : ?>
						<span class="views"><?php echo $vid_info['views']; ?></span>
					<?php endif; ?>
					<?php if( isset( $vid_info['likes'] ) ) : ?>
						<span class="likes"><?php echo $vid_info['likes']; ?></span>
					<?php endif; ?>
				<?php endif; ?>
			</h5><!--End Meta -->
		<?php endif; ?>
		<h2 class="post-title typography-title">
			<a href="<?php echo $link; ?>">
				<?php the_title(); ?>
			</a>&nbsp;
			<span class="hd-icon">HD</span>
		</h2>
	</div>
	<div class="post-image fitvid">
		<?php if ($image != ""){ echo add_video_wmode_transparent($image); }?>
	</div>
</div>