<?php 
require_once(TEMPLATEPATH.'/lib/init.php');
/********************************************************************
Mobile Detect
********************************************************************/
class uagent_info
{
   var $useragent = "";
   var $httpaccept = ""; 
   var $true = 1;
   var $false = 0;
   var $deviceIphone = 'iphone';
   var $deviceIpod = 'ipod';
   var $deviceAndroid = 'android';
   var $deviceBlackberry = 'blackberry';
   function uagent_info()
   { 
       $this->useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
       $this->httpaccept = strtolower($_SERVER['HTTP_ACCEPT']);
   }
   function Get_Uagent()
   { 
       return $this->useragent;
   }
   function DetectIphone()
   {
      if (stripos($this->useragent, $this->deviceIphone) > -1)
      {
         //The iPod touch says it's an iPhone! So let's disambiguate.
         if ($this->DetectIpod() == $this->true)
         {
            return $this->false;
         }
         else
            return $this->true; 
      }
      else
         return $this->false; 
   }
   function DetectAndroid()
   {
      if (stripos($this->useragent, $this->deviceAndroid) > -1)
      {
            return $this->true; 
      }
      else
         return $this->false; 
   }
   function DetectBlackberry()
   {
      if (stripos($this->useragent, $this->deviceBlackberry) > -1)
      {
            return $this->true; 
      }
      else
         return $this->false; 
   }
}
$uagent_obj = new uagent_info();
$iphone = $uagent_obj->DetectIphone();
$android = $uagent_obj->DetectAndroid();
$blackberry = $uagent_obj->DetectBlackberry();
/********************************************************************
Custom breadcrumb
********************************************************************/
add_filter('genesis_breadcrumb_args', 'custom_breadcrumb_args');
function custom_breadcrumb_args($args) {
	$args['labels']['prefix'] = __('', 'genesis'); 
	$args['labels']['author'] = __('','genesis');
	$args['labels']['tag'] = __('','genesis');
	$args['labels']['category'] = __('','genesis');
	$args['labels']['date'] = __('','genesis');
	$args['labels']['tax'] = __('','genesis');
	$args['home'] = __('Trang chủ', 'genesis');
	$args['labels']['search'] = __('Kết quả tìm kiếm cho từ khóa ','genesis');
    return $args;
}
/********************************************************************
Deregister Jquery
********************************************************************/
add_action( 'wp_print_scripts', 'child_scripts_cdn', 100 );
function child_scripts_cdn() {
if ( !is_admin() ) {
	//wp_deregister_script( 'jquery' );
}}
/********************************************************************
Top
********************************************************************/
add_action ('genesis_after_header', 'top');
function top() { 
if(is_home()){ ?>
	<div id="top">
    	<div class="wrap">
            <?php if ( ! dynamic_sidebar( 'feature' ) ) : ?><?php endif; // end feature widget area ?>
            <?php if ( ! dynamic_sidebar( 'latest' ) ) : ?><?php endif; // end latest widget area ?>
            <?php if ( ! dynamic_sidebar( 'top_banners' ) ) : ?><?php endif; // end top banners widget area ?>
        </div>
    </div>
<?php
}
}
/********************************************************************
Custom header
********************************************************************/
remove_action('genesis_header', 'genesis_do_header');
add_action ('genesis_header', 'custom_header');
function custom_header() { ?>
    <h1><a title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" href="<?php echo home_url( '/' ); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a></h1>
    <?php if ( ! dynamic_sidebar( 'header-right' ) ) : ?><?php endif; // end header banner widget area ?>
<?php
}
/********************************************************************
Custom Footer
********************************************************************/
remove_action('genesis_after_header', 'genesis_do_subnav');
add_action('genesis_footer', 'genesis_do_subnav');
remove_action('genesis_footer', 'genesis_do_footer');
add_action ('genesis_footer', 'custom_footer');
function custom_footer() { ?>
	<p class="copyright">&copy; 2012 <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> | All rights reserved.</p>
<?php
}
/********************************************************************
Change Doctype HTML5
********************************************************************/
remove_action('genesis_doctype', 'genesis_do_doctype');
add_action('genesis_doctype', 'custom_do_doctype');
function custom_do_doctype() { 
?>
<!DOCTYPE html> 
<html lang="en">                      
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<?php
}
/********************************************************************
Unregister layout
********************************************************************/
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'full-width-content' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
/********************************************************************
Custom Loop
********************************************************************/
remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'genesis_do_loop_1');
function genesis_do_loop_1() {
	if(is_home()){
		include CHILD_DIR. '/inc/home_loop.php';
	}elseif(is_archive()){
		include CHILD_DIR. '/inc/archive_loop.php';
	}elseif(is_search()){
		include CHILD_DIR. '/inc/search_loop.php';
	}elseif(is_single()){
		include CHILD_DIR. '/inc/single_loop.php';
	}elseif(is_page()){
		include CHILD_DIR. '/inc/page_loop.php';
	}else {
		genesis_standard_loop();
	}
}
/********************************************************************
Modify the speak your mind text
********************************************************************/
add_filter( 'genesis_comment_form_args', 'custom_comment_form_args' );
function custom_comment_form_args($args) {
    $args['title_reply'] = 'Gửi phản hồi';
    return $args;
}
/********************************************************************
Modify comments header text in comments 
********************************************************************/
add_filter( 'genesis_title_comments', 'custom_genesis_title_comments' );
function custom_genesis_title_comments() { ?>
    <h3><?php comments_number(__('Chưa có phản hồi nào, hãy là người đầu tiên <a href="#respond">gửi một phản hồi</a> ','genesis'), __('Đã có 1 phản hồi | <a href="#respond">Gửi một phản hồi</a>','genesis'), __('Đã có % phản hồi | <a href="#respond">Gửi một phản hồi</a>','genesis') ) ?></h3>
<?php
}
/********************************************************************
Modify the comment says text
********************************************************************/
add_filter( 'comment_author_says_text', 'custom_comment_author_says_text' );
function custom_comment_author_says_text() {
    return 'nói';
}
/********************************************************************
Excerpt Word Limit
********************************************************************/
function excerpt($num) {
	$link = get_permalink();
	$ending = get_option('wl_excerpt_ending');
	$limit = $num+1;
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	array_pop($excerpt);
	$excerpt = implode(" ",$excerpt).$ending;
	echo $excerpt;
	$readmore = get_option('wl_readmore_link');
	if($readmore!="") {
		$readmore = '<p class="readmore"><a href="'.$link.'">'.$readmore.'</a></p>';
		echo $readmore;
	}
}
/********************************************************************
Feature Widget
********************************************************************/
class slider extends WP_Widget {
	function slider() {
	//Constructor
		$widget_ops = array('classname' => 'feature', 'description' => 'Feature Articles' );		
		$this->WP_Widget('widget_slider', 'vPress Featured', $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$category = empty($instance['category']) ? '' : apply_filters('widget_category', $instance['category']);
		echo $before_widget;
		?>
			<?php $feature = new WP_query('showposts=1&cat='.$category) ?>
            <?php while ($feature->have_posts()) : $feature->the_post();?>
                <div class="hot-news">
                    <?php img2(250,190) ?>
                    <h1><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
                    <?php the_excerpt() ?>
                </div>
            <?php  endwhile; ?>
            <ul>
            <?php $others = new WP_query('showposts=3&offset=1&cat='.$category) ?>
            <?php while ($others->have_posts()) : $others->the_post();?>
                <li>
                    <?php img2(159,124) ?>
                    <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                </li>
            <?php  endwhile; ?>
            </ul>
		<?php
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['category'] = ($new_instance['category']);		
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'post_number' => '', 'category' => '' ) );		
		$category = strip_tags($instance['category']);		
	?>
		<p><label for="<?php echo $this->get_field_id('category'); ?>">Select Category:</label>      
        <select name="<?php echo $this->get_field_name('category'); ?>" id="<?php echo $this->get_field_id('category'); ?>" style="width:170px">
        <?php $categories = get_categories('hide_empty=1');
        foreach ($categories as $cat) {
        if ($category == $cat->cat_ID) { $selected = ' selected="selected"'; } else { $selected = ''; }
        $opt = '<option value="' . $cat->cat_ID . '"' . $selected . '>' . $cat->cat_name . '</option>';
        echo $opt; } ?>
        </select>
        </p>  
<?php
	}
}
register_widget('slider');
/********************************************************************
Magic Widget
********************************************************************/
class magic extends WP_Widget {
	function magic() {
	//Constructor
		$widget_ops = array('classname' => 'magic', 'description' => 'Magic Box widget' );		
		$this->WP_Widget('widget_magic', 'vPress Magic Box', $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$title = apply_filters('widget_title', $instance['title'] );
		$category = empty($instance['category']) ? '' : apply_filters('widget_category', $instance['category']);
		$type = $instance['type'];
		$number = $instance['number'];
		echo $before_widget;
		if ( $title ){
			echo $before_title . $title . $after_title;}
		?>
        	<?php if($type =='photo'){ ?>
            	<div class="photo">
					<?php
                        $magic = new WP_query('showposts=1&cat='.$category); 
                        while ($magic->have_posts()) : $magic->the_post();
                    ?>
                    	<div class="img">
                        <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                        <?php img2(318,170) ?>
                        </div>
            		<?php  endwhile; ?>
                    <?php if ( $number !== '0' ) { ?>
                    <ul>
                    <?php $others = new WP_query('showposts='.$number.'&offset=1&cat='.$category) ?>
                    <?php while ($others->have_posts()) : $others->the_post();?>
                        <li>
                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                        </li>
                    <?php  endwhile;
					}?>
                    </ul>
              	</div>
        	<?php }else{ ?>
            	<div class="video">
					<?php
                        $magic = new WP_query('showposts=1&cat='.$category); 
                        while ($magic->have_posts()) : $magic->the_post();
                    ?>
                    	<div>
                            <?php
							global $post;
							if( get_post_meta($post->ID, 'video', true)){ ?>
                            	<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                            	<?php echo get_post_meta($post->ID, 'video', true) ?>
                            <?php }else{ ?>
                            	<p>Bạn cần chọn chuyên mục mà bài viết có sử dụng custom field: video</p>
                            <?php } ?>
                       	</div>
            		<?php  endwhile; ?>
                    <?php if ( $number !== '0' ) { ?>
                    	<ul>
						<?php $others = new WP_query('showposts='.$number.'&offset=1&cat='.$category) ?>
                        <?php while ($others->have_posts()) : $others->the_post();?>
                            <li>
                                <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                            </li>
                        <?php  endwhile; ?>
                        </ul>
					<?php }?>
                    
              	</div>
            <?php }?>
		<?php
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['category'] = ($new_instance['category']);
		$instance['title'] = strip_tags( $new_instance['title'] );	
		$instance['type'] = strip_tags( $new_instance['type'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$defaults = array( 'title' => __('Magic Box', 'genesis'),'number' => __('2', 'genesis'));
		$instance = wp_parse_args( (array) $instance, $defaults );
		$category = strip_tags($instance['category']);		
	?>
    	<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'genesis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
    	<p><label for="<?php echo $this->get_field_id('type'); ?>">Select type:</label>     
        <select name="<?php echo $this->get_field_name('type'); ?>" id="<?php echo $this->get_field_id('type'); ?>" style="width:170px">
            <option <?php if ( 'photo' == $instance['type'] ) echo ' selected="selected"'; ?>>photo</option>
            <option <?php if ( 'video' == $instance['type'] ) echo ' selected="selected"'; ?>>video</option>
        </select>   
        </p>  
		<p><label for="<?php echo $this->get_field_id('category'); ?>">Select Category        
        <select name="<?php echo $this->get_field_name('category'); ?>" id="<?php echo $this->get_field_id('category'); ?>" style="width:170px">
        <?php $categories = get_categories('hide_empty=1');
        foreach ($categories as $cat) {
        if ($category == $cat->cat_ID) { $selected = ' selected="selected"'; } else { $selected = ''; }
        $opt = '<option value="' . $cat->cat_ID . '"' . $selected . '>' . $cat->cat_name . '</option>';
        echo $opt; } ?>
        </select>
        </p>  
        <p><label for="<?php echo $this->get_field_id('number'); ?>">Select number post:</label>
        <select name="<?php echo $this->get_field_name('number'); ?>" id="<?php echo $this->get_field_id('number'); ?>" style="width:50px">
			<option <?php if ( '0' == $instance['number'] ) echo ' selected="selected"'; ?>>0</option>
			<?php for($i=1;$i<9;$i++) { 
                if ($i == $instance['number']) {
                    echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
                } else {
                    echo '<option value="'.$i.'">'.$i.'</option>';
                }
                    
            } ?>
        </select>   
<?php
	}
}
register_widget('magic');
/********************************************************************
Latest Widget
********************************************************************/
class latest extends WP_Widget {
	function latest() {
	//Constructor
		$widget_ops = array('classname' => 'latest', 'description' => 'Latest posts' );		
		$this->WP_Widget('widget_latest', 'vPress Latest', $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$number = $instance['number'];
		echo $before_widget;
		?>
        	<ul id="latest">
			<?php $latest = new WP_query('showposts='.$number) ?>
            <?php while ($latest->have_posts()) : $latest->the_post();?>
                <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
            <?php  endwhile; ?>
            </ul>
		<?php
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['number'] = strip_tags( $new_instance['number'] );		
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$defaults = array( 'number' => __('10', 'genesis') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>	
		<p><label for="<?php echo $this->get_field_id('number'); ?>">Select number post:</label>
        <select name="<?php echo $this->get_field_name('number'); ?>" id="<?php echo $this->get_field_id('number'); ?>" >
			<?php for($i=1;$i<15;$i++) { 
                if ($i == $instance['number']) {
                    echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
                } else {
                    echo '<option value="'.$i.'">'.$i.'</option>';
                }            
            } ?>
        </select>       
        </p>  
<?php
	}
}
register_widget('latest');
/********************************************************************
Category Widget
********************************************************************/
class cat extends WP_Widget {
	function cat() {
	//Constructor
		$widget_ops = array('classname' => '', 'description' => 'Category posts' );		
		$this->WP_Widget('widget_cat', 'vPress Category', $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$category = empty($instance['category']) ? '' : apply_filters('widget_category', $instance['category']);
		echo $before_widget;
		?>
            <div class="cat-title">
                <h4><a href="<?php echo get_category_link($category); ?>"><?php echo get_cat_name($category); ?></a></h4>
                <ul>
                    <?php wp_list_categories('title_li=&show_option_none=&depth=1&child_of='.$category); ?> 
                </ul>
            </div>
            <div class="entry-content">
                <?php $feature = new WP_query('showposts=1&cat='.$category);  ?>
                <?php while ($feature->have_posts()) : $feature->the_post(); ?>
                <div>
                    <?php img2(130,100); ?>
                    <h3 ><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'vnh' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                    <p><?php excerpt(30); ?></p>
                </div>
                <?php endwhile; //end first news ?>
                <ul class="other">
                    <?php $more = new WP_query(); $more->query('showposts=1&offset=1&cat='.$category); ?>
                    <?php while ($more->have_posts()) : $more->the_post(); ?>
                    <li>
                    <?php img2(40,40); ?>
                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'vnh' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title() ?></a></li>
                    <?php endwhile; ?>
                    <?php $more = new WP_query(); $more->query('showposts=2&offset=2&cat='.$category); ?>
                    <?php while ($more->have_posts()) : $more->the_post(); ?>
                    <li class="other1" ><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'vnh' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title() ?></a></li>
                    <?php endwhile; ?>
                </ul><!--/other news-->
            </div>
		<?php
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['category'] = ($new_instance['category']);		
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'post_number' => '', 'category' => '' ) );		
		$category = strip_tags($instance['category']);		
	?>
		<p><label for="<?php echo $this->get_field_id('category'); ?>">Select Category </label>      
        <select name="<?php echo $this->get_field_name('category'); ?>" id="<?php echo $this->get_field_id('category'); ?>" style="width:170px">
        <?php $categories = get_categories('hide_empty=1');
        foreach ($categories as $cat) {
        if ($category == $cat->cat_ID) { $selected = ' selected="selected"'; } else { $selected = ''; }
        $opt = '<option value="' . $cat->cat_ID . '"' . $selected . '>' . $cat->cat_name . '</option>';
        echo $opt; } ?>
        </select>
        </p>  
<?php
	}
}
register_widget('cat');
/********************************************************************
Weather - Gold - Forex Widget
********************************************************************/
class weather_gold_forex extends WP_Widget {
	function weather_gold_forex() {
	//Constructor
		$widget_ops = array('classname' => 'weather_gold_forex', 'description' => 'weather, gold, forex widget' );		
		$this->WP_Widget('widget_weather_gold_forex', 'vPress WGF', $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$city = $instance['city'];
		echo $before_widget;
		?>
            <div id="weather">
                <h4>Thời tiết 
				<?php if ($city == 'hanoi'){ echo 'Hà Nội';}elseif($city == 'danang'){echo 'Đà Nẵng';}elseif($city == 'hochiminh'){echo ' TP Hồ Chí Minh';} ?>
                </h4>
                <script  type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/weather.min.js"></script>
                <script type="text/javascript">
                showWeather('<?php echo $city; ?>, vietnam');
                </script>
            </div>
            <div id="gold_forex">
                <div class="gold">
                    <h4>Giá vàng 9999</h4>
                    <span>ĐVT: tr.đ/lượng</span>
                    <script type="text/javascript" src="http://vnexpress.net/Service/Gold_Content.js"></script>
                    <script type="text/javascript">
                    document.write("<table><tr><td>Loại</td><td >Mua</td><td >Bán</td></tr><tr><td>SJC</td><td>"+ vGoldSjcBuy +"</td><td>"+ vGoldSjcSell +"</td></tr></table>");
                    </script>
                    <!--<a class="by" target="_blank" href="http://www.sacombank-sbj.com">Sacombank</a>-->
                </div>
                <div class="forex">
                    <h4>Tỷ giá</h4>
                    <script type="text/javascript" src="http://vnexpress.net/Service/Forex_Content.js"></script>
                    <script type="text/javascript">
                    document.write("<table><tr><td>"+ vForexs[0] +"</td><td>"+ vCosts[0]+" </td></tr>");
                    document.write("<tr><td>"+ vForexs[1] +"</td><td>"+ vCosts[1] +"</td></tr>");
                    document.write("<tr><td>"+ vForexs[2] +"</td><td>"+ vCosts[2] +"</td></tr></table>");
                    </script>
                    <!--<a class="by" target="_blank" href="http://www.eximbank.com.vn">eximbank</a>-->
                </div>
            </div>
		<?php
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;	
		$instance['city'] = ($new_instance['city']);	
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$defaults = array( 'city' => __('hanoi', 'genesis') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>	     
        <p><label for="<?php echo $this->get_field_id('city'); ?>">Select city:</label>        
        <select name="<?php echo $this->get_field_name('city'); ?>" id="<?php echo $this->get_field_id('city'); ?>" style="width:170px">
            <option <?php if ( 'hanoi' == $instance['city'] ) echo ' selected="selected"'; ?>>hanoi</option>
            <option <?php if ( 'danang' == $instance['city'] ) echo ' selected="selected"'; ?>>danang</option>
            <option <?php if ( 'hochiminh' == $instance['city'] ) echo ' selected="selected"'; ?>>hochiminh</option>
        </select>   
        </p> 
<?php
	}
}
register_widget('weather_gold_forex');
/********************************************************************
Stock Widget
********************************************************************/
class stock extends WP_Widget {
	function stock() {
	//Constructor
		$widget_ops = array('classname' => 'stock', 'description' => 'stock widget' );		
		$this->WP_Widget('widget_stock', 'vPress Stock', $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$title = apply_filters('widget_title', $instance['title'] );
		echo $before_widget;
		if ( $title ){
			echo $before_title . $title . $after_title;
		}
		?>
            <div><img src="http://vnexpress.net/Images/Stock/chartho.png" alt="stock" /></div>
		<?php
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );		
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$defaults = array( 'title' => __('Giá chứng khoán', 'genesis'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>	
        <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'genesis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text"/>
		</p>
<?php
	}
}
register_widget('stock');
/********************************************************************
Define Genesis Options  >>> don't work
add_filter('genesis_options', 'define_genesis_setting_custom', 10, 2);
function define_genesis_setting_custom($options, $setting) {
    if($setting == GENESIS_SETTINGS_FIELD) {
        $options['update'] = 1;
        $options['blog_title'] = 'text';
        $options['header_right'] = 1;
        $options['site_layout'] = 'content-sidebar-sidebar';
        $options['nav'] = 1;
        $options['nav_superfish'] = 1;
        $options['nav_home'] = 1;
        $options['nav_type'] = 'pages';
        $options['nav_pages_sort'] = 'menu_order';
        $options['nav_categories_sort'] = 'name';
        $options['nav_depth'] = 0;
        $options['nav_extras_enable'] = 0;
        $options['nav_extras'] = 'date';
        $options['nav_extras_twitter_id'] = '';
        $options['nav_extras_twitter_text'] = 'Follow me on Twitter';
        $options['subnav'] = 1;
        $options['subnav_superfish'] = 0;
        $options['subnav_home'] = 0;
        $options['subnav_type'] = 'categories';
        $options['subnav_pages_sort'] = 'menu_order';
        $options['subnav_categories_sort'] = 'name';
        $options['subnav_depth'] = 1;
        $options['feed_uri'] = '';
        $options['comments_feed_uri'] = '';
        $options['redirect_feeds'] = 0;
        $options['comments_pages'] = 0;
        $options['comments_posts'] = 1;
        $options['trackbacks_pages'] = 0;
        $options['trackbacks_posts'] = 1;
        $options['author_box_single'] = 1;
        $options['breadcrumb_home'] = 0;
        $options['breadcrumb_single'] = 1;
        $options['breadcrumb_page'] = 1;
        $options['breadcrumb_archive'] = 1;
        $options['breadcrumb_404'] = 1;
        $options['content_archive'] = 'full';
        $options['content_archive_thumbnail'] = 0;
        $options['posts_nav'] = 'older-newer';
        $options['blog_cat'] = '';
        $options['blog_cat_exclude'] = '';
        $options['blog_cat_num'] = 10;
        $options['header_scripts'] = '';
        $options['footer_scripts'] = '';
        $options['theme_version'] = PARENT_THEME_VERSION;
        }
    return $options;
}
********************************************************************/
/********************************************************************
Register Widgets
********************************************************************/
register_sidebar( array(
		'name' => __( 'Feature Widget Area', 'genesis' ),
		'id' => 'feature',
		'description' => __( 'The feature widget area', 'genesis' ),
		'before_widget' => '<div id="feature" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
register_sidebar( array(
		'name' => __( 'Latest Widget Area', 'genesis' ),
		'id' => 'latest',
		'description' => __( 'The latest widget area', 'genesis' ),
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
register_sidebar( array(
		'name' => __( 'Top Banners Widget Area', 'genesis' ),
		'id' => 'top_banners',
		'description' => __( 'The top banners widget area', 'genesis' ),
		'before_widget' => '<div id="%1$s" class="top-banners widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	) );
register_sidebar( array(
		'name' => __( 'Category Widget Area', 'genesis' ),
		'id' => 'cat',
		'description' => __( 'The Category widget area', 'genesis' ),
		'before_widget' => '<li id="%1$s" class="cat %2$s">',
		'after_widget' => '</li>',
	) );
/** Remove Genesis widgets */
add_action( 'widgets_init', 'remove_genesis_widgets', 20 );
function remove_genesis_widgets() {
    unregister_widget( 'Genesis_eNews_Updates' );
    unregister_widget( 'Genesis_Featured_Page' );
    unregister_widget( 'Genesis_User_Profile_Widget' );
    unregister_widget( 'Genesis_Menu_Pages_Widget' );
    unregister_widget( 'Genesis_Widget_Menu_Categories' );
    unregister_widget( 'Genesis_Featured_Post' );
    unregister_widget( 'Genesis_Latest_Tweets_Widget' );
}
/********************************************************************
Page navigation
********************************************************************/
function page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 8;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
	echo $before.'<div class="page_navi">'."\n";
	if ($start_page >= 2 && $pages_to_show < $max_page) {
		$first_page_text = "First";
		echo '<a href="'.get_pagenum_link().'" title="'.$first_page_text.'">'.$first_page_text.'</a>';
	}
	previous_posts_link('&laquo;');
	for($i = $start_page; $i  <= $end_page; $i++) {						
		if($i == $paged) {
			echo '<span class="current">'.$i.'</span>';
		} else {
			echo '<a href="'.get_pagenum_link($i).'">'.$i.'</a>';
		}
	}
	next_posts_link('&raquo;');
	if ($end_page < $max_page) {
		$last_page_text = "Last";
		echo '<a href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'">'.$last_page_text.'</a>';
	}
	echo '</div>'.$after."\n";
}
/********************************************************************
Get image attach
********************************************************************/
function img($width) {
	global $post;
	$custom_field_value_2 = get_post_meta($post->ID, 'out_image', true);
	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => 1) );
	if(has_post_thumbnail()){
		$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID,'full'));
		$thumbnailsrc = $domsxe->attributes()->src;
		$img_url = parse_url($thumbnailsrc,PHP_URL_PATH);
	print '<img class="thumb" src="'.CHILD_URL.'/thumb.php?src='.$img_url.'&amp;w='.$width.'&amp;q=70" alt="'.$post->post_title.'" title="'.$post->post_title.'" /></a>';
	}
	elseif ($custom_field_value_2 == true) {
	print '<img class="thumb" src="'.$custom_field_value_2.'" alt="'.$post->post_title.'" /></a>';
	} 
	elseif ($attachments == true) {
		foreach($attachments as $id => $attachment) {
		$img = wp_get_attachment_image_src($id, 'full');
		$image = $image[0];
		$img_url = parse_url($img[0], PHP_URL_PATH);
		print '<img class="thumb"  src="'.CHILD_URL.'/thumb.php?src='.$img_url.'&amp;w='.$width.'&amp;q=70" alt="'.$post->post_title.'" title="'.$post->post_title.'" />';
		}
	}
	else {
		
	}
}
function img2($width,$height) {
	global $post;
	$custom_field_value_2 = get_post_meta($post->ID, 'out_image', true);
	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => 1) );
	if(has_post_thumbnail()){
		$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID,'full'));
		$thumbnailsrc = $domsxe->attributes()->src;
		$img_url = parse_url($thumbnailsrc,PHP_URL_PATH);
	print '<img class="thumb" src="'.CHILD_URL.'/thumb.php?src='.$img_url.'&amp;w='.$width.'&amp;h='.$height.'&amp;q=70" alt="'.$post->post_title.'" title="'.$post->post_title.'" />';
	}
	elseif ($custom_field_value_2 == true) {
	print '<img class="thumb" src="'.$custom_field_value_2.'" alt="'.$post->post_title.'" />';
	} 
	elseif ($attachments == true) {
		foreach($attachments as $id => $attachment) {
		$img = wp_get_attachment_image_src($id, 'full');
		$image = $image[0];
		$img_url = parse_url($img[0], PHP_URL_PATH);
		print '<img  class="thumb" src="'.CHILD_URL.'/thumb.php?src='.$img_url.'&amp;w='.$width.'&amp;h='.$height.'&amp;q=70" alt="'.$post->post_title.'" title="'.$post->post_title.'" />';
		}
	}
	else {
		global $post, $posts;
		$first_img = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$first_img = $matches [1] [0];
		
		if($first_img){ 
			print '<img class="thumb" src="'.$first_img.'" alt="'.$post->post_title.'" />';
		}
	}
}
/********************************************************************
Add js
********************************************************************/
add_action('wp_head', 'css');
function css() {
?>
	<script src="<?php bloginfo('stylesheet_directory'); ?>http://hamo.vn/wp-content/themes/vPress/js/respond.min.js"></script>
<?php
}
function hieund_scripts() {
   wp_enqueue_script('jquery-1.8.1.min.js', get_bloginfo('template_directory').'http://hamo.vn/wp-content/themes/vPress/js/jquery-1.8.1.min.js', array('jquery'));
}
add_action('wp_head', 'hieund_scripts');

require_once ('custom_functions.php');