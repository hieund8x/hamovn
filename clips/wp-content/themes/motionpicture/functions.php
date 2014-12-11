<?php  global $themename, $input_prefix;

/*****************/
/* Theme Details */

$themename = "Motion Picture";
$themeid = "motionpicture";
$productid = "1380";
$presstrendsid = "k8m89788s10ijycchyhe13op5bdzdad6v";

/**********************/
/* Include OCMX files */
$include_folders = array("/ocmx/includes/", "/ocmx/theme-setup/", "/ocmx/widgets/", "/ocmx/front-end/", "/ajax/", "/ocmx/interface/");

// This is a hack, to avoid the "headers already sent by...." error which pops up when you call pages directly from wp-admin/ like edit.php for example
include_once (get_template_directory()."/ocmx/folder-class.php");
include_once (get_template_directory()."/ocmx/load-includes.php");
include_once (get_template_directory()."/ocmx/custom.php");
include_once (get_template_directory()."/ocmx/post-custom.php");
include_once (get_template_directory()."/ocmx/seo-post-custom.php");

/**********************/
/* "Hook" up the OCMX */

update_option("ocmx_font_support", true);
add_action('init', 'ocmx_add_scripts');
add_action('after_setup_theme', 'ocmx_setup');

function add_widgetized_pages(){
	global $wpdb;
	$get_widget_pages = $wpdb->get_results("SELECT * FROM ".$wpdb->postmeta." WHERE `meta_key` = '_wp_page_template' AND  `meta_value` = 'widget-page.php'");
	foreach($get_widget_pages as $pages) :
		$post = get_post($pages->post_id);
		register_sidebar(array("name" => $post->post_title." Full Width", "description" => "Place orange Home Page or full-width widgets here, such as the Slider or Four Column widget."));
		register_sidebar(array("name" => $post->post_title." 3 Column", "description" => "Place all standard WordPress widgets or single-column into this panel to display in 3 columns.", "before_title" => '<h4 class="widgettitle">', "after_title" => '</h4><div class="content">', 'before_widget' => '<li id="%1$s" class="widget %2$s">', 'after_widget' => '</div></li>'));
	endforeach;
}
add_action("init", "add_widgetized_pages");

/***********************/
/* Add OCMX Menu Items */

add_action('admin_menu', 'ocmx_add_admin');
function ocmx_add_admin() {
	global $wpdb;

	add_object_page("Theme Options", "Theme Options", 'edit_themes', basename(__FILE__), '', 'http://obox-design.com/images/ocmx-favicon.png');

	//Check if we need to upgrade the Gallery Table
	check_gallery_table();

	add_submenu_page(basename(__FILE__), "General Options", "General", "edit_theme_options", basename(__FILE__), 'ocmx_general_options');
	add_submenu_page(basename(__FILE__), "Customize", "Customize", "edit_theme_options", "customize.php");
	add_submenu_page(basename(__FILE__), "Typography", "Typography", "edit_theme_options", "ocmx-fonts", 'ocmx_font_options');
	add_submenu_page(basename(__FILE__), "Adverts", "Adverts", "edit_theme_options",  "ocmx-adverts", 'ocmx_advert_options');
	add_submenu_page(basename(__FILE__), "SEO Options", "SEO Options", "edit_theme_options", "ocmx-seo", 'ocmx_seo_options');
	add_submenu_page(basename(__FILE__), "Help", "Help", "manage_options", "obox-help", 'ocmx_welcome_page');

};
/* Custom fix for iframes with youtube hiding menus and other bits */

function add_video_wmode_transparent($html) {
	if (strpos($html, "<iframe" ) !== false) {
	$search = array('" frameborder="0"', '?hd=1?hd=1');
		$replace = array('?hd=1&wmode=transparent" frameborder="0"', '?hd=1');
		$html = str_replace($search, $replace, $html);
	return $html;
   } else {
		return $html;
   }
}

add_filter('the_excerpt', 'add_video_wmode_transparent', 10);
add_filter('the_content', 'add_video_wmode_transparent', 10);
add_filter('obox_image', 'add_video_wmode_transparent', 10);

/*****************/
/* Add Nav Menus */

if (function_exists('register_nav_menus')) :
	register_nav_menus( array(
		'primary' => __('Primary Navigation', '$themename'),
		'secondary' => __('Footer Navigation', '$themename')
	) );
endif;

/*********************/
/* Load Localization */
load_theme_textdomain('ocmx', get_template_directory() . '/lang');

/***********************************************************************/
/* Set the parameters which allow the /interface/ folder to be included*/

function check_allow_ocmx(){
	if(
		!isset($_POST["ocmx_gallery_update"])
		&& (strpos($_SERVER['SCRIPT_FILENAME'], "admin.php") != null || strpos($_SERVER['SCRIPT_FILENAME'], "admin-ajax.php") != null && !isset($_POST['action']))
		&& is_user_logged_in()
	) :
		return true;
	else:
		return false;
	endif;
}

/**************************/
/* WP 3.4 Support         */
global $wp_version;
if ( version_compare( $wp_version, '3.4', '>=' ) )
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );

if ( ! isset( $content_width ) ) $content_width = 960;

function ocmx_setup_image_sizes() {
	add_image_size('960x535', 980, 551, true);
	add_image_size('580x332', 580, 332, true);
	add_image_size('290x163', 290, 163, true);
	add_image_size('195x112', 195, 112, true);
	add_image_size('195x112', 195, 112, true);
	add_image_size('580', 580, 9999);
	add_image_size('940', 940, 9999);
}

add_action( 'after_setup_theme', 'ocmx_setup_image_sizes' );

/**************************/
/* Facebook Support      */
function get_fbimage() {
	global $post;
	$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', '' );
	$fbimage = null;
	if ( has_post_thumbnail($post->ID) ) {
		$fbimage = $src[0];
	} else {
		global $post, $posts;
		$fbimage = '';
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',
		$post->post_content, $matches);
		if(!empty($matches[1]))
			$fbimage = $matches [1] [0];
	}
	if(empty($fbimage)) {
		$fbimage = get_the_post_thumbnail($post->ID);
	}
	return $fbimage;
}
/******************************************************************************/
/* Each theme has their own "No Posts" styling, so it's kept in functions.php */

function ocmx_no_posts(){ ?>
	<li class="post transparent-container">
	<div class="content clearfix">
		<h3 class="post-title"><a href="#"><?php _e("Page Not Found", "ocmx"); ?></a></h3>
		<div class="post-meta clearfix"></div>
		<div class="copy <?php echo $image_class; ?>">
			 <?php _e("The page you are looking for does not exist", "ocmx"); ?>
		</div>
	</div>
</li>
<?php
}

/************************************************/
/* Fallback Function for WordPress Custom Menus */

function ocmx_fallback() {
	echo '<ul id="nav" class="clearfix">';
	wp_list_pages('title_li=&');
	echo '</ul>';
}
?>