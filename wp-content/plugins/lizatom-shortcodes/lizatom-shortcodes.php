<?php
	/*
	  Plugin Name: Lizatom Shortcodes (shared by thachpham.com)
	  Plugin URI: http://lizatom.com/wordpress-plugin/lizatom-shortcodes/
	  Version: 1.3.1
	  Author: Lizatom.com
	  Author URI: http://lizatom.com
	  Description: Easily add new elements in to the articles.
	  Text Domain: lizatom-shortcodes
	  Domain Path: /languages
	  License: GPL2
	 */

	// Load libs
	require_once 'lib/available.php';
	require_once 'lib/admin.php';
	require_once 'lib/shortcodes.php';
	require_once 'lib/color.php';

	/**
	 * Plugin initialization
	 */
	function lts_plugin_init() {

		// Make plugin available for translation
		load_plugin_textdomain( 'lizatom-shortcodes', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

		// Enable shortcodes in text widgets
		add_filter( 'widget_text', 'do_shortcode' );

		// Enable auto-formatting
		if ( get_option( 'lts_disable_custom_formatting' ) != 'on' ) {

			// Disable WordPress native formatters
			remove_filter( 'the_content', 'wpautop' );
			remove_filter( 'the_content', 'wptexturize' );

			// Apply custom formatter function
			add_filter( 'the_content', 'lts_custom_formatter', 99 );
			add_filter( 'widget_text', 'lts_custom_formatter', 99 );
		}

		// Fix for large posts, http://core.trac.wordpress.org/ticket/8553
		@ini_set( 'pcre.backtrack_limit', 500000 );

		// Register styles
		wp_register_style( 'lizatom-shortcodes', lts_plugin_url() . '/css/style.css', false, lts_get_version(), 'all' );
		wp_register_style( 'lizatom-shortcodes-admin', lts_plugin_url() . '/css/admin.css', false, lts_get_version(), 'all' );
		wp_register_style( 'lizatom-shortcodes-generator', lts_plugin_url() . '/css/generator.css', false, lts_get_version(), 'all' );
		wp_register_style( 'codemirror', lts_plugin_url() . '/css/codemirror.css', false, lts_get_version(), 'all' );
		wp_register_style( 'codemirror-css', lts_plugin_url() . '/css/codemirror-css.css', false, lts_get_version(), 'all' );

		// Register scripts
		wp_register_script( 'lizatom-shortcodes', lts_plugin_url() . '/js/init.js', false, lts_get_version(), false );
		wp_register_script( 'lizatom-shortcodes-admin', lts_plugin_url() . '/js/admin.js', false, lts_get_version(), false );
		wp_register_script( 'lizatom-shortcodes-generator', lts_plugin_url() . '/js/generator.js', array( 'jquery' ), lts_get_version(), false );
		wp_register_script( 'codemirror', lts_plugin_url() . '/js/codemirror.js', false, lts_get_version(), false );
		wp_register_script( 'codemirror-css', lts_plugin_url() . '/js/codemirror-css.js', false, lts_get_version(), false );
		wp_register_script( 'ajax-form', lts_plugin_url() . '/js/jquery.form.js', false, lts_get_version(), false );

		// Front-end scripts and styles
		if ( !is_admin() ) {

			$disabled_scripts = get_option( 'lts_disabled_scripts' );
			$disabled_styles = get_option( 'lts_disabled_styles' );

			// Enqueue styles			
			if ( !isset( $disabled_styles['style'] ) ) {
				wp_enqueue_style( 'lizatom-shortcodes' );
			}

			// Enqueue scripts
			if ( !isset( $disabled_scripts['jquery'] ) ) {
				wp_enqueue_script( 'jquery' );
			}			
			if ( !isset( $disabled_scripts['init'] ) ) {
				wp_enqueue_script( 'lizatom-shortcodes' );
			}
		}

		// Back-end scripts and styles
		elseif ( isset( $_GET['page'] ) && $_GET['page'] == 'lizatom-shortcodes' ) {

			// Enqueue styles
			wp_enqueue_style( 'codemirror' );
			wp_enqueue_style( 'codemirror-css' );
			wp_enqueue_style( 'lizatom-shortcodes-admin' );

			// Enqueue scripts
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'codemirror' );
			wp_enqueue_script( 'codemirror-css' );
			wp_enqueue_script( 'ajax-form' );
			wp_enqueue_script( 'lizatom-shortcodes-admin' );
		}

		// Scipts and stylesheets for editing pages (shortcode generator popup)
		elseif ( is_admin() ) {

			// Get current page type
			global $pagenow;

			// Pages for including
			$lts_generator_includes_pages = array( 'post.php', 'edit.php', 'post-new.php', 'index.php', 'edit-tags.php', 'widgets.php' );

			if ( in_array( $pagenow, $lts_generator_includes_pages ) ) {
				// Enqueue styles
				wp_enqueue_style( 'thickbox' );
				wp_enqueue_style( 'lizatom-shortcodes-generator' );

				// Enqueue scripts
				wp_enqueue_script( 'jquery' );
				wp_enqueue_script( 'thickbox' );
				wp_enqueue_script( 'lizatom-shortcodes-generator' );
			}
		}

		// Register shortcodes
		foreach ( lts_shortcodes() as $shortcode => $params ) {
			add_shortcode( lts_compatibility_mode_prefix() . $shortcode, 'lts_' . $shortcode . '_shortcode' );
		}
	}

	add_action( 'init', 'lts_plugin_init' );

	/**
	 * Returns current plugin version.
	 *
	 * @return string Plugin version
	 */
	function lts_get_version() {
		if ( !function_exists( 'get_plugins' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
		$plugin_file = basename( ( __FILE__ ) );
		return $plugin_folder[$plugin_file]['Version'];
	}

	/**
	 * Returns current plugin url
	 *
	 * @return string Plugin url
	 */
	function lts_plugin_url() {
		return plugins_url( basename( __FILE__, '.php' ), dirname( __FILE__ ) );
	}

	/**
	 * Shortcode names prefix in compatibility mode
	 *
	 * @return string Special prefix
	 */
	function lts_compatibility_mode_prefix() {
		$prefix = ( get_option( 'lts_compatibility_mode' ) == 'on' ) ? 'lts_' : '';
		return $prefix;
	}

	/**
	 * Hook to translate plugin information
	 */
	function lts_add_locale_strings() {
		$strings = __( 'Lizatom Shortcodes', 'lizatom-shortcodes' ) . __( 'Lizatom.com', 'lizatom-shortcodes' ) . __( 'Easily add new elements into your articles or widgets.', 'lizatom-shortcodes' );
	}

	/*
	 * Custom shortcode function for nested shortcodes support
	 */

	function lts_do_shortcode( $content, $modifier ) {
		if ( strpos( $content, '[_' ) !== false ) {
			$content = preg_replace( '@(\[_*)_(' . $modifier . '|/)@', "$1$2", $content );
		}
		return do_shortcode( $content );
	}

	/**
	 * Disable auto-formatting for shortcodes
	 *
	 * @param string $content
	 * @return string Formatted content with clean shortcodes content
	 */
	function lts_custom_formatter( $content ) {
		$new_content = '';

		// Matches the contents and the open and closing tags
		$pattern_full = '{(\[raw\].*?\[/raw\])}is';

		// Matches just the contents
		$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';

		// Divide content into pieces
		$pieces = preg_split( $pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE );

		// Loop over pieces
		foreach ( $pieces as $piece ) {

			// Look for presence of the shortcode
			if ( preg_match( $pattern_contents, $piece, $matches ) ) {

				// Append to content (no formatting)
				$new_content .= $matches[1];
			} else {

				// Format and append to content
				$new_content .= wptexturize( wpautop( $piece ) );
			}
		}

		return $new_content;
	}

	/**
	 * Print custom CSS styles in wp_head
	 *
	 * @return string Custom CSS
	 */
	function lts_print_custom_css() {
		if ( get_option( 'lts_custom_css' ) ) {
			echo "\n<!-- Lizatom Shortcodes custom CSS - begin -->\n<style type='text/css'>\n" . str_replace( '%theme%', get_template_directory_uri(), get_option( 'lts_custom_css' ) ) . "\n</style>\n<!-- Lizatom Shortcodes custom CSS - end -->\n\n";
		}
	}

	add_action( 'wp_head', 'lts_print_custom_css' );

	/**
	 * Manage settings
	 */
	function lts_manage_settings() {

		// Insert default CSS
		if ( !get_option( 'lts_custom_css' ) ) {
			$default_css = '';
			update_option( 'lts_custom_css', $default_css );
		}

		// Save main settings
		if ( isset( $_POST['save'] ) && $_GET['page'] == 'lizatom-shortcodes' ) {
			update_option( 'lts_disable_custom_formatting', $_POST['lts_disable_custom_formatting'] );
			update_option( 'lts_compatibility_mode', $_POST['lts_compatibility_mode'] );
			update_option( 'lts_disabled_scripts', $_POST['lts_disabled_scripts'] );
			update_option( 'lts_disabled_styles', $_POST['lts_disabled_styles'] );
		}

		// Save custom css
		if ( isset( $_POST['save-css'] ) && $_GET['page'] == 'lizatom-shortcodes' ) {
			update_option( 'lts_custom_css', $_POST['lts_custom_css'] );
		}
	}

	add_action( 'admin_init', 'lts_manage_settings' );

	/**
	 * Add settings link to plugins dashboard
	 *
	 * @param array $links Links
	 * @return array Links
	 */
	function lts_add_settings_link( $links ) {
		$links[] = '<a href="' . admin_url( 'options-general.php?page=lizatom-shortcodes' ) . '">' . __( 'Settings', 'lizatom-shortcodes' ) . '</a>';
		$links[] = '<a href="' . admin_url( 'options-general.php?page=lizatom-shortcodes#tab-3' ) . '">' . __( 'Docs', 'lizatom-shortcodes' ) . '</a>';
		return $links;
	}

	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'lts_add_settings_link', -10 );

	/**
	 * Print notification if options saved
	 */
	function lts_save_notification() {

		// Save main settings
		if ( isset( $_POST['save'] ) && $_GET['page'] == 'lizatom-shortcodes' ) {
			echo '<div class="updated"><p><strong>' . __( 'Settings saved', 'lizatom-shortcodes' ) . '</strong></p></div>';
		}

		// Save custom css
		if ( isset( $_POST['save-css'] ) && $_GET['page'] == 'lizatom-shortcodes' ) {
			echo '<div class="updated"><p><strong>' . __( 'Custom CSS saved', 'lizatom-shortcodes' ) . '</strong></p></div>';
		}
	}

	/**
	 * Add generator button to Upload/Insert buttons
	 */
	function lts_add_generator_button( $page = null, $target = null ) {
		echo '<a href="#TB_inline?width=640&height=600&inlineId=lt-generator-wrap" class="thickbox" title="' . __( 'Insert shortcode', 'lizatom-shortcodes' ) . '" data-page="' . $page . '" data-target="' . $target . '"><img src="' . lts_plugin_url() . '/images/admin/media-icon.png" alt="" /></a>';
	}

	add_action( 'media_buttons', 'lts_add_generator_button', 100 );

	/**
	 * Generator popup box
	 */
	function lts_generator_popup() {
		?>
		<div id="lt-generator-wrap" style="display:none">
			<div id="lt-generator">
				<div id="lt-generator-shell">
					<div id="lt-generator-header">
						<select id="lt-generator-select">
							<option value="raw"><?php _e( 'Select shortcode', 'lizatom-shortcodes' ); ?></option>
							<?php
							foreach ( lts_shortcodes() as $name => $shortcode ) {
								?>
								<option value="<?php echo $name; ?>"><?php echo strtoupper( $name ); ?>:&nbsp;&nbsp;<?php echo $shortcode['desc']; ?></option>
								<?php
							}
							?>
						</select>
						<div id="lt-generator-tools">
							<a href="<?php echo admin_url( 'options-general.php?page=lizatom-shortcodes' ); ?>" target="_blank" title="<?php _e( 'Settings', 'lizatom-shortcodes' ); ?>"><img src="<?php echo lts_plugin_url(); ?>/images/generator/settings.png" alt="" /></a>
							<a href="http://lizatom.com/forum/" target="_blank" title="<?php _e( 'Support forum', 'lizatom-shortcodes' ); ?>"><img src="<?php echo lts_plugin_url(); ?>/images/generator/support.png" alt="" /></a>
						</div>
					</div>
					<div id="lt-generator-settings"></div>
					<input type="hidden" name="lt-generator-url" id="lt-generator-url" value="<?php echo lts_plugin_url(); ?>" />
					<input type="hidden" name="lt-compatibility-mode-prefix" id="lt-compatibility-mode-prefix" value="<?php echo lts_compatibility_mode_prefix(); ?>" />
				</div>
			</div>
		</div>
		<?php
	}

	add_action( 'admin_footer', 'lts_generator_popup' );
?>
