(function () {
	'use strict';

	var $ = require('jquery');

	if (typeof gmInit == 'undefined') {
		return;
	}

	gmInit(function () {
		$('.google-map').each(function () {
			var mapEl = $(this);
			var lat = parseFloat(mapEl.attr('data-lat'));
			var lng = parseFloat(mapEl.attr('data-lng'));

			var map = new google.maps.Map(mapEl[0], {
				center: {
					lat: lat,
					lng: lng
				},
				zoom: 15,
				scrollwheel: false,
				mapTypeControl: false,
				streetViewControl: false,

				// https://snazzymaps.com/style/134/light-dream
				styles: [{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]
			});

			new google.maps.Marker({
				position: new google.maps.LatLng(lat, lng),
				map: map
			});
		});
	});
})();
