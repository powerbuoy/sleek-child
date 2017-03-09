(function () {
	'use strict';

	var $ = require('jquery');

	// Closes all popups by clearing hash
	var closePopups = function () {
		var st = $(document).scrollTop();

		window.location.hash = '#'; // Bump :target

		$(document).scrollTop(st);

		if ('replaceState' in window.history) {
			window.history.pushState('', document.title, window.location.pathname + window.location.search);
		}
	};

	// Opens popup with id id
	var openPopup = function (id) {
		var st = $(document).scrollTop();

		window.location.hash = '#' + id;

		$(document).scrollTop(st);
	};

	// Hook up close clicks
	$('.popup, .popup__close, [data-close-popup]').click(function (e) {
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

	// Automatically open these poups on pageload
	var autoOpen = $('[data-popup-auto-open]');

	if (autoOpen.length) {
		var autoOpenId = autoOpen.eq(0).attr('id'); // We can only open one popup (the first one)
		var alreadyBeenOpen = window.localStorage.getItem('popup_auto_open_' + autoOpenId); // Only open it once

		if (!alreadyBeenOpen) {
			window.localStorage.setItem('popup_auto_open_' + autoOpenId, true);

			openPopup(autoOpenId);
		}
	}
})();
