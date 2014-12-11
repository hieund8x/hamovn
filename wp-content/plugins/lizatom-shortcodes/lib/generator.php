<?php

	// Start WordPress
	require( '../../../../wp-load.php' );

	// Capability check
	if ( !current_user_can( 'publish_posts' ) )
		die( 'Access denied' );

	// Param check
	if ( empty( $_GET['shortcode'] ) )
		die( 'Shortcode not specified' );

	$shortcode = lts_shortcodes( $_GET['shortcode'] );

	// Shortcode has atts
	if ( count( $shortcode['atts'] ) && $shortcode['atts'] ) {
	   $return .= '<p>';
            $return .= '<label>Usage</label>';
            $return .= '<code class="lt-generator-attr">'. htmlspecialchars( $shortcode['usage'] ) .'</code>';
            $return .= '</p>';
		foreach ( $shortcode['atts'] as $attr_name => $attr_info ) {
		    
			$return .= '<p>';                    
			$return .= '<label for="lt-generator-attr-' . $attr_name . '">' . $attr_info['desc'] . '</label>';

			// Select
			if ( count( $attr_info['values'] ) && $attr_info['values'] ) {			
				$return .= '<select name="' . $attr_name . '" id="lt-generator-attr-' . $attr_name . '" class="lt-generator-attr">';
				foreach ( $attr_info['values'] as $attr_value ) {
					$attr_value_selected = ( $attr_info['default'] == $attr_value ) ? ' selected="selected"' : '';
					$return .= '<option' . $attr_value_selected . '>' . $attr_value . '</option>';
				}
				$return .= '</select>';
			}

			// Text input
			else {
				$attr_field_type = ( $attr_info['type'] == 'color' ) ? 'color' : 'text';
				$return .= '<input type="' . $attr_field_type . '" name="' . $attr_name . '" value="' . $attr_info['default'] . '" id="lt-generator-attr-' . $attr_name . '" class="lt-generator-attr" />';
			}
			$return .= '</p>';
		}
	}

	// Single shortcode (not closed)
	if ( $shortcode['type'] == 'single' ) {
		$return .= '<input type="hidden" name="lt-generator-content" id="lt-generator-content" value="false" />';
	}

	// Wrapping shortcode
	else {
		$return .= '<p><label>' . __( 'Content', 'lizatom-shortcodes' ) . '</label><input type="text" name="lt-generator-content" id="lt-generator-content" value="' . $shortcode['content'] . '" /></p>';
	}

	$return .= '<p><a href="#" class="button-primary" id="lt-generator-insert">' . __( 'Insert', 'lizatom-shortcodes' ) . '</a> ';
	$return .= '</p>';

	$return .= '<input type="hidden" name="lt-generator-result" id="lt-generator-result" value="" />';

	echo $return;
?>
