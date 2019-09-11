(function () {
	'use strict';

	if (typeof SLEEK_COOKIE_CONSENT == 'undefined') {
		return;
	}

	var acceptsCookies = window.localStorage.getItem('cookie_consent');

	if (!acceptsCookies) {
		var el = document.createElement('div');

		el.id = 'cookie-consent';
		el.innerHTML = SLEEK_COOKIE_CONSENT;

		document.body.appendChild(el);

		var close = el.querySelector('a.close');

		if (close) {
			close.addEventListener('click', function (e) {
				e.preventDefault();
				window.localStorage.setItem('cookie_consent', true);
				el.parentNode.removeChild(el);
			});
		}
	}
})();
