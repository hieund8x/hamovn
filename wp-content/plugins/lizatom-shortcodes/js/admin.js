jQuery(document).ready(function($) {

	// Code editor
	var lts_custom_editor = CodeMirror.fromTextArea(document.getElementById("lt-custom-css"), {});

	// Tables
	$('.lt-table-shortcodes tr:even, .lt-table-demos tr:even').addClass('even');

	// Tabs
	$('#lt-wrapper .lt-pane:first').show();
	$('#lt-tabs a').click(function() {
		$('.lt-message').hide();
		$('#lt-tabs a').removeClass('lt-current');
		$(this).addClass('lt-current');
		$('#lt-wrapper .lt-pane').hide();
		$('#lt-wrapper .lt-pane').eq($(this).index()).show();
		lts_custom_editor.refresh();
	});

	// Ajaxify settings form
	$('#lt-form-save-settings').ajaxForm({
		beforeSubmit: function() {
			$('#lt-form-save-settings .lt-spin').show();
			$('#lt-form-save-settings .lt-submit').attr('disabled', true);
		},
		success: function() {
			$('#lt-form-save-settings .lt-spin').hide();
			$('#lt-form-save-settings .lt-submit').attr('disabled', false);
		}
	});

	// Ajaxify custom CSS form
	$('#lt-form-save-custom-css').ajaxForm({
		beforeSubmit: function() {
			$('#lt-form-save-custom-css .lt-spin').show();
			$('#lt-form-save-custom-css .lt-submit').attr('disabled', true);
		},
		success: function() {
			$('#lt-form-save-custom-css .lt-spin').hide();
			$('#lt-form-save-custom-css .lt-submit').attr('disabled', false);
		}
	});

	// Auto-open tab by link with hash
	if ( strpos( document.location.hash, '#tab-' ) !== false )
		$('#lt-tabs a:eq(' + document.location.hash.replace('#tab-','') + ')').trigger('click');

});

// ########## Strpos tool ##########

function strpos( haystack, needle, offset) {
	var i = haystack.indexOf( needle, offset );
	return i >= 0 ? i : false;
}