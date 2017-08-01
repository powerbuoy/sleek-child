(function () {
	'use strict';

	var $ = require('jquery');

	require('slick-carousel');

	// Wrap WP galleries in [data-slideshow] (TODO: Should be optional!)
	$('div.gallery').each(function () {
		var gallery = $(this).addClass('is-slideshow');
		var colClass = gallery.attr('class').split(' ').filter(function (val) {
			return val.indexOf('gallery-columns-') != -1;
		});
		var numCols = 1;

		if (colClass && colClass.length) {
			numCols = colClass[0].replace('gallery-columns-', '');
		}

		gallery.wrapInner('<div data-slideshow="' + numCols + '"></div>');
	});

	// Find every [data-slideshow]
	$('[data-slideshow]').each(function () {
		var wrap = $(this);
		var id = wrap.attr('id');
		var slides = wrap.find('> *');
		var numSlides = wrap.attr('data-slideshow');
			numSlides = numSlides ? parseInt(numSlides) : 1;
		var config = {
			dots: true,
			arrows: false,
			slidesToShow: numSlides,
			slidesToScroll: numSlides,
			infinite: true,
			speed: 400,
			autoplay: false,
		//	adaptiveHeight: true,
			prevArrow: '<a role="button" class="slick-prev icon-left"></a>',
			nextArrow: '<a role="button" class="slick-next icon-right"></a>'
		};

		// Init slideshow
		if (slides.length > numSlides) {
			wrap.slick(config);
		}
	});
})();
