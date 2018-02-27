(function () {
	'use strict';

	var acceptsCookies = window.localStorage.getItem('accepts_cookies');
	var cookieMessage = 'We use cookies to bring you the best possible experience when browsing our site. <a href="https://cookiesandyou.com/" target="_blank">Read more about cookies</a> | <a href="#" class=" close">Accept</a>';

	if (!acceptsCookies) {
		var warning = document.createElement('div');

		warning.id = 'cookie-warning';
		warning.innerHTML = cookieMessage;

		warning.style.background = 'rgba(255, 255, 255, .95)';
		warning.style.position = 'fixed';
		warning.style.left = 0;
		warning.style.right = 0;
		warning.style.bottom = 0;
		warning.style.zIndex = 1000;
		warning.style.padding = '1.5rem';
		warning.style.textAlign = 'center';

		document.body.appendChild(warning);

		warning.querySelector('a.close').addEventListener('click', function (e) {
			e.preventDefault();
			window.localStorage.setItem('accepts_cookies', true);
			warning.parentNode.removeChild(warning);
		});
	}
})();
