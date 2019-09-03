(function () {
	'use strict';

	var $ = require('jquery');
	var Glide = require('@glidejs/glide');

	// Wrap WP galleries in [data-slideshow] (TODO: Should be optional!)
	$('div.gallery').each(function () {
		var numCols = 1;
		var gallery = $(this).addClass('is-slideshow');
		var colClass = gallery.attr('class').split(' ').filter(function (val) {
			return val.indexOf('gallery--cols-') != -1;
		});

		if (colClass && colClass.length) {
			numCols = colClass[0].replace('gallery--cols-', '');
		}

		gallery.wrapInner('<div data-slideshow="' + numCols + '"></div>');
	});

	// Modify all [data-slideshow] to work with Glide
	$('[data-slideshow]').each(function () {
		// Wrap [data-slideshow] in needed divs
		var wrap = $(this);
		var perPage = wrap.data('slideshow') || 1;
		var outer = $('<div class="glide"><div class="glide__track" data-glide-el="track"></div></div>').insertBefore(wrap);
		var track = outer.find('div.glide__track');

		wrap.addClass('glide__slides').children().addClass('glide__slide');
		track.append(wrap);

		// Create buttons
		var buttons = $('<div data-glide-el="controls"><a data-glide-dir="<" class="slideshow-prev">&larr;</a><a data-glide-dir=">" class="slideshow-next">&rarr;</a></div>').appendTo(outer);
		var nav = '<div data-glide-el="controls[nav]" class="slideshow-pages">';

		wrap.children().each(function (i) {
			nav += '<a data-glide-dir="=' + i + '">' + i + '</a>';
		});

		nav += '</div>';

		nav = $(nav).appendTo(outer);

		// Move potential classes
		if (wrap.is('.slideshow--white')) {
			outer.addClass('slideshow--white');
		}

		// Initialize Glide
		new Glide(outer[0], {
			type: 'carousel',
			perView: perPage,
			focusAt: 'center'
		}).mount();
	});
})();
