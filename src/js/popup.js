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
	$('.popup, .popup__close, [data-close-popup]').click(function (e) {
		// Only direct clicks
		if (e.target == this) {
			e.preventDefault();
			closePopups();
		}
	});

	// And esc
	$(window).keyup(function (e) {
		if (e.keyCode == 27) {
			closePopups();
		}
	});
})();
