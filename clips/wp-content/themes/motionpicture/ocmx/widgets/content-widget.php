<?php
class ocmx_content_widget extends WP_Widget {
	/** constructor */
	function ocmx_content_widget() {
		parent::WP_Widget(false, $name = "(Obox) Content Widget", array("description" => "Home Page Widget - Display standard posts from a post category in a thumbnail column layout."));
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		 // Turn $args array into variables.
		extract( $args );
		
		// Turn $instance array into variables
		$instance_defaults = array ( 'excerpt_length' => 80, 'post_thumb' => true);
		$instance_args = wp_parse_args( $instance, $instance_defaults );
		extract( $instance_args, EXTR_SKIP );
		
		// Setup the post filter if it's defined
		if(isset($postfilter) && isset($instance[$postfilter]))
			$filterval = esc_attr($instance[$postfilter]);
		else
			$filterval = 0;	 
		
		// Setup the thumbnails
		if(isset($post_thumb) && isset($instance[$post_thumb]))
			if($post_thumb == "true"):
				$post_thumb = 1;
			else :
				$post_thumb = 0;
			endif;

		// Set the base query args
		$args = array(
			"post_type" => $posttype,
			"posts_per_page" => $post_count
		);
		
		// Filter by the chosen taxonomy
		if(isset($postfilter) && $postfilter != "" && $filterval != "0") :
			$args['tax_query'] = array(
					array(
						"taxonomy" => $postfilter,
						"field" => "slug",
						"terms" => $filterval
					)
				);
		endif;
		
		// Set the post order
		if(isset($post_order_by)) :
			$args['order'] = $post_order;
			$args['orderby'] = $post_order_by;
		endif;

		//Set the post Aguments and Query accordingly
		$count = 0;
		$ocmx_posts = new WP_Query($args);  ?>

		<div class="video-list clearfix">
			<?php if(isset($title)) : ?>
				<h4 class="widgettitle">
					<a href="<?php if(isset ($title_link)) {echo $title_link;} ?>"><?php echo $title; ?></a>
				</h4>
			<?php endif; ?>


			<ul class="<?php echo $layout_columns; ?>-column content-widget clearfix">
				<?php while ($ocmx_posts->have_posts()) : $ocmx_posts->the_post();
					global $post;
					$link = get_permalink($post->ID);
					$vid_info = array();
					$vid_info = get_post_meta($post->ID, "oembed_info", true);
					if($layout_columns == 'four') :
						$width = 195;
						$height = 112;
						$resizer = '195x112';
					elseif($layout_columns == 'three') :
						$width = 290;
						$height = 163;
						$resizer = '290x163';
					elseif($layout_columns == 'two') :
						$width = 440;
						$height = 245;
						$resizer = '440x245';
					elseif($layout_columns == 'one') :
						$width = 960;
						$height = 535;
						$resizer = '960x535';
					endif;
					$args  = array('postid' => $post->ID, 'width' => $width, 'height' => $height, 'hide_href' => false, 'exclude_video' => $post_thumb, 'imglink' => false, 'imgnocontainer' => true, 'resizer' => $resizer);

					$image = get_obox_media($args);
					if($show_images != "on" || $image == "") : $maxlen = 230; else : $maxlen = 205; endif; ?>
					<li>
						<div class="content">
							<?php if($show_images == "on" && $image !="") : ?>
								 <div class="post-image fitvid">
									<?php echo $image;?>
								 </div>
							 <?php endif; ?>

							<div class="content-copy">
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
								<h2 class="post-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h2>
								<?php // Excerpts on/off
								if(isset( $show_excerpts ) && $show_excerpts == "on" ) :
									// Check if we're using a real excerpt or the content
									if( $post->post_excerpt != "") :
										$excerpt = get_the_excerpt();
										$excerpttext = strip_tags( $excerpt );
									else :
										$content = get_the_content();
										$excerpttext = strip_tags($content);
									endif;
										
									// If the Excerpt exists, continue
									if( $excerpttext != "" ) :
										// Check how long the excerpt is
										$counter = strlen( $excerpttext );
										
										// If we've set a limit on the excerpt, put it into play
										if( !isset( $excerpt_length ) || ( isset ($excerpt_length ) && $excerpt_length == '' ) ) :
											$excerpttext = $excerpttext;
										else :
											$excerpttext = substr( $excerpttext, 0, $excerpt_length );
										endif; ?>
									
										<?php // Use an ellipsis if the excerpt is longer than the count
										if ( $excerpt_length < $counter ):
											$excerpttext .= '&hellip;';
											echo '<p>'.$excerpttext.'</p>';
										else: 
											echo '<p>'.$excerpttext.'</p>';
										endif;	?>
									
								<?php endif;
								endif; 
								 if(isset($read_more) && $read_more == "on") :
									echo '<a href="'.$link.'" class="read-more">'.__('Read More', 'ocmx').'</a>';
								endif; ?>
							</div>
						</div>

					</li>
				<?php endwhile; ?>
			</ul>

	</div>
<?php
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		$instance_defaults = array ( 'excerpt_length' => 80, 'post_thumb' => 1, 'posttype' => 'post', 'postfilter' => '0', 'post_count' => 4, 'layout_columns' => 2);
		$instance_args = wp_parse_args( $instance, $instance_defaults );
		extract( $instance_args, EXTR_SKIP );
		
		// Setup the post filter if it's defined
		if(isset($postfilter) && isset($instance[$postfilter]))
			$filterval = esc_attr($instance[$postfilter]);
		else
			$filterval = 0;	   

		$post_type_args = array("public" => true, "exclude_from_search" => false, "show_ui" => true);
		$post_types = get_post_types( $post_type_args, "objects");

?>
	<p><?php _e("Click Save after selecting each menu option to load the next option (3 total)", "ocmx"); ?></p>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>">Title<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if(isset($title)) {echo $title;} ?>" /></label>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('title_link'); ?>"><?php _e('Custom Title Link', 'ocmx'); ?><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title_link'); ?>" type="text" value="<?php if(isset($title_link)){ echo $title_link; }?>" /></label>
	</p>
   <p>
		<label for="<?php echo $this->get_field_id('posttype'); ?>"><?php _e("Display", "ocmx"); ?></label>
		<select size="1" class="widefat" id="<?php echo $this->get_field_id("posttype"); ?>" name="<?php echo $this->get_field_name("posttype"); ?>">
			<option <?php if(!isset($posttype) || $posttype == ""){echo "selected=\"selected\"";} ?> value="">--- Select a Content Type ---</option>
			<?php foreach($post_types as $post_type => $details) : ?>
				<option <?php if(isset($posttype) && $posttype == $post_type){echo "selected=\"selected\"";} ?> value="<?php echo $post_type; ?>"><?php echo $details->labels->name; ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<?php if($posttype != "") :
		if($posttype != "page") :
			$taxonomyargs = array('post_type' => $posttype, "public" => true, "exclude_from_search" => false, "show_ui" => true); 
			$taxonomies = get_object_taxonomies($taxonomyargs,'objects');
			if(is_array($taxonomies) && !empty($taxonomies)) : ?>
				<p>
					<label for="<?php echo $this->get_field_id('postfilter'); ?>"><?php _e("Filter by", "ocmx"); ?></label>
					<select size="1" class="widefat" id="<?php echo $this->get_field_id("postfilter"); ?>" name="<?php echo $this->get_field_name("postfilter"); ?>">
						<option <?php if($postfilter == ""){echo "selected=\"selected\"";} ?> value="">--- Select a Filter ---</option>
						<?php foreach($taxonomies as $taxonomy => $details) : ?>
							<option <?php if($postfilter == $taxonomy){echo "selected=\"selected\"";} ?> value="<?php echo $taxonomy; ?>"><?php echo $details->labels->name; ?></option>
						<?php $validtaxes[] = $taxonomy;
						endforeach; ?>
					</select>
				</p>
			<?php endif; // !empty($taxonomies)
			
			if(isset($validtaxes) && $postfilter != "" && ( (is_array($validtaxes) && in_array($postfilter, $validtaxes)) || !is_array($validtaxes) ) ) :
				$tax = get_taxonomy($postfilter);
				$terms = get_terms($postfilter, "orderby=count&hide_empty=0"); ?>
				<p><label for="<?php echo $this->get_field_id($postfilter); ?>"><?php echo $tax->labels->name; ?></label>
				   <select size="1" class="widefat" id="<?php echo $this->get_field_id($postfilter); ?>" name="<?php echo $this->get_field_name($postfilter); ?>">
						<option <?php if($filterval == 0){echo "selected=\"selected\"";} ?> value="0">All</option>
						<?php foreach($terms as $term => $details) :?>
							<option  <?php if($filterval == $details->slug){echo "selected=\"selected\"";} ?> value="<?php echo $details->slug; ?>"><?php echo $details->name; ?></option>
						<?php endforeach;?>
					</select>
				</p>
			<?php endif; // isset($postfilter) && $postfilter != ""
		 endif;  // $posttype != "page"
	endif;  // $posttype != "" ?>
	<p>
		<label for="<?php echo $this->get_field_id('layout_columns'); ?>">Column Layout</label>
		<select size="1" class="widefat" id="<?php echo $this->get_field_id('layout_columns'); ?>" name="<?php echo $this->get_field_name('layout_columns'); ?>">
				<option <?php if(isset($layout_columns) && $layout_columns == "one") : ?>selected="selected"<?php endif; ?> value="one">1</option>
				<option <?php if(isset($layout_columns) && $layout_columns == "two") : ?>selected="selected"<?php endif; ?> value="two">2</option>
				<option <?php if(isset($layout_columns) && $layout_columns == "three") : ?>selected="selected"<?php endif; ?> value="three">3</option>
				<option <?php if(isset($layout_columns) && $layout_columns == "four") : ?>selected="selected"<?php endif; ?> value="four">4</option>
		</select>
	</p>


	<p>
		<label for="<?php echo $this->get_field_id('post_count'); ?>">Post Count</label>
		<select size="1" class="widefat" id="<?php echo $this->get_field_id('comment_count'); ?>" name="<?php echo $this->get_field_name('post_count'); ?>">
			<?php $i = 1;
			while($i < 13) :?>
				<option <?php if(isset($post_count) && $post_count == $i) : ?>selected="selected"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php if($i < 1) :
					$i++;
				else:
					$i=($i+1);
				endif;
			endwhile; ?>
		</select>
	</p>
	<?php  // Setup the order values
	$order_params = array("date" => "Post Date", "title" => "Post Title", "rand" => "Random",  "comment_count" => "Comment Count",  "menu_order" => "Menu Order"); ?> 
	<p>
		<label for="<?php echo $this->get_field_id('post_order_by'); ?>"><?php _e("Order By", "ocmx"); ?></label>
		<select size="1" class="widefat" id="<?php echo $this->get_field_id('post_order_by'); ?>" name="<?php echo $this->get_field_name('post_order_by'); ?>">
			<?php foreach($order_params as $value => $label) :?>
				<option  <?php if(isset($post_order_by) && $post_order_by == $value){echo "selected=\"selected\"";} ?> value="<?php echo $value; ?>"><?php echo $label; ?></option>
			<?php endforeach;?>
		</select>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('post_order'); ?>"><?php _e("Order", "ocmx"); ?></label>
		<select size="1" class="widefat" id="<?php echo $this->get_field_id('post_order'); ?>" name="<?php echo $this->get_field_name('post_order'); ?>">
			<option <?php if(!isset($post_order) || isset($post_order) && $post_order == "DESC") : ?>selected="selected"<?php endif; ?> value="DESC"><?php _e("Descending", 'ocmx'); ?></option>
			<option <?php if(isset($post_order) && $post_order == "ASC") : ?>selected="selected"<?php endif; ?> value="ASC"><?php _e("Ascending", 'ocmx'); ?></option>
		</select>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('show_images'); ?>">
			<input type="checkbox" <?php if(isset($show_images) && $show_images == "on") : ?>checked="checked"<?php endif; ?> id="<?php echo $this->get_field_id('show_images'); ?>" name="<?php echo $this->get_field_name('show_images'); ?>">
			Enable Images/Videos
		</label>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('post_thumb'); ?>">Thumbnails</label>
		<select size="1" class="widefat" id="<?php echo $this->get_field_id('post_thumb'); ?>" name="<?php echo $this->get_field_name('post_thumb'); ?>">
			<option <?php if(isset($post_thumb) && $post_thumb == "true") : ?>selected="selected"<?php endif; ?> value="true">Featured Image</option>
			<option <?php if(isset($post_thumb) && $post_thumb == "false") : ?>selected="selected"<?php endif; ?> value="false">Videos</option>
		</select>
		<small>If no thumbnail is found, the video is shown as a fallback for video posts.</small>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('show_meta'); ?>">
			<input type="checkbox" <?php if(isset($show_meta) && $show_meta == "on") : ?>checked="checked"<?php endif; ?> id="<?php echo $this->get_field_id('show_meta'); ?>" name="<?php echo $this->get_field_name('show_meta'); ?>">
			Show Video Meta (oEmbed Videos Only)
		</label>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('show_dates'); ?>">
			<input type="checkbox" <?php if(isset($show_dates) && $show_dates == "on") : ?>checked="checked"<?php endif; ?> id="<?php echo $this->get_field_id('show_dates'); ?>" name="<?php echo $this->get_field_name('show_dates'); ?>">
			Show Published Date?
		</label>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('show_excerpts'); ?>">
			<input type="checkbox" <?php if(isset($show_excerpts) && $show_excerpts == "on") : ?>checked="checked"<?php endif; ?> id="<?php echo $this->get_field_id('show_excerpts'); ?>" name="<?php echo $this->get_field_name('show_excerpts'); ?>">
			Show Excerpts
		</label>
	</p>

	<p><label for="<?php echo $this->get_field_id('excerpt_length'); ?>">Excerpt Length (character count)<input class="shortfat" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" type="text" value="<?php if(isset($excerpt_length)) { echo $excerpt_length;} ?>" /><br /></label></p>


<?php
	} // form

}// class

//This sample widget can then be registered in the widgets_init hook:

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("ocmx_content_widget");'));

?>