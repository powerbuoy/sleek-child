(function () {
	'use strict';

	var $ = require('jquery');
	var Siema = require('siema');

	// Wrap WP galleries in [data-slideshow] (TODO: Should be optional!)
	$('div.gallery').each(function () {
		var numCols = 1;
		var gallery = $(this).addClass('is-slideshow');
		var colClass = gallery.attr('class').split(' ').filter(function (val) {
			return val.indexOf('gallery-columns-') != -1;
		});

		if (colClass && colClass.length) {
			numCols = colClass[0].replace('gallery-columns-', '');
		}

		gallery.wrapInner('<div data-slideshow="' + numCols + '"></div>');
	});

	// Init slideshows
	$('[data-slideshow]').each(function () {
		var wrap = $(this);
		var slides = wrap.find('> *');
		var totalSlides = slides.length;
		var numSlides = wrap.attr('data-slideshow');
		var prev = $('<a role="button" class="slideshow-prev"></a>').appendTo(wrap.parent());
		var next = $('<a role="button" class="slideshow-next"></a>').appendTo(wrap.parent());
		var pages = $('<nav class="slideshow-pages"></nav>');

		numSlides = numSlides ? parseInt(numSlides) : 1;

		// Siema config
		var config = {
			selector: this,
			duration: 400,
			easing: 'ease-out',
			perPage: {
				600: numSlides > 2 ? 2 : 1,
				1080: numSlides
			},
			startIndex: 0,
			draggable: true,
			multipleDrag: true,
			threshold: 20,
			loop: true,
			rtl: false
		};

		// Hook up prev/next
		prev.on('click', function (e) {
			e.preventDefault();
			slider.prev();
		});

		next.on('click', function (e) {
			e.preventDefault();
			slider.next();
		});

		// Hook up pages
		var pagesHTML = '';

		for (var i = 0; i < totalSlides; i++) {
			pagesHTML += '<a role="button" data-slideshow-page="' + i + '">' + (i + 1) + '</a>';
		}

		pages.html(pagesHTML).appendTo(wrap.parent());

		pages.on('click', 'a', function (e) {
			e.preventDefault();
			slider.goTo(parseInt(this.getAttribute('data-slideshow-page')));
		});

		config.onInit = config.onChange = function () {
			// BUG: https://github.com/pawelgrzybek/siema/issues/151
			var currentSlide = this.currentSlide;

			if (currentSlide < 0) {
				currentSlide = totalSlides + currentSlide;
			}

			pages.find('a').removeClass('active');
			pages.find('[data-slideshow-page="' + currentSlide + '"]').addClass('active');
		};

		// Create slideshow
		var slider = new Siema(config);
	});
})();
