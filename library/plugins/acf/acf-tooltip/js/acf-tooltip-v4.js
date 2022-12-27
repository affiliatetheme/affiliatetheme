(function($) {

	var tooltiptext;
	var label;

	$(document).live('acf/setup_fields', function (e, div) {
		$('.acf_postbox p.label').each(function() {
			label = $(this).find('label');
			label.detach();
			tooltiptext = $(this).html();
			$(this).html('')
			label.appendTo( $(this) );
			acf_label_tooltips(label, tooltiptext);
		});

		$('.repeater tr.row td.label, .acf-flexible-content .values.ui-sortable .layout tr.sub_field td.label').each(function() {
			label = $(this).find('label');
			tooltiptext = label.parent().find('.sub-field-instructions').html();
			label.parent().find('.sub-field-instructions').remove();
			acf_label_tooltips(label, tooltiptext);
		});

		$('.repeater th.acf-th-text, .acf-flexible-content .values.ui-sortable .layout th.acf-th-text').each(function() {
			tooltiptext = $(this).find('.sub-field-instructions').html();
			$(this).find('.sub-field-instructions').remove();
			label = $(this).find('span');
			acf_label_tooltips(label, tooltiptext);
		});

		$('.tooltip').qtip({
			style: {
				classes: 'qtip-acf',
				def: false
			},
			position: {
				my: 'center left',  // Position my top left...
				at: 'right center', // at the bottom right of...
			}
		});

	});

	function acf_label_tooltips(labelfield, tooltiptext) {
		if( !$.trim(tooltiptext) =='') {
			if ( !label.hasClass('has_tooltip') ) {
				label.append('<span class="tooltip" title="'+tooltiptext+'"> <span class="dashicons dashicons-editor-help"></span></span>');
				label.addClass('has_tooltip');
			}
		}
	};
	
})(jQuery);
