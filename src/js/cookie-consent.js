(function () {
	'use strict';

	if (!(SLEEK_CHILD_CONFIG && SLEEK_CHILD_CONFIG.COOKIE_CONSENT)) {
		return;
	}

	var acceptsCookies = window.localStorage.getItem('cookie_consent');
	var cookieMessage = SLEEK_CHILD_CONFIG.COOKIE_CONSENT;

	if (!acceptsCookies) {
		var el = document.createElement('div');

		el.id = 'cookie-consent';
		el.innerHTML = cookieMessage;

		document.body.appendChild(el);

		el.querySelector('a.close').addEventListener('click', function (e) {
			e.preventDefault();
			window.localStorage.setItem('cookie_consent', true);
			el.parentNode.removeChild(el);
		});
	}
})();
