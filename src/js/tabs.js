(function () {
	'use strict';

	var $ = require('jquery');
	var velocity = require('velocity-animate');

	// TODO: Update hash on tab change + set active tab on page load and hash change
	$('[data-tabs]').each(function () {
		var tabs = $(this);
		var tabContent = false;

		// Find the tab content container by looking at the first tab target
		var firstTabTarget = tabs.find('a[href^="#"]').eq(0);

		firstTabTarget = firstTabTarget.attr('href');
		firstTabTarget = $(firstTabTarget);

		if (firstTabTarget.length) {
			tabContent = firstTabTarget.parents('[data-tab-content]').eq(0);
		}

		// Only continue if we've found the tabContent
		if (!(tabContent && tabContent.length)) {
			return this;
		}

		// Sets the active tab
		var setActiveTab = function (name, duration) {
			duration = typeof duration == 'undefined' ? 200 : duration;
			name = name.indexOf('#') === 0 ? name : '#' + name;

			var target = tabContent.find(name);

			if (target.length) {
				// Scroll to new tab
				velocity(target[0], 'scroll', {
					duration: duration,
					container: tabContent[0],
					axis: 'x'
				});

				// Update nav
				tabs.find('.active').removeClass('active');
				tabs.find('a[href="' + name + '"]').addClass('active');
			}
		};

		// Set first tab to active
		setActiveTab(firstTabTarget.attr('id'));

		// Hook up clicks
		tabs.on('click', 'a', function (e) {
			e.preventDefault();

			setActiveTab($(this).attr('href'));
		});

		// On resize - scroll back to the active tab
		$(window).on('resize', function () {
			var active = tabs.find('.active').attr('href');

			setActiveTab(active, 0);
		});
	});
})();
