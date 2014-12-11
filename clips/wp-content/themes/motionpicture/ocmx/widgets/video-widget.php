<?php
class video_widget extends WP_Widget {
    /** constructor */
    function video_widget() {
		$widget_ops = array('classname' => 'latest-videos', 'description' => __( "Display your videos in a neat fading widget.") );
		$this->WP_Widget('video_widget', __("(Obox) Videos"), $widget_ops);	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
		global $wpdb;
		if(isset($instance["title"]))
        	$title = esc_attr($instance["title"]);
		if(isset($instance["video_images"]))
			$video_images = esc_attr($instance["video_images"]);
		if(isset($instance["post_count"]))
			$post_count = esc_attr($instance["post_count"]);
		$use_category = $instance["post_category"];
		if($use_category == "0") :
			$use_cat = 0;
			$cat_title = "no";
		else :
			$use_cat = get_category_by_slug($use_category);
			$catlink = get_category_link($use_cat->term_id);		
			$cat_id = "cat=".$use_cat->term_id."&";
			$the_cat_title = $use_cat->name;
		endif;
		if(isset($instance["post_thumb"]))
			$post_thumb = esc_attr($instance["post_thumb"]);
		if($post_thumb == "true"):
			$post_thumb = 1;
		else :
			$post_thumb = 0;		
		endif;
 			$post_query = new WP_Query($cat_id."posts_per_page=".$post_count); 
			
		//Set the post Aguments and Query accordingly
		$count = 1; ?>
	
   	<li class="widget latest-videos">
	  <?php if($title !="" ) : ?><h4 class="widgettitle"><?php echo $title;?></h4><?php endif; ?> 
      	<div class="content">
            <?php while ($post_query->have_posts()) : $post_query->the_post();
				global $post;
				$link = get_permalink($post->ID);
				$args  = array('postid' => $post->ID, 'width' => 280, 'height' => 154, 'hide_href' => false, 'exclude_video' => $post_thumb, 'resizer' => '290x163');
				$url = get_post_meta($post->ID, "video_link", true);
				$vid_info = video_info($url);
				$image = get_obox_media($args); ?>   
				<div id="video_widget_<?php echo $count; ?>">
					<?php if( $image !="" ) : ?> 
                        <div class="post-image fitvid">
                        	<?php echo $image;?>
                        </div>     
                    <?php endif; ?>       
				</div>
		   <?php $count++;
		   endwhile;
		   $count = 1;?>
		</div>
        <ul class="pagination">
            <?php while ($post_query->have_posts()) : global $post; $post_query->the_post();
				$link = get_permalink($post->ID); ?>
                <li class="video-title" style="<?php if($count !== 1) : ?>display: none;<?php else : ?>display: block;<?php endif; ?>" rel="#video_widget_<?php echo $count; ?>"><a href="<?php echo $link; ?>"><?php echo substr($post->post_title, 0, 33); if(strlen($post->post_title > 33)){echo "...";} ?></a></li>
                <?php $count++;
           endwhile; ?>
            <li class="previous"><a href=""><?php _e("Previous", "ocmx"); ?></a></li>
            <li class="next"><a href=""><?php _e("Next", "ocmx"); ?></a></li>
        </ul>
	</li>
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
		if(isset($instance["post_count"]))
			$post_count = $instance["post_count"];
		if(isset($instance["show_images"]))
			$show_images = $instance["show_images"];
		if(isset($instance["post_category"]))
 	       	$post_category = $instance["post_category"];
        if(isset($instance["post_thumb"]))
			$post_thumb = $instance["post_thumb"];
?>
       <p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title","ocmx") ?><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if(isset($title)) {echo $title;} ?>" /></label>
	</p>
	
           <p>
   		<label for="<?php echo $this->get_field_id('post_category'); ?>"><?php _e("Category","ocmx") ?></label>
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
                            if($use_value == $post_category)
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
    
    <p>
        <label for="<?php echo $this->get_field_id('post_thumb'); ?>">Thumbnails</label>
        <select size="1" class="widefat" id="<?php echo $this->get_field_id('post_thumb'); ?>" name="<?php echo $this->get_field_name('post_thumb'); ?>">
				<option <?php if(isset($post_thumb) && $post_thumb == "true") : ?>selected="selected"<?php endif; ?> value="true">Post Feature Image</option>
				<option <?php if(isset($post_thumb) && $post_thumb == "false") : ?>selected="selected"<?php endif; ?> value="false">Videos</option>
        </select>
    </p>
<?php 
	} // form

}// class

//This sample widget can then be registered in the widgets_init hook:

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("video_widget");'));

?>