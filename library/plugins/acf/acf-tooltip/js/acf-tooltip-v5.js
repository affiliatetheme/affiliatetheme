(function($) {

	var tooltiptext;
	var label;
	var description;

    if(jQuery('body[class*="acf-options"]').length > 0)
        return;
	
	if(jQuery('body.post-type-acf-field-group').length > 0)
        return;
	
	jQuery('body').addClass('hide-acf-descriptions');

	acf.add_action('ready append', function( $el ) {
		$('.clones .table-layout').addClass('is_clone');

		$('.acf-label').each(function() {
			acf_label_tooltips($(this));
		});

		$('*').not('.clones').find('.table-layout').not('.is_clone').find('thead > tr > .acf-th').each(function() {
			acf_repeater_tooltips($(this));
		});
		

		$('*').not('.clones').find('.table-layout').not('.is_clone').find('thead > tr > .acf-th').each(function() {
			acf_repeater_tooltips($(this));
		});

		$('.is_clone').removeClass('is_clone');

		acf_remove_clones();

		acf_tooltip();
		
	});

	function acf_remove_clones() {
		$('.acf-clone[data-layout="block"] td.acf-fields').each(function() {		
			acf_remove_class_and_span($(this));
		});

		$('.acf-clone[data-layout="row"] td.acf-label').each(function() {			
			acf_remove_class_and_span($(this));
		});

		$('.acf-clone[data-layout="table"] th.acf-th').each(function() {			
			// acf_remove_th_span($(this));
		});

		$('.acf-repeater .acf-clone .acf-label').each(function() {			
			acf_remove_class_and_span($(this));
		});
	};

	function acf_remove_class_and_span(that) {
		label = that.find('label');
		label.removeClass('has_tooltip')
			.find('span').remove();
	};

	function acf_remove_th_span(that) {
		that.find('span').remove();
	};

	function acf_tooltip() {
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
	}

	function acf_repeater_tooltips(repeaterfield) {		
		description = repeaterfield.find('p.description')
		tooltiptext = description.html();
		description.remove();
		if( !$.trim(tooltiptext) =='') {
			repeaterfield.append('<span class="tooltip" title="'+tooltiptext+'"> <span class="dashicons dashicons-editor-help"></span></span>');
		}
	};

	function acf_label_tooltips(labelfield) {
		tooltiptext = labelfield.find('p').html();
		label = labelfield.find('label');
		if( !$.trim(tooltiptext) =='') {
			if ( !label.hasClass('has_tooltip') ) {
				label.append('<span class="tooltip" title="'+tooltiptext+'"> <span class="dashicons dashicons-editor-help"></span></span>');
				label.addClass('has_tooltip');
			}
		}
	};
	
})(jQuery);
