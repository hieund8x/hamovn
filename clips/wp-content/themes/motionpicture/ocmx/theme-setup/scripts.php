<?php
function ocmx_add_scripts()
	{
		global $themeid;
		
		wp_enqueue_script("jquery");
		if(!is_admin() && !(in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ) ):
			// Include stylesheets
			wp_enqueue_style( $themeid.'-jplayer', get_template_directory_uri().'/ocmx/jplayer.css');
			wp_enqueue_style( $themeid.'-customizer', home_url().'/?stylesheet=custom');
			wp_enqueue_style( $themeid.'-custom', get_template_directory_uri().'/custom.css');
			
			wp_enqueue_script( $themeid."-menu", get_bloginfo("template_directory")."/scripts/menu.js", array( "jquery" ) );
			wp_enqueue_script( $themeid."-jquery", get_bloginfo("template_directory")."/scripts/theme.js", array( "jquery" ) );
			wp_enqueue_script( $themeid."-jplayer", get_bloginfo("template_directory")."/scripts/jplayer.min.js", array( "jquery" ) );
			wp_enqueue_script( $themeid."-selfhosted", get_bloginfo("template_directory")."/scripts/selfhosted.js", array( "jquery" ) );
			wp_enqueue_script( $themeid."-fitvid", get_bloginfo("template_directory")."/scripts/fitvids.js", array( "jquery" ) );
		
			//Localization
			wp_localize_script( $themeid."-jquery", "ThemeAjax", array( "ajaxurl" => admin_url( "admin-ajax.php" ) ) );
			
			//AJAX Functions
			add_action( 'wp_ajax_nopriv_ocmx_comment-post', 'ocmx_comment_post'  );
			add_action( 'wp_ajax_ocmx_comment-post', 'ocmx_comment_post' );
		
		else:
		/* Back-end */
			wp_enqueue_script( 'jquery-ui-draggable' );
			wp_enqueue_script( 'jquery-ui-droppable' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jquery-ui-tabs' );
			
			wp_enqueue_script( $themeid."ajaxupload", get_bloginfo("template_directory")."/scripts/ajaxupload.js", array( "jquery" ) );
			wp_enqueue_script( "ocmx-multifile", get_bloginfo("template_directory")."/scripts/multifile.js", array( "jquery" ) );
			wp_enqueue_script( "ocmx-jquery", get_bloginfo("template_directory")."/scripts/ocmx.js", array( "jquery" ) );
			
			//Localization
			wp_localize_script( "ocmx-jquery", "ThemeAjax", array( "ajaxurl" => admin_url( "admin-ajax.php" ) ) );
			
			add_action( 'wp_ajax_ocmx_save-options', 'update_ocmx_options');
			add_action( 'wp_ajax_ocmx_reset-options', 'reset_ocmx_options');
			add_action( 'wp_ajax_ocmx_ads-refresh', 'ocmx_ads_refresh' );
			add_action( 'wp_ajax_ocmx_ads-remove', 'ocmx_ads_remove' );
			add_action( 'wp_ajax_ocmx_layout-refresh', 'ocmx_layout_refresh' );
			add_action( 'wp_ajax_ocmx_ajax-upload', 'ocmx_ajax_upload' );
			add_action( 'wp_ajax_ocmx_remove-image', 'ocmx_ajax_remove_image' );
			
			wp_enqueue_style( 'welcome-page', get_template_directory_uri() . '/ocmx/welcome-page.css');
			
		endif;
	}
?>