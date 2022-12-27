(function(){
	tinymce.PluginManager.add('at_shortcodes_generator_button', function( editor, url ) {
		editor.addButton( 'at_shortcodes_generator_button', {
			text: 'Shortcodes',
			icon: false,
			onclick: function() {
				var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 992 < width ) ? 992 : width;
				W = W - 80;
				H = H - 84;
				tb_show( 'Shortcodes', ajaxurl + '?action=at_shortcodes_form&width=' + W + '&height=' + H + '&inlineId=endcore-shortcodes-form' );
			}
		});
	});
})()