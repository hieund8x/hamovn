<?php
	$link = get_permalink( $post->ID );
	$args  = array( 'postid' => $post->ID, 'width' => 580, 'height' => 332, 'hide_href' => false, 'exclude_video' => false, 'imglink' => false, 'imgnocontainer' => true, 'resizer' => '580x332' );
	$image = get_obox_media( $args );

	$vid_info = array();
	$vid_info = get_post_meta($post->ID, "oembed_info", true);
	$share_url = wp_get_shortlink();
	$share_title = get_the_title($post->ID); 
					
?>
<!--Begin List of Posts -->
<li class="post clearfix">
	<div class="content clearfix">
		<!--If no oEmbed thumb, show the Featured Image or Video -->
		<?php if( $image !="" ) : ?>
			<div class="post-image fitvid">
				<?php echo $image;?>
			</div>
		<?php endif; ?>

		<!--Begin Content -->
		<div class="post-title-block">
			<h5 class="date post-date">
				<!--If Dates are checked in Theme Options, show the date -->
				<?php if( get_option( "ocmx_meta_date" ) != "false" ){
					 	echo the_time( get_option( 'date_format' ) ); } 
					if( get_option( "ocmx_meta_author" ) != "false" ){
						_e(" by "); the_author_posts_link(); } 
					if( get_option( "ocmx_meta_category" ) != "false" ){
				 		_e(" in "); the_category(", "); } ?>&nbsp;
                 
				<!--If this is an oEmbed video and you have Video Meta checked in Theme Options, show Likes and Views -->

				<?php if ( get_option( "ocmx_video_meta" ) != "false") : ?>
						<?php if( isset( $vid_info['views'] ) ) : ?>
							<span class="views"><?php echo $vid_info['views']; ?></span>
						<?php endif; 
						 if( isset( $vid_info['likes'] ) ) : ?>
							<span class="likes"><?php echo $vid_info['likes']; ?></span>
						<?php endif; 
					endif; ?>
			</h5>
			<!--Show Title -->
			<h2 class="post-title typography-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h2>
		</div>

		<!--If you have an Excerpt or More tag in the post, show the Excerpt, else show the whole post-->
		<div class="copy clearfix">
			 <?php if( get_option('ocmx_content_length') != 'no' ) :
					the_excerpt();
				else :
					the_content("");
				endif; ?>
		</div>
		<!--Begin Post Meta-->
		<ul class="post-meta">
			<li class="meta-block">
				<?php if( get_option( 'ocmx_content_length' ) != 'no' ) : ?>
                    <a href="<?php echo $link; ?>" class="action-link"><?php _e("Continue Reading","ocmx"); ?></a>
                <?php endif; ?>
				<?php if( comments_open($post->ID) && get_option( "ocmx_meta_comments" ) != "false" ): ?>
					<a href="<?php echo $link; ?>#comments" class="comment-count"><?php comments_number( __('0 Comments','ocmx'),__('1 Comment','ocmx'),__('% Comments','ocmx') ); ?></a>
				<?php endif; ?>
			</li>
			<!--Show Social Sharing if checked in Theme Options -->
			<?php if( get_option( 'ocmx_meta_social' ) != 'false' ) : ?>
                <li class="meta-block">
                    <ul class="social">
                        <li class="addthis">
                            <!-- AddThis Button BEGIN : Customize at http://www.addthis.com -->
                                <div class="addthis_toolbox addthis_default_style"
                                    addthis:url="<?php echo $share_url; ?>"
                                    addthis:title="<?php $share_title; ?>"> 
                                    <a class="addthis_button_facebook_like"></a>
                                    <a class="addthis_button_tweet"></a>
                                    <a class="addthis_counter addthis_pill_style"></a>
                                </div>
                                <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-507462e4620a0fff"></script>
                            <!-- AddThis Button END -->
                        </li>
                        <li>
                            <div class="short-url">
                                <span><?php _e("Short Url", "ocmx"); ?></span>
                                <input type="text" value="<?php echo wp_get_shortlink( $post->ID ); ?>">
                            </div>
                        </li>
                    </ul>
                </li>
			<?php endif; ?><!--End Sharing -->
		 </ul><!--End Post Meta -->
	<!--End Content -->
	</div>
</li>