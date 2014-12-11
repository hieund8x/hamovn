<?php //OCMX Custom logo and Favicon

function ocmx_logo_register($wp_customize){
    
    $wp_customize->add_section('ocmx_general', array(
        'title'    => __('General Theme Settings', 'ocmx'),
        'priority' => 30,
    ));
    
   //Custom Colors
	
	$wp_customize->add_setting('ocmx_ignore_colours', array(
        'default'        => 'no',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control('header_color_scheme', array(
        'label'      => __('Use Theme Default Color Scheme', 'ocmx'),
        'section'    => 'ocmx_general',
        'settings'   => 'ocmx_ignore_colours',
        'type'       => 'radio',
        'priority' => 0,
        'choices'    => array(
            'yes' => 'Yes',
            'no' => 'No'
        ),
    ));
 
    $wp_customize->add_setting('ocmx_custom_logo', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'ocmx_custom_logo', array(
        'label'    => __('Custom Logo', 'ocmx'),
        'section'  => 'ocmx_general',
        'settings' => 'ocmx_custom_logo',
    )));
    
    $wp_customize->add_setting('ocmx_custom_favicon', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'ocmx_custom_favicon', array(
        'label'    => __('Custom Favicon', 'ocmx'),
        'section'  => 'ocmx_general',
        'settings' => 'ocmx_custom_favicon',
    )));
    
}

add_action('customize_register', 'ocmx_logo_register');

// OCMX Color Options 

function ocmx_customize_register($wp_customize) {


	// Header Color Scheme
	$wp_customize->add_section('header_color_scheme', array(
		'title' => __( 'Header Color Scheme', 'ocmx' ),
		'priority' => 35,
		)
	);
	
	$wp_customize->add_setting( 'ocmx_header_container', array(
		'default' => '#333',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_header_container', array(
		'label' => __( 'Header Container', 'ocmx' ),
		'section' => 'header_color_scheme',
		'settings' => 'ocmx_header_container',
		'priority' => 1,
	)));
	$wp_customize->add_setting( 'ocmx_header_container_border', array(
		'default' => '#DADDE1',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_header_container_border', array(
		'label' => __( 'Header Container Borders', 'ocmx' ),
		'section' => 'header_color_scheme',
		'settings' => 'ocmx_header_container_border',
		'priority' => 2,
	)));
	
	$wp_customize->add_setting( 'ocmx_navigation_container', array(
		'default' => '#fff',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_navigation_container', array(
		'label' => __( 'Navigation Container', 'ocmx' ),
		'section' => 'header_color_scheme',
		'settings' => 'ocmx_navigation_container',
		'priority' => 3,
	)));
    
    $wp_customize->add_setting( 'ocmx_navigation_font_color', array(
		'default' => '#92A4A5',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_navigation_font_color', array(
		'label' => __( 'Navigation Links', 'ocmx' ),
		'section' => 'header_color_scheme',
		'settings' => 'ocmx_navigation_font_color',
		'priority' => 4,
	)));
	
	$wp_customize->add_setting( 'ocmx_navigation_hover', array(
		'default' => '#333',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_navigation_hover', array(
		'label' => __( 'Navigation Hover', 'ocmx' ),
		'section' => 'header_color_scheme',
		'settings' => 'ocmx_navigation_hover',
		'priority' => 5,
	)));
	
	
	// Content Color Scheme
	$wp_customize->add_section('content_color_scheme', array(
		'title' => __( 'Content Color Scheme', 'ocmx' ),
		'priority' => 36
		)
	);
	
	$wp_customize->add_setting( 'ocmx_post_content', array(
		'default' => '#fff',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_post_content', array(
		'label' => __( 'Post Content Background', 'ocmx' ),
		'section' => 'content_color_scheme',
		'settings' => 'ocmx_post_content',
		'priority' => 1,
	)));
	
	$wp_customize->add_setting( 'ocmx_post_titles_font_color', array(
		'default' => '#333',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_post_titles_font_color', array(
		'label' => __( 'Post Titles Color', 'ocmx' ),
		'section' => 'content_color_scheme',
		'settings' => 'ocmx_post_titles_font_color',
		'priority' => 3,
	)));
	
	$wp_customize->add_setting( 'ocmx_post_titles_hover', array(
		'default' => '#39c',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_post_titles_hover', array(
		'label' => __( 'Post Titles Hover Color', 'ocmx' ),
		'section' => 'content_color_scheme',
		'settings' => 'ocmx_post_titles_hover',
		'priority' => 4,
	)));
    
    $wp_customize->add_setting( 'ocmx_widget_titles_font_color', array(
		'default' => '#111',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_widget_titles_font_color', array(
		'label' => __( 'Section Titles', 'ocmx' ),
		'section' => 'content_color_scheme',
		'settings' => 'ocmx_widget_titles_font_color',
		'priority' => 5,
	)));
	
	$wp_customize->add_setting( 'ocmx_date_meta', array(
		'default' => '#999',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_date_meta', array(
		'label' => __( 'Date Text', 'ocmx' ),
		'section' => 'content_color_scheme',
		'settings' => 'ocmx_date_meta',
		'priority' => 6,
	)));
	
	$wp_customize->add_setting( 'ocmx_general_font_color', array(
		'default' => '#595959',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_general_font_color', array(
		'label' => __( 'General Body Text Color', 'ocmx' ),
		'section' => 'content_color_scheme',
		'settings' => 'ocmx_general_font_color',
		'priority' => 10,
	)));
	
	$wp_customize->add_setting( 'ocmx_post_copy_font_color', array(
		'default' => '#595959',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_post_copy_font_color', array(
		'label' => __( 'Post Copy Color', 'ocmx' ),
		'section' => 'content_color_scheme',
		'settings' => 'ocmx_post_copy_font_color',
		'priority' => 12,
	)));
	
	$wp_customize->add_setting( 'ocmx_body_links', array(
		'default' => '#39C',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_body_links', array(
		'label' => __( 'General Link Color', 'ocmx' ),
		'section' => 'content_color_scheme',
		'settings' => 'ocmx_body_links',
		'priority' => 15,
	)));
	
	$wp_customize->add_setting( 'ocmx_body_links_hover', array(
		'default' => '#000',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_body_links_hover', array(
		'label' => __( 'General Link Color Hover', 'ocmx' ),
		'section' => 'content_color_scheme',
		'settings' => 'ocmx_body_links_hover',
		'priority' => 20,
	)));
	
	$wp_customize->add_setting( 'ocmx_content_borders', array(
		'default' => '#FFF',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_content_borders', array(
		'label' => __( 'Content Borders Color', 'ocmx' ),
		'section' => 'content_color_scheme',
		'settings' => 'ocmx_content_borders',
		'priority' => 20,
	)));
	
	$wp_customize->add_setting( 'ocmx_post_meta', array(
		'default' => '#F1F1F1',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_post_meta', array(
		'label' => __( 'Post Meta', 'ocmx' ),
		'section' => 'content_color_scheme',
		'settings' => 'ocmx_post_meta',
		'priority' => 56,
	)));
	
	$wp_customize->add_setting( 'ocmx_post_meta_font_color', array(
		'default' => '#999',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_post_meta_font_color', array(
		'label' => __( 'Post Meta Text', 'ocmx' ),
		'section' => 'content_color_scheme',
		'settings' => 'ocmx_post_meta_font_color',
		'priority' => 60,
	)));
	
	$wp_customize->add_setting( 'ocmx_buttons', array(
		'default' => '#6C9',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_buttons', array(
		'label' => __( 'Button Color', 'ocmx' ),
		'section' => 'content_color_scheme',
		'settings' => 'ocmx_buttons',
		'priority' => 65,
	)));
	
	$wp_customize->add_setting( 'ocmx_buttons_hover', array(
		'default' => '#f33',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_buttons_hover', array(
		'label' => __( 'Button Hover Color', 'ocmx' ),
		'section' => 'content_color_scheme',
		'settings' => 'ocmx_buttons_hover',
		'priority' => 70,
	)));
	
		
	
	// Footer Color Scheme
	$wp_customize->add_section('footer_color_scheme', array(
		'title' => __( 'Footer Color Scheme', 'ocmx' ),
		'priority' => 37,
		)
	);
	
	$wp_customize->add_setting( 'ocmx_footer_container', array(
		'default' => '#333',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_footer_container', array(
		'label' => __( 'Footer Container', 'ocmx' ),
		'section' => 'footer_color_scheme',
		'settings' => 'ocmx_footer_container',
		'priority' => 35,
	)));
	
	$wp_customize->add_setting( 'ocmx_widget_footer_titles_font_color', array(
		'default' => '#fff',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_widget_footer_titles_font_color', array(
		'label' => __( 'Footer Widget Titles', 'ocmx' ),
		'section' => 'footer_color_scheme',
		'settings' => 'ocmx_widget_footer_titles_font_color',
		'priority' => 36,
	)));
	
	$wp_customize->add_setting( 'ocmx_footer_links', array(
		'default' => '#999',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_footer_links', array(
		'label' => __( 'Footer Links', 'ocmx' ),
		'section' => 'footer_color_scheme',
		'settings' => 'ocmx_footer_links',
		'priority' => 37,
	)));
	
	$wp_customize->add_setting( 'ocmx_footer_links_hover', array(
		'default' => '#fff',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_footer_links_hover', array(
		'label' => __( 'Footer Links Hover', 'ocmx' ),
		'section' => 'footer_color_scheme',
		'settings' => 'ocmx_footer_links_hover',
		'priority' => 38,
	)));
	
	$wp_customize->add_setting( 'ocmx_footer_text_color', array(
		'default' => '#999',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_footer_text_color', array(
		'label' => __( 'Footer Text Color', 'ocmx' ),
		'section' => 'footer_color_scheme',
		'settings' => 'ocmx_footer_text_color',
		'priority' => 50,
	)));
	
	$wp_customize->add_setting( 'ocmx_footer_border', array(
		'default' => '#ccc',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_footer_border', array(
		'label' => __( 'Footer Borders Color', 'ocmx' ),
		'section' => 'footer_color_scheme',
		'settings' => 'ocmx_footer_border',
		'priority' => 55,
	)));
	
	wp_reset_query();

//ADD JQUERY

if ( $wp_customize->is_preview() && ! is_admin() )
	add_action( 'wp_footer', 'ocmx_customize_preview', 21);
	
	function ocmx_customize_preview() {
	?>
	<script type="text/javascript">

	( function( $ ){
	
		wp.customize('ocmx_header_container',function( value ) {
			value.bind(function(to) {
				jQuery('#header-container').css({'backgroundColor': to});
			});
		});
		
		wp.customize('ocmx_header_container_border',function( value ) {
			value.bind(function(to) {
				jQuery('#header-container').css({'borderColor': to});
			});
		});
		
		wp.customize('ocmx_navigation_container',function( value ) {
			value.bind(function(to) {
				jQuery('#footer-navigation-container, #navigation-container, ul#nav ul.sub-menu').css({'background': to});
			});
		});
		wp.customize('ocmx_navigation_container',function( value ) {
			value.bind(function(to) {
				jQuery('#footer-navigation-container, #navigation-container, ul#nav li a, ul#nav ul.sub-menu li, ul#nav li a, ul#nav ul.sub-menu').css({'borderColor': to});
			});
		});
		wp.customize('ocmx_navigation_font_color',function( value ) {
			value.bind(function(to) {
				jQuery('ul#nav li a, ul#footer-nav li a').css({'color': to});
			});
		});

		wp.customize('ocmx_navigation_hover',function( value ) {
			value.bind(function(to) {
				jQuery('ul#nav li a:hover, ul#footer-nav li a:hover').css({'color': to});
			});
		});
		
		wp.customize('ocmx_post_content',function( value ) {
			value.bind(function(to) {
				jQuery('.slider, .video-list .four-column li, .video-list, .content, #right-column, #widget-block, .search-form').css({'background': to});
			});
		});
		
		wp.customize('ocmx_general_font_color',function( value ) {
			value.bind(function(to) {
				jQuery('body').css({'color': to});
			});
		});
		
		wp.customize('ocmx_post_copy_font_color',function( value ) {
			value.bind(function(to) {
				jQuery('copy, .copy p').css({'color': to});
			});
		});
		
		wp.customize('ocmx_body_links',function( value ) {
			value.bind(function(to) {
				jQuery('.copy a, .widget .content a, .logged-in-as a, .reply-to-comment a, .comment h4.comment-name a').css({'color': to});
			});
		});
		
		wp.customize('ocmx_body_links_hover',function( value ) {
			value.bind(function(to) {
				jQuery('.copy a:hover, .widget .content a:hover, .logged-in-as a:hover, .reply-to-comment a:hover').css({'color': to});
			});
		});
		
		wp.customize('ocmx_widget_titles_font_color',function( value ) {
			value.bind(function(to) {
				jQuery('h3.widgettitle, h4.widgettitle, .widgettitle a, .section-title, .section-title a').css({'color': to});
			});
		});
		
		
		wp.customize('ocmx_post_titles_font_color',function( value ) {
			value.bind(function(to) {
				jQuery('.copy h3.post-title a, .post-title, .post-title a, .page-title, .four-column .post-title a, #portfolio-content h4 a, .slider .post-title').css({'color': to});
			});
		});
		
		wp.customize('ocmx_post_titles_hover',function( value ) {
			value.bind(function(to) {
				jQuery('.copy h3.post-title a:hover, .post-title:hover, .post-title a:hover, .page-title:hover, .four-column .post-title a:hover, #portfolio-content h4 a:hover').css({'color': to});
			});
		});
		
		wp.customize('ocmx_content_borders',function( value ) {
			value.bind(function(to) {
				jQuery('.post-meta, .post-meta li.meta-block:first-child, .video-list .section-title, .video-list li, h4.widgettitle, ul.widget-list li.widget li, .search-form, .blog-main-post-container .post-title-block, .next-prev-post-nav, .comments').css({'borderColor': to});
			});
		});

		wp.customize('ocmx_date_meta',function( value ) {
			value.bind(function(to) {
				jQuery('h5.date, .archives_list .date').css({'color': to});
			});
		});
			
		wp.customize('ocmx_post_meta',function( value ) {
			value.bind(function(to) {
				jQuery('.next-prev-post-nav, .post-meta').css({'backgroundColor': to});
			});
		});
		
		wp.customize('ocmx_post_meta_font_color',function( value ) {
			value.bind(function(to) {
				jQuery('.next-prev-post-nav li a, .post-meta li.meta-block:first-child a.action-link, .post-meta li.meta-block:first-child a.comment-count, .short-url, .short-url input').css({'color': to});
			});
		});
		
		wp.customize('ocmx_buttons',function( value ) {
			value.bind(function(to) {
				jQuery('.search-form input[type="submit"], input.submit_button, #comment_submit, .submit, input.submit_button, #comment_submit, .submit, input[type="button"], input[type="submit"], .slider .next, .slider .previous').css({'backgroundColor': to});
			});
		});
		
		wp.customize('ocmx_buttons_hover',function( value ) {
			value.bind(function(to) {
				jQuery('.search-form input[type="submit"]:hover, input.submit_button:hover, #comment_submit:hover, .submit:hover, input.submit_button:hover, #comment_submit:hover, .submit:hover, .slider .next:hover, .slider .previous:hover').css({'backgroundColor': to});
			});
		});
		
		wp.customize('ocmx_footer_links',function( value ) {
			value.bind(function(to) {
				jQuery('#footer a').css({'color': to});
			});
		});
		
		wp.customize('ocmx_footer_links_hover',function( value ) {
			value.bind(function(to) {
				jQuery('#footer a:hover, .obox-credit a:hover').css({'color': to});
			});
		});
		
		wp.customize('ocmx_footer_border',function( value ) {
			value.bind(function(to) {
				jQuery('#footer-container, #footer ul li.column ul li, .footer-text').css({'borderColor': to});
			});
		});
		
		wp.customize('ocmx_footer_text',function( value ) {
			value.bind(function(to) {
				jQuery('#footer, #footer ul li.column ul li, .footer-text p').css({'color': to});
			});
		});
		
		wp.customize('ocmx_footer_container',function( value ) {
			value.bind(function(to) {
				jQuery('#footer-container').css({'backgroundColor': to});
			});
		});
		
		wp.customize('ocmx_widget_footer_titles_font_color',function( value ) {
			value.bind(function(to) {
				jQuery('#footer h4, #footer h4 a, #footer .widgettitle').css({'color': to});
			});
		});
		
	} )( jQuery );
	</script>
<?php } 

//ADD POST MESSAGE


}
add_action( 'customize_register', 'ocmx_customize_register' );

function ocmx_add_query_vars($query_vars) {
	$query_vars[] = 'stylesheet';
	return $query_vars;
}
add_filter( 'query_vars', 'ocmx_add_query_vars' );
function ocmx_takeover_css() {
	    $style = get_query_var('stylesheet');
	    if($style == "custom") {
		    include_once(TEMPLATEPATH . '/style.php');
	        exit;
	    }
	}
add_action( 'template_redirect', 'ocmx_takeover_css');