<?php
global $obox_meta, $theme_options;

/* Setup Post Image Sizes */
add_image_size("post", 590, 350, true);

$theme_options = array();

$theme_options["general_site_options"] =
		array(
				array("label" => "Custom Logo", "description" => "Full URL or folder path to your custom logo.", "name" => "ocmx_custom_logo", "default" => "", "id" => "upload_button", "input_type" => "file", "args" => array("width" => 90, "height" => 75)),
				array("label" => "Favicon", "description" => "Select a favicon for your site", "name" => "ocmx_custom_favicon", "default" => "", "id" => "upload_button_favicon", "input_type" => "file", "sub_title" => "favicon", "args" => array("width" => 16, "height" => 16)),
				array(
					"main_section" => "Facebook Sharing Options",
					"main_description" => "Set a default image URL to appear on Facebook shares if no featured image is found. Recommended size 200x200.",
					"sub_elements" =>
						array(
							array("label" => "Disable OpenGraph?", "description" => "Select No if you want to disable the theme's OpenGraph support(do this only if using a conflicting plugin)", "name" => "ocmx_open_graph", "default" => "no", "id" => "ocmx_open_graph", "input_type" => 'select', 'options' => array('Yes' => 'yes', 'No' => 'no')
							),

							array("label" => "Image URL", "description" => "", "name" => "ocmx_site_thumbnail", "sub_title" => "Open Graph image", "default" => "", "id" => "upload_button_ocmx_site_thumbnail", "input_type" => "file", "args" => array("width" => 80, "height" => 80)
							)
						)
				),
				array(
				"main_section" => "Full Posts or Excerpts?",
				"main_description" => "Select whether to show full posts or excerpts in your archives/ blog list.",
				"sub_elements" => 
				array(
						array("label" => "Content Length", "description" => "Selecting excerpts will show the Read More link.","name" => "ocmx_content_length", "default" => "yes", "id" => "ocmx_content_length", "input_type" => 'select', 'options' => array('Show Excerpts' => 'yes', 'Show Full Post Content' => 'no'))
						 )
					 ),
				array(
				"main_section" => "Post Meta",
				"main_description" => "These settings control which post meta is displayed in widgets, posts and pages.",
				"sub_elements" =>
					array(
						array("label" => "Date", "description" => "Uncheck to turn off date. Does not affect widgets.","name" => "ocmx_meta_date", "", "default" => "true", "id" => "ocmx_meta_date", "input_type" => "checkbox"),
						array("label" => "Tags", "description" => "Check to show tags on single posts", "name" => "ocmx_meta_tags", "default" => "true", "id" => "ocmx_meta_tags", "input_type" => "checkbox"),
						array("label" => "Comment Link", "description" => "Uncheck to hide the comment link in posts and archives.", "name" => "ocmx_meta_comments", "default" => "true", "id" => "ocmx_meta_comments", "input_type" => "checkbox"),
						array("label" => "Category Link", "description" => "Uncheck to hide the category link in posts and archives.", "name" => "ocmx_meta_category", "default" => "true", "id" => "ocmx_meta_category", "input_type" => "checkbox"),
						array("label" => "Post Author", "description" => "Uncheck to hide author link in posts and archives.", "name" => "ocmx_meta_author", "default" => "true", "id" => "ocmx_meta_author", "input_type" => "checkbox"),
						array("label" => "Social Sharing", "description" => "Uncheck to hide social sharing options on single posts and blog list.", "name" => "ocmx_meta_social", "default" => "true", "id" => "ocmx_meta_social", "input_type" => "checkbox"),
						array("label" => "Video Meta", "description" => "Show likes and views for oEmbed on posts and archives.","name" => "ocmx_video_meta", "", "default" => "true", "id" => "ocmx_video_meta", "input_type" => "checkbox")
					)
				),
				array("label" => "Custom RSS URL", "description" => "", "name" => "ocmx_rss_url", "default" => "", "id" => "", "input_type" => "text"),
				array(
					  "main_section" => "Press Trends Analytics",
					  "main_description" => "Select Yes Opt out. No personal data is collected.",
					  "sub_elements" =>
						 array(
							 array("label" => "Disable Press Trends?", "description" => "PressTrends helps Obox build better themes and provide awesome support by retrieving aggregated stats. PressTrends also provides a <a href='http://wordpress.org/extend/plugins/presstrends/' title='PressTrends Plugin for WordPress' target='_blank'>plugin for you</a> that delivers stats on how your site is performing against similar sites like yours. <a href='http://www.presstrends.me' title='PressTrends' target='_blank'>Learn more</a>","name" => "ocmx_disable_press_trends", "default" => "no", "id" => "ocmx_disable_press_trends", "input_type" => 'select', 'options' => array('Yes' => 'yes', 'No' => 'no'))
							)
					   )
		);

$theme_options["custom_options"] = array(
			array("label" => "Color Options", "description" => "Select your desired colour option.", "name" => "ocmx_theme_style", "default" => "light", "id" => "", "input_type" => "select", "options" => array("Light" => "light", "Dark" => "dark")
			),
			array(
				"main_section" => "Custom Styling",
				"main_description" => "Set your own custom social buttons and CSS for any element you wish to restyle.",
				"sub_elements" =>
					array(

						array("label" => "Custom CSS", "description" => "Enter changed classes from the theme stylesheet, or custom CSS here.", "name" => "ocmx_custom_css", "default" => "", "id" => "ocmx_custom_css", "input_type" => "memo"),
						array("label" => "Social Widget Code", "description" => "Paste the template tag or code for your social sharing plugin here.", "name" => "ocmx_social_tag", "default" => "", "id" => "", "input_type" => "memo"),
						 )
			)
);

$theme_options["footer_options"] = array(
			array("label" => "Custom Footer Text", "description" => "", "name" => "ocmx_custom_footer", "default" => "Copyright ".date("Y").". Motion Picture was created in WordPress by Obox Themes."	, "id" => "ocmx_custom_footer", "input_type" => "memo"),
			array("label" => "Hide Obox Logo", "description" => "Hide the Obox Logo from the footer.", "name" => "ocmx_logo_hide", "default" => "false", "id" => "ocmx_logo_hide", "input_type" => 'select', 'options' => array('Yes' => 'true', 'No' => 'false')),
			array("label" => "Site Analytics", "description" => "Enter in the Google Analytics Script here.","name" => "ocmx_googleAnalytics", "default" => "", "id" => "","input_type" => "memo")
);


$theme_options["seo_options"] = array(
							array("label" => "Use OCMX SEO", "description" => "Select \"No\" if you are using an SEO plugin.", "name" => "ocmx_seo", "default" => "yes", "input_type" => "select", "options" => array("Yes" => "yes", "No" => "no")),
							array("label" => "Separator", "description" => "Define a new seperator character for your page titles.", "name" => "ocmx_seperator", "default" => "|", "input_type" => "text"),
							array("label" => "Site Wide Title", "description" => "Set your site's meta title.", "name" => "ocmx_meta_title", "default" =>  get_bloginfo("title"), "input_type" => "text"),
							array("label" => "Site Keywords", "description" => "", "name" => "ocmx_meta_keywords", "default" => "", "input_type" => "text"),
							array("label" => "Site Description", "description" => "Use a custom meta description.", "name" => "ocmx_meta_description", "default" => get_bloginfo("description"), "input_type" => "memo")

						);
$theme_options["small_ad_options"] = array(
						array(
								"label" => "Number of Small Ads",
								"description" => "When using the select box, you must click \"Save Changes\" before the blocks are added or removed.",
								"name" => "ocmx_small_ads",
								"id" =>  "ocmx_small_ads",
								"prefix" => "ocmx_small_ad",
								"default" => "0",
								"input_type" => "select",
								"options" => array("None" => "0", "1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10"),
								"args" => array("width" => 125, "height" => "125")
							)
					  );

$theme_options["medium_ad_options"] = array(
						array(
								"label" => "Number of Medium Ads",
								"description" => "",
								"name" => "ocmx_medium_ads",
								"id" =>  "ocmx_medium_ads",
								"prefix" => "ocmx_medium_ad",
								"default" => "0",
								"input_type" => "select",
								"options" => array("None" => "0", "1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10"),
								"args" => array("width" => 300, "height" => "250")
							)
						);
global $input_prefix;
$theme_options["custom_advert_options"] = array(
						array(
							"main_section" => "Header Ad",
							"main_description" => "These settings allow you to manage your custom adverts which display in the header of your site. (Recommended size for the header ad is 468px by 60px)",
							"sub_elements" =>
								array(
									array("label" => "Advert Title", "description" => "", "name" => $input_prefix."header_ad_title", "default" => "", "id" =>  $input_prefix."header_ad_title", "input_type" => "text"),
									array("label" => "Advert Link", "description" => "", "name" => $input_prefix."header_ad_link", "default" => "", "id" =>  $input_prefix."header_ad_link", "input_type" => "text"),
									array("label" => "Image URL", "description" => "", "name" => $input_prefix."header_ad_image", "default" => "", "id" =>  $input_prefix."header_ad_image", "input_type" => "text"),
									array("label" => "Advert Script", "description" => "", "name" => $input_prefix."header_ad_buysell_id", "default" => "", "id" => $input_prefix."header_buysell_id", "input_type" => "memo"),
								)
						)
					);


$theme_options["layout_options"] = array(
	array(
		"label" => "Home Page Layout",
		"description" => "Set your home page to either display as a blog, mimic our theme demo or take full control by using widgets.",
		"name" => "ocmx_home_page_layout", "default" => "blog",
		"id" => "ocmx_home_page_layout",
		"input_type" => "hidden",
		"default" => "blog",
		"options" =>
			array(
				"blog" => array("label" => "Blog", "description" => "Set your home page to display like a normal blog.", "load_options" => "blog_home_options"),
				"widget" => array("label" => "Widget Driven", "description" => "Take control by setting up your home page with widgets.")
			)
	)
);

$theme_options["blog_home_options"] =
	array(
		array("label" => "Post Count", "description" => "Number of Posts to display on the Home Page (Used only with the 'Regular Blog' layout).", "name" => "ocmx_home_page_posts", "default" => "5", "id" => "", "input_type" => "select", "options" => array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10", "15" => "15", "20" => "20")),
		array("label" => "Category", "description" => "Which Category will we display on the Home Page (Used only with the 'Regular Blog' layout)?", "name" => "ocmx_home_page_categories", "default" => "", "id" => "", "input_type" => "select", "options" => "loop_categories"),
	);




/***************************************************************************/
/* Setup Defaults for this theme for optiosn which aren't set in this page */

update_option("ocmx_general_font_style_default", "Georgia, 'Times New Roman', Times, serif");
update_option("ocmx_navigation_font_style_default", "Georgia, 'Times New Roman', Times, serif");
update_option("ocmx_sub_navigation_font_style_default", "Georgia, 'Times New Roman', Times, serif");
update_option("ocmx_post_font_titles_style_default", "'Helvetica Neue', Helvetica, Arial, sans-serif");
update_option("ocmx_post_font_meta_style_default", "'Helvetica Neue', Helvetica, Arial, sans-serif");
update_option("ocmx_post_font_copy_font_style_default", "Georgia, 'Times New Roman', Times, serif");
update_option("ocmx_widget_font_titles_font_style_default", "'Helvetica Neue', Helvetica, Arial, sans-serif");
update_option("ocmx_widget_footer_titles_font_size_default", "'Helvetica Neue', Helvetica, Arial, sans-serif");


update_option("ocmx_general_font_color_default", "#667373");
update_option("ocmx_navigation_font_color_default", "#92A4A5");
update_option("ocmx_sub_navigation_font_color_default", "#92A4A5");
update_option("ocmx_post_titles_font_color_default", "#4C5554");
update_option("ocmx_post_meta_font_color_default", "#888");
update_option("ocmx_post_copy_font_color_default", "#595959");
update_option("ocmx_widget_titles_font_color_default", "#333");
update_option("ocmx_widget_footer_titles_font_size_default", "#92A4A5");

update_option("ocmx_general_font_size_default", "14");
update_option("ocmx_navigation_font_size_default", "12");
update_option("ocmx_sub_navigation_font_size_default", "12");
update_option("ocmx_post_titles_font_size_default", "23");
update_option("ocmx_post_meta_font_size_default", "12");
update_option("ocmx_post_copy_font_size_default", "14");
update_option("ocmx_widget_titles_font_size_default", "15");
update_option("ocmx_widget_footer_titles_font_size_default", "12");

update_option("allow_gallery_effect", "1");

add_action("switch_theme", "remove_ocmx_gallery_effects");
function remove_ocmx_gallery_effects(){delete_option("allow_gallery_effect");};
?>