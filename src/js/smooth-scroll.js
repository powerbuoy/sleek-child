(function () {
	'use strict';

	var $ = require('jquery');
	var jump = require('jump.js');
	var jumpConf = {
		duration: 1200,
		offset: 0
	};

	$('[data-smooth-scroll]').each(function () {
		// TODO: Add support for links that point to different pages#hash
		var trigger = $(this);
		var href = trigger.attr('href');
		var targetId = href.substr(href.indexOf('#')).substr(1);
		var target = document.getElementById(targetId);

		if (target) {
			trigger.click(function (e) {
				e.stopPropagation();
				e.preventDefault();

				var st = $(document).scrollTop();

				window.location.hash = '#' + targetId; // Bump :target

				$(document).scrollTop(st);

				jump(target, jumpConf);
			});
		}
		else if (targetId == 'top') {
			trigger.click(function (e) {
				e.stopPropagation();
				e.preventDefault();

				jump(document.body, jumpConf);
			});
		}
	});

	// If a hash is set on page load - scroll there (TODO: Watch for popups?? #header? etc)
/*	if (window.location.hash) {
		var target = document.getElementById(window.location.hash.substr(1));

		if (target) {
			jump(target, jumpConf);
		}
	} */

	// If on home page, make logo scroll to top
	if ($('html.home').length) {
		$('.site-logo').click(function (e) {
			e.preventDefault();

			jump(document.body, jumpConf);

			window.location.hash = '#'; // Bump :target

			if ('replaceState' in window.history) {
				window.history.pushState('', document.title, window.location.pathname + window.location.search);
			}
		});
	}
})();
