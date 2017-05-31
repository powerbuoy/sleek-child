(function () {
	'use strict';

	var $ = require('jquery');

	require('slick-carousel');

	// Wrap WP galleries in [data-slideshow]
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

	// NOTE: These should match the SASS variables in config.scss
	var siteWidthMax = 1360;
	var siteWidth = 90;
	var bpMedium = 760;

	var sitePadding = (100 - siteWidth) / 2 + '%';
	var siteWidthReached = (siteWidthMax * 100) / siteWidth;

	// Find every [data-slideshow]
	$('[data-slideshow]').each(function () {
		var wrap = $(this);
		var id = wrap.attr('id');
		var nav = $('[data-slideshow-nav="' + id + '"]');
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

		// Center mode!
		if (wrap.is('[data-slideshow-center-mode]')) {
			config.centerMode = true;
			config.centerPadding = (($(window).width() - siteWidthMax) / 2) + 'px';
			config.slidesToShow = numSlides;

			// In low res
			config.responsive = [
				{
					breakpoint: bpMedium,
					settings: {
						slidesToShow: 1,
						centerPadding: sitePadding
					}
				},
				{
					breakpoint: siteWidthReached,
					settings: {
						slidesToShow: numSlides,
						centerPadding: sitePadding
					}
				}
			];

			// On resize - re-calculate centerPadding
			$(window).on('resize', function () {
				if (window.matchMedia('(min-width: ' + siteWidthReached + 'px)').matches) {
					wrap.slick('slickSetOption', 'centerPadding', (($(window).width() - siteWidthMax) / 2) + 'px');
				}
				else {
					wrap.slick('slickSetOption', 'centerPadding', sitePadding);
				}
			});
		}

		// Init slideshow
		if (slides.length > numSlides) {
			wrap.slick(config);

			if (nav.length) {
				// Select the first
				nav.find('a').eq(0).addClass('active');

				// Select on change
				wrap.on('afterChange', function (e, slick, i) {
					nav.find('a').removeClass('active').eq(i).addClass('active');
				});

				// Change on click
				nav.find('a').on('click', function (e) {
					e.preventDefault();

					wrap.slick('slickGoTo', nav.find('a').index(this));
				});
			}
		}
	});
})();
