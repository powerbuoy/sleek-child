(function () {
	'use strict';

	var $ = require('jquery');

	require('toggle-hash');

	$('[data-toggle-hash]').each(function () {
		var t = $(this);
		var tText = t.text();
		var ttText = t.attr('data-toggle-hash');

		ttText = ttText ? ttText : tText;

		t.toggleHash({
			onAdd: function (hash) {
				t.text(ttText);
				$(document.documentElement).addClass('hash-active').addClass('hash-active-' + hash.substr(1));
			},
			onRemove: function (hash) {
				t.text(tText);
				$(document.documentElement).removeClass('hash-active').removeClass('hash-active-' + hash.substr(1));
			},
		});
	});
})();
