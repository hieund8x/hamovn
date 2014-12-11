<?php
class feature_posts_widget extends WP_Widget {
	/** constructor */
	function feature_posts_widget() {
		parent::WP_Widget(false, $name = "(Obox) Slider", array("description" => "Home Page Widget - Display fading images or video with excerpts."));
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		extract( $args );

		if(isset($instance["display_limit"]))
			$display_limit = $instance["display_limit"];

		if(isset($instance["post_thumb"]))
			$post_thumb = $instance["post_thumb"];
		if($post_thumb == "true"):
			$post_thumb = 1;
		else :
			$post_thumb = 0;
		endif;

		if(isset($instance["post_category"]))
			$use_category = $instance["post_category"];

		if($use_category != "0") :
			$args = array(
				"post_type" => 'post',
				"posts_per_page" => $display_limit,
				"tax_query" => array(
					array(
						"taxonomy" => 'category',
						"field" => "slug",
						"terms" => $use_category
					)
				)
			);
			$use_cat = get_category_by_slug($use_category);
			$catlink = get_category_link($use_cat->term_id);
		else :
			$args = array(
				"post_type" => 'post',
				"posts_per_page" => $display_limit
			);
		endif;

		if(isset($instance["show_meta"]))
			$show_meta = $instance["show_meta"];
		if(isset($instance["show_dates"]))
			$show_dates = $instance["show_dates"];
		if(isset($instance["auto_interval"]))
		$auto_interval = $instance["auto_interval"];

		$ocmx_posts = new WP_Query($args);
		//Set the post Aguments and Query accordingly
		$count = 1; ?>
	<div class="slider clearfix">
		<ul class="gallery-container gallery-image">
			<?php while ($ocmx_posts->have_posts()) : $ocmx_posts->the_post();
				$args  = array('postid' => $ocmx_posts->post->ID, 'width' => 580, 'height' => 332, 'hide_href' => false, 'exclude_video' => $post_thumb, 'resizer' => '580x332');
				$image = get_obox_media($args); ?>
				<li <?php if( $count !== 1 ) : ?>class="no_display"<?php endif; ?>>
					<?php if( $image !="" ) : ?>
						<div class="post-image fitvid">
							<?php if ($image != ""){ echo add_video_wmode_transparent($image); }?>
						</div>
					<?php endif; ?>
				</li>
			<?php
				$count++;
			endwhile; ?>
		</ul>
		<div class="copy">
			<?php if( $auto_interval == "0" || $auto_interval == "" ) : ?>
				<a href="#" class="previous"><?php _e("Previous", "ocmx"); ?></a>
				<a href="#" class="next"><?php _e("Next", "ocmx"); ?></a>
			<?php endif; ?>
			<?php $count=1;  ?>
			<ul>
				<?php while ($ocmx_posts->have_posts()) : $ocmx_posts->the_post();
					global $post;
					$this_post = get_post($post->ID);
					$link = get_permalink($post->ID);

					$vid_info = array();
					$vid_info = get_post_meta($post->ID, "oembed_info", true);
				?>
				<li <?php if( $count !== 1 ) : ?>class="no_display"<?php endif; ?>>

					<h5 class="date">
						<?php if(isset($show_dates) && $show_dates == "on") : ?>
							<?php the_time(get_option('date_format')); ?> &nbsp;
						<?php endif; ?>
						<?php if(isset($show_meta) && $show_meta == "on") : ?>
							<?php if( isset( $vid_info['views'] ) ) : ?>
								<span class="views"><?php echo $vid_info['views']; ?></span>
							<?php endif; ?>
							<?php if( isset( $vid_info['likes'] ) ) : ?>
									<span class="likes"><?php echo $vid_info['likes']; ?></span>
							<?php endif; ?>
						<?php endif; ?>
					</h5>


					<h3 class="post-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h3>

					<?php $title_len = strlen($this_post->post_title);
					if($title_len > 22)
						{$excerpt_length  = 145;}
					else
						{$excerpt_length  = 205;}
					$content = get_the_content("");
					$contenttext = strip_tags($content);
					$excerpt = get_the_excerpt();
					$excerpttext = strip_tags($excerpt);
					if($post->post_excerpt != "") :
						echo '<p>';
							echo substr($excerpttext, 0, $excerpt_length );
						echo '</p>';
					else :
						echo '<p>';
							echo substr($contenttext, 0, $excerpt_length );
						echo '</p>';
					endif; ?>
				</li>
				<?php
					$count++;
				endwhile; ?>
			</ul>
		</div>
		<div id="slider-number-<?php echo $use_category; ?>" class="no_display">0</div>
		<div id="slider-auto-<?php echo $use_category; ?>" class="no_display"><?php echo $auto_interval; ?></div>
	</div>

<?php
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		if(isset($instance["title"]))
			$title = $instance["title"];
		if(isset($instance["display_limit"]))
			$display_limit = $instance["display_limit"];
		if(isset($instance["auto_interval"]))
			$auto_interval = $instance["auto_interval"];
		if(isset($instance["show_meta"]))
			$show_meta = $instance["show_meta"];
		if(isset($instance["show_dates"]))
			$show_dates = $instance["show_dates"];
		if(isset($instance["post_thumb"]))
			$post_thumb = $instance["post_thumb"];
		if(isset($instance["post_count"]))
			$post_thumb = $instance["post_count"];
		if(isset($instance["video_meta"]))
			$video_meta = $instance["video_meta"];
?>

		<p><label for="<?php echo $this->get_field_id('post_category'); ?>">Posts Category</label>
		   <select size="1" class="widefat" id="<?php echo $this->get_field_id("post_category"); ?>" name="<?php echo $this->get_field_name("post_category"); ?>">
				<option <?php if(isset($post_count) && $post_count == 0){echo "selected=\"selected\"";} ?> value="0">All</option>
				<?php
						$category_args = array('hide_empty' => false);
						$option_loop = get_categories($category_args);
						foreach($option_loop as $option_label => $value)
							{
								// Set the $value and $label for the options
								$use_value =  $value->slug;
								$label =  $value->cat_name;
								//If this option == the value we set above, select it
								if($use_value == $instance["post_category"])
									{$selected = " selected='selected' ";}
								else
									{$selected = " ";}
				?>
								<option <?php echo $selected; ?> value="<?php echo $use_value; ?>"><?php echo $label; ?></option>
				<?php
							}
				?>
			</select>
		</p>
		 <p>
		<label for="<?php echo $this->get_field_id('post_thumb'); ?>">Thumbnails</label>
		<select size="1" class="widefat" id="<?php echo $this->get_field_id('post_thumb'); ?>" name="<?php echo $this->get_field_name('post_thumb'); ?>">
				<option <?php if(isset($post_thumb) && $post_thumb == "true") : ?>selected="selected"<?php endif; ?> value="true">Post Feature Image</option>
				<option <?php if(isset($post_thumb) && $post_thumb == "false") : ?>selected="selected"<?php endif; ?> value="false">Videos</option>
		</select>
		</p>
		 <p><label for="<?php echo $this->get_field_id('display_limit'); ?>">Post Count</label>
			<select size="1" class="widefat" id="<?php echo $this->get_field_id('display_limit'); ?>" name="<?php echo $this->get_field_name('display_limit'); ?>">
				<?php for($i = 1; $i < 10; $i++) : ?>
					<option <?php if(isset($display_limit) && $display_limit == $i) : ?>selected="selected"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('show_dates'); ?>">
				<input type="checkbox" <?php if(isset($show_dates) && $show_dates == "on") : ?>checked="checked"<?php endif; ?> id="<?php echo $this->get_field_id('show_dates'); ?>" name="<?php echo $this->get_field_name('show_dates'); ?>">
				Show Dates
			</label>
	   </p>
		<p>
		<label for="<?php echo $this->get_field_id('show_meta'); ?>">
			<input type="checkbox" <?php if(isset($show_meta) && $show_meta == "on") : ?>checked="checked"<?php endif; ?> id="<?php echo $this->get_field_id('show_meta'); ?>" name="<?php echo $this->get_field_name('show_meta'); ?>">
			Show Video Meta (oEmbed Videos Only)
		</label>
		</p>
		<p><label for="<?php echo $this->get_field_id('auto_interval'); ?>">Auto Slide Interval (seconds)<input class="shortfat" id="<?php echo $this->get_field_id('auto_interval'); ?>" name="<?php echo $this->get_field_name('auto_interval'); ?>" type="text" value="<?php if(isset($auto_interval)) {echo $auto_interval;} ?>" /><br /><em>(Set to 0 for no auto-sliding)</em></label></p>



<?php
	} // form

}// class

//This sample widget can then be registered in the widgets_init hook:

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("feature_posts_widget");'));

?>