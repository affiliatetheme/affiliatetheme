(function($){

	function initialize_field( $el ) {

		//$el.doStuff();

	}

	function add_to_selected_list( key, $field ) {
		var current = $field.val();
		var values = [];

		if( current === '' || typeof current === 'undefined' || current === null || current === '{}' ) {
			values.push( key );
		}
		else {
			var values = $.parseJSON( current );
			values.push( key )
		}

		values = JSON.stringify( values );
		$field.val( values );

	}

	function sort_selected( $multiselect ) {
		var $selected = $multiselect.find( '.selected.field li' );
		var $input_field = $multiselect.find( '#field-value' );

		values = [];
		if( $selected.length > 0 ) {
			$.each( $selected, function() {
				values.push( $(this).data('key') );
			})
		}

		values = JSON.stringify( values );
		$input_field.val( values );

	}

	function add_to_list_ui( $item, $list, $other_list ) {
		$item.appendTo( $list );
	}

	function order_list( $list ) {
		var list_array = [];
		$.each( $list.find('li'), function() {
			list_array.push( $(this).data('search_term') );
		})
		list_array.sort();

		$.each( list_array, function() {
			$list.append( $list.find("li[data-search_term='" + this + "']") );
		})

	}

	function remove_from_selected_list( key, $field ) {
		var current = $.parseJSON( $field.val() );

		current = $.grep( current, function(value) {
		  return value != key;
		});

		values = JSON.stringify( current );
		if( values === '[]' ) {
			values = '';
		}
		$field.val( values );

	}

	function get_field_search_elements( query, $selectable ) {
		var toShow = $();
		$.each( $selectable.find('li'), function() {
			var search_term = $(this).data('search_term').toLowerCase();
			query = query.toLowerCase();
			if( search_term.indexOf( query ) > -1 ) {
				var $element = $( 'li[data-key="' + $(this).data('key') + '"]' );
				toShow = toShow.add( $element );
			}
		});

		return toShow;
	}


	if( typeof acf.add_action !== 'undefined' ) {

		/*
		*  ready append (ACF5)
		*
		*  These are 2 events which are fired during the page load
		*  ready = on page load similar to $(document).ready()
		*  append = on new DOM elements appended via repeater field
		*
		*  @type	event
		*  @date	20/07/13
		*
		*  @param	$el (jQuery selection) the jQuery element which contains the ACF fields
		*  @return	n/a
		*/

		acf.add_action('ready append', function( $el ){

			// search $el for fields of type 'FIELD_NAME'
			acf.get_fields({ type : 'field_selector'}, $el).each(function(){

				initialize_field( $(this) );

				var $this = $(this);

    			$(this).find('.selected.field').sortable({
					axis: 'y',
					containerment: 'parent',
					cursor: 'move',
					items: 'li',
					helper: 'clone',
					placeholder: 'sortable-placeholder',
					forcePlaceholderSize: true,
					opacity: 0.5,
					revert: 100,
					stop: function() {
						sort_selected( $this );
					}

				});
    			$(this).find('.selected').disableSelection();


				$( document ).on( 'click', '.multiselector .selectable li', function() {
					var $multiselector = $(this).parents( '.multiselector' );
					var $selected = $multiselector.find( '.selected ul' );
					var $selectable = $multiselector.find( '.selectable ul' );
					var $input_field = $multiselector.find( '#field-value' );
					var key = $(this).data('key');

					add_to_list_ui( $(this), $selected, $selectable );
					add_to_selected_list( key, $input_field );
				})

				$( document ).on( 'click', '.multiselector .selected li', function() {
					var $multiselector = $(this).parents( '.multiselector' );
					var $selectable = $multiselector.find( '.selectable ul' );
					var $selected = $multiselector.find( '.selected ul' );
					var $input_field = $multiselector.find( '#field-value' );
					var key = $(this).data('key');

					add_to_list_ui( $(this), $selectable, $selected );
					order_list( $selectable );
					remove_from_selected_list( key, $input_field );
				})

				$( document ).on( 'keyup', '.multiselector #field-search', function() {
					var query = $(this).val();
					var $multiselector = $(this).parents( '.multiselector' );
					var $selectable = $multiselector.find( '.selectable ul' );

					var $search_elements = get_field_search_elements( query, $selectable );

					$selectable.find('li').hide();
					$search_elements.show();

				})



			});

		});


	} else {


		/*
		*  acf/setup_fields (ACF4)
		*
		*  This event is triggered when ACF adds any new elements to the DOM.
		*
		*  @type	function
		*  @since	1.0.0
		*  @date	01/01/12
		*
		*  @param	event		e: an event object. This can be ignored
		*  @param	Element		postbox: An element which contains the new HTML
		*
		*  @return	n/a
		*/

		$(document).live('acf/setup_fields', function(e, postbox){

			$(postbox).find('.field[data-field_type="field_selector"]').each(function(){

				initialize_field( $(this) );

				var $this = $(this);

    			$(this).find('.selected.field').sortable({
					axis: 'y',
					containerment: 'parent',
					cursor: 'move',
					items: 'li',
					helper: 'clone',
					placeholder: 'sortable-placeholder',
					forcePlaceholderSize: true,
					opacity: 0.5,
					revert: 100,
					stop: function() {
						sort_selected( $this );
					}

				});
    			$(this).find('.selected').disableSelection();


				$( document ).on( 'click', '.multiselector .selectable li', function() {
					var $multiselector = $(this).parents( '.multiselector' );
					var $selected = $multiselector.find( '.selected ul' );
					var $selectable = $multiselector.find( '.selectable ul' );
					var $input_field = $multiselector.find( '#field-value' );
					var key = $(this).data('key');

					add_to_list_ui( $(this), $selected, $selectable );
					add_to_selected_list( key, $input_field );
				})

				$( document ).on( 'click', '.multiselector .selected li', function() {
					var $multiselector = $(this).parents( '.multiselector' );
					var $selectable = $multiselector.find( '.selectable ul' );
					var $selected = $multiselector.find( '.selected ul' );
					var $input_field = $multiselector.find( '#field-value' );
					var key = $(this).data('key');

					add_to_list_ui( $(this), $selectable, $selected );
					order_list( $selectable );
					remove_from_selected_list( key, $input_field );
				})

				$( document ).on( 'keyup', '.multiselector #field-search', function() {
					var query = $(this).val();
					var $multiselector = $(this).parents( '.multiselector' );
					var $selectable = $multiselector.find( '.selectable ul' );

					var $search_elements = get_field_search_elements( query, $selectable );

					$selectable.find('li').hide();
					$search_elements.show();

				})


			});

		});


	}


})(jQuery);
