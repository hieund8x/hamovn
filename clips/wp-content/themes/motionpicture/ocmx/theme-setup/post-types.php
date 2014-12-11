<?php add_action( "init", "add_gallery_post_type" );
function add_gallery_post_type() {
  	register_post_type("ocmx_gallery", 
		array("labels" => array(
						"name" => __( "Gallery" ),
						"singular_name" => __( "Gallery" ),
						"rewrite" => array("slug" => "gallery")
					),
			"query_var" => true,
    		"rewrite" => true,
	    	"capability_type" => "post",
			"public" => true,
			"show_ui" => false)
	);
} ?>