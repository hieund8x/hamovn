<?php 
/* Template Name: Post Grid */
get_header(); 
// If there is a custom link or title set, use them

$args = array(
	"post_type" => "post",
	"paged" => $paged
);

$temp = $wp_query; 
$wp_query = null; 
$wp_query = new WP_Query($args);
?>


<div id="post-grid" class="clearfix">
	<div class="post-title-block">
		<h2 class="page-title"><?php the_title(); ?></h2>
	</div>
	<div class="video-list clearfix">
		<ul class="four-column content-widget clearfix">
			<?php if($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post();
				global $post;
				$link = get_permalink($post->ID);
				$vid_info = array();
				$vid_info = get_post_meta($post->ID, "oembed_info", true);	
				$args  = array('postid' => $post->ID, 'width' => '195', 'height' => '112', 'hide_href' => false, 'exclude_video' => true, 'imglink' => false, 'imgnocontainer' => true, 'resizer' => '195x112');
				$image = get_obox_media($args);
				?>
				<li>
					<?php if($image !="") : ?>
						 <div class="post-image fitvid">
							<?php echo $image;?>
						 </div>
					 <?php endif; ?>
					<h5 class="date">
						<?php if( get_option('ocmx_meta_date') !="false" ) : ?>
							<span class="dater"><?php the_time(get_option('date_format')); ?></span>
						<?php endif; ?>
						<?php if( get_option('ocmx_video_meta') !="false" ) : ?>
							<?php if( isset( $vid_info['views'] ) ) : ?>
								<span class="views"><?php echo $vid_info['views']; ?></span>
							<?php endif; ?>
							<?php if( isset( $vid_info['likes'] ) ) : ?>
									<span class="likes"><?php echo $vid_info['likes']; ?></span>
							<?php endif; ?>
						<?php endif; ?>
					</h5>
					<h2 class="post-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h2>
					<!--Show Excerpts if enabled -->
					<?php the_excerpt();?>

				</li>
			<?php endwhile; 
			else : 
				ocmx_no_posts(); wp_reset_postdata();
			endif; ?>
		</ul>
	</div>
</div>

<?php motionpic_pagination("clearfix", "pagination clearfix"); ?>
<?php $wp_query = null; $wp_query = $temp;?>

<?php get_footer(); ?>