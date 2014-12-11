<?php 
/* Obox SEO */
function ocmx_site_title()
	{
		global $post;
		$obox_post_title = get_post_meta($post->ID, "ocmx_post_meta_title", true);
		$obox_site_title = get_option("ocmx_meta_title");
		
		$separator = get_option("ocmx_seperator");
		$post_title = get_the_title($post->ID);
		
		if(get_option("ocmx_seo") == "yes") :
			if($obox_post_title !=="") :
				echo "\n<title>".$obox_site_title. $separator . $obox_post_title."</title>";
			elseif(is_home() && $obox_site_title !=="") :
				echo "\n<title>".$obox_site_title."</title>";
			else :
				echo "\n<title>".$obox_site_title. $separator . $post_title."</title>";
			endif;
		endif;
	}
function ocmx_meta_keywords()
	{
		global $post;
		$obox_post_keywords = get_post_meta($post->ID, "ocmx_post_meta_keywords", true);
		$obox_site_keywords = get_option("ocmx_meta_keywords");
		$posttags = get_the_tags($post->ID);
	
		if(get_option("ocmx_seo") == "yes") :
			if($obox_post_keywords !=="") :
				echo "\n<meta name=\"keywords\" content=\"".$obox_post_keywords."\" />";
			elseif(is_singular() && fetch_post_tags($post->ID) !== "") :	
				echo "\n<meta name=\"keywords\" content=\"";
					if ($posttags) {
						foreach($posttags as $tag) {
							echo $tag->name . ','; 
						}
					}
				echo "\" />";
			elseif(is_home() && $obox_site_keywords !=="") :
				echo "\n<meta name=\"keywords\" content=\"".$obox_site_keywords."\" />";
			endif;
		endif;
		
	}
function ocmx_meta_description()
	{
		global $post;
		$obox_post_description = get_post_meta($post->ID, "ocmx_post_meta_description", true);
		$obox_site_description = get_option("ocmx_meta_description");
		
		if($obox_post_description !=="") :
			echo "\n<meta name=\"description\" content=\"".$obox_post_description."\" />";
		elseif(is_singular() && $post->post_excerpt !== "") :	
			echo "\n<meta name=\"description\" content=\"".trim(strip_tags($post->post_excerpt))."\" />";
		elseif(is_home() && $obox_site_description !=="") :
			echo "\n<meta name=\"description\" content=\"".$obox_site_description."\" />";
		endif;
	}
?>