<?php
// Create Dynamic Sidebars
if (function_exists('register_sidebar')) :
	register_sidebar(array("name" => "Home Page", "description" => "Place orange Home Page or full-width widgets here, such as the Slider or Four Column widget."));
	register_sidebar(array("name" => "Home Page 3 Column", "description" => "Place all standard WordPress widgets or single-column into this panel to display in 3 columns.", "before_title" => '<h4 class="widgettitle">', "after_title" => '</h4><div class="content">', 'before_widget' => '<li id="%1$s" class="widget %2$s">', 'after_widget' => '</li>'));
	register_sidebar(array("name" => "Sidebar", "before_title" => '<h4 class="widgettitle">', "after_title" => '</h4><div class="content">', 'before_widget' => '<li id="%1$s" class="widget %2$s">', 'after_widget' => '</div></li>'));
	register_sidebar(array("name" => "Footer", "before_title" => "<h4>", "after_title" => "</h4>", "before_widget" => "<li class=\"column\">", "after_widget" => "</li>"));
endif;

function ocmx_clear_old_widgets(){
	unregister_widget("ocmx_recent_posts_widget");
	unregister_widget("dual_column_widget");
}
add_action('widgets_init', 'ocmx_clear_old_widgets', 11);


?>