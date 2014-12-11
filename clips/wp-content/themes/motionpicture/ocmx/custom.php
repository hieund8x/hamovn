<?php
// Custom fields for WP write panel

$obox_meta = array(
		"slider_link" => array (
			"name"			=> "slider_link",
			"default" 		=> "",
			"label" 		=> "Slider Link",
			"desc"      	=> "Add a custom link to your slider post. <br />(Used only with the Slider post type)",
			"input_type"  	=> "text"
		),
		"media" => array (
			"name"			=> "other_media",
			"default" 		=> "",
			"label" 		=> "Image",
			"desc"      	=> "Select a feature image to use for your post.",
			"input_type"  	=> "image",
			"input_size"	=> "50",
			"img_width"		=> "535",
			"img_height"	=> "255"
		),
		"video" => array (
			"name"			=> "video_link",
			"default" 		=> "",
			"label" 		=> "Video Link",
			"desc"      	=> "Provide your video link instead of the embed code and we'll use <a href='http://codex.wordpress.org/Embeds' target='_blank'>oEmbed</a> to translate that into a video.",
			"input_type"  	=> "text"
		),
		"embed" => array (
			"name"			=> "main_video",
			"default" 		=> "",
			"label" 		=> "Embed Code",
			"desc"      	=> "Input the embed code of your video here.",
			"input_type"  	=> "textarea"
		),
		"hd_toggle" => array (
			"name"			=> "hd_video",
			"default" 		=> "",
			"label" 		=> "Video Quality",
			"desc"      	=> "Selecting this option will set the size of the Video in the post page.",
			"input_type"  	=> "select",
			"options"  	=> array("Standard Definition" => "no", "High Definition" => "yes")
		),
		"hostedvideo" => array (
			"name"			=> "video_hosted",
			"default" 		=> "",
			"label" 		=> "Self Hosted Video Formats: .MP4 or .MPV",
			"desc"      	=> "Please paste in your self hosted video link. To upload videos <a href='".get_bloginfo("url")."/wp-admin/media-new.php'>click here</a>",
			"input_type"  	=> "text"
		),
		"hostedvideo_ogv" => array (
			"name"			=> "video_hosted_ogv",
			"default" 		=> "",
			"label" 		=> "Self Hosted Video Formats: .OGV (for non HTML5 browsers)",
			"desc"      	=> "Please paste in your self hosted video link. To upload videos <a href='".get_bloginfo("url")."/wp-admin/media-new.php'>click here</a>",
			"input_type"  	=> "text"
		)
	);

function create_meta_box_ui() {
	global $post, $obox_meta;
	post_meta_panel($post->ID, $obox_meta);
}
function insert_obox_metabox($pID) {
	global $post, $obox_meta, $meta_added;
	if(!isset($meta_added))
		post_meta_update($pID, $obox_meta);
	$meta_added = 1;
}
if(function_exists("ocmx_change_metatype")) {}

function add_obox_meta_box() {
	if (function_exists('add_meta_box') ) {
		add_meta_box('obox-meta-box',$GLOBALS['themename'].' Options','create_meta_box_ui','post','normal','high');
		add_meta_box('obox-meta-box',$GLOBALS['themename'].' Options','create_meta_box_ui','page','normal','high');
		add_meta_box('obox-meta-box',$GLOBALS['themename'].' Options','create_meta_box_ui','slider','normal','high');
	}
}

function my_page_excerpt_meta_box() {
	add_meta_box( 'postexcerpt', __('Excerpt'), 'post_excerpt_meta_box', 'page', 'normal', 'core' );
}

add_action('admin_menu', 'add_obox_meta_box');
add_action('admin_menu', 'my_page_excerpt_meta_box');
add_action('admin_head', 'ocmx_change_metatype');
add_action('save_post', 'insert_obox_metabox');
add_action('publish_post', 'insert_obox_metabox');  ?>