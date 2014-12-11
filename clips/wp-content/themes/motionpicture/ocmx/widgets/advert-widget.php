<?php
class ocmx_small_ad_widget extends WP_Widget {
    /** constructor */
    function ocmx_small_ad_widget() {
		$widget_ops = array('classname' => 'adverts-125 column' );
		$this->WP_Widget('ocmx_small_ad_widget', __("(Obox) 125px Adverts"), $widget_ops);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
		global $alt;
		if(isset($instance["title"]))
			$title = $instance["title"];
		?>
		
        <?php echo $before_widget;
			if(isset($title) && $title !="") : 
				echo $before_title; 
					echo $title; 
				echo $after_title; 
			endif; 
            if(get_option("ocmx_small_ads") != "0") : ?>
           <ul>
                <?php for ($i = 1; $i <= get_option("ocmx_small_ads"); $i++)
                    {
                        $ad_title_id = "ocmx_small_ad_title_".$i;
                        $ad_link_id = "ocmx_small_ad_link_".$i;
                        $ad_img_id ="ocmx_small_ad_img_".$i;
                        $ad_script_id ="ocmx_small_ad_script_".$i; ?>
                        <li class="advert">
                            <?php if(get_option($ad_script_id) !== "") :
                                echo stripslashes(get_option($ad_script_id));                                
                            elseif(get_option($ad_img_id) !== "") : ?>
                                <a href="<?php echo get_option($ad_link_id); ?>" class="sponsor-item" title="<?php echo get_option($ad_title_id); ?>" rel="nofollow">
                                    <img src="<?php echo get_option($ad_img_id); ?>" alt="<?php echo get_option($ad_title_id); ?>" />
                                </a>
                            <?php endif; ?>
                        </li>
                        <?php if($alt == "1") :
                            $alt = 0;
                        else :
                            $alt = 1;
                        endif;
                    }	?>
            </ul>
            <?php endif; ?>
        <?php echo $after_widget; ?>
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
		?>
        	<p><label for="<?php echo $this->get_field_id('title'); ?>">Title<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if(isset($title)) { echo $title; }?>" /></label></p>
        	<p><em>You can modify your sidebar ads in the <a href="admin.php?page=ocmx-adverts">Theme Options</a> panel</em></p>
        <?php 
    }

} // class FooWidget

//This sample widget can then be registered in the widgets_init hook:

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("ocmx_small_ad_widget");'));

?>