<?php
$link = get_permalink($post->ID);
$hd_video = get_post_meta($post->ID, "hd_video", true);

$vid_info = array();
$vid_info = get_post_meta($post->ID, "oembed_info", true);

$social_code = get_option("ocmx_social_tag");
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('content clearfix'); ?>>
	<!--If this the video option in the post is set to Standard, show the standard video/image block -->
	<?php  if ( $hd_video != "yes" ) :
		$args  = array('postid' => $post->ID, 'width' => 580, 'hide_href' => false, 'imglink' => false, 'imgnocontainer' => true, 'resizer' => '580');
		$image = get_obox_media($args); ?>
		<!--Show the Featured Image or Video -->
		<div class="post-image fitvid">
			<?php if ($image != ""){ echo add_video_wmode_transparent($image); }?>
		</div>

		<?php if(!is_page()): // Show the Next/Prev links only if this is a post ?>
			<ul class="next-prev-post-nav">
				<li>
					<?php if ( get_adjacent_post( false, '', true ) ): // if there are older posts ?>
						&larr;  <?php previous_post_link("%link", "%title"); ?>
					<?php else : ?>
						&nbsp;
					<?php endif; ?>
				</li>
				<li>
					<?php if ( get_adjacent_post( false, '', false ) ): // if there are newer posts ?>
						<?php next_post_link( "%link", "%title" ); ?> &rarr;
					<?php else : ?>
						&nbsp;
					<?php endif; ?>
				</li>
			</ul>
		<?php endif; ?>

		<!--Begin Title Block -->
		<div class="post-title-block">
			<?php if(!is_page())  : // Only show meta if this is a post ?>
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
			<!--Show the Title -->
			<h2 class="post-title typography-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h2>
		</div>
	<!--End Standard Size Title Block -->
	<?php endif; ?>

	<!--Begin Content -->
	<div class="copy <?php echo $image_class; ?> clearfix">
		<?php the_content(""); ?>
		<?php wp_link_pages(); ?>
	</div>

	<!--Begin Post Meta -->
	<ul class="post-meta">
		<!--If Tags are checked in Theme Options, show them -->
		<?php if(get_option("ocmx_meta_tags") != "false"): ?>
			<li class="meta-block">
				<?php if(has_tag()): ?>
					<ul class="tags">
						<?php the_tags('<li><strong>Tags:</strong></li><li>','</li><li>','</li>'); ?>
					</ul>
				 <?php endif; ?>
			 </li>
		<?php endif; ?>

		<!--If Social is checked in Theme Options, show the buttons -->
		<?php if(!is_page() && get_option("ocmx_meta_social") != "false"): ?>
			 <?php if(isset($social_code) && $social_code !="" ) : ?>
				<span class="social"><?php echo get_option("ocmx_social_tag"); ?></span>
			<?php else : // Show sharing if enabled in Theme Options ?>
				<li class="meta-block social">
					<!-- AddThis Button BEGIN : Customize at http://www.addthis.com -->
					<div class="addthis_toolbox addthis_default_style ">
						<a class="addthis_button_facebook_like"></a>
						<a class="addthis_button_tweet"></a>
						<a class="addthis_counter addthis_pill_style"></a>
					</div>
					<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-507462e4620a0fff"></script>
					<!-- AddThis Button END -->
				</li>
			<?php endif; ?>  
		<?php endif; ?>
	</ul><!--End Meta -->
</div>
