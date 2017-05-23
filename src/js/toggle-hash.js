(function () {
	'use strict';

	var $ = require('jquery');

	require('toggle-hash');

	$('[data-toggle-hash]').toggleHash({
		onAdd: function (hash) {
			$(document.documentElement).addClass('hash-active').addClass('hash-active-' + hash.substr(1));
		},
		onRemove: function (hash) {
			$(document.documentElement).removeClass('hash-active').removeClass('hash-active-' + hash.substr(1));
		},
	});
})();
