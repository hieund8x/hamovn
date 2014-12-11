<?php

	/**
	 * Register administration page
	 */
	function lizatom_shortcodes_add_admin() {
		add_options_page( __( 'Lizatom Shortcodes', 'lizatom-shortcodes' ), __( 'Lizatom Shortcodes', 'lizatom-shortcodes' ), 'manage_options', 'lizatom-shortcodes', 'lizatom_shortcodes_admin_page' );
	}

	/**
	 * Administration page
	 */
	function lizatom_shortcodes_admin_page() {

		$checked = ' checked="checked"';
		$disabled_formatting = ( get_option( 'lts_disable_custom_formatting' ) == 'on' ) ? $checked : '';
		$disabled_compatibility = ( get_option( 'lts_compatibility_mode' ) == 'on' ) ? $checked : '';
		$disabled_scripts = get_option( 'lts_disabled_scripts' );
		$disabled_styles = get_option( 'lts_disabled_styles' );
		?>

		<!-- .wrap -->
		<div class="wrap">

			<div id="icon-options-general" class="icon32"><br /></div>
			<h2><?php _e( 'Lizatom Shortcodes', 'lizatom-shortcodes' ); ?></h2>

			<!-- #lt-wrapper -->
			<div id="lt-wrapper">

				<?php lts_save_notification(); ?>

				<div id="lt-tabs">
					<a class="lt-current"><span><?php _e( 'Settings', 'lizatom-shortcodes' ); ?></span></a>
					<a><span><?php _e( 'Custom CSS', 'lizatom-shortcodes' ); ?></span></a>
					<a><span><?php _e( 'Shortcodes', 'lizatom-shortcodes' ); ?></span></a>
				</div>
				
				<!-- Settings -->
				<div class="lt-pane">
					<form action="" method="post" id="lt-form-save-settings">
						<p class="lt-message lt-message-loading"><?php _e( 'Saving...', 'lizatom-shortcodes' ); ?></p>
						<p class="lt-message lt-message-success"><?php _e( 'Settings saved', 'lizatom-shortcodes' ); ?></p>
						<table class="fixed">
							<tr>
								<td width="250">
									<p><label><input type="checkbox" name="lts_disable_custom_formatting" <?php echo $disabled_formatting; ?> /> <?php _e( 'Disable custom formatting', 'lizatom-shortcodes' ); ?></label></p>
								</td>
								<td>
									<p><small><?php _e( 'Enable this option if you have some problems with other plugins or content formatting', 'lizatom-shortcodes' ); ?></small></p>
								</td>
							</tr>
							<tr>
								<td>
									<p><label><input type="checkbox" name="lts_compatibility_mode" <?php echo $disabled_compatibility; ?> /> <?php _e( 'Compatibility mode', 'lizatom-shortcodes' ); ?></label></p>
								</td>
								<td>
									<p><small><?php _e( 'Enable this option if you have some problems with other plugins that uses similar shortcode names', 'lizatom-shortcodes' ); ?><br/><code>[button] => [lts_button]</code><br/></small></p>
								</td>
							</tr>
							<tr>
								<td colspan="2"><h4><?php _e( 'Disable scripts', 'lizatom-shortcodes' ); ?></h4></td>
							</tr>
							<tr>
								<td>
									<p><label><input type="checkbox" name="lts_disabled_scripts[jquery]" <?php echo ( isset( $disabled_scripts['jquery'] ) ) ? $checked : ''; ?> /> <?php _e( 'Disable', 'lizatom-shortcodes' ); ?> jQuery</label></p>
								</td>
								<td>
									<p><small><?php _e( 'Check scripts, that you want to exclude form wp_head section', 'lizatom-shortcodes' ); ?><br/><span class="lt-warning"><?php _e( 'Be careful with this settings!', 'lizatom-shortcodes' ); ?></span></small></p>
								</td>
							</tr>
							<tr>
								<td colspan="2"><h4><?php _e( 'Disable styles', 'lizatom-shortcodes' ); ?></h4></td>
							</tr>
							<tr>
								<td>
									<p><label><input type="checkbox" name="lts_disabled_styles[style]" <?php echo ( isset( $disabled_styles['style'] ) ) ? $checked : ''; ?> /> <?php _e( 'Disable', 'lizatom-shortcodes' ); ?> <code>style.css</code></label></p>
								</td>
								<td>
									<p><small><?php _e( 'Check stylesheets, that you want to exclude form wp_head section', 'lizatom-shortcodes' ); ?><br/><span class="lt-warning"><?php _e( 'Be careful with this settings!', 'lizatom-shortcodes' ); ?></span></small></p>
								</td>
							</tr>
							<tr><td><br/></td><td><br/></td></tr>
							<tr>
								<td colspan="2">
									<input type="submit" value="<?php _e( 'Save settings', 'lizatom-shortcodes' ); ?>" class="button-primary lt-submit" />
									<span class="lt-spin"><img src="<?php echo lts_plugin_url(); ?>/images/admin/spin.gif" alt="" /></span>
									<div class="lt-clear"></div>
									<input type="hidden" name="save" value="true" />
								</td>
							</tr>
						</table>
					</form>
				</div>
				<!-- custom CSS -->
				<div class="lt-pane">
					<form action="" method="post" id="lt-form-save-custom-css">
						<p class="lt-message lt-message-loading"><?php _e( 'Saving...', 'lizatom-shortcodes' ); ?></p>
						<p class="lt-message lt-message-success"><?php _e( 'Custom CSS saved', 'lizatom-shortcodes' ); ?></p>
						<p><?php _e( 'You can add custom styles, that will override defaults', 'lizatom-shortcodes' ); ?></p>
						<p><a href="<?php echo lts_plugin_url(); ?>/css/style.css" target="_blank"><?php _e( 'See original styles', 'lizatom-shortcodes' ); ?></a> </p>
						<p><textarea id="lt-custom-css" name="lts_custom_css" rows="14" cols="90"><?php echo get_option( 'lts_custom_css' ); ?></textarea></p>
						<p>
							<input type="submit" value="<?php _e( 'Save styles', 'lizatom-shortcodes' ); ?>" class="button-primary lt-submit" />
							<span class="lt-spin"><img src="<?php echo lts_plugin_url(); ?>/images/admin/spin.gif" alt="" /></span>
							<span class="lt-clear"></span>
							<input type="hidden" name="save-css" value="true" />
						</p>
					</form>
				</div>
				<!-- shortcodes showcase -->
				<div class="lt-pane">
					<table class="widefat fixed lt-table-shortcodes">
						<tr>
							<th width="150"><?php _e( 'Shortcode', 'lizatom-shortcodes' ); ?></th>
							<th width="200"><?php _e( 'Parameters', 'lizatom-shortcodes' ); ?></th>
							<th><?php _e( 'Usage', 'lizatom-shortcodes' ); ?></th>
						</tr>
						<?php
						foreach ( lts_shortcodes() as $id => $shortcode ) {
							?>
							<tr>
								<td>
									<strong><?php echo $id; ?></strong><br/>
									<small><?php echo $shortcode['desc']; ?></small>
								</td>
								<td>
									<?php
									foreach ( $shortcode['atts'] as $attr_name => $attr ) {
										echo '<strong>' . $attr['desc'] . '</strong><br/>';
										echo $attr_name;
										if ( $attr['values'] ) {
											echo '="' . implode( '|', $attr['values'] ) . '"';
										} elseif ( $attr['default'] ) {
											echo '="' . $attr['default'] . '"';
										}
										echo '<br/>';
									}
									?>
								</td>
								<td><?php echo str_replace( '&lt;br/&gt;', '<br/>', htmlspecialchars( $shortcode['usage'] ) ); ?></td>
							</tr>
							<?php
						}
						?>
					</table>
				</div>
			</div>
			<!-- /#lt-wrapper -->

		</div>
		<!-- /.wrap -->
		<?php
	}

	add_action( 'admin_menu', 'lizatom_shortcodes_add_admin' );
?>