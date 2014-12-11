<?php 
// The Loop
/*
 * Usage: [ocmx-gallery gallery_id="1"]
 */
 function ocmx_gallery_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        "id" => '1'
    ), $atts));
	global $wpdb;
	
	$table_Details = fetch_ocmx_gallery($id, "dbDate", "ASC");
	$rowcnt=1;
?>
    <ul class="portfolio-list">
        <?php foreach ($table_Details as $gallery_list) :
			$large_image = get_bloginfo("wpurl")."/wp-content/uploads/ocmx-gallery/large/".$gallery_list->Image;
			$this_image = get_bloginfo("wpurl")."/wp-content/uploads/ocmx-gallery/small/".$gallery_list->Image; ?>
			<li>
				<a href="<?php echo $large_image; ?>" rel="lightbox" class="portfolio-image">
					<span><img src="<?php bloginfo('template_directory'); ?>/functions/timthumb.php?src=<?php echo $this_image; ?>&amp;h=100&amp;w=205&amp;zc=1" border="0" alt="<?php echo $gallery_list->Item; ?>" /></span>
				</a>
				<h4><?php if($gallery_list->Item !== "") : echo $gallery_list->Item; endif; ?></h4>
				<?php if($gallery_list->Description !== "NULL" && $gallery_list->Description !== "") : ?>
					<p><?php echo $gallery_list->Description; ?></p>
				<?php endif; ?>
			</li>
        <?php
                if($rowcnt == 4) :  $rowcnt = 1; else : $rowcnt++; endif;
            endforeach; 
        ?>
    </ul>
<?php     
}
add_shortcode("ocmx-gallery", "ocmx_gallery_shortcode");
?>