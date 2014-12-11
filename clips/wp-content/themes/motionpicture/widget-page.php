<?php 
/* Template Name: Widgetized Page */
get_header(); 
$widget_title = $post->post_title;
if (function_exists('dynamic_sidebar')) : ?> 
<?php dynamic_sidebar($widget_title." Full-Width"); ?>
    <?php endif; 
$sidebarname = $widget_title." 3 Column";
if (function_exists('dynamic_sidebar')) : ?> 
    <div id="widget-block" class="clearfix">
        <ul class="widget-list">
            <?php dynamic_sidebar($widget_title." 3 Column"); ?>
        </ul>
    </div>
    <?php endif; 
get_footer(); ?>