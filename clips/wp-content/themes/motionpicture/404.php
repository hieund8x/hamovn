<?php
	get_header();

	global $wpdb;
	//DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month, count(ID) as posts
	global $wpquery;
	if (is_paged()) :
		$fetch_archive = query_posts("posts_per_page=20&paged=".get_query_var('paged'));
	else :
		$fetch_archive = query_posts("posts_per_page=20&paged=");
	endif;
?>

<ul class="clearfix">
	<li id="left-column">
		<div class="archives">
			<h3 class="section-title"><?php _e("404 | Trang này hiện chưa có nội dung.", "ocmx"); ?></h3>
			<ul class="archives_list">
			<?php foreach($fetch_archive as $archive_data) :
				global $post;
				 $post = $archive_data;
				$category_id = get_the_category($archive_data->ID);
				$this_category = get_category($category_id[0]->term_id);
				$this_category_link = get_category_link($category_id[0]->term_id);
				$link = get_permalink($archive_data->ID);
				$args  = array('postid' => $post->ID, 'width' => 150, 'height' => 98, 'hide_href' => false, 'exclude_video' => true, 'resizer' => '195x112');
				$image = get_obox_media($args);
				?>
				<li>
					<?php if($image !="") : ?>
						<div class="archive-post-image">
							<?php echo $image; ?>
						</div>
					<?php endif; ?>
					<?php if(get_option("ocmx_meta_date") != "false"): ?>
						<span class="date">
							<?php echo date('F dS', strtotime($archive_data->post_date)); ?>
						</span>
					<?php endif; ?>
					<a href="<?php echo get_permalink($archive_data->ID); ?>" class="post-title"><?php echo substr($archive_data->post_title, 0, 45); ?></a>
					<?php if(get_option("ocmx_meta_comments") != "false"): ?>
						<a href="<?php echo get_permalink($archive_data->ID); ?>/#comments" class="comment-count" title="Comment on <?php echo get_permalink($archive_data->post_title); ?>">
						<?php echo $archive_data->comment_count; ?> <?php _e("comments"); ?>
						</a>
					<?php endif; ?>
					<span class="label">
						<a href="<?php echo $this_category_link; ?>" title="View all posts in <?php echo $this_category->name; ?>" rel="category tag"><?php echo $this_category->name; ?></a>
					</span>
				</li>
				<?php
					$last_month = date("m Y", strtotime($archive_data->post_date));
				endforeach;
			?>

		</ul>
		 <?php motionpic_pagination("clearfix", "pagination clearfix"); ?>
	  </div>
	</li>
	<?php get_sidebar(); ?>
</ul>
<?php get_footer(); ?>