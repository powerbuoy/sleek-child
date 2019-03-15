(function () {
	'use strict';

	var $ = require('jquery');
	var SleekMap = require('sleek-map');

	// Make sure we have an API key
	if (typeof gmInit === 'undefined' || typeof SLEEK_CONFIG === 'undefined' || typeof SLEEK_CONFIG.GOOGLE_MAPS_API_KEY === 'undefined') {
		console.log('No Google Maps API key found');

		return;
	}

	// When Google Maps has loaded
	gmInit(function () {
		$('.google-map').each(function () {
			this.sleekMap = new SleekMap(this, SleekMap.parseMapEl(this));
		});
	});
})();
