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
			// TODO: Add geolocation-lookup from thepace

			var map = new google.maps.Map(mapEl[0], {
				center: {
					lat: lat,
					lng: lng
				},
				zoom: 15,
				scrollwheel: false,
				mapTypeControl: false,
				streetViewControl: false
			});

			new google.maps.Marker({
				position: new google.maps.LatLng(lat, lng),
				map: map
			});
		});
	});
})();
