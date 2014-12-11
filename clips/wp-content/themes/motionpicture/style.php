<?php header('Content-type: text/css'); ?>
<?php if(get_option("ocmx_ignore_colours") != "yes"): ?>

	<?php if(get_option("ocmx_header_container")) : ?>
		#header-container{background-color: <?php echo get_option('ocmx_header_container');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_header_container_border")) : ?>
		#header-container{border-color: <?php echo get_option('ocmx_header_container_border');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_navigation_container")) : ?>
		#footer-navigation-container, #navigation-container, ul#nav ul.sub-menu{background: <?php echo get_option('ocmx_navigation_container');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_navigation_container")) : ?>
		#footer-navigation-container, ul#footer-nav li a, #navigation-container, ul#nav li a, ul#nav ul.sub-menu li, ul#nav li a, ul#nav ul.sub-menu{border-color: <?php echo get_option('ocmx_navigation_container');?>; border-top: 0px;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_navigation_font_color")) : ?>
		ul#nav li a, ul#footer-nav li a{color: <?php echo get_option('ocmx_navigation_font_color');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_navigation_hover")) : ?>
		ul#nav li a:hover, ul#footer-nav li a:hover{color: <?php echo get_option('ocmx_navigation_hover');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_post_content")) : ?>
		.slider, .video-list .four-column li, .video-list, .content, #right-column, #widget-block, .search-form{background: <?php echo get_option('ocmx_post_content');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_general_font_color")) : ?>
		body{color: <?php echo get_option('ocmx_general_font_color');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_post_copy_font_color")) : ?>
		.copy, .copy p{color: <?php echo get_option('ocmx_post_copy_font_color');?> !important;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_body_links")) : ?>
		.copy a, .widget .content a, .logged-in-as a, .reply-to-comment a, .comment h4.comment-name a{color: <?php echo get_option('ocmx_body_links');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_body_links_hover")) : ?>
		.copy a:hover, .widget .content a:hover, .logged-in-as a:hover, .reply-to-comment a:hover, .comment h4.comment-name a:hover{color: <?php echo get_option('ocmx_body_links_hover');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_widget_titles_font_color")) : ?>
		h3.widgettitle, h4.widgettitle, .widgettitle a, .section-title, .section-title a{color: <?php echo get_option('ocmx_widget_titles_font_color');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_post_titles_font_color")) : ?>
		.copy h3.post-title a, .post-title, .post-title a, .page-title, .four-column .post-title a, #portfolio-content h4 a, .slider .post-title{color: <?php echo get_option('ocmx_post_titles_font_color');?> !important;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_post_titles_hover")) : ?>
		.copy h3.post-title a:hover, .post-title:hover, .post-title a:hover, .page-title:hover, .four-column .post-title a:hover, #portfolio-content h4 a:hover{color: <?php echo get_option('ocmx_post_titles_hover');?>;}
	<?php endif; ?>

	<?php if(get_option("ocmx_date_meta")) : ?>
		h5.date, .archives_list .date{color: <?php echo get_option('ocmx_date_meta');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_post_meta")) : ?>
		.next-prev-post-nav, .post-meta{background: <?php echo get_option('ocmx_post_meta');?> !important;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_post_meta_font_color")) : ?>
		.next-prev-post-nav li a, .post-meta li.meta-block:first-child a.action-link, .post-meta li.meta-block:first-child a.comment-count, .short-url, .short-url input {color: <?php echo get_option('ocmx_post_meta_font_color');?>;}
	<?php endif; ?>
    
	<?php if(get_option("ocmx_content_borders")) : ?>
	.post-meta, .post-meta li.meta-block:first-child, .video-list .section-title, .video-list li, h4.widgettitle, ul.widget-list li.widget li, .search-form, .blog-main-post-container .post-title-block, .next-prev-post-nav, .comments{border-color: <?php echo get_option('ocmx_content_borders');?>; background: none;}
    .video-list .section-title, .post-meta, .next-prev-post-nav, h4.widgettitle{border-bottom: 4px solid <?php echo get_option('ocmx_content_borders');?>;}
	<?php endif; ?>
    
	<?php if(get_option("ocmx_buttons")) : ?>
	.search-form input[type="submit"], input.submit_button, #comment_submit, .submit, input.submit_button, #comment_submit, .submit, input[type="button"], input[type="submit"], .slider .next, .slider .previous{background-color: <?php echo get_option('ocmx_buttons');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_buttons_hover")) : ?>
	.search-form input[type="submit"]:hover, input.submit_button:hover, #comment_submit:hover, .submit:hover, input.submit_button:hover, #comment_submit:hover, .submit:hover, input[type="button"]:hover, input, [type="submit"]:hover, .slider .next:hover, .slider .previous:hover{background-color: <?php echo get_option('ocmx_buttons_hover');?>;}
	<?php endif; ?>
    
    <?php if(get_option("ocmx_widget_footer_titles_font_color")) : ?>
		#footer h4, #footer h4 a, #footer .widgettitle{color: <?php echo get_option('ocmx_widget_footer_titles_font_color');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_footer_links")) : ?>
		#footer a{color: <?php echo get_option('ocmx_buttons_hover');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_footer_links_hover")) : ?>
		#footer a:hover, .obox-credit a:hover{color: <?php echo get_option('ocmx_buttons_hover');?>;}
	<?php endif; ?>
    
    	<?php if(get_option("ocmx_footer_border")) : ?>
		#footer-container, #footer ul li.column ul li, .footer-text{border-color: <?php echo get_option('ocmx_footer_border');?>;}
	<?php endif; ?>
    
    <?php if(get_option("ocmx_footer_links")) : ?>
		#footer a, .obox-credit a{color: <?php echo get_option('ocmx_footer_links');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_footer_text")) : ?>
		#footer, #footer ul li.column ul li, .footer-text p{color: <?php echo get_option('ocmx_footer_text');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_footer_container")) : ?>
		#footer-container{background-color: <?php echo get_option('ocmx_footer_container');?>;}
	<?php endif; ?>
	
<?php endif; ?>
<?php if(get_theme_mod( 'background_color' ) !="") : ?>
	body{background: none;}
<?php endif; 
if(get_option("ocmx_custom_css") != ""): 
	echo get_option("ocmx_custom_css"); 
endif; 
?>