/**
 * 
 * jquery extend for combobox
 */
(function ($) {
	$.widget("custom.combobox", {
		_create: function () {
			this.wrapper = $("<span>")
					.addClass("input-group")
					.insertAfter(this.element);
			this.element.hide();
			this._createAutocomplete();
			this._createShowAllButton();
		},
		_createAutocomplete: function () {
			var selected = this.element.children(":selected"),
					value = selected.val() ? selected.text() : "";
			this.input = $("<input>")
					.appendTo(this.wrapper)
					.val(value)
					.attr("title", "")
					.addClass("form-control")
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: $.proxy(this, "_source")
					})
					.tooltip({
						tooltipClass: "ui-state-highlight"
					});
			if(this.element.data('comboboxplaceholder') !== '' && this.element.data('comboboxplaceholder') !== 'undefined' ){
				this.input.attr('placeholder',this.element.data('comboboxplaceholder'));
			}
			this._on(this.input, {
				autocompleteselect: function (event, ui) {
					ui.item.option.selected = true;
					this._trigger("select", event, {
						item: ui.item.option
					});
					console.log(this.element);
					if(this.element[0].tagName.toLowerCase() == 'select'){
						this.element.change();
					}else{
						console.log('trigger input');
						this.element.focusout();
					}
				},
				autocompletechange: "_removeIfInvalid"
			});
		},
		_createShowAllButton: function () {
			var input = this.input,
					wasOpen = false;
			$("<span>")
					.attr("tabIndex", -1)
//					.attr("title", "Show All Items")
//					.tooltip()
					.appendTo(this.wrapper)
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: '<span class="show-all">'
					})
					.removeClass("ui-corner-all")
					.addClass("input-group-addon icon-down-open")
					.mousedown(function () {
						wasOpen = input.autocomplete("widget").is(":visible");
					})
					.click(function () {
						input.focus();
// Close if already visible
						if (wasOpen) {
							return;
						}
// Pass empty string as value to search for, displaying all results
						input.autocomplete("search", "");
					});
		},
		_source: function (request, response) {
			var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
			response(this.element.children("option").map(function () {
				var text = $(this).text();
				if (this.value && (!request.term || matcher.test(text)))
					return {
						label: text,
						value: text,
						option: this
					};
			}));
		},
		_removeIfInvalid: function (event, ui) {
// Selected an item, nothing to do
			if (ui.item) {
				return;
			}
// Search for a match (case-insensitive)
			var value = this.input.val(),
					valueLowerCase = value.toLowerCase(),
					valid = false;
			this.element.children("option").each(function () {
				if ($(this).text().toLowerCase() === valueLowerCase) {
					this.selected = valid = true;
					return false;
				}
			});
// Found a match, nothing to do
			if (valid) {
				return;
			}
// Remove invalid value
			this.input
					.val("")
					.attr("title", value + " didn't match any item")
					.tooltip("open");
			this.element.val("");
			this._delay(function () {
				this.input.tooltip("close").attr("title", "");
			}, 2500);
			this.input.autocomplete("instance").term = "";
		},
		_destroy: function () {
			this.wrapper.remove();
			this.element.show();
		}
	});
})(jQuery);


/**
 * on dom ready
 */

$('.filter').find('form').each(function(){
	var form  = $(this);
	form.find('input[type="submit"]').hide();
	form.find('.form-control').on('focusin',function(){
		var value = $(this).val();
		$(this).on('focusout',function(e){
			if(value != $(this).val()){
				form.submit();
			}
		});
	});
	form.find('select').on('change',function(){
		form.submit();
	});
});

$(document).ready(function(){
	/**
	 * monthJumpNav
	 */
	$('#monthJumpNav > select').change(function(){
		$('#monthJumpNav').submit();
	});
	
	$('.autosuggest-combobox').combobox();
	$('.autosuggest-ajax-list').each(function(){
		var $e = $(this);
		var url = $(this).data('url');
		$e.autocomplete({
			source: function (request, response) {
				$.ajax({
					url: url,
					dataType: 'json',
					type: 'get',
					data: 'ajax[arguments][q]='+request.term,
					success: function(data) {
						$e.removeClass('ui-autocomplete-loading');
						response($.map(data, function (item) {
							return {
								label: item.name,
								value: item.name
							};
						}));
					},
					error: function(data) {
						$e.removeClass('ui-autocomplete-loading');
					},
				});
			},
			select: function( event, ui ) {
				console.log(ui.item.label);
				$e.val( ui.item.label ).focusout();
			},
			minLength: 3,
		});
	});
	
//		WE need that globally.... moved to main.js
//	var minDate = '+1d',
//		maxDate = '+24M',
//		baseRange = 0;
//	$('.datepicker').datepicker({
//		dateFormat: 'dd.mm.yy',
//		dayNamesMin: ['Mo','Di','Mi','Do','Fr','Sa','So'],
//		monthNames: ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'],
//		nextText: '&gt;',
//		prevText: '&lt;',
//		minDate: minDate,
//		maxDate: maxDate,
//		firstDay: 1,
//		onSelect: function( selectedDate ) {
//			var minEndDate = new Date( $(this).datepicker('getDate') );
//			var ankDate = minEndDate.getDate();
//			minEndDate.setDate(ankDate + baseRange);
//
//			//set until-Date correspondently, if empty + set the mindate for it....
//			var eUntil = $(this).parents('form').find('.datepicker-until');
//			eUntil.datepicker( "option", "minDate", minEndDate ); 
//
////			var newDiff = dateInterval( $(this).datepicker('getDate') , eUntil.datepicker('getDate') );
//			$(this).blur();
//		}
//	});
	
	$('.toggle-filter').click(function(){
		var filter = $(this).parents('.filter');
		filter.toggleClass('open');
		if(filter.hasClass('open')){
			var toggleText = $(this).data('closetext');
			filter.find('.switch-view-wrap').fadeOut('fast').css({position: 'relative',right:'auto',top:'auto'}).fadeIn(0);
		}else{
			var toggleText = $(this).data('opentext');	
		}
		$(this).text(toggleText);
		filter.one('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function() {
			if(!filter.hasClass('open')){
				filter.find('.switch-view-wrap').hide().css({position: 'absolute',right:'0px', top:'-15px'}).fadeIn('slow');
			}
		});
	});
	
	
	$('.day-toggle').click(function(){
		var ul = $(this).parent().next();
		ul.toggleClass('open');
		var toggleText = $(this).data('closetext');
		if(!ul.hasClass('open')){
			toggleText = $(this).data('opentext');
		}
		$(this).text(toggleText);
	});
	
	
});





/**
 * 
 * 
 * detail MAP-Stuff
 * 
 * 
 */	
function initialize() {
	
	$('#location-map').each(function(i){
		var mapCanvas = $(this);
		var location = mapCanvas.data('location');
		// geocoding
		if( mapCanvas.data('geocode') === true && location !== ''){
			geocoder = new google.maps.Geocoder();
			geocoder.geocode({ 'address': location.address+','+location.city }, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					map.setCenter(results[0].geometry.location);
					var marker = new google.maps.Marker({
						map: map,
						position: results[0].geometry.location,
						title: location.name,
						icon: new google.maps.MarkerImage('/typo3conf/ext/z3_map/Resources/Public/Icons/map_marker_53x77.png'),
						width: 53,
						height: 77,
						anchor: new google.maps.Point( 53, 77 ),
					});
					
				}
			});
		}
		// map
		var mapOptions = {
			zoom: 18,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			panControl: false,
			zoomControl: true,
			scaleControl: false,
			streetViewControl: false,
			overviewMapControl: false,
			mapTypeControl: false,
		};
		var map = new google.maps.Map(mapCanvas.get(0), mapOptions);
		
	});
}

function loadScript() {
	var script = document.createElement('script');
	script.type = 'text/javascript';
	script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' + 'callback=initialize';
	document.body.appendChild(script);
}

loadScript();