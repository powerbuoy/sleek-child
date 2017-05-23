(function () {
	'use strict';

	var $ = require('jquery');

	require('slick-carousel');

	$('[data-slideshow]').each(function () {
		var wrap = $(this);
		var id = wrap.attr('id');
		var nav = $('[data-slideshow-nav="' + id + '"]');
		var slides = wrap.find('> *');
		var numSlides = wrap.attr('data-slideshow');
			numSlides = numSlides ? parseInt(numSlides) : 1;

		if (slides.length > numSlides) {
			wrap.slick({
				dots: true,
				arrows: true,
				slidesToShow: numSlides,
				slidesToScroll: numSlides,
				infinite: true,
				speed: 400,
				autoplay: false,
				adaptiveHeight: true,
				prevArrow: '<a role="button" class="slick-prev icon-left"></a>',
				nextArrow: '<a role="button" class="slick-next icon-right"></a>'
			});

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
