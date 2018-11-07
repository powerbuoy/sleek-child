(function () {
	'use strict';

	var $ = require('jquery');

	// Closes all popups by clearing hash
	var closePopups = function () {
		var st = $(document).scrollTop(); // Store scroll position
		window.location.hash = '#'; // Bump CSS :target styling
		$(document).scrollTop(st); // Restore scroll position

		// Update URL
		if ('replaceState' in window.history) {
			window.history.pushState('', document.title, window.location.pathname + window.location.search);
		}
	};

	// Hook up close clicks
	$('.popup, .popup__close').click(function (e) {
		// Only direct clicks
		if (e.target == this) {
			e.preventDefault();
			closePopups();
		}
	});

	// Popup templates
	$('[data-popup-template]').click(function () {
		var clicked = $(this);
		var popupId = clicked.attr('href').substr(1);
		var templateId = clicked.attr('data-popup-template');

		$('#' + popupId).find('div.popup-template-content').html($('#' + templateId).html());
	});
})();
