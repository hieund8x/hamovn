    </div><!--End the content container -->
    	<!--Begin Footer Navigation -->        
            <div id="footer-navigation-container">
            <?php if (function_exists("wp_nav_menu")) :	
                 wp_nav_menu(array(
                    'menu' => 'Motion Picture Footer Nav',
                    'menu_id' => 'footer-nav',
                    'menu_class' => 'clearfix',
                    'sort_column' 	=> 'menu_order',
                    'theme_location' => 'secondary',
                    'container' => 'ul',
                    'fallback_cb' => 'ocmx_fallback_secondary')
                     );
                 endif; ?>
            </div>
           
	<div id="footer-container">
		<div id="footer">
      		<!--Begin Footer Widget Area -->
            <ul class="footer-widgets">
                <?php if (function_exists('dynamic_sidebar')) :
                    dynamic_sidebar(4);
                endif; ?>
            </ul> 
             <!--Begin Footer Copyright Area -->
            <div class="footer-text">
                <p><?php echo stripslashes(get_option("ocmx_custom_footer")); ?></p>
                <?php if(get_option("ocmx_logo_hide") != "true") : ?>
                    <div class="obox-credit">
                    	<p><a href="http://www.obox-design.com">WordPress Themes</a> by <a href="http://www.obox-design.com"><img src="<?php bloginfo("template_directory"); ?>/images/obox-logo.png" alt="Theme created by Obox" /></a></p>
                    </div>
                <?php endif; ?>
            </div>
		</div>
	</div> <!-- End Footer Container -->

<div id="template-directory" class="no_display"><?php echo bloginfo("template_directory"); ?></div>
<!--End Footer -->
<?php wp_footer(); ?>

<!--Google Analytics code -->
<?php 
	if(get_option("ocmx_googleAnalytics")) :
		echo stripslashes(get_option("ocmx_googleAnalytics"));
	endif;
?>
<script>
  jQuery(document).ready(function(){
    jQuery(".fitvid").fitVids();
  });
</script>
</body>
</html>