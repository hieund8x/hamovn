jQuery(document).ready(function($) {

	// Select shortcode
	$('#lt-generator-select').live( "change", function() {
		var queried_shortcode = $('#lt-generator-select').find(':selected').val();
		$('#lt-generator-settings').addClass('lt-loading-animation');
		$('#lt-generator-settings').load($('#lt-generator-url').val() + '/lib/generator.php?shortcode=' + queried_shortcode, function() {
			$('#lt-generator-settings').removeClass('lt-loading-animation');
		});
	});

	// Insert shortcode
	$('#lt-generator-insert').live('click', function(event) {
		var queried_shortcode = $('#lt-generator-select').find(':selected').val();
		var lts_compatibility_mode_prefix = $('#lt-compatibility-mode-prefix').val();
		$('#lt-generator-result').val('[' + lts_compatibility_mode_prefix + queried_shortcode);
		$('#lt-generator-settings .lt-generator-attr').each(function() {
			if ( $(this).val() !== '' ) {
				$('#lt-generator-result').val( $('#lt-generator-result').val() + ' ' + $(this).attr('name') + '="' + $(this).val() + '"' );
			}
		});
		$('#lt-generator-result').val($('#lt-generator-result').val() + ']');

		// wrap shortcode
		if ( $('#lt-generator-content').val() != 'false' ) {
			$('#lt-generator-result').val($('#lt-generator-result').val() + $('#lt-generator-content').val() + '[/' + lts_compatibility_mode_prefix + queried_shortcode + ']');
		}

		var shortcode = jQuery('#lt-generator-result').val();

		// Insert into widget
		if ( typeof window.lts_generator_target !== 'undefined' ) {
			jQuery('textarea#' + window.lts_generator_target).val( jQuery('textarea#' + window.lts_generator_target).val() + shortcode);
			tb_remove();
		}

		// Insert into editor
		else {
			window.send_to_editor(shortcode);
		}

		// Prevent default action
		event.preventDefault();
		return false;
	});

	// Widget insertion button click
	jQuery('a[data-page="widget"]').live('click',function(event) {
		window.lts_generator_target = jQuery(this).attr('data-target');
	});

});